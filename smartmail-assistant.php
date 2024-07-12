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

// Ensure vendor autoload is available
function sma_check_composer_install() {
    $vendor_dir = plugin_dir_path(__FILE__) . 'vendor';
    if (!file_exists($vendor_dir . '/autoload.php')) {
        $composer_json_path = plugin_dir_path(__FILE__) . 'composer.json';
        if (file_exists($composer_json_path)) {
            shell_exec('cd ' . escapeshellarg(plugin_dir_path(__FILE__)) . ' && composer install');
        }
    }
}
add_action('admin_init', 'sma_check_composer_install');

// Include Composer autoload
require plugin_dir_path(__FILE__) . 'vendor/autoload.php';

// Include necessary files
include_once plugin_dir_path(__FILE__) . 'includes/admin-settings.php';
include_once plugin_dir_path(__FILE__) . 'includes/api-functions.php';
include_once plugin_dir_path(__FILE__) . 'includes/shortcodes.php';

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

// Create or update necessary pages and assign templates
function create_smartmail_pages() {
    $pages = [
        'smartmail-assistant' => [
            'title' => 'SmartMail Assistant',
            'content' => '[sma_assistant]',
            'template' => 'smartmail-page.php'
        ],
        'smartmail-dashboard' => [
            'title' => 'SmartMail Dashboard',
            'content' => '[sma_dashboard]',
            'template' => 'smartmail-dashboard.php'
        ],
    ];

    foreach ($pages as $slug => $page) {
        $existing_page = get_page_by_path($slug);
        if (!$existing_page) {
            $page_id = wp_insert_post([
                'post_title' => $page['title'],
                'post_name' => $slug,
                'post_content' => $page['content'],
                'post_status' => 'publish',
                'post_type' => 'page',
            ]);

            if ($page_id && !is_wp_error($page_id)) {
                update_post_meta($page_id, '_wp_page_template', $page['template']);
            }
        } else {
            // Update the template of the existing page
            update_post_meta($existing_page->ID, '_wp_page_template', $page['template']);
        }
    }
}
add_action('init', 'create_smartmail_pages');

// Register custom templates
function smartmail_register_templates($templates) {
    $templates['smartmail-page.php'] = 'SmartMail Assistant';
    $templates['smartmail-dashboard.php'] = 'SmartMail Dashboard';
    return $templates;
}
add_filter('theme_page_templates', 'smartmail_register_templates');

// Load custom templates
function smartmail_load_template($template) {
    global $post;

    if (!$post) return $template;

    $custom_template = get_post_meta($post->ID, '_wp_page_template', true);
    if (in_array($custom_template, ['smartmail-page.php', 'smartmail-dashboard.php'])) {
        $template_path = SMARTMAIL_PLUGIN_DIR . 'templates/' . $custom_template;
        if (file_exists($template_path)) {
            return $template_path;
        }
    }

    return $template;
}
add_filter('template_include', 'smartmail_load_template');
?>
