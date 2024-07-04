<?php
/*
Plugin Name: SmartMail Assistant
Description: Provides advanced email management using OpenAI.
Author: Marco Zagato
Author URI: https://smartmail.store
Version: 1.0.0
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Include necessary files
include_once plugin_dir_path(__FILE__) . 'includes/admin-settings.php';
include_once plugin_dir_path(__FILE__) . 'includes/api-functions.php';
include_once plugin_dir_path(__FILE__) . 'includes/shortcodes.php';
include_once plugin_dir_path(__FILE__) . 'includes/class-wc-gateway-pi.php';

// Register settings and admin menu
add_action('admin_init', 'smartmail_register_settings');
add_action('admin_menu', 'smartmail_settings_page');

// Activation hook
function smartmail_activate() {
    // Actions to perform upon plugin activation
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'smartmail_activate');

// Deactivation hook
function smartmail_deactivate() {
    // Actions to perform upon plugin deactivation
    flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'smartmail_deactivate');
?>
