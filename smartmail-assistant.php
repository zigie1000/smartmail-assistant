<?php
/*
Plugin Name: SmartMail Assistant
Description: An AI-powered assistant for managing emails.
Version: 1.0.0
Author: Marco Zagato
Author URI: https://smartmail.store
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Include necessary files
include_once plugin_dir_path(__FILE__) . 'includes/admin-settings.php';
include_once plugin_dir_path(__FILE__) . 'includes/api-functions.php';
include_once plugin_dir_path(__FILE__) . 'includes/ai-functions.php';
include_once plugin_dir_path(__FILE__) . 'includes/shortcodes.php';

// Register the activation hook to create necessary pages
register_activation_hook(__FILE__, 'smartmail_create_pages');

function smartmail_create_pages() {
    // Create SmartMail Dashboard Page
    $dashboard_page = array(
        'post_title'    => 'SmartMail Dashboard',
        'post_content'  => '',
        'post_status'   => 'publish',
        'post_type'     => 'page',
        'post_author'   => 1,
        'page_template' => 'includes/templates/smartmail-dashboard.php'
    );

    // Create SmartMail Page
    $smartmail_page = array(
        'post_title'    => 'SmartMail Page',
        'post_content'  => '',
        'post_status'   => 'publish',
        'post_type'     => 'page',
        'post_author'   => 1,
        'page_template' => 'includes/templates/smartmail-page.php'
    );

    // Insert the pages into the database
    wp_insert_post($dashboard_page);
    wp_insert_post($smartmail_page);
}

// Add admin menu
add_action('admin_menu', 'smartmail_admin_menu');

function smartmail_admin_menu() {
    add_menu_page('SmartMail Assistant', 'SmartMail Assistant', 'manage_options', 'smartmail-assistant', 'smartmail_settings_page', 'dashicons-email-alt2');
}

function smartmail_settings_page() {
    include plugin_dir_path(__FILE__) . 'includes/templates/admin-settings-template.php';
}

// Add AJAX actions
add_action('wp_ajax_smartmail_email_categorization', 'smartmail_email_categorization');
add_action('wp_ajax_smartmail_priority_inbox', 'smartmail_priority_inbox');
add_action('wp_ajax_smartmail_automated_responses', 'smartmail_automated_responses');
add_action('wp_ajax_smartmail_email_summarization', 'smartmail_email_summarization');
add_action('wp_ajax_smartmail_meeting_scheduler', 'smartmail_meeting_scheduler');
add_action('wp_ajax_smartmail_follow_up_reminders', 'smartmail_follow_up_reminders');
add_action('wp_ajax_smartmail_sentiment_analysis', 'smartmail_sentiment_analysis');
add_action('wp_ajax_smartmail_email_templates', 'smartmail_email_templates');
add_action('wp_ajax_smartmail_forensic_analysis', 'smartmail_forensic_analysis');
