<?php
/**
 * Monero Payment Processing
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/monero-payment-processing.php.
 *
 * @package WooCommerce/Templates
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

?>

<div class="woocommerce monero-payment-processing">

    <?php
    /**
     * Display the Monero payment processing message.
     *
     * @param int $order_id Order ID.
     */
    do_action('woocommerce_before_monero_payment_processing', $order_id);
    ?>

    <p><?php esc_html_e('Please send your Monero payment to the following address:', 'woocommerce'); ?></p>
    <p>
        <strong><?php echo esc_html($monero_wallet_address); ?></strong>
    </p>

    <!-- Add any additional information or instructions for the Monero payment processing -->

    <?php
    /**
     * Display additional Monero payment processing content.
     *
     * @param int $order_id Order ID.
     */
    do_action('woocommerce_after_monero_payment_processing', $order_id);
    ?>

</div>
