<?php
// Register settings for the SmartMail Assistant
if (!function_exists('smartmail_register_settings')) {
    function smartmail_register_settings() {
        register_setting('smartmail_options_group', 'smartmail_openai_api_key');
        
        add_settings_section(
            'smartmail_settings_section', 
            'Main Settings', 
            'smartmail_settings_section_callback', 
            'smartmail'
        );

        add_settings_field(
            'smartmail_openai_api_key', 
            'OpenAI API Key', 
            'smartmail_openai_api_key_callback', 
            'smartmail', 
            'smartmail_settings_section'
        );
    }
}

function smartmail_settings_section_callback() {
    echo 'Main settings for SmartMail Assistant.';
}

function smartmail_openai_api_key_callback() {
    $api_key = get_option('smartmail_openai_api_key');
    echo '<input type="text" name="smartmail_openai_api_key" value="' . esc_attr($api_key) . '" />';
}

add_action('admin_init', 'smartmail_register_settings');
?>
