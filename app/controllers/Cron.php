<?php

namespace Altum\Controllers;


use Altum\Date;

class Cron extends Controller {

    public function index() {

        /* Initiation */
        set_time_limit(0);

        /* Make sure the key is correct */
        if(!isset($_GET['key']) || (isset($_GET['key']) && $_GET['key'] != settings()->cron->key)) {
            die();
        }

        $date = \Altum\Date::$date;

        $this->users_plan_expiry_reminder();

        /* Update cron job last run date */
        $new_cron = json_encode(array_merge((array) settings()->cron, ['cron_datetime' => $date]));
        db()->where('`key`', 'cron')->update('settings', ['value' => $new_cron]);

        /* Make sure the reset date month is different than the current one to avoid double resetting */
        $reset_date = (new \DateTime(settings()->cron->reset_date))->format('m');
        $current_date = (new \DateTime())->format('m');

        if($reset_date == $current_date) {
            die();
        }

        /* Clean the track_logs table */
        $activity_date = (new \DateTime())->modify('-30 day')->format('Y-m-d H:i:s');
        database()->query("DELETE FROM `track_logs` WHERE `datetime` < '{$activity_date}'");

        /* Reset the users notification impressions */
        database()->query("UPDATE `users` SET `current_month_notifications_impressions` = 0");

        /* Update the settings with the updated time */
        $new_cron = json_encode(array_merge((array) settings()->cron, ['reset_date' => $date]));

        /* Database query */
        db()->where('`key`', 'cron')->update('settings', ['value' => $new_cron]);

        /* Clear the cache */
        \Altum\Cache::$adapter->deleteItem('settings');

    }

    private function users_plan_expiry_reminder() {

        /* Determine when to send the email reminder */
        $days = 5;
        $future_date = (new \DateTime())->modify('+' . $days . ' days')->format('Y-m-d H:i:s');

        /* Get potential monitors from users that have almost all the conditions to get an email report right now */
        $result = database()->query("
            SELECT
                `user_id`,
                `name`,
                `email`,
                `plan_id`,
                `plan_expiration_date`,
                `language`
            FROM 
                `users`
            WHERE 
                `active` = 1
                AND `plan_id` <> 'free'
                AND `plan_id` <> 'trial'
                AND `plan_expiry_reminder` = '0'
                AND (`payment_subscription_id` IS NOT NULL OR `payment_subscription_id` <> '')
				AND '{$future_date}' > `plan_expiration_date`
            LIMIT 25
        ");

        /* Go through each result */
        while($user = $result->fetch_object()) {

            /* Determine the exact days until expiration */
            $days_until_expiration = (new \DateTime($user->plan_expiration_date))->diff((new \DateTime()))->days;

            /* Get the language for the user */
            $language = language($user->language);

            /* Prepare the email */
            $email_template = get_email_template(
                [
                    '{{DAYS_UNTIL_EXPIRATION}}' => $days_until_expiration,
                ],
                $language->global->emails->user_plan_expiry_reminder->subject,
                [
                    '{{DAYS_UNTIL_EXPIRATION}}' => $days_until_expiration,
                    '{{USER_PLAN_RENEW_LINK}}' => url('pay/' . $user->plan_id),
                    '{{NAME}}' => $user->name,
                    '{{PLAN_NAME}}' => (new \Altum\Models\Plan())->get_plan_by_id($user->plan_id)->name,
                ],
                $language->global->emails->user_plan_expiry_reminder->body
            );

            send_mail($user->email, $email_template->subject, $email_template->body);

            /* Update user */
            db()->where('user_id', $user->user_id)->update('users', ['plan_expiry_reminder' => 1]);

            if(DEBUG) {
                echo sprintf('Email sent for user_id %s', $user->user_id);
            }
        }

    }

}
