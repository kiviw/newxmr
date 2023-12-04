<?php
/**
 * Monero Payment Gateway Class.
 */
class WC_Monero_Gateway extends WC_Payment_Gateway {
    public function __construct() {
        $this->id = 'monero_gateway';
        $this->icon = ''; // Add URL to your payment gateway icon.
        $this->has_fields = false;
        $this->method_title = __('Monero', 'woocommerce');
        $this->method_description = __('Accept Monero payments.', 'woocommerce');

        // Load the settings.
        $this->init_form_fields();
        $this->init_settings();

        // Define user set variables.
        $this->title = $this->get_option('title');
        $this->description = $this->get_option('description');
        $this->enabled = $this->get_option('enabled');
        $this->debug = $this->get_option('debug');

        // Hooks.
        add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options'));
        add_action('woocommerce_thankyou_' . $this->id, array($this, 'thankyou_page'));
        add_action('woocommerce_email_before_order_table', array($this, 'email_instructions'), 10, 3);

        // Payment listener/API hook.
        add_action('woocommerce_api_' . strtolower(get_class($this)), array($this, 'check_monero_callback'));
    }

    /**
     * Initialize Gateway Settings Form Fields.
     */
    public function init_form_fields() {
        $this->form_fields = array(
            'enabled' => array(
                'title'   => __('Enable/Disable', 'woocommerce'),
                'type'    => 'checkbox',
                'label'   => __('Enable Monero Payments', 'woocommerce'),
                'default' => 'yes',
            ),
            'title' => array(
                'title'       => __('Title', 'woocommerce'),
                'type'        => 'text',
                'description' => __('This controls the title which the user sees during checkout.', 'woocommerce'),
                'default'     => __('Monero', 'woocommerce'),
                'desc_tip'    => true,
            ),
            'description' => array(
                'title'       => __('Description', 'woocommerce'),
                'type'        => 'textarea',
                'description' => __('This controls the description which the user sees during checkout.', 'woocommerce'),
                'default'     => __('Pay securely using Monero.', 'woocommerce'),
            ),
            'debug' => array(
                'title'       => __('Debug Log', 'woocommerce'),
                'type'        => 'checkbox',
                'label'       => __('Enable logging', 'woocommerce'),
                'default'     => 'no',
                'description' => sprintf(__('Log Monero events, such as IPN requests, inside %s', 'woocommerce'), wc_get_log_file_path('monero')),
            ),
        );
    }

    /**
     * Output for the order received page.
     */
    public function thankyou_page() {
        if ($this->instructions) {
            echo wpautop(wptexturize($this->instructions));
        }
    }

    /**
     * Add content to the WC emails.
     *
     * @param WC_Order $order Order object.
     * @param bool     $sent_to_admin Sent to admin.
     * @param bool     $plain_text Email format: plain text or HTML.
     */
    public function email_instructions($order, $sent_to_admin, $plain_text = false) {
        if ($this->instructions && !$sent_to_admin && 'monero_gateway' === $order->get_payment_method() && $order->has_status('pending')) {
            echo wpautop(wptexturize($this->instructions)) . PHP_EOL;
        }
    }

    /**
     * Check for valid Monero callback.
     */
    public function check_monero_callback() {
        // Implement Monero callback logic here.
    }
}
