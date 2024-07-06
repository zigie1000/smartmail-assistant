<?php
/**
 * Plugin Name: SmartMail Assistant
 * Description: An AI-driven email assistant providing various features such as email categorization, priority inbox, automated responses, and more.
 * Version: 1.0.0
 * Author: Marco Zagato
 * Author URI: https://smartmail.store
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

require_once plugin_dir_path(__FILE__) . 'smartmail-api-functions.php';
require_once plugin_dir_path(__FILE__) . 'smartmail-shortcodes.php';

function smartmail_activate() {
    smartmail_create_page('SmartMail Assistant', 'smartmail-assistant', '[sma_assistant]');
    smartmail_create_page('SmartMail Dashboard', 'smartmail-dashboard', '[sma_dashboard]');
}
register_activation_hook(__FILE__, 'smartmail_activate');

function smartmail_create_page($title, $slug, $shortcode) {
    $page = get_page_by_path($slug);
    if (!$page) {
        wp_insert_post([
            'post_title' => $title,
            'post_name' => $slug,
            'post_content' => $shortcode,
            'post_status' => 'publish',
            'post_type' => 'page'
        ]);
    }
}

add_action('admin_menu', 'smartmail_register_menu');
function smartmail_register_menu() {
    add_menu_page('SmartMail Assistant', 'SmartMail Assistant', 'manage_options', 'smartmail-assistant', 'smartmail_render_dashboard', 'dashicons-email-alt', 6);
    add_submenu_page('smartmail-assistant', 'Dashboard', 'Dashboard', 'manage_options', 'smartmail-dashboard', 'smartmail_render_dashboard');
}

function smartmail_render_dashboard() {
    echo '<div class="wrap"><h1>SmartMail Assistant Dashboard</h1></div>';
}

add_action('wp_ajax_smartmail_email_categorization', 'smartmail_handle_email_categorization');
add_action('wp_ajax_nopriv_smartmail_email_categorization', 'smartmail_handle_email_categorization');
function smartmail_handle_email_categorization() {
    // Your email categorization logic here
    wp_send_json_success('Categorized email content');
}

add_action('wp_ajax_smartmail_priority_inbox', 'smartmail_handle_priority_inbox');
add_action('wp_ajax_nopriv_smartmail_priority_inbox', 'smartmail_handle_priority_inbox');
function smartmail_handle_priority_inbox() {
    // Your priority inbox logic here
    wp_send_json_success('Email priority determined');
}

// Repeat similar AJAX handlers for other features

?>
