<?php

namespace Altum\Routing;

use Altum\Database\Database;
use Altum\Language;

class Router {
    public static $params = [];
    public static $original_request = '';
    public static $language_code = '';
    public static $path = '';
    public static $controller_key = 'index';
    public static $controller = 'Index';
    public static $controller_settings = [
        'menu_no_margin' => false,
        'body_white' => true,
        'wrapper' => 'wrapper',
        'no_authentication_check' => false,

        /* Should we see a view for the controller? */
        'has_view' => true,

        /* If set on yes, ads wont show on these pages at all */
        'no_ads' => false,

        /* Authentication guard check (potential values: null, 'guest', 'user', 'admin') */
        'authentication' => null
    ];
    public static $method = 'index';
    public static $data = [];

    public static $routes = [
        '' => [
            'index' => [
                'controller' => 'Index',
                'settings' => [
                    'menu_no_margin' => true
                ]
            ],

            'login' => [
                'controller' => 'Login',
                'settings' => [
                    'wrapper' => 'basic_wrapper',
                    'no_ads' => true
                ]
            ],

            'register' => [
                'controller' => 'Register',
                'settings' => [
                    'wrapper' => 'basic_wrapper',
                    'no_ads' => true
                ]
            ],

            'affiliate' => [
                'controller' => 'Affiliate'
            ],

            'pages' => [
                'controller' => 'Pages'
            ],

            'page' => [
                'controller' => 'Page'
            ],

            'api-documentation' => [
                'controller' => 'ApiDocumentation',
            ],

            'activate-user' => [
                'controller' => 'ActivateUser'
            ],

            'lost-password' => [
                'controller' => 'LostPassword',
                'settings' => [
                    'wrapper' => 'basic_wrapper',
                    'no_ads' => true
                ]
            ],

            'reset-password' => [
                'controller' => 'ResetPassword',
                'settings' => [
                    'wrapper' => 'basic_wrapper',
                    'no_ads' => true
                ]
            ],

            'resend-activation' => [
                'controller' => 'ResendActivation',
                'settings' => [
                    'wrapper' => 'basic_wrapper',
                    'no_ads' => true
                ]
            ],

            'logout' => [
                'controller' => 'Logout'
            ],

            'notfound' => [
                'controller' => 'NotFound'
            ],

            /* Logged in */
            'dashboard' => [
                'controller' => 'Dashboard',
                'settings' => [
                    'menu_no_margin' => true,
                    'body_white' => false
                ]
            ],

            'campaign' => [
                'controller' => 'Campaign',
                'settings' => [
                    'menu_no_margin' => true,
                    'body_white' => false
                ]
            ],

            'notification-create' => [
                'controller' => 'NotificationCreate',
                'settings' => [
                    'menu_no_margin' => true,
                    'body_white' => false
                ]
            ],

            'notification' => [
                'controller' => 'Notification',
                'settings' => [
                    'menu_no_margin' => true,
                    'body_white' => false
                ]
            ],

            'account' => [
                'controller' => 'Account',
                'settings' => [
                    'menu_no_margin' => true,
                    'body_white' => false,
                    'no_ads'    => true
                ]
            ],

            'account-plan' => [
                'controller' => 'AccountPlan',
                'settings' => [
                    'menu_no_margin' => true,
                    'body_white' => false,
                    'no_ads'    => true
                ]
            ],

            'account-payments' => [
                'controller' => 'AccountPayments',
                'settings' => [
                    'menu_no_margin' => true,
                    'body_white' => false,
                    'no_ads'    => true
                ]
            ],

            'account-logs' => [
                'controller' => 'AccountLogs',
                'settings' => [
                    'menu_no_margin' => true,
                    'body_white' => false,
                    'no_ads'    => true
                ]
            ],

            'account-api' => [
                'controller' => 'AccountApi',
                'settings' => [
                    'menu_no_margin' => true,
                    'body_white' => false,
                    'no_ads'    => true
                ]
            ],

            'account-delete' => [
                'controller' => 'AccountDelete',
                'settings' => [
                    'menu_no_margin' => true,
                    'body_white' => false,
                    'no_ads'    => true
                ]
            ],

            'referrals' => [
                'controller' => 'Referrals',
                'settings' => [
                    'no_ads'    => true
                ]
            ],

            'refer' => [
                'controller' => 'Refer',
                'settings' => [
                    'has_view' => false
                ]
            ],

            'invoice' => [
                'controller' => 'Invoice',
                'settings' => [
                    'wrapper' => 'invoice/invoice_wrapper',
                    'body_white' => false,
                    'no_ads' => true
                ]
            ],

            'plan' => [
                'controller' => 'Plan',
                'settings' => [
                    'no_ads' => true
                ]
            ],

            'pay' => [
                'controller' => 'Pay',
                'settings' => [
                    'no_ads' => true
                ]
            ],

            'pay-billing' => [
                'controller' => 'PayBilling',
                'settings' => [
                    'no_ads' => true
                ]
            ],

            'pay-thank-you' => [
                'controller' => 'PayThankYou',
                'settings' => [
                    'no_ads' => true
                ]
            ],

            'pixel' => [
                'controller' => 'Pixel',
                'settings' => [
                    'no_authentication_check' => true,
                    'has_view' => false
                ]
            ],

            'pixel-track' => [
                'controller' => 'PixelTrack',
                'settings' => [
                    'no_authentication_check' => true,
                    'has_view' => false
                ]
            ],

            'pixel-webhook' => [
                'controller' => 'PixelWebhook',
                'settings' => [
                    'no_authentication_check' => true,
                    'has_view' => false
                ]
            ],

            /* Webhooks */
            'webhook-paypal' => [
                'controller' => 'WebhookPaypal',
                'settings' => [
                    'no_authentication_check' => true,
                    'has_view' => false
                ]
            ],

            'webhook-stripe' => [
                'controller' => 'WebhookStripe',
                'settings' => [
                    'no_authentication_check' => true,
                    'has_view' => false
                ]
            ],

            /* Ajax */
            'campaigns-ajax' => [
                'controller' => 'CampaignsAjax'
            ],

            'notification-data-ajax' => [
                'controller' => 'NotificationDataAjax'
            ],

            'notifications-ajax' => [
                'controller' => 'NotificationsAjax'
            ],

            /* Others */
            'sitemap' => [
                'controller' => 'Sitemap',
                'settings' => [
                    'no_authentication_check' => true
                ]
            ],

            'cron' => [
                'controller' => 'Cron',
                'settings' => [
                    'no_authentication_check' => true,
                    'has_view' => false
                ]
            ],
        ],

        'api' => [
            'campaigns' => [
                'controller' => 'ApiCampaigns',
                'settings' => [
                    'no_authentication_check' => true,
                    'has_view' => false
                ]
            ],
            'notifications' => [
                'controller' => 'ApiNotifications',
                'settings' => [
                    'no_authentication_check' => true,
                    'has_view' => false
                ]
            ],
            'user' => [
                'controller' => 'ApiUser',
                'settings' => [
                    'no_authentication_check' => true,
                    'has_view' => false
                ]
            ],
            'payments' => [
                'controller' => 'ApiPayments',
                'settings' => [
                    'no_authentication_check' => true,
                    'has_view' => false
                ]
            ],
            'logs' => [
                'controller' => 'ApiLogs',
                'settings' => [
                    'no_authentication_check' => true,
                    'has_view' => false
                ]
            ],
        ],

        /* Admin Panel */
        'admin' => [
            'index' => [
                'controller' => 'AdminIndex'
            ],

            'campaigns' => [
                'controller' => 'AdminCampaigns'
            ],

            'notifications' => [
                'controller' => 'AdminNotifications'
            ],

            'users' => [
                'controller' => 'AdminUsers'
            ],

            'user-create' => [
                'controller' => 'AdminUserCreate'
            ],

            'user-view' => [
                'controller' => 'AdminUserView'
            ],

            'user-update' => [
                'controller' => 'AdminUserUpdate'
            ],


            'pages-categories' => [
                'controller' => 'AdminPagesCategories'
            ],

            'pages-category-create' => [
                'controller' => 'AdminPagesCategoryCreate'
            ],

            'pages-category-update' => [
                'controller' => 'AdminPagesCategoryUpdate'
            ],

            'pages' => [
                'controller' => 'AdminPages'
            ],

            'page-create' => [
                'controller' => 'AdminPageCreate'
            ],

            'page-update' => [
                'controller' => 'AdminPageUpdate'
            ],


            'plans' => [
                'controller' => 'AdminPlans'
            ],

            'plan-create' => [
                'controller' => 'AdminPlanCreate'
            ],

            'plan-update' => [
                'controller' => 'AdminPlanUpdate'
            ],


            'codes' => [
                'controller' => 'AdminCodes'
            ],

            'code-create' => [
                'controller' => 'AdminCodeCreate'
            ],

            'code-update' => [
                'controller' => 'AdminCodeUpdate'
            ],


            'taxes' => [
                'controller' => 'AdminTaxes'
            ],

            'tax-create' => [
                'controller' => 'AdminTaxCreate'
            ],

            'tax-update' => [
                'controller' => 'AdminTaxUpdate'
            ],

            'payments' => [
                'controller' => 'AdminPayments'
            ],

            'affiliates-withdrawals' => [
                'controller' => 'AdminAffiliatesWithdrawals',
            ],

            'statistics' => [
                'controller' => 'AdminStatistics'
            ],

            'plugins' => [
                'controller' => 'AdminPlugins',
            ],

            'settings' => [
                'controller' => 'AdminSettings'
            ],

            'api-documentation' => [
                'controller' => 'AdminApiDocumentation',
            ],
        ],

        'admin-api' => [
            'users' => [
                'controller' => 'AdminApiUsers',
                'settings' => [
                    'no_authentication_check' => true,
                    'has_view' => false
                ]
            ],

            'plans' => [
                'controller' => 'AdminApiPlans',
                'settings' => [
                    'no_authentication_check' => true,
                    'has_view' => false
                ]
            ],
        ],
    ];


    public static function parse_url() {

        $params = self::$params;

        if(isset($_GET['altum'])) {
            $params = explode('/', filter_var(rtrim($_GET['altum'], '/'), FILTER_SANITIZE_URL));
        }

        self::$params = $params;

        return $params;

    }

    public static function get_params() {

        return self::$params = array_values(self::$params);
    }

    public static function parse_language() {

        /* Check for potential language set in the first parameter */
        if(!empty(self::$params[0]) && array_key_exists(self::$params[0], Language::$languages)) {

            /* Set the language */
            $language_code = filter_var(self::$params[0], FILTER_SANITIZE_STRING);
            Language::set_by_code($language_code);
            self::$language_code = $language_code;

            /* Unset the parameter so that it wont be used further */
            unset(self::$params[0]);
            self::$params = array_values(self::$params);

        }

    }

    public static function parse_controller() {

        self::$original_request = filter_var(implode('/', self::$params), FILTER_SANITIZE_STRING);

        /* Check for potential other paths than the default one (admin panel) */
        if(!empty(self::$params[0])) {

            if (in_array(self::$params[0], ['admin', 'admin-api', 'api'])) {
                self::$path = self::$params[0];

                unset(self::$params[0]);

                self::$params = array_values(self::$params);
            }

        }

        if(!empty(self::$params[0])) {

            if(array_key_exists(self::$params[0], self::$routes[self::$path]) && file_exists(APP_PATH . 'controllers/' . (self::$path != '' ? self::$path . '/' : null) . self::$routes[self::$path][self::$params[0]]['controller'] . '.php')) {

                self::$controller_key = self::$params[0];

                unset(self::$params[0]);

            } else {

                /* Not found controller */
                self::$path = '';
                self::$controller_key = 'notfound';

            }

        }

        /* Save the current controller */
        self::$controller = self::$routes[self::$path][self::$controller_key]['controller'];

        /* Admin path authentication force check */
        if(self::$path == 'admin' && !isset(self::$routes[self::$path][self::$controller_key]['settings'])) {
            self::$routes[self::$path][self::$controller_key]['settings'] = ['authentication' => 'admin'];
        }

        /* Make sure we also save the controller specific settings */
        if(isset(self::$routes[self::$path][self::$controller_key]['settings'])) {
            self::$controller_settings = array_merge(self::$controller_settings, self::$routes[self::$path][self::$controller_key]['settings']);
        }

        return self::$controller;

    }

    public static function get_controller($controller_name, $path = '') {

        require_once APP_PATH . 'controllers/' . ($path != '' ? $path . '/' : null) . $controller_name . '.php';

        /* Create a new instance of the controller */
        $class = 'Altum\\Controllers\\' . $controller_name;

        /* Instantiate the controller class */
        $controller = new $class;

        return $controller;
    }

    public static function parse_method($controller) {

        $method = self::$method;

        /* Make sure to check the class method if set in the url */
        if(isset(self::get_params()[0]) && method_exists($controller, self::get_params()[0])) {

            /* Make sure the method is not private */
            $reflection = new \ReflectionMethod($controller, self::get_params()[0]);
            if($reflection->isPublic()) {
                $method = self::get_params()[0];

                unset(self::$params[0]);
            }

        }

        return $method;

    }

}
