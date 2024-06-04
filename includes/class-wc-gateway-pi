<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class WC_Gateway_Pi extends WC_Payment_Gateway {

    public function __construct() {
        $this->id                 = 'pi_gateway';
        $this->icon               = apply_filters('woocommerce_gateway_icon', '');
        $this->has_fields         = false;
        $this->method_title       = 'Pi Gateway';
        $this->method_description = 'Custom payment gateway for Pi Network.';

        $this->init_form_fields();
        $this->init_settings();

        $this->title        = $this->get_option('title');
        $this->description  = $this->get_option('description');

        add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options'));
        add_action('woocommerce_receipt_' . $this->id, array($this, 'receipt_page'));
    }

    public function init_form_fields() {
        $this->form_fields = array(
            'enabled' => array(
                'title'   => 'Enable/Disable',
                'type'    => 'checkbox',
                'label'   => 'Enable Pi Gateway',
                'default' => 'yes'
            ),
            'title' => array(
                'title'       => 'Title',
                'type'        => 'text',
                'description' => 'This controls the title which the user sees during checkout.',
                'default'     => 'Pi Payment',
                'desc_tip'    => true,
            ),
            'description' => array(
                'title'       => 'Description',
                'type'        => 'textarea',
                'description' => 'This controls the description which the user sees during checkout.',
                'default'     => 'Pay with Pi Network.',
            ),
        );
    }

    public function process_payment($order_id) {
        $order = wc_get_order($order_id);
        $order->payment_complete();
        wc_reduce_stock_levels($order_id);
        $order->add_order_note('Pi payment received.');
        WC()->cart->empty_cart();

        return array(
            'result'   => 'success',
            'redirect' => $this->get_return_url($order),
        );
    }

    public function receipt_page($order) {
        echo 'Thank you for your order, please make payment using Pi Network.';
    }
}

function add_pi_gateway_class($methods) {
    $methods[] = 'WC_Gateway_Pi';
    return $methods;
}
add_filter('woocommerce_payment_gateways', 'add_pi_gateway_class');
?>
