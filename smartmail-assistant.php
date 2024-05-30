<?php
/*
Plugin Name: SmartMail Assistant Developer
Description: Developer version with extended functionalities.
Version: 1.0
Author: Your Name
*/

if (!defined('ABSPATH')) {
    exit;
}

// Include necessary files
require_once plugin_dir_path(__FILE__) . 'includes/admin-settings.php';
require_once plugin_dir_path(__FILE__) . 'includes/api-functions.php';
require_once plugin_dir_path(__FILE__) . 'includes/subscription-functions.php';
require_once plugin_dir_path(__FILE__) . 'includes/shortcodes.php';
require_once plugin_dir_path(__FILE__) . 'src/pi-network-functions.php';

// Register activation hook
function sma_dev_activate() {
    sma_add_developer_role();
    update_option('sma_free_features', array('email_categorization', 'priority_inbox'));
    update_option('sma_pro_features', array('auto_responses', 'email_summarization', 'meeting_scheduler', 'follow_up_reminders', 'sentiment_analysis', 'email_templates'));
}
register_activation_hook(__FILE__, 'sma_dev_activate');

// Register deactivation hook
function sma_dev_deactivate() {
    delete_option('sma_free_features');
    delete_option('sma_pro_features');
}
register_deactivation_hook(__FILE__, 'sma_dev_deactivate');

// Enqueue scripts and styles
function sma_dev_enqueue_scripts() {
    wp_enqueue_style('sma-styles', plugin_dir_url(__FILE__) . 'assets/css/style.css');
    wp_enqueue_script('sma-scripts', plugin_dir_url(__FILE__) . 'assets/js/script.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'sma_dev_enqueue_scripts');

// Register custom page templates
function sma_dev_register_templates($templates) {
    $templates['templates/admin-dashboard-page.php'] = 'Admin Dashboard';
    $templates['templates/test-page.php'] = 'Test Page';
    return $templates;
}
add_filter('theme_page_templates', 'sma_dev_register_templates');

function sma_dev_load_template($template) {
    if (get_page_template_slug() == 'templates/admin-dashboard-page.php') {
        $template = plugin_dir_path(__FILE__) . 'templates/admin-dashboard-page.php';
    } elseif (get_page_template_slug() == 'templates/test-page.php') {
        $template = plugin_dir_path(__FILE__) . 'templates/test-page.php';
    }
    return $template;
}
add_filter('template_include', 'sma_dev_load_template');

// Add Developer Role
function sma_add_developer_role() {
    add_role('developer', 'Developer', array(
        'read' => true,
        'manage_options' => true,
    ));
}
register_activation_hook(__FILE__, 'sma_add_developer_role');

// Include Pi Network compatibility
require_once plugin_dir_path(__FILE__) . 'config/pi-sdk-config.php';