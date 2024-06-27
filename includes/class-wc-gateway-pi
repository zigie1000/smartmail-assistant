<?php
// Custom WooCommerce payment gateway integration

if (!class_exists('WC_Payment_Gateway')) return;

class WC_Gateway_Pi extends WC_Payment_Gateway {

    public function __construct() {
        $this->id = 'pi_gateway';
        $this->method_title = __('Pi Payment Gateway', 'smartmail-assistant');
        $this->method_description = __('Custom payment gateway for Pi network.', 'smartmail-assistant');

        $this->init_form_fields();
        $this->init_settings();

        $this->title = $this->get_option('title');
        $this->description = $this->get_option('description');
        $this->api_url = $this->get_option('api_url');
        $this->api_key = $this->get_option('api_key');

        // Actions.
        add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options'));
        add_action('woocommerce_receipt_' . $this->id, array($this, 'receipt_page'));

        // Payment listener/API hook.
        add_action('woocommerce_api_wc_gateway_' . $this->id, array($this, 'check_response'));

        // Check if the gateway is available.
        $this->enabled = ( 'yes' === $this->get_option( 'enabled', 'yes' ) ) && !empty($this->api_key);

        // Load debugging.
        $this->debug = ( 'yes' === $this->get_option( 'debug', 'no' ) );

        // Set the log file for debugging.
        if ($this->debug) {
            if (!class_exists('WC_Logger')) {
                include_once(WC()->plugin_path() . '/includes/class-wc-logger.php');
            }
            $this->log = new WC_Logger();
        }
    }

    public function init_form_fields() {
        $this->form_fields = array(
            'enabled' => array(
                'title'   => __('Enable/Disable', 'smartmail-assistant'),
                'type'    => 'checkbox',
                'label'   => __('Enable Pi Payment Gateway', 'smartmail-assistant'),
                'default' => 'yes'
            ),
            'title' => array(
                'title'       => __('Title', 'smartmail-assistant'),
                'type'        => 'text',
                'description' => __('This controls the title which the user sees during checkout.', 'smartmail-assistant'),
                'default'     => __('Pi Payment', 'smartmail-assistant'),
                'desc_tip'    => true,
            ),
            'description' => array(
                'title'       => __('Description', 'smartmail-assistant'),
                'type'        => 'textarea',
                'description' => __('This controls the description which the user sees during checkout.', 'smartmail-assistant'),
                'default'     => __('Pay with Pi cryptocurrency.', 'smartmail-assistant'),
            ),
            'api_url' => array(
                'title'       => 'API URL',
                'type'        => 'text',
                'description' => 'URL for the Pi Network API.',
                'default'     => 'https://api.minepi.com/v2/',
                'desc_tip'    => true,
            ),
            'api_key' => array(
                'title'       => 'API Key',
                'type'        => 'password',
                'description' => 'API key for accessing the Pi Network API.',
                'default'     => '',
                'desc_tip'    => true,
            ),
            'debug' => array(
                'title'       => __('Debug Log', 'smartmail-assistant'),
                'type'        => 'checkbox',
                'label'       => __('Enable logging', 'smartmail-assistant'),
                'default'     => 'no',
                'description' => __('Log events such as API requests', 'smartmail-assistant'),
            ),
        );
    }

    public function process_payment($order_id) {
        $order = wc_get_order($order_id);

        // Log the payment process initiation.
        if ($this->debug) {
            $this->log->add('pi_gateway', 'Processing payment for order ' . $order_id);
        }

        try {
            // Mark as on-hold (we're awaiting the payment).
            $order->update_status('on-hold', __('Awaiting Pi payment', 'smartmail-assistant'));

            // Reduce stock levels.
            wc_reduce_stock_levels($order_id);

            // Remove cart.
            WC()->cart->empty_cart();

            // Return thank you redirect.
            return array(
                'result'   => 'success',
                'redirect' => $this->get_return_url($order)
            );
        } catch (Exception $e) {
            // Log the error.
            if ($this->debug) {
                $this->log->add('pi_gateway', 'Error processing payment: ' . $e->getMessage());
            }
            // Add error notice for the customer.
            wc_add_notice(__('Payment error:', 'smartmail-assistant') . $e->getMessage(), 'error');
            return array(
                'result'   => 'fail',
                'redirect' => ''
            );
        }
    }

    public function receipt_page($order) {
        echo '<p>' . __('Thank you for your order. Please click the button below to pay with Pi.', 'smartmail-assistant') . '</p>';
        // Add any additional instructions or buttons here.
    }

    public function check_response() {
        // Handle the response from the Pi payment gateway.
        if ($this->debug) {
            $this->log->add('pi_gateway', 'Checking response from Pi Network API');
        }

        // Your logic to check the response from the Pi API goes here.
    }
}

function add_wc_gateway_pi($methods) {
    $methods[] = 'WC_Gateway_Pi';
    return $methods;
}
add_filter('woocommerce_payment_gateways', 'add_wc_gateway_pi');
