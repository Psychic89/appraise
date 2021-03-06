<?php

namespace Altum\Controllers;

use Altum\Alerts;
use Altum\Database\Database;
use Altum\Middlewares\Csrf;

class AdminPlanCreate extends Controller {

    public function index() {

        if(in_array(settings()->license->type, ['Extended License', 'extended'])) {
            /* Get the available taxes from the system */
            $taxes = db()->get('taxes', null, ['tax_id', 'internal_name', 'name', 'description']);
        }

        if(!empty($_POST)) {
            /* Filter some the variables */
            $_POST['name'] = Database::clean_string($_POST['name']);
            $_POST['monthly_price'] = (float) $_POST['monthly_price'];
            $_POST['annual_price'] = (float) $_POST['annual_price'];
            $_POST['lifetime_price'] = (float) $_POST['lifetime_price'];

            /* Determine the enabled notifications */
            $enabled_notifications = [];

            foreach(array_keys(\Altum\Notification::get_config()) as $notification) {
                $enabled_notifications[$notification] = (bool) isset($_POST['enabled_notifications']) && in_array($notification, $_POST['enabled_notifications']);
            }

            $_POST['settings'] = json_encode([
                'no_ads' => (bool) isset($_POST['no_ads']),
                'removable_branding' => (bool) isset($_POST['removable_branding']),
                'custom_branding' => (bool) isset($_POST['custom_branding']),
                'api_is_enabled' => (bool) isset($_POST['api_is_enabled']),
                'campaigns_limit' => (int) $_POST['campaigns_limit'],
                'notifications_limit' => (int) $_POST['notifications_limit'],
                'notifications_impressions_limit' => (int) $_POST['notifications_impressions_limit'],
                'enabled_notifications' => $enabled_notifications
            ]);

            $_POST['status'] = (int) $_POST['status'];
            $_POST['order'] = (int) $_POST['order'];
            $_POST['taxes_ids'] = json_encode(array_keys($_POST['taxes_ids'] ?? []));

            if(!Csrf::check()) {
                Alerts::add_error(language()->global->error_message->invalid_csrf_token);
            }

            if(!Alerts::has_field_errors() && !Alerts::has_errors()) {

                /* Database query */
                db()->insert('plans', [
                    'name' => $_POST['name'],
                    'monthly_price' => $_POST['monthly_price'],
                    'annual_price' => $_POST['annual_price'],
                    'lifetime_price' => $_POST['lifetime_price'],
                    'settings' => $_POST['settings'],
                    'taxes_ids' => $_POST['taxes_ids'],
                    'status' => $_POST['status'],
                    'order' => $_POST['order'],
                    'date' => \Altum\Date::$date,
                ]);

                /* Set a nice success message */
                Alerts::add_success(language()->global->success_message->basic);

                redirect('admin/plans');
            }
        }


        /* Main View */
        $data = [
            'taxes' => $taxes ?? null
        ];

        $view = new \Altum\Views\View('admin/plan-create/index', (array) $this);

        $this->add_view_content('content', $view->run($data));

    }

}
