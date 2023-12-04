<?php
/**
 * Monero Payment Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/monero-payment-form.php.
 *
 * @package WooCommerce/Templates
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

?>

<fieldset id="monero-payment-form">
    <p class="form-row">
        <label for="monero_wallet_address"><?php esc_html_e('Monero Wallet Address', 'woocommerce'); ?> <span class="required">*</span></label>
        <input type="text" class="input-text" name="monero_wallet_address" id="monero_wallet_address" required />
    </p>

    <!-- Add any additional fields or information specific to your Monero payment form -->

    <?php do_action('wc_monero_form_before_submit'); ?>

    <div class="clear"></div>

    <p class="form-row">
        <input type="hidden" id="monero-payment-method" name="payment_method" value="monero_gateway" />
        <?php wp_nonce_field('woocommerce-process_checkout', 'woocommerce-process-checkout-nonce'); ?>
        <button type="submit" class="button alt" id="place_order" value="<?php esc_attr_e('Place order', 'woocommerce'); ?>" data-value="<?php esc_attr_e('Place order', 'woocommerce'); ?>"><?php esc_html_e('Place order', 'woocommerce'); ?></button>
    </p>

    <?php do_action('wc_monero_form_after_submit'); ?>
</fieldset>
