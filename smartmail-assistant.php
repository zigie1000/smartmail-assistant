<?php
/*
Plugin Name: SmartMail Assistant
Description: Enhance your email productivity with AI-powered features.
Author: Marco Zagato
Author URI: https://smartmail.store
Version: 1.0
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Includes
require_once plugin_dir_path(__FILE__) . 'includes/admin-settings.php';
require_once plugin_dir_path(__FILE__) . 'includes/api-functions.php';
require_once plugin_dir_path(__FILE__) . 'includes/shortcodes.php';

// Hooks and filters
add_action('admin_menu', 'smartmail_admin_menu');
add_action('admin_init', 'smartmail_register_settings');
add_action('wp_enqueue_scripts', 'smartmail_enqueue_scripts');
add_action('init', 'smartmail_register_shortcodes');
add_filter('theme_page_templates', 'smartmail_load_templates');
register_activation_hook(__FILE__, 'smartmail_create_pages');

// Admin menu setup
function smartmail_admin_menu() {
    add_menu_page(
        'SmartMail Assistant Settings',
        'SmartMail Assistant',
        'manage_options',
        'smartmail-assistant',
        'smartmail_settings_page',
        'dashicons-email',
        6
    );
}

// Register settings
function smartmail_register_settings() {
    register_setting('smartmail_settings_group', 'smartmail_openai_api_key');
}

// Enqueue scripts and styles
function smartmail_enqueue_scripts() {
    wp_enqueue_style('smartmail-style', plugins_url('assets/css/smartmail-style.css', __FILE__));
    wp_enqueue_script('smartmail-script', plugins_url('assets/js/smartmail-script.js', __FILE__), array('jquery'), null, true);
}

// Load templates
function smartmail_load_templates($templates) {
    $templates['smartmail-page.php'] = 'SmartMail Page';
    $templates['smartmail-dashboard.php'] = 'SmartMail Dashboard';
    return $templates;
}

// Create pages
function smartmail_create_pages() {
    $pages = array(
        'smartmail-page' => array(
            'title' => 'SmartMail Page',
            'content' => '[smartmail_page]'
        ),
        'smartmail-dashboard' => array(
            'title' => 'SmartMail Dashboard',
            'content' => '[smartmail_dashboard]'
        ),
    );

    foreach ($pages as $slug => $page) {
        if (!get_page_by_path($slug)) {
            wp_insert_post(array(
                'post_title' => $page['title'],
                'post_name' => $slug,
                'post_content' => $page['content'],
                'post_status' => 'publish',
                'post_type' => 'page'
            ));
        }
    }
}

// Register shortcodes
function smartmail_register_shortcodes() {
    add_shortcode('smartmail_page', 'smartmail_page_shortcode');
    add_shortcode('smartmail_dashboard', 'smartmail_dashboard_shortcode');
}
