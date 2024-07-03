<?php
/**
 * Plugin Name: SmartMail Assistant
 * Description: A plugin to provide various email management features using OpenAI.
 * Version: 1.0
 * Author: Marco Zagato
 * Author URI: https://smartmail.store
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Include necessary files
include_once plugin_dir_path(__FILE__) . 'includes/admin-settings.php';
include_once plugin_dir_path(__FILE__) . 'includes/ai-functions.php';
include_once plugin_dir_path(__FILE__) . 'includes/api-functions.php';

// Enqueue JavaScript for AJAX
function smartmail_enqueue_scripts() {
    wp_enqueue_script('smartmail-ajax', plugin_dir_url(__FILE__) . 'assets/js/smartmail-ajax.js', array('jquery'), null, true);
    wp_localize_script('smartmail-ajax', 'smartmail_ajax', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'smartmail_enqueue_scripts');

// Register AJAX handlers for logged-in users
add_action('wp_ajax_smartmail_email_categorization', 'smartmail_email_categorization');
add_action('wp_ajax_smartmail_priority_inbox', 'smartmail_priority_inbox');
add_action('wp_ajax_smartmail_automated_responses', 'smartmail_automated_responses');
add_action('wp_ajax_smartmail_email_summarization', 'smartmail_email_summarization');
add_action('wp_ajax_smartmail_meeting_scheduler', 'smartmail_meeting_scheduler');
add_action('wp_ajax_smartmail_follow_up_reminders', 'smartmail_follow_up_reminders');
add_action('wp_ajax_smartmail_sentiment_analysis', 'smartmail_sentiment_analysis');
add_action('wp_ajax_smartmail_email_templates', 'smartmail_email_templates');
add_action('wp_ajax_smartmail_forensic_analysis', 'smartmail_forensic_analysis');

// Register AJAX handlers for non-logged-in users
add_action('wp_ajax_nopriv_smartmail_email_categorization', 'smartmail_email_categorization');
add_action('wp_ajax_nopriv_smartmail_priority_inbox', 'smartmail_priority_inbox');
add_action('wp_ajax_nopriv_smartmail_automated_responses', 'smartmail_automated_responses');
add_action('wp_ajax_nopriv_smartmail_email_summarization', 'smartmail_email_summarization');
add_action('wp_ajax_nopriv_smartmail_meeting_scheduler', 'smartmail_meeting_scheduler');
add_action('wp_ajax_nopriv_smartmail_follow_up_reminders', 'smartmail_follow_up_reminders');
add_action('wp_ajax_nopriv_smartmail_sentiment_analysis', 'smartmail_sentiment_analysis');
add_action('wp_ajax_nopriv_smartmail_email_templates', 'smartmail_email_templates');
add_action('wp_ajax_nopriv_smartmail_forensic_analysis', 'smartmail_forensic_analysis');

// Create necessary pages on plugin activation
function smartmail_create_pages() {
    $pages = [
        'SmartMail Page' => 'smartmail-page.php',
        'SmartMail Dashboard' => 'smartmail-dashboard.php'
    ];

    foreach ($pages as $title => $template) {
        $page_check = get_page_by_title($title);
        if (!isset($page_check->ID)) {
            $new_page_id = wp_insert_post([
                'post_title' => $title,
                'post_content' => '',
                'post_status' => 'publish',
                'post_type' => 'page',
                'page_template' => 'includes/templates/' . $template
            ]);
        }
    }
}
register_activation_hook(__FILE__, 'smartmail_create_pages');
