<?php
/*
Plugin Name: SmartMail Assistant
Description: Provides AI-powered email features.
Version: 1.0
Author: Marco Zagato
Author URI: https://smartmail.store
*/

// Ensure the file is not accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Include necessary files
include_once plugin_dir_path(__FILE__) . 'includes/admin-settings.php';
include_once plugin_dir_path(__FILE__) . 'includes/ai-functions.php';
include_once plugin_dir_path(__FILE__) . 'includes/api-functions.php';
include_once plugin_dir_path(__FILE__) . 'includes/class-wc-gateway-pi.php';
include_once plugin_dir_path(__FILE__) . 'includes/functions.php';

// Register activation hook
register_activation_hook(__FILE__, 'smartmail_activate');
function smartmail_activate() {
    // Code to run on activation
    // Create required pages
    if (!get_option('smartmail_pages_created')) {
        $pages = [
            'SmartMail Dashboard' => 'smartmail-dashboard',
            'SmartMail Ebooks' => 'smartmail-ebooks',
            'SmartMail Software' => 'smartmail-software',
            'SmartMail Subscription' => 'smartmail-subscription',
            'Subscribe' => 'subscribe'
        ];

        foreach ($pages as $title => $slug) {
            if (!get_page_by_path($slug)) {
                wp_insert_post([
                    'post_title' => $title,
                    'post_name' => $slug,
                    'post_status' => 'publish',
                    'post_type' => 'page',
                    'page_template' => 'templates/smartmail-page.php' // Ensure this matches your template file path
                ]);
            }
        }

        update_option('smartmail_pages_created', 1);
    }
}

// Admin menu
function smartmail_admin_menu() {
    add_menu_page('SmartMail Assistant', 'SmartMail Assistant', 'manage_options', 'smartmail-assistant', 'smartmail_admin_dashboard', 'dashicons-email-alt', 6);
}
add_action('admin_menu', 'smartmail_admin_menu');

function smartmail_admin_dashboard() {
    echo '<div class="wrap"><h1>SmartMail Assistant</h1></div>';
}

// Enqueue scripts and styles
function smartmail_enqueue_scripts() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('smartmail-ajax', plugins_url('assets/js/smartmail.js', __FILE__), array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'smartmail_enqueue_scripts');

// Shortcodes for AI features
function sma_email_categorization_shortcode() {
    ob_start();
    ?>
    <form id="smartmail-categorization-form">
        <textarea id="categorization-email-content" placeholder="Enter email content here"></textarea>
        <button type="submit">Categorize Email</button>
    </form>
    <div id="categorization-result"></div>
    <?php
    return ob_get_clean();
}
add_shortcode('sma_email_categorization', 'sma_email_categorization_shortcode');

function sma_priority_inbox_shortcode() {
    ob_start();
    ?>
    <form id="smartmail-priority-form">
        <textarea id="priority-email-content" placeholder="Enter email content here"></textarea>
        <button type="submit">Determine Priority</button>
    </form>
    <div id="priority-result"></div>
    <?php
    return ob_get_clean();
}
add_shortcode('sma_priority_inbox', 'sma_priority_inbox_shortcode');

function sma_automated_responses_shortcode() {
    ob_start();
    ?>
    <form id="smartmail-automated-responses-form">
        <textarea id="automated-responses-email-content" placeholder="Enter email content here"></textarea>
        <button type="submit">Generate Response</button>
    </form>
    <div id="automated-responses-result"></div>
    <?php
    return ob_get_clean();
}
add_shortcode('sma_automated_responses', 'sma_automated_responses_shortcode');

function sma_email_summarization_shortcode() {
    ob_start();
    ?>
    <form id="smartmail-summarization-form">
        <textarea id="summarization-email-content" placeholder="Enter email content here"></textarea>
        <button type="submit">Summarize Email</button>
    </form>
    <div id="summarization-result"></div>
    <?php
    return ob_get_clean();
}
add_shortcode('sma_email_summarization', 'sma_email_summarization_shortcode');

function sma_meeting_scheduler_shortcode() {
    ob_start();
    ?>
    <form id="smartmail-meeting-scheduler-form">
        <textarea id="meeting-scheduler-email-content" placeholder="Enter email content here"></textarea>
        <button type="submit">Schedule Meeting</button>
    </form>
    <div id="meeting-scheduler-result"></div>
    <?php
    return ob_get_clean();
}
add_shortcode('sma_meeting_scheduler', 'sma_meeting_scheduler_shortcode');

function sma_follow_up_reminders_shortcode() {
    ob_start();
    ?>
    <form id="smartmail-follow-up-reminders-form">
        <textarea id="follow-up-reminders-email-content" placeholder="Enter email content here"></textarea>
        <button type="submit">Generate Follow-up Reminder</button>
    </form>
    <div id="follow-up-reminders-result"></div>
    <?php
    return ob_get_clean();
}
add_shortcode('sma_follow_up_reminders', 'sma_follow_up_reminders_shortcode');

function sma_sentiment_analysis_shortcode() {
    ob_start();
    ?>
    <form id="smartmail-sentiment-analysis-form">
        <textarea id="sentiment-analysis-email-content" placeholder="Enter email content here"></textarea>
        <button type="submit">Analyze Sentiment</button>
    </form>
    <div id="sentiment-analysis-result"></div>
    <?php
    return ob_get_clean();
}
add_shortcode('sma_sentiment_analysis', 'sma_sentiment_analysis_shortcode');

function sma_email_templates_shortcode() {
    ob_start();
    ?>
    <form id="smartmail-email-templates-form">
        <textarea id="email-templates-request" placeholder="Enter your request for an email template"></textarea>
        <button type="submit">Generate Template</button>
    </form>
    <div id="email-templates-result"></div>
    <?php
    return ob_get_clean();
}
add_shortcode('sma_email_templates', 'sma_email_templates_shortcode');

function sma_forensic_analysis_shortcode() {
    ob_start();
    ?>
    <form id="smartmail-forensic-analysis-form">
        <textarea id="forensic-analysis-email-content" placeholder="Enter email content here"></textarea>
        <button type="submit">Perform Analysis</button>
    </form>
    <div id="forensic-analysis-result"></div>
    <?php
    return ob_get_clean();
}
add_shortcode('sma_forensic_analysis', 'sma_forensic_analysis_shortcode');

?>           
