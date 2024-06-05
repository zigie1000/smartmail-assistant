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
    if (!function_exists('wp_remote_get')) {
        wp_die('Missing wp_remote_get function.');
    }

    if (!class_exists('WooCommerce')) {
        wp_die('WooCommerce is not installed or activated.');
    }
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
    require_once SMARTMAIL_PLUGIN_PATH . $file;
    smartmail_log("Included file: $file");
}

// Activation and deactivation hooks
register_activation_hook(__FILE__, function() {
    update_option('smartmail_plugin_activated', true);
    smartmail_log('SmartMail Assistant plugin activated successfully.');
});

register_deactivation_hook(__FILE__, function() {
    delete_option('smartmail_plugin_activated');
    smartmail_log('SmartMail Assistant plugin deactivated successfully.');
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

// Ensure the AI functions are included
if (!function_exists('smartmail_email_categorization')) {
    function smartmail_email_categorization($email_content) {
        // AI logic for categorizing emails
        return "Categorized email content: $email_content";
    }
}

if (!function_exists('smartmail_priority_inbox')) {
    function smartmail_priority_inbox($email_content) {
        // AI logic for priority inbox
        return "Priority inbox content: $email_content";
    }
}

if (!function_exists('smartmail_automated_responses')) {
    function smartmail_automated_responses($email_content) {
        // AI logic for automated responses
        return "Automated response for email: $email_content";
    }
}

if (!function_exists('smartmail_email_summarization')) {
    function smartmail_email_summarization($email_content) {
        // AI logic for email summarization
        return "Summary of the email: $email_content";
    }
}

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
