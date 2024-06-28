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

// Function to log messages
function smartmail_log($message) {
    if (defined('SMARTMAIL_DEBUG_LOG')) {
        error_log($message . PHP_EOL, 3, SMARTMAIL_DEBUG_LOG);
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
        smartmail_log('SmartMail Assistant plugin activated successfully.');
        smartmail_create_pages();
    } catch (Exception $e) {
        $error_message = 'SmartMail Assistant activation error: ' . $e->getMessage();
        smartmail_log($error_message);
        wp_die($error_message);
    }
});

register_deactivation_hook(__FILE__, function() {
    try {
        delete_option('smartmail_plugin_activated');
        smartmail_log('SmartMail Assistant plugin deactivated successfully.');
    } catch (Exception $e) {
        $error_message = 'SmartMail Assistant deactivation error: ' . $e->getMessage();
        smartmail_log($error_message);
        wp_die($error_message);
    }
});

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
        smartmail_log('Admin menu added.');
    }
}
add_action('admin_menu', 'smartmail_admin_menu');

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

// Create SmartMail Assistant pages on plugin activation
function smartmail_create_pages() {
    $pages = [
        'smartmail-dashboard' => [
            'post_title' => 'SmartMail Dashboard',
            'post_content' => '[smartmail_assistant_dashboard]',
            'post_status' => 'publish',
            'post_type' => 'page'
        ],
        'smartmail-page' => [
            'post_title' => 'SmartMail Page',
            'post_content' => '[smartmail_assistant_template]',
            'post_status' => 'publish',
            'post_type' => 'page'
        ]
    ];

    foreach ($pages as $slug => $page_data) {
        if (!get_page_by_path($slug)) {
            wp_insert_post($page_data);
        }
    }
}

// Shortcode to display SmartMail Assistant dashboard template
function smartmail_assistant_dashboard_shortcode() {
    ob_start();
    include plugin_dir_path(__FILE__) . 'includes/templates/admin-dashboard.php';
    return ob_get_clean();
}
add_shortcode('smartmail_assistant_dashboard', 'smartmail_assistant_dashboard_shortcode');

// Shortcode to display SmartMail Assistant page template
function smartmail_assistant_template_shortcode() {
    ob_start();
    include plugin_dir_path(__FILE__) . 'includes/templates/smartmail-page.php';
    return ob_get_clean();
}
add_shortcode('smartmail_assistant_template', 'smartmail_assistant_template_shortcode');

?>
