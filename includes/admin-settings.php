<?php
// Admin settings for SmartMail Assistant

if (!function_exists('smartmail_register_settings')) {
    function smartmail_register_settings() {
        register_setting('smartmail_options_group', 'smartmail_openai_api_key');
        add_settings_section('smartmail_main_section', 'Main Settings', 'smartmail_main_section_cb', 'smartmail');
        add_settings_field('smartmail_openai_api_key', 'OpenAI API Key', 'smartmail_openai_api_key_cb', 'smartmail', 'smartmail_main_section');
    }
}
add_action('admin_init', 'smartmail_register_settings');

function smartmail_main_section_cb() {
    echo '<p>Main settings for SmartMail Assistant.</p>';
}

function smartmail_openai_api_key_cb() {
    $api_key = get_option('smartmail_openai_api_key');
    echo '<input type="text" id="smartmail_openai_api_key" name="smartmail_openai_api_key" value="' . esc_attr($api_key) . '" />';
}
?>
