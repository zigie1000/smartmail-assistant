<?php
/*
Plugin Name: SmartMail Assistant
Description: A plugin to manage SmartMail functionalities including AI-based email categorization, priority inbox, and more.
Version: 1.0.0
Author: Marco Zagato
Author URI: https://smartmail.store
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Include dependencies
require_once plugin_dir_path(__FILE__) . 'includes/admin-settings.php';
require_once plugin_dir_path(__FILE__) . 'includes/ai-functions.php';
require_once plugin_dir_path(__FILE__) . 'includes/api-functions.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-wc-gateway-pi.php';
require_once plugin_dir_path(__FILE__) . 'includes/functions.php';
require_once plugin_dir_path(__FILE__) . 'includes/shortcodes.php';

// Initialize the plugin
function smartmail_assistant_init() {
    // Add custom initialization code here
    add_action('admin_menu', 'smartmail_assistant_menu');
}

add_action('plugins_loaded', 'smartmail_assistant_init');

// Add admin menu
function smartmail_assistant_menu() {
    add_menu_page(
        'SmartMail Assistant',
        'SmartMail Assistant',
        'manage_options',
        'smartmail-assistant',
        'smartmail_assistant_settings_page',
        'dashicons-email-alt',
        26
    );
}

// Display settings page
function smartmail_assistant_settings_page() {
    echo '<div class="wrap">';
    echo '<h1>SmartMail Assistant Settings</h1>';
    echo '<form method="post" action="options.php">';
    settings_fields('smartmail_options_group');
    do_settings_sections('smartmail');
    submit_button();
    echo '</form>';
    echo '</div>';
}

// Register settings
function smartmail_assistant_register_settings() {
    register_setting('smartmail_options_group', 'smartmail_options', 'smartmail_options_validate');
    add_settings_section('smartmail_main', 'Main Settings', 'smartmail_section_text', 'smartmail');
    add_settings_field('smartmail_openai_api_key', 'OpenAI API Key', 'smartmail_openai_api_key_render', 'smartmail', 'smartmail_main');
}

add_action('admin_init', 'smartmail_assistant_register_settings');

function smartmail_section_text() {
    echo '<p>Enter your settings below:</p>';
}

function smartmail_openai_api_key_render() {
    $options = get_option('smartmail_options');
    echo "<input id='smartmail_openai_api_key' name='smartmail_options[openai_api_key]' size='40' type='text' value='{$options['openai_api_key']}' />";
}

function smartmail_options_validate($input) {
    $newinput['openai_api_key'] = trim($input['openai_api_key']);
    if (!preg_match('/^[a-zA-Z0-9]{32}$/i', $newinput['openai_api_key'])) {
        $newinput['openai_api_key'] = '';
    }
    return $newinput;
}
