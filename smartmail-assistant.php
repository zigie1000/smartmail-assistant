<?php
/**
 * Plugin Name: SmartMail Assistant
 * Plugin URI: https://smartmail.store
 * Description: A comprehensive assistant for managing your SmartMail, including AI-driven features.
 * Version: 1.0.0
 * Author: Marco Zagato
 * Author URI: https://smartmail.store
 * License: MIT
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Define constants
define('SMARTMAIL_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('SMARTMAIL_PLUGIN_URL', plugin_dir_url(__FILE__));
define('SMARTMAIL_DEBUG_LOG', SMARTMAIL_PLUGIN_PATH . 'debug.log');

// Include Composer's autoloader
require_once SMARTMAIL_PLUGIN_PATH . 'vendor/autoload.php';

// Function to log messages
if (!function_exists('smartmail_log')) {
    function smartmail_log($message) {
        if (defined('SMARTMAIL_DEBUG_LOG')) {
            error_log($message . PHP_EOL, 3, SMARTMAIL_DEBUG_LOG);
        }
    }
}
smartmail_log('SmartMail Assistant plugin loaded.');

// Check dependencies
function smartmail_check_dependencies() {
    smartmail_log('Checking dependencies.');
    if (!function_exists('wp_remote_get')) {
        smartmail_log('Missing wp_remote_get function.');
        wp_die('Missing wp_remote_get function.');
    }

    if (!class_exists('WooCommerce')) {
        smartmail_log('WooCommerce is not installed or activated.');
        wp_die('WooCommerce is not installed or activated.');
    }
    smartmail_log('All dependencies are met.');
}
add_action('admin_init', 'smartmail_check_dependencies');

// Include necessary files
$files = [
    'includes/admin-settings.php',
    'includes/api-functions.php',
    'includes/class-wc-gateway-pi.php',
    'includes/functions.php',
    'includes/shortcodes.php',
    'includes/subscription-functions.php',
    'includes/ai-functions.php'
];

foreach ($files as $file) {
    $file_path = SMARTMAIL_PLUGIN_PATH . $file;
    if (file_exists($file_path)) {
        require_once $file_path;
        smartmail_log("Included file: $file");
    } else {
        smartmail_log("Missing file: $file");
    }
}

// Activation and deactivation hooks
register_activation_hook(__FILE__, function() {
    try {
        update_option('smartmail_plugin_activated', true);
        smartmail_create_pages();
        add_custom_woocommerce_capabilities();
        smartmail_log('SmartMail Assistant plugin activated successfully.');
    } catch (Exception $e) {
        $error_message = 'SmartMail Assistant activation error: ' . $e->getMessage();
        smartmail_log($error_message);
        wp_die($error_message);
    }
});

register_deactivation_hook(__FILE__, function() {
    try {
        delete_option('smartmail_plugin_activated');
        remove_custom_woocommerce_capabilities();
        smartmail_log('SmartMail Assistant plugin deactivated successfully.');
    } catch (Exception $e) {
        $error_message = 'SmartMail Assistant deactivation error: ' . $e->getMessage();
        smartmail_log($error_message);
        wp_die($error_message);
    }
});

// Add custom capabilities for WooCommerce
function add_custom_woocommerce_capabilities() {
    $role = get_role('shop_manager');
    if ($role) {
        $role->add_cap('manage_woocommerce');
        $role->add_cap('edit_shop_orders');
        $role->add_cap('read_shop_orders');
        $role->add_cap('edit_products');
        $role->add_cap('publish_products');
        $role->add_cap('edit_others_shop_orders');
        $role->add_cap('view_woocommerce_reports');
    }

    $admin_role = get_role('administrator');
    if ($admin_role) {
        $admin_role->add_cap('manage_woocommerce');
        $admin_role->add_cap('edit_shop_orders');
        $admin_role->add_cap('read_shop_orders');
        $admin_role->add_cap('edit_products');
        $admin_role->add_cap('publish_products');
        $admin_role->add_cap('edit_others_shop_orders');
        $admin_role->add_cap('view_woocommerce_reports');
    }
}

function remove_custom_woocommerce_capabilities() {
    $role = get_role('shop_manager');
    if ($role) {
        $role->remove_cap('manage_woocommerce');
        $role->remove_cap('edit_shop_orders');
        $role->remove_cap('read_shop_orders');
        $role->remove_cap('edit_products');
        $role->remove_cap('publish_products');
        $role->remove_cap('edit_others_shop_orders');
        $role->remove_cap('view_woocommerce_reports');
    }

    $admin_role = get_role('administrator');
    if ($admin_role) {
        $admin_role->remove_cap('manage_woocommerce');
        $admin_role->remove_cap('edit_shop_orders');
        $admin_role->remove_cap('read_shop_orders');
        $admin_role->remove_cap('edit_products');
        $admin_role->remove_cap('publish_products');
        $admin_role->remove_cap('edit_others_shop_orders');
        $admin_role->remove_cap('view_woocommerce_reports');
    }
}

// Add admin menu for user settings
if (!function_exists('smartmail_admin_menu')) {
    function smartmail_admin_menu() {
        add_menu_page(
            'SmartMail Assistant',
            'SmartMail',
            'manage_options',
            'smartmail',
            'smartmail_admin_page',
            'dashicons-email-alt2',
            6
        );
        add_submenu_page(
            'smartmail',
            'Settings',
            'Settings',
            'manage_options',
            'smartmail-settings',
            'smartmail_settings_page'
        );
        add_submenu_page(
            'smartmail',
            'Dashboard',
            'Dashboard',
            'manage_options',
            'smartmail-dashboard',
            'smartmail_dashboard_template'
        );
    }
}
add_action('admin_menu', 'smartmail_admin_menu');

if (!function_exists('smartmail_admin_page')) {
    function smartmail_admin_page() {
        ?>
        <div class="wrap">
            <h1>SmartMail Assistant Settings</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('smartmail_options_group');
                do_settings_sections('smartmail');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }
}

if (!function_exists('smartmail_settings_page')) {
    function smartmail_settings_page() {
        ?>
        <div class="wrap">
            <h1>SmartMail Assistant API Settings</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('smartmail_options_group');
                do_settings_sections('smartmail');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }
}

if (!function_exists('smartmail_dashboard_template')) {
    function smartmail_dashboard_template() {
        if (is_user_logged_in() && current_user_can('manage_options')) {
            include plugin_dir_path(__FILE__) . 'includes/templates/admin-dashboard.php';
        } else {
            wp_die('You do not have sufficient permissions to access this page.');
        }
    }
}

// Register settings
if (!function_exists('smartmail_register_settings')) {
    function smartmail_register_settings() {
        register_setting('smartmail_options_group', 'smartmail_openai_api_key', [
            'type' => 'string',
            'description' => 'OpenAI API Key',
            'sanitize_callback' => 'sanitize_text_field',
            'default' => ''
        ]);

        add_settings_section(
            'smartmail_settings_section',
            'SmartMail Assistant Settings',
            null,
            'smartmail'
        );

        add_settings_field(
            'smartmail_openai_api_key',
            'OpenAI API Key',
            'smartmail_openai_api_key_render',
            'smartmail',
            'smartmail_settings_section'
        );
    }
}
add_action('admin_init', 'smartmail_register_settings');

if (!function_exists('smartmail_openai_api_key_render')) {
    function smartmail_openai_api_key_render() {
        $value = get_option('smartmail_openai_api_key');
        ?>
        <input type="text" name="smartmail_openai_api_key" value="<?php echo esc_attr($value); ?>" />
        <?php
    }
}

// Automatic page creation
if (!function_exists('smartmail_create_pages')) {
    function smartmail_create_pages() {
        $pages = [
            [
                'title' => 'SmartMail Dashboard',
                'content' => '[smartmail_dashboard]',
            ],
            [
                'title' => 'SmartMail Assistant',
                'content' => '[sma_email_categorization][sma_priority_inbox][sma_automated_responses][sma_email_summarization][sma_meeting_scheduler][sma_follow_up_reminders][sma_sentiment_analysis][sma_email_templates][sma_forensic_analysis]',
            ],
        ];

        foreach ($pages as $page) {
            if (!get_page_by_title($page['title'])) {
                wp_insert_post([
                    'post_title' => $page['title'],
                    'post_content' => $page['content'],
                    'post_status' => 'publish',
                    'post_type' => 'page',
                ]);
            }
        }
    }
}
register_activation_hook(__FILE__, 'smartmail_create_pages');

// Get OpenAI client
if (!function_exists('get_openai_client')) {
    function get_openai_client() {
        require_once plugin_dir_path(__FILE__) . 'vendor/autoload.php';
        $api_key = get_option('smartmail_openai_api_key');
        if (!$api_key) {
            throw new Exception('OpenAI API key is missing.');
        }
        return OpenAI\Client::factory(['api_key' => $api_key]);
    }
}

// Add custom WooCommerce settings
if (!function_exists('smartmail_add_woocommerce_settings')) {
    function smartmail_add_woocommerce_settings() {
        add_option('smartmail_woocommerce_setting', 'default_value');

        register_setting('woocommerce', 'smartmail_woocommerce_setting', [
            'type' => 'string',
            'description' => 'A custom setting for WooCommerce.',
            'sanitize_callback' => 'sanitize_text_field',
            'default' => 'default_value'
        ]);

        add_settings_section(
            'smartmail_woocommerce_settings_section',
            'SmartMail WooCommerce Settings',
            null,
            'woocommerce'
        );

        add_settings_field(
            'smartmail_woocommerce_setting',
            'Custom WooCommerce Setting',
            'smartmail_woocommerce_setting_render',
            'woocommerce',
            'smartmail_woocommerce_settings_section'
        );
    }
}
add_action('admin_init', 'smartmail_add_woocommerce_settings');

if (!function_exists('smartmail_woocommerce_setting_render')) {
    function smartmail_woocommerce_setting_render() {
        $value = get_option('smartmail_woocommerce_setting');
        ?>
        <input type="text" name="smartmail_woocommerce_setting" value="<?php echo esc_attr($value); ?>" />
        <?php
    }
}

// WooCommerce hooks for additional functionality
if (!function_exists('smartmail_woocommerce_hooks')) {
    function smartmail_woocommerce_hooks() {
        // Example: Add a custom field to WooCommerce product edit page
        add_action('woocommerce_product_options_general_product_data', 'smartmail_add_custom_field');
        add_action('woocommerce_process_product_meta', 'smartmail_save_custom_field');
    }
}
add_action('admin_init', 'smartmail_woocommerce_hooks');

if (!function_exists('smartmail_add_custom_field')) {
    function smartmail_add_custom_field() {
        woocommerce_wp_text_input([
            'id' => 'smartmail_custom_field',
            'label' => __('SmartMail Custom Field', 'woocommerce'),
            'desc_tip' => 'true',
            'description' => __('Enter a custom value for SmartMail.', 'woocommerce'),
        ]);
    }
}

if (!function_exists('smartmail_save_custom_field')) {
    function smartmail_save_custom_field($post_id) {
        $custom_field_value = isset($_POST['smartmail_custom_field']) ? sanitize_text_field($_POST['smartmail_custom_field']) : '';
        update_post_meta($post_id, 'smartmail_custom_field', $custom_field_value);
    }
}

// Handle errors and logging
set_error_handler(function($errno, $errstr, $errfile, $errline) {
    $log_message = "Error [$errno]: $errstr in $errfile on line $errline";
    smartmail_log($log_message);
    return false; // Let the normal error handler run as well
});

set_exception_handler(function($exception) {
    $log_message = "Exception: " . $exception->getMessage();
    smartmail_log($log_message);
    wp_die($log_message);
});
