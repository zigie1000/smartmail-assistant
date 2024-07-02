<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Function to add settings page
function smartmail_settings_init() {
    add_options_page(
        'SmartMail Assistant Settings',
        'SmartMail Assistant',
        'manage_options',
        'smartmail-assistant-settings',
        'smartmail_settings_page'
    );
}

add_action('admin_menu', 'smartmail_settings_init');

if (!function_exists('smartmail_settings_page')) {
    function smartmail_settings_page() {
        // Content of the settings page
        include plugin_dir_path(__FILE__) . 'templates/admin-settings-template.php';
    }
}
