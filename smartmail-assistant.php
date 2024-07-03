<?php
/**
 * Plugin Name: SmartMail Assistant
 * Description: AI-powered email management.
 * Version: 1.0
 * Author: Marco Zagato
 * Author URI: https://smartmail.store
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Include necessary files
include_once plugin_dir_path(__FILE__) . 'includes/admin-settings.php';
include_once plugin_dir_path(__FILE__) . 'includes/api-functions.php';

// Register activation hook
register_activation_hook(__FILE__, 'smartmail_create_required_pages');

// Create required pages upon activation
function smartmail_create_required_pages() {
    $pages = [
        'smartmail-dashboard' => [
            'title' => 'SmartMail Dashboard',
            'content' => '[smartmail_dashboard]',
        ],
        'smartmail-page' => [
            'title' => 'SmartMail Page',
            'content' => '[smartmail_page]',
        ],
    ];

    foreach ($pages as $slug => $page) {
        if (!get_page_by_path($slug)) {
            wp_insert_post([
                'post_name' => $slug,
                'post_title' => $page['title'],
                'post_content' => $page['content'],
                'post_status' => 'publish',
                'post_type' => 'page',
            ]);
        }
    }
}

// Shortcodes for rendering AI-powered features
function smartmail_dashboard_shortcode() {
    ob_start();
    include plugin_dir_path(__FILE__) . 'includes/templates/smartmail-dashboard.php';
    return ob_get_clean();
}
add_shortcode('smartmail_dashboard', 'smartmail_dashboard_shortcode');

function smartmail_page_shortcode() {
    ob_start();
    include plugin_dir_path(__FILE__) . 'includes/templates/smartmail-page.php';
    return ob_get_clean();
}
add_shortcode('smartmail_page', 'smartmail_page_shortcode');
