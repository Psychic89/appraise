<?php

namespace Altum\Controllers;


use Altum\Meta;

class Index extends Controller {

    public function index() {

        /* Custom index redirect if set */
        if(!empty(settings()->index_url)) {
            header('Location: ' . settings()->index_url);
            die();
        }

        $total_track_notifications = database()->query("SELECT MAX(`id`) AS `total` FROM `track_notifications`")->fetch_object()->total ?? 0;
        $total_notifications = database()->query("SELECT MAX(`notification_id`) AS `total` FROM `notifications`")->fetch_object()->total ?? 0;

        /* Plans View */
        $data = [
            'simple_plan_settings' => [
                'no_ads',
                'removable_branding',
                'custom_branding',
            ],
        ];

        $view = new \Altum\Views\View('partials/plans', (array) $this);

        $this->add_view_content('plans', $view->run($data));

        /* Opengraph image */
        if(settings()->opengraph) {
            Meta::set_social_url(SITE_URL);
            Meta::set_social_description(language()->index->meta_description);
            Meta::set_social_image(UPLOADS_FULL_URL . 'opengraph/' .settings()->opengraph);
        }

        /* Main View */
        $data = [
            'notifications' => \Altum\Notification::get_config(),
            'total_track_notifications' => $total_track_notifications,
            'total_notifications' => $total_notifications
        ];

        $view = new \Altum\Views\View('index/index', (array) $this);

        $this->add_view_content('content', $view->run($data));

    }

}
