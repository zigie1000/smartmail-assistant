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

// Function to log messages to a custom debug log file
function smartmail_log($message) {
    if (defined('SMARTMAIL_DEBUG_LOG')) {
        error_log($message . PHP_EOL, 3, SMARTMAIL_DEBUG_LOG);
    }
}

// Define plugin constants
define('SMARTMAIL_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('SMARTMAIL_PLUGIN_URL', plugin_dir_url(__FILE__));
define('SMARTMAIL_DEBUG_LOG', SMARTMAIL_PLUGIN_PATH . 'debug.log');

// Example usage of logging
smartmail_log('SmartMail Assistant plugin loaded.');

// Check for required dependencies
function smartmail_check_dependencies() {
    $bypass_dependencies = get_option('smartmail_bypass_dependencies', 'no');

    if ($bypass_dependencies === 'yes') {
        smartmail_log('Bypassing dependency checks.');
        return;
    }

    $missing_dependencies = array();

    if (!function_exists('wp_remote_get')) {
        $missing_dependencies[] = 'wp_remote_get function (WordPress core)';
        smartmail_log('Missing wp_remote_get function.');
    }

    if (!class_exists('WooCommerce')) {
        $missing_dependencies[] = 'WooCommerce';
        smartmail_log('WooCommerce is not installed or activated.');
    }

    if (!empty($missing_dependencies)) {
        deactivate_plugins(plugin_basename(__FILE__));
        $message = 'The following dependencies are missing: ' . implode(', ', $missing_dependencies);
        smartmail_log($message);
        wp_die($message);
    }
}
add_action('admin_init', 'smartmail_check_dependencies');

// Include necessary files
function smartmail_include_files() {
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
}
add_action('plugins_loaded', 'smartmail_include_files');

// Activation hook
function smartmail_activate() {
    try {
        // Add activation code here
        update_option('smartmail_plugin_activated', true);
        smartmail_log('SmartMail Assistant plugin activated successfully.');
    } catch (Exception $e) {
        $error_message = 'SmartMail Assistant activation error: ' . $e->getMessage();
        smartmail_log($error_message);
        wp_die($error_message);
    }
}
register_activation_hook(__FILE__, 'smartmail_activate');

// Deactivation hook
function smartmail_deactivate() {
    try {
        // Add deactivation code here
        delete_option('smartmail_plugin_activated');
        smartmail_log('SmartMail Assistant plugin deactivated successfully.');
    } catch (Exception $e) {
        $error_message = 'SmartMail Assistant deactivation error: ' . $e->getMessage();
        smartmail_log($error_message);
        wp_die($error_message);
    }
}
register_deactivation_hook(__FILE__, 'smartmail_deactivate');

// Ensure compatibility with WooCommerce
function smartmail_woocommerce_compatibility_check() {
    if (class_exists('WooCommerce')) {
        smartmail_log('WooCommerce is active.');
    } else {
        deactivate_plugins(plugin_basename(__FILE__));
        $message = 'SmartMail Assistant requires WooCommerce to be installed and activated.';
        smartmail_log($message);
        wp_die($message);
    }
}
add_action('plugins_loaded', 'smartmail_woocommerce_compatibility_check', 11);

// Include admin settings
include_once SMARTMAIL_PLUGIN_PATH
if (!function_exists('smartmail_meeting_scheduler')) {
    function smartmail_meeting_scheduler($email_content) {
        // AI logic for meeting scheduling
        return "Scheduled meeting details: $email_content";
    }
}

if (!function_exists('smartmail_follow_up_reminders')) {
    function smartmail_follow_up_reminders($email_content) {
        // AI logic for follow-up reminders
        return "Follow-up reminder for email: $email_content";
    }
}

if (!function_exists('smartmail_sentiment_analysis')) {
    function smartmail_sentiment_analysis($email_content) {
        // AI logic for sentiment analysis
        return "Sentiment analysis result: Neutral for email: $email_content";
    }
}

if (!function_exists('smartmail_email_templates')) {
    function smartmail_email_templates() {
        // AI logic for email templates
        return "Email templates generated";
    }
}

// Shortcodes to use AI functions in posts or pages
add_shortcode('smartmail_email_categorization', 'smartmail_email_categorization_shortcode');
add_shortcode('smartmail_priority_inbox', 'smartmail_priority_inbox_shortcode');
add_shortcode('smartmail_automated_responses', 'smartmail_automated_responses_shortcode');
add_shortcode('smartmail_email_summarization', 'smartmail_email_summarization_shortcode');
add_shortcode('smartmail_meeting_scheduler', 'smartmail_meeting_scheduler_shortcode');
add_shortcode('smartmail_follow_up_reminders', 'smartmail_follow_up_reminders_shortcode');
add_shortcode('smartmail_sentiment_analysis', 'smartmail_sentiment_analysis_shortcode');
add_shortcode('smartmail_email_templates', 'smartmail_email_templates_shortcode');

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
?>




    
