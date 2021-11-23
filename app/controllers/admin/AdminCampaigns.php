<?php

namespace Altum\Controllers;

use Altum\Alerts;
use Altum\Middlewares\Csrf;

class AdminCampaigns extends Controller {

    public function index() {

        /* Prepare the filtering system */
        $filters = (new \Altum\Filters(['user_id', 'is_enabled'], ['name', 'domain'], ['datetime', 'name']));

        /* Prepare the paginator */
        $total_rows = database()->query("SELECT COUNT(*) AS `total` FROM `campaigns` WHERE 1 = 1 {$filters->get_sql_where()}")->fetch_object()->total ?? 0;
        $paginator = (new \Altum\Paginator($total_rows, $filters->get_results_per_page(), $_GET['page'] ?? 1, url('admin/campaigns?' . $filters->get_get() . '&page=%d')));

        /* Get the data */
        $campaigns = [];
        $campaigns_result = database()->query("
            SELECT
                `campaigns`.*, `users`.`name` AS `user_name`, `users`.`email` AS `user_email`
            FROM
                `campaigns`
            LEFT JOIN
                `users` ON `campaigns`.`user_id` = `users`.`user_id`
            WHERE
                1 = 1
                {$filters->get_sql_where('campaigns')}
                {$filters->get_sql_order_by('campaigns')}

            {$paginator->get_sql_limit()}
        ");
        while($row = $campaigns_result->fetch_object()) {
            $campaigns[] = $row;
        }

        /* Export handler */
        process_export_csv($campaigns, 'include', ['campaign_id', 'user_id', 'pixel_key', 'name', 'domain', 'is_enabled', 'last_datetime', 'datetime'], sprintf(language()->admin_campaigns->title));
        process_export_json($campaigns, 'include', ['campaign_id', 'user_id', 'pixel_key', 'name', 'domain', 'is_enabled', 'last_datetime', 'datetime'], sprintf(language()->admin_campaigns->title));

        /* Prepare the pagination view */
        $pagination = (new \Altum\Views\View('partials/pagination', (array) $this))->run(['paginator' => $paginator]);

        /* Delete Modal */
        $view = new \Altum\Views\View('admin/campaigns/campaign_delete_modal', (array) $this);
        \Altum\Event::add_content($view->run(), 'modals');

        /* Main View */
        $data = [
            'campaigns' => $campaigns,
            'filters' => $filters,
            'pagination' => $pagination
        ];

        $view = new \Altum\Views\View('admin/campaigns/index', (array) $this);

        $this->add_view_content('content', $view->run($data));

    }

    public function delete() {

        $campaign_id = isset($this->params[0]) ? (int) $this->params[0] : null;

        if(!Csrf::check('global_token')) {
            Alerts::add_error(language()->global->error_message->invalid_csrf_token);
        }

        if(!$campaign = db()->where('campaign_id', $campaign_id)->getOne('campaigns', ['campaign_id'])) {
            redirect('admin/campaigns');
        }

        if(!Alerts::has_field_errors() && !Alerts::has_errors()) {

            /* Delete the campaign */
            db()->where('campaign_id', $campaign->campaign_id)->delete('campaigns');

            /* Clear the cache */
            \Altum\Cache::$adapter->deleteItemsByTag('campaign_id=' . $campaign->campaign_id);

            /* Set a nice success message */
            Alerts::add_success(language()->admin_campaign_delete_modal->success_message);

        }

        redirect('admin/campaigns');
    }

}
