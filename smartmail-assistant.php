<?php
/**
 * Plugin Name: SmartMail Assistant
 * Description: An AI-powered email assistant plugin for WordPress.
 * Version: 1.0
 * Author: Marco Zagato
 * Author URI: https://smartmail.store
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Include necessary files
require_once plugin_dir_path(__FILE__) . 'vendor/autoload.php';
include_once plugin_dir_path(__FILE__) . 'includes/admin-settings.php';
include_once plugin_dir_path(__FILE__) . 'includes/api-functions.php';
include_once plugin_dir_path(__FILE__) . 'includes/shortcodes.php';
include_once plugin_dir_path(__FILE__) . 'includes/subscriptions-functions.php';
include_once plugin_dir_path(__FILE__) . 'includes/class-wc-gateway-pi.php';

// Add admin menu
function smartmail_admin_menu() {
    add_menu_page(
        'SmartMail Assistant Settings',
        'SmartMail Assistant',
        'manage_options',
        'smartmail-assistant-settings',
        'smartmail_settings_page',
        'dashicons-email-alt',
        6
    );
}
add_action('admin_menu', 'smartmail_admin_menu');

// Plugin activation hook
function smartmail_activate() {
    // Code to run on activation
}
register_activation_hook(__FILE__, 'smartmail_activate');

// Plugin deactivation hook
function smartmail_deactivate() {
    // Code to run on deactivation
}
register_deactivation_hook(__FILE__, 'smartmail_deactivate');

// Enqueue scripts and styles
function smartmail_enqueue_scripts() {
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'smartmail_enqueue_scripts');
