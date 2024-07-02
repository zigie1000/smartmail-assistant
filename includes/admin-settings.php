<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Ensure WooCommerce is active
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
                'type'    => 'checkbox',
                'label'   => __('Enable Pi Payment', 'woocommerce'),
                'default' => 'yes'
            ),
            'title' => array(
                'title'       => __('Title', 'woocommerce'),
                'type'        => 'text',
                'description' => __('This controls the title which the user sees during checkout.', 'woocommerce'),
                'default'     => __('Pi Payment', 'woocommerce'),
                'desc_tip'    => true,
            ),
            'description' => array(
                'title'       => __('Description', 'woocommerce'),
                'type'        => 'textarea',
                'description' => __('This controls the description which the user sees during checkout.', 'woocommerce'),
                'default'     => __('Pay with Pi', 'woocommerce'),
            ),
        );
    }

    public function process_payment($order_id) {
        $order = wc_get_order($order_id);
        $order->update_status('on-hold', __('Awaiting Pi payment', 'woocommerce'));
        $order->reduce_order_stock();
        WC()->cart->empty_cart();
        return array(
            'result'   => 'success',
            'redirect' => $this->get_return_url($order)
        );
    }

    public function receipt_page($order) {
        echo '<p>' . __('Thank you for your order, please make your payment using Pi.', 'woocommerce') . '</p>';
    }

    public function check_response() {
        @ob_clean();
        $response = json_decode(file_get_contents('php://input'), true);
        if ($response['status'] == 'success') {
            $order = wc_get_order($response['order_id']);
            $order->payment_complete();
            $order->add_order_note(__('Pi payment completed', 'woocommerce'));
        }
        http_response_code(200);
        exit();
    }
}

function add_pi_gateway($methods) {
    $methods[] = 'WC_Gateway_Pi';
    return $methods;
}

add_filter('woocommerce_payment_gateways', 'add_pi_gateway');
