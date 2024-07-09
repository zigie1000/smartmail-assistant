<?php
/*
Plugin Name: SmartMail Assistant
Plugin URI: https://smartmail.store
Description: A plugin to assist with SmartMail features.
Version: 1.0.0
Author: Marco Zagato
Author URI: https://smartmail.store
License: GPL2
*/

if (!defined('WPINC')) {
    die;
}

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

// Admin menu
function smartmail_admin_menu() {
    add_menu_page(
        'SmartMail Assistant Settings',
        'SmartMail Assistant',
        'manage_options',
        'smartmail-assistant',
        'smartmail_settings_page',
        'dashicons-email-alt',
        20
    );
}
add_action('admin_menu', 'smartmail_admin_menu');
?>
