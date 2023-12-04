<?php
/**
 * Monero Price Functionality
 */

if (!class_exists('Monero_Price')) {

    class Monero_Price {

        /**
         * Constructor
         */
        public function __construct() {
            // Schedule the task to update Monero price every 5 minutes
            add_action('init', array($this, 'schedule_monero_price_update'));
        }

        /**
         * Schedule the task to update Monero price
         */
        public function schedule_monero_price_update() {
            if (!wp_next_scheduled('update_monero_price')) {
                wp_schedule_event(time(), 'five_minutes', 'update_monero_price');
            }
        }

        /**
         * Task callback function to update Monero price
         */
        public static function update_monero_price() {
            // Implement logic to update Monero price from the Coingecko API
            // You can use the code from the Monero Price Plugin to fetch and update the price
        }
    }

    $monero_price = new Monero_Price();

    // Hook to execute the task
    add_action('update_monero_price', array('Monero_Price', 'update_monero_price'));

    // Define the interval
    add_filter('cron_schedules', array('Monero_Price', 'add_five_minutes_interval'));

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
