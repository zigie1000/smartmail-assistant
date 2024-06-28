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

// Include the OpenAI client if it exists
if (file_exists(SMARTMAIL_PLUGIN_PATH . 'vendor/autoload.php')) {
    require_once SMARTMAIL_PLUGIN_PATH . 'vendor/autoload.php';
    smartmail_log('OpenAI client included.');
} else {
    smartmail_log('OpenAI client not found.');
}

// Function to get the OpenAI client
function get_openai_client() {
    $api_key = get_option('smartmail_openai_api_key');
    if (!$api_key) {
        smartmail_log('OpenAI API key not found.');
        return null;
    }
    return OpenAI::client($api_key);
}

// Shortcodes for displaying content
if (!function_exists('smartmail_register_shortcodes')) {
    function smartmail_register_shortcodes() {
        add_shortcode('sma_email_categorization', 'smartmail_email_categorization_shortcode');
        add_shortcode('sma_priority_inbox', 'smartmail_priority_inbox_shortcode');
        add_shortcode('sma_automated_responses', 'smartmail_automated_responses_shortcode');
        add_shortcode('sma_email_summarization', 'smartmail_email_summarization_shortcode');
        add_shortcode('sma_meeting_scheduler', 'smartmail_meeting_scheduler_shortcode');
        add_shortcode('sma_follow_up_reminders', 'smartmail_follow_up_reminders_shortcode');
        add_shortcode('sma_sentiment_analysis', 'smartmail_sentiment_analysis_shortcode');
        add_shortcode('sma_email_templates', 'smartmail_email_templates_shortcode');
        add_shortcode('sma_forensic_analysis', 'smartmail_forensic_analysis_shortcode');
    }
}
add_action('init', 'smartmail_register_shortcodes');

function smartmail_email_categorization_shortcode($atts, $content = null) {
    return smartmail_email_categorization($content);
}

function smartmail_priority_inbox_shortcode($atts, $content = null) {
    return smartmail_priority_inbox($content);
}

function smartmail_automated_responses_shortcode($atts, $content = null) {
    return smartmail_automated_responses($content);
}

function smartmail_email_summarization_shortcode($atts, $content = null) {
    return smartmail_email_summarization($content);
}

function smartmail_meeting_scheduler_shortcode($atts, $content = null) {
    return smartmail_meeting_scheduler($content);
}

function smartmail_follow_up_reminders_shortcode($atts, $content = null) {
    return smartmail_follow_up_reminders($content);
}

function smartmail_sentiment_analysis_shortcode($atts, $content = null) {
    return smartmail_sentiment_analysis($content);
}

function smartmail_email_templates_shortcode($atts, $content = null) {
    return smartmail_email_templates();
}

function smartmail_forensic_analysis_shortcode($atts, $content = null) {
    return smartmail_forensic_analysis($content);
}
?>
