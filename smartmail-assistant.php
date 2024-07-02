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
                    'page_template' => 'templates/smartmail-page.php'
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

// AJAX handler functions
add_action('wp_ajax_smartmail_email_categorization', 'smartmail_email_categorization_handler');
add_action('wp_ajax_nopriv_smartmail_email_categorization', 'smartmail_email_categorization_handler');

function smartmail_email_categorization_handler() {
    if (isset($_POST['content'])) {
        $result = smartmail_email_categorization(sanitize_text_field($_POST['content']));
        echo $result;
    }
    wp_die();
}

// Repeat for other AJAX actions...
