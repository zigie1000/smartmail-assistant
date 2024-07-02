<?php

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('WC_Payment_Gateway')) {
    return;
}

class WC_Gateway_Pi extends WC_Payment_Gateway {
    public function __construct() {
        $this->id                 = 'pi';
        $this->icon               = apply_filters('woocommerce_gateway_icon', '');
        $this->has_fields         = false;
        $this->method_title       = __('Pi Gateway', 'woocommerce');
        $this->method_description = __('Allows payments with Pi.', 'woocommerce');
        
        $this->init_form_fields();
        $this->init_settings();

        $this->title        = $this->get_option('title');
        $this->description  = $this->get_option('description');
        $this->enabled      = $this->get_option('enabled');

        add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options'));
        add_action('woocommerce_receipt_' . $this->id, array($this, 'receipt_page'));
        add_action('woocommerce_api_wc_gateway_' . $this->id, array($this, 'check_response'));
    }

    public function init_form_fields() {
        $this->form_fields = array(
            'enabled' => array(
                'title'   => __('Enable/Disable', 'woocommerce'),
               
