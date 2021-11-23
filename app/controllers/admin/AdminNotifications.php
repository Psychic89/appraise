<?php

namespace Altum\Controllers;

use Altum\Alerts;
use Altum\Middlewares\Csrf;

class AdminNotifications extends Controller {

    public function index() {

        /* Prepare the filtering system */
        $filters = (new \Altum\Filters(['user_id', 'campaign_id', 'type', 'is_enabled'], ['name'], ['datetime', 'name']));

        /* Prepare the paginator */
        $total_rows = database()->query("SELECT COUNT(*) AS `total` FROM `notifications` WHERE 1 = 1 {$filters->get_sql_where()}")->fetch_object()->total ?? 0;
        $paginator = (new \Altum\Paginator($total_rows, $filters->get_results_per_page(), $_GET['page'] ?? 1, url('admin/notifications?' . $filters->get_get() . '&page=%d')));

        /* Get the data */
        $notifications = [];
        $notifications_result = database()->query("
            SELECT
                `notifications`.*, `users`.`name` AS `user_name`, `users`.`email` AS `user_email`
            FROM
                `notifications`
            LEFT JOIN
                `users` ON `notifications`.`user_id` = `users`.`user_id`
            WHERE
                1 = 1
                {$filters->get_sql_where('notifications')}
                {$filters->get_sql_order_by('notifications')}

            {$paginator->get_sql_limit()}
        ");
        while($row = $notifications_result->fetch_object()) {
            $notifications[] = $row;
        }

        /* Export handler */
        process_export_csv($notifications, 'include', ['notification_id', 'campaign_id', 'user_id', 'name', 'type', 'is_enabled', 'last_datetime', 'datetime'], sprintf(language()->admin_notifications->title));
        process_export_json($notifications, 'include', ['notification_id', 'campaign_id', 'user_id', 'name', 'type', 'is_enabled', 'last_datetime', 'datetime'], sprintf(language()->admin_notifications->title));

        /* Prepare the pagination view */
        $pagination = (new \Altum\Views\View('partials/pagination', (array) $this))->run(['paginator' => $paginator]);

        /* Delete Modal */
        $view = new \Altum\Views\View('admin/notifications/notification_delete_modal', (array) $this);
        \Altum\Event::add_content($view->run(), 'modals');

        /* Main View */
        $data = [
            'notifications' => $notifications,
            'filters' => $filters,
            'pagination' => $pagination
        ];

        $view = new \Altum\Views\View('admin/notifications/index', (array) $this);

        $this->add_view_content('content', $view->run($data));

    }

    public function delete() {

        $notification_id = isset($this->params[0]) ? (int) $this->params[0] : null;

        if(!Csrf::check('global_token')) {
            Alerts::add_error(language()->global->error_message->invalid_csrf_token);
        }

        if(!$notification = db()->where('notification_id', $notification_id)->getOne('notifications', ['notification_id'])) {
            redirect('admin/notifications');
        }

        if(!Alerts::has_field_errors() && !Alerts::has_errors()) {

            /* Delete the notification */
            db()->where('notification_id', $notification->notification_id)->delete('notifications');

            /* Clear the cache */
            \Altum\Cache::$adapter->deleteItemsByTag('notification_id=' . $notification->notification_id);

            /* Set a nice success message */
            Alerts::add_success(language()->admin_notification_delete_modal->success_message);

        }

        redirect('admin/notifications');
    }

}
