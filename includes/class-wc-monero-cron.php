<?php
/**
 * Monero Payment Gateway Cron Jobs
 */

if (!class_exists('WC_Monero_Cron')) {

    class WC_Monero_Cron {

        /**
         * Constructor
         */
        public function __construct() {
            // Schedule the cron job to run every 5 minutes
            add_action('init', array($this, 'schedule_cron_job'));
        }

        /**
         * Schedule the cron job
         */
        public function schedule_cron_job() {
            if (!wp_next_scheduled('wc_monero_cron_hook')) {
                wp_schedule_event(time(), 'five_minutes', 'wc_monero_cron_hook');
            }
        }

        /**
         * Cron job callback function
         */
        public static function cron_job_callback() {
            // Implement your Monero-related cron job logic here
        }
    }

    $wc_monero_cron = new WC_Monero_Cron();

    // Hook to execute the cron job
    add_action('wc_monero_cron_hook', array('WC_Monero_Cron', 'cron_job_callback'));

    // Define the interval
    add_filter('cron_schedules', array('WC_Monero_Cron', 'add_five_minutes_interval'));

    /**
     * Define the custom interval
     *
     * @param array $schedules Existing cron schedules.
     * @return array Schedules with custom interval added.
     */
    public static function add_five_minutes_interval($schedules) {
        $schedules['five_minutes'] = array(
            'interval' => 5 * 60,
            'display'  => __('Every 5 Minutes'),
        );

        return $schedules;
    }
}
