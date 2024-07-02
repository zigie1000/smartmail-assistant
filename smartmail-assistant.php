<?php
/*
Plugin Name: SmartMail Assistant
Description: A plugin to enhance email management with AI features.
Version: 1.0
Author: Marco Zagato
Author URI: https://smartmail.store
*/

if (!defined('ABSPATH')) {
    exit;
}

// Define constants
define('SMARTMAIL_ASSISTANT_DIR', plugin_dir_path(__FILE__));
define('SMARTMAIL_ASSISTANT_URL', plugin_dir_url(__FILE__));

// Include necessary files
require_once SMARTMAIL_ASSISTANT_DIR . 'vendor/autoload.php';
require_once SMARTMAIL_ASSISTANT_DIR . 'includes/admin-settings.php';
require_once SMARTMAIL_ASSISTANT_DIR . 'includes/ai-functions.php';
require_once SMARTMAIL_ASSISTANT_DIR . 'includes/shortcodes.php';

// Add admin menu
function smartmail_admin_menu() {
    add_menu_page(
        'SmartMail Assistant',
        'SmartMail Assistant',
        'manage_options',
        'smartmail-assistant',
        'smartmail_admin_page',
        'dashicons-email',
        6
    );
}

function smartmail_admin_page() {
    echo '<div class="wrap"><h1>SmartMail Assistant Settings</h1>';
    echo '<form method="post" action="options.php">';
    settings_fields('smartmail_options_group');
    do_settings_sections('smartmail');
    submit_button();
    echo '</form></div>';
}

add_action('admin_menu', 'smartmail_admin_menu');

// Register settings
function smartmail_register_settings() {
    register_setting('smartmail_options_group', 'smartmail_openai_api_key');
    add_settings_section('smartmail_settings_section', 'API Settings', null, 'smartmail');
    add_settings_field('smartmail_openai_api_key', 'OpenAI API Key', 'smartmail_openai_api_key_render', 'smartmail', 'smartmail_settings_section');
}

function smartmail_openai_api_key_render() {
    $value = get_option('smartmail_openai_api_key');
    echo '<input type="text" name="smartmail_openai_api_key" value="' . esc_attr($value) . '" />';
}

add_action('admin_init', 'smartmail_register_settings');

// Register shortcodes
add_action('init', 'smartmail_register_shortcodes');
