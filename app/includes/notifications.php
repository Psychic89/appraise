<?php

/* Check and get Pro notifications pack */
$pro_notifications = file_exists(ROOT_PATH . 'app/includes/pro_notifications.php') ? include ROOT_PATH . 'app/includes/pro_notifications.php' : [];

/* Current available type of notifications and its defaults */
return array_merge(
    $pro_notifications,
    [
        'INFORMATIONAL' => [
            'title' => language()->notification->informational->title_default,
            'description' => language()->notification->informational->description_default,
            'image' => language()->notification->informational->image_default,
            'url'   => '',
            'url_new_tab' => true,

            'trigger_all_pages' => true,
            'triggers' => [],
            'display_trigger' => 'delay',
            'display_trigger_value' => 2,
            'display_frequency' => 'all_time',
            'display_mobile' => true,
            'display_desktop' => true,

            'display_duration' => 5,
            'display_position' => 'bottom_left',
            'display_close_button' => true,
            'display_branding' => true,

            'title_color' => '#000',
            'description_color' => '#000',
            'background_color' => '#fff',
            'background_pattern' => false,
            'background_pattern_svg' => '',

            'border_radius' => 'rounded',
            'border_color' => '#000',
            'border_width' => 0,
            'shadow'        => true,

            'on_animation' => 'fadeIn',
            'off_animation' => 'fadeOut'
        ],

        'COUPON' => [
            'title' => language()->notification->coupon->title_default,
            'description' => language()->notification->coupon->description_default,
            'image' => language()->notification->coupon->image_default,
            'coupon_code' => language()->notification->coupon->coupon_code_default,
            'button_url'   => '',
            'button_text'  => language()->notification->coupon->button_text_default,
            'footer_text'  => language()->notification->coupon->footer_text_default,

            'trigger_all_pages' => true,
            'triggers' => [],
            'display_trigger' => 'delay',
            'display_trigger_value' => 2,
            'display_frequency' => 'all_time',
            'display_mobile' => true,
            'display_desktop' => true,

            'display_duration' => 5,
            'display_position' => 'bottom_left',
            'display_close_button' => true,
            'display_branding' => true,

            'title_color' => '#000',
            'description_color' => '#000',
            'background_color' => '#fff',
            'background_pattern' => false,
            'background_pattern_svg' => '',
            'button_background_color' => '#000',
            'button_color' => '#fff',
            'border_radius' => 'rounded',
            'border_color' => '#000',
            'border_width' => 0,
            'shadow'        => true,

            'on_animation' => 'fadeIn',
            'off_animation' => 'fadeOut',
        ],

        'LIVE_COUNTER' => [
            'description' => language()->notification->live_counter->description_default,
            'last_activity' => 15,
            'url'   => '',
            'url_new_tab' => true,

            'trigger_all_pages' => true,
            'triggers' => [],
            'display_trigger' => 'delay',
            'display_trigger_value' => 2,
            'display_duration' => 5,
            'display_position' => 'bottom_left',
            'display_minimum_activity' => 0,
            'display_frequency' => 'all_time',
            'display_close_button' => true,
            'display_branding' => true,
            'display_mobile' => true,
            'display_desktop' => true,

            'number_color' => '#fff',
            'number_background_color' => '#000',
            'description_color' => '#000',
            'background_color' => '#fff',
            'background_pattern' => false,
            'background_pattern_svg' => '',
            'border_radius' => 'rounded',
            'border_color' => '#000',
            'border_width' => 0,
            'shadow'        => true,

            'on_animation' => 'fadeIn',
            'off_animation' => 'fadeOut',
            'pulse_background_color' => '#17bf21',
        ],

        'EMAIL_COLLECTOR' => [
            'title' => language()->notification->email_collector->title_default,
            'description' => language()->notification->email_collector->description_default,
            'email_placeholder' => language()->notification->email_collector->email_placeholder_default,
            'button_text' => language()->notification->email_collector->button_text_default,
            'show_agreement' => false,
            'agreement_text' => language()->notification->email_collector->agreement_text_default,
            'agreement_url' => '',
            'thank_you_url' => '',

            'trigger_all_pages' => true,
            'triggers' => [],
            'display_trigger' => 'delay',
            'display_trigger_value' => 2,
            'display_frequency' => 'all_time',
            'display_mobile' => true,
            'display_desktop' => true,

            'display_duration' => 5,
            'display_position' => 'bottom_left',
            'display_close_button' => true,
            'display_branding' => true,

            'title_color' => '#000',
            'description_color' => '#000',
            'background_color' => '#fff',
            'background_pattern' => false,
            'background_pattern_svg' => '',
            'button_background_color' => '#272727',
            'button_color' => '#fff',
            'border_radius' => 'rounded',
            'border_color' => '#000',
            'border_width' => 0,
            'shadow'        => true,

            'on_animation' => 'fadeIn',
            'off_animation' => 'fadeOut',

            'data_send_is_enabled' => 0,
            'data_send_webhook' => '',
            'data_send_email' => '',
        ],

        'LATEST_CONVERSION' => [
            'title' => language()->notification->latest_conversion->title_default,
            'description' => language()->notification->latest_conversion->description_default,
            'image' => language()->notification->latest_conversion->image_default,
            'url'   => '',
            'url_new_tab' => true,
            'conversions_count' => 1,

            'trigger_all_pages' => true,
            'triggers' => [],
            'display_trigger' => 'delay',
            'display_trigger_value' => 2,
            'display_frequency' => 'all_time',
            'display_mobile' => true,
            'display_desktop' => true,

            'display_minimum_activity' => 0,
            'display_duration' => 5,
            'display_position' => 'bottom_left',
            'display_close_button' => true,
            'display_branding' => true,

            'title_color' => '#000',
            'description_color' => '#000',
            'background_color' => '#fff',
            'background_pattern' => false,
            'background_pattern_svg' => '',
            'border_radius' => 'rounded',
            'border_color' => '#000',
            'border_width' => 0,
            'shadow'        => true,

            'on_animation' => 'fadeIn',
            'off_animation' => 'fadeOut',

            'data_trigger_auto' => false,
            'data_triggers_auto' => []
        ],

        'CONVERSIONS_COUNTER' => [
            'title' => language()->notification->conversions_counter->title_default,
            'last_activity' => 2,
            'url' => '',
            'url_new_tab' => true,

            'trigger_all_pages' => true,
            'triggers' => [],
            'display_trigger' => 'delay',
            'display_trigger_value' => 2,
            'display_duration' => 5,
            'display_position' => 'bottom_left',
            'display_minimum_activity' => 0,
            'display_frequency' => 'all_time',
            'display_close_button' => false,
            'display_branding' => true,
            'display_mobile' => true,
            'display_desktop' => true,

            'number_color' => '#fff',
            'number_background_color' => '#000',
            'title_color' => '#000',
            'background_color' => '#fff',
            'background_pattern' => false,
            'background_pattern_svg' => '',
            'border_radius' => 'rounded',
            'border_color' => '#000',
            'border_width' => 0,
            'shadow'        => true,

            'on_animation' => 'fadeIn',
            'off_animation' => 'fadeOut',

            'data_trigger_auto' => false,
            'data_triggers_auto' => []
        ],

        'VIDEO' => [
            'title' => language()->notification->video->title_default,
            'video' => '',
            'button_url'   => '',
            'button_text'  => language()->notification->video->button_text_default,

            'trigger_all_pages' => true,
            'triggers' => [],
            'display_trigger' => 'delay',
            'display_trigger_value' => 2,
            'display_frequency' => 'all_time',
            'display_mobile' => true,
            'display_desktop' => true,

            'display_duration' => 5,
            'display_position' => 'bottom_left',
            'display_close_button' => true,
            'display_branding' => true,

            'title_color' => '#000',
            'background_color' => '#fff',
            'background_pattern' => false,
            'background_pattern_svg' => '',
            'button_background_color' => '#000',
            'button_color' => '#fff',
            'border_radius' => 'rounded',
            'border_color' => '#000',
            'border_width' => 0,
            'shadow'        => true,

            'on_animation' => 'fadeIn',
            'off_animation' => 'fadeOut',
        ],

        'SOCIAL_SHARE' => [
            'title' => language()->notification->social_share->title_default,
            'description' => language()->notification->social_share->description_default,
            'share_url'   => '',
            'share_facebook' => true,
            'share_twitter' => true,
            'share_linkedin' => true,

            'trigger_all_pages' => true,
            'triggers' => [],
            'display_trigger' => 'delay',
            'display_trigger_value' => 2,
            'display_frequency' => 'all_time',
            'display_mobile' => true,
            'display_desktop' => true,

            'display_duration' => 5,
            'display_position' => 'bottom_left',
            'display_close_button' => true,
            'display_branding' => true,

            'title_color' => '#000',
            'description_color' => '#000',
            'background_color' => '#fff',
            'background_pattern' => false,
            'background_pattern_svg' => '',
            'border_radius' => 'rounded',
            'border_color' => '#000',
            'border_width' => 0,
            'shadow'        => true,

            'on_animation' => 'fadeIn',
            'off_animation' => 'fadeOut',
        ],

        'RANDOM_REVIEW' => [
            'url'   => '',
            'url_new_tab' => true,
            'reviews_count' => 1,
            'title' => language()->notification->random_review->title_default,
            'description' => language()->notification->random_review->description_default,
            'image' => language()->notification->random_review->image_default,
            'stars' => 5,

            'trigger_all_pages' => true,
            'triggers' => [],
            'display_trigger' => 'delay',
            'display_trigger_value' => 2,
            'display_frequency' => 'all_time',
            'display_mobile' => true,
            'display_desktop' => true,

            'display_duration' => 5,
            'display_position' => 'bottom_left',
            'display_close_button' => false,
            'display_branding' => true,

            'title_color' => '#000',
            'description_color' => '#000',
            'background_color' => '#fff',
            'background_pattern' => false,
            'background_pattern_svg' => '',
            'border_radius' => 'rounded',
            'border_color' => '#000',
            'border_width' => 0,
            'shadow'        => true,

            'on_animation' => 'fadeIn',
            'off_animation' => 'fadeOut',
        ],

        'EMOJI_FEEDBACK' => [
            'title' => language()->notification->emoji_feedback->title_default,
            'show_angry' => true,
            'show_sad' => true,
            'show_neutral' => true,
            'show_happy' => true,
            'show_excited' => true,

            'trigger_all_pages' => true,
            'triggers' => [],
            'display_trigger' => 'delay',
            'display_trigger_value' => 2,
            'display_frequency' => 'all_time',
            'display_mobile' => true,
            'display_desktop' => true,

            'display_duration' => 5,
            'display_position' => 'bottom_left',
            'display_close_button' => false,
            'display_branding' => true,

            'title_color' => '#000',
            'background_color' => '#fff',
            'background_pattern' => false,
            'background_pattern_svg' => '',
            'border_radius' => 'rounded',
            'border_color' => '#000',
            'border_width' => 0,
            'shadow'        => true,

            'on_animation' => 'fadeIn',
            'off_animation' => 'fadeOut',
        ],

        'COOKIE_NOTIFICATION' => [
            'description' => language()->notification->cookie_notification->description_default,
            'image' => language()->notification->cookie_notification->image_default,
            'url_text' => language()->notification->cookie_notification->url_text_default,
            'url' => '',
            'url_new_tab' => true,
            'button_text'  => language()->notification->cookie_notification->button_text_default,

            'trigger_all_pages' => true,
            'triggers' => [],
            'display_trigger' => 'delay',
            'display_trigger_value' => 2,
            'display_frequency' => 'all_time',
            'display_mobile' => true,
            'display_desktop' => true,

            'display_duration' => 5,
            'display_position' => 'bottom_left',
            'display_close_button' => true,
            'display_branding' => true,

            'description_color' => '#000',
            'background_color' => '#fff',
            'background_pattern' => false,
            'background_pattern_svg' => '',
            'button_background_color' => '#000',
            'button_color' => '#fff',
            'border_radius' => 'rounded',
            'border_color' => '#000',
            'border_width' => 0,
            'shadow'        => true,

            'on_animation' => 'fadeIn',
            'off_animation' => 'fadeOut',
        ],

        'SCORE_FEEDBACK' => [
            'title' => language()->notification->score_feedback->title_default,
            'description' => language()->notification->score_feedback->description_default,

            'trigger_all_pages' => true,
            'triggers' => [],
            'display_trigger' => 'delay',
            'display_trigger_value' => 2,
            'display_frequency' => 'all_time',
            'display_mobile' => true,
            'display_desktop' => true,

            'display_duration' => 5,
            'display_position' => 'bottom_left',
            'display_close_button' => false,
            'display_branding' => true,

            'title_color' => '#000',
            'description_color' => '#000',
            'background_color' => '#fff',
            'background_pattern' => false,
            'background_pattern_svg' => '',
            'button_background_color' => '#000',
            'button_color' => '#fff',
            'border_radius' => 'rounded',
            'border_color' => '#000',
            'border_width' => 0,
            'shadow'        => true,

            'on_animation' => 'fadeIn',
            'off_animation' => 'fadeOut',
        ],

        'REQUEST_COLLECTOR' => [
            'title' => language()->notification->request_collector->title_default,
            'description' => language()->notification->request_collector->description_default,
            'image' => language()->notification->request_collector->image_default,
            'content_title' => language()->notification->request_collector->content_title_default,
            'content_description' => language()->notification->request_collector->content_description_default,
            'input_placeholder' => language()->notification->request_collector->input_placeholder_default,
            'button_text' => language()->notification->request_collector->button_text_default,
            'show_agreement' => false,
            'agreement_text' => language()->notification->request_collector->agreement_text_default,
            'agreement_url' => '',
            'thank_you_url' => '',

            'trigger_all_pages' => true,
            'triggers' => [],
            'display_trigger' => 'delay',
            'display_trigger_value' => 2,
            'display_frequency' => 'all_time',
            'display_mobile' => true,
            'display_desktop' => true,

            'display_duration' => 5,
            'display_position' => 'bottom_left',
            'display_close_button' => false,
            'display_branding' => true,

            'title_color' => '#000',
            'description_color' => '#000',
            'content_title_color' => '#000',
            'content_description_color' => '#000',
            'background_color' => '#fff',
            'background_pattern' => false,
            'background_pattern_svg' => '',
            'button_background_color' => '#000',
            'button_color' => '#fff',
            'border_radius' => 'rounded',
            'border_color' => '#000',
            'border_width' => 0,
            'shadow'        => true,

            'on_animation' => 'fadeIn',
            'off_animation' => 'fadeOut',

            'data_send_is_enabled' => 0,
            'data_send_webhook' => '',
            'data_send_email' => '',
        ],

        'COUNTDOWN_COLLECTOR' => [
            'title' => language()->notification->countdown_collector->title_default,
            'description' => language()->notification->countdown_collector->description_default,
            'content_title' => language()->notification->countdown_collector->content_title_default,
            'input_placeholder' => language()->notification->countdown_collector->input_placeholder_default,
            'button_text' => language()->notification->countdown_collector->button_text_default,
            'end_date' => (new \DateTime())->modify('+5 hours')->format('Y-m-d H:i:s'),
            'show_agreement' => false,
            'agreement_text' => language()->notification->countdown_collector->agreement_text_default,
            'agreement_url' => '',
            'thank_you_url' => '',

            'trigger_all_pages' => true,
            'triggers' => [],
            'display_trigger' => 'delay',
            'display_trigger_value' => 2,
            'display_frequency' => 'all_time',
            'display_mobile' => true,
            'display_desktop' => true,

            'display_duration' => 5,
            'display_position' => 'bottom_left',
            'display_close_button' => false,
            'display_branding' => true,

            'title_color' => '#000',
            'description_color' => '#000',
            'content_title_color' => '#000',
            'time_color' => '#fff',
            'time_background_color' => '#000',
            'background_color' => '#fff',
            'background_pattern' => false,
            'background_pattern_svg' => '',
            'button_background_color' => '#000',
            'button_color' => '#fff',
            'border_radius' => 'rounded',
            'border_color' => '#000',
            'border_width' => 0,
            'shadow'        => true,

            'on_animation' => 'fadeIn',
            'off_animation' => 'fadeOut',

            'data_send_is_enabled' => 0,
            'data_send_webhook' => '',
            'data_send_email' => '',
        ]
    ]
);
