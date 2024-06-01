<?php
// Admin settings for SmartMail Assistant Plugin

// Register settings
function smartmail_register_settings() {
    register_setting('smartmail_settings', 'smartmail_api_key');
    add_settings_section('smartmail_section', 'API Settings', null, 'smartmail');
    add_settings_field('smartmail_api_key', 'API Key', 'smartmail_api_key_callback', 'smartmail', 'smartmail_section');
}
add_action('admin_init', 'smartmail_register_settings');

// API Key field callback
function smartmail_api_key_callback() {
    $api_key = get_option('smartmail_api_key');
    echo '<input type="text" name="smartmail_api_key" value="' . esc_attr($api_key) . '" class="regular-text">';
}
?>
