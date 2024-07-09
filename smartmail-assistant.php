<?php
/**
 * Plugin Name: SmartMail Assistant
 * Description: AI-powered email assistant for WordPress.
 * Version: 1.0.0
 * Author: Marco Zagato
 * Author URI: https://smartmail.store
 * License: MIT
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

define('SMARTMAIL_PLUGIN_DIR', plugin_dir_path(__FILE__));

// Load Composer's autoload file
require SMARTMAIL_PLUGIN_DIR . 'vendor/autoload.php';

// Load dependencies
require_once SMARTMAIL_PLUGIN_DIR . 'includes/admin-settings.php';
require_once SMARTMAIL_PLUGIN_DIR . 'includes/api-functions.php';
require_once SMARTMAIL_PLUGIN_DIR . 'includes/shortcodes.php';

// Register and enqueue scripts
function smartmail_register_scripts() {
    wp_register_script('smartmail-assistant-script', plugins_url('assets/js/script.js', __FILE__), array('jquery'), '1.0.0', true);
    wp_enqueue_script('smartmail-assistant-script');
}

add_action('wp_enqueue_scripts', 'smartmail_register_scripts');

function smartmail_admin_register_scripts() {
    wp_register_script('smartmail-assistant-admin-script', plugins_url('assets/js/admin-script.js', __FILE__), array('jquery'), '1.0.0', true);
    wp_enqueue_script('smartmail-assistant-admin-script');
}

add_action('admin_enqueue_scripts', 'smartmail_admin_register_scripts');

// Create admin menu
function smartmail_create_menu() {
    add_menu_page('SmartMail Assistant Settings', 'SmartMail Assistant', 'manage_options', 'smartmail-assistant', 'smartmail_settings_page', 'dashicons-email', 110);
}

add_action('admin_menu', 'smartmail_create_menu');

// Create necessary pages
function create_smartmail_pages() {
    $pages = [
        'smartmail-assistant' => [
            'title' => 'SmartMail Assistant',
            'content' => '[sma_assistant]'
        ],
        'smartmail-dashboard' => [
            'title' => 'SmartMail Dashboard',
            'content' => '[sma_dashboard]'
        ],
    ];

    foreach ($pages as $slug => $page) {
        if (!get_page_by_path($slug)) {
            wp_insert_post([
                'post_title' => $page['title'],
                'post_name' => $slug,
                'post_content' => $page['content'],
                'post_status' => 'publish',
                'post_type' => 'page',
            ]);
        }
    }
}
add_action('init', 'create_smartmail_pages');
?>
