<?php
// Add admin settings page
function smartmail_admin_settings() {
    add_options_page(
        'SmartMail Assistant Settings',
        'SmartMail Assistant',
        'manage_options',
        'smartmail',
        'smartmail_admin_settings_page'
    );
}
add_action('admin_menu', 'smartmail_admin_settings');

// Admin settings page content
function smartmail_admin_settings_page() {
    echo '<div class="wrap">';
    echo '<h1>SmartMail Assistant Settings</h1>';
    echo '<form method="post" action="options.php">';
    settings_fields('smartmail_options_group');
    do_settings_sections('smartmail');
    submit_button();
    echo '</form>';
    echo '</div>';
}

// Register and define the settings
function smartmail_register_settings() {
    register_setting('smartmail_options_group', 'smartmail_options');
    add_settings_section('smartmail_main_section', 'Main Settings', 'smartmail_section_callback', 'smartmail');
    add_settings_field('smartmail_field', 'API Key', 'smartmail_field_callback', 'smartmail', 'smartmail_main_section');
}
add_action('admin_init', 'smartmail_register_settings');

// Section callback
function smartmail_section_callback() {
    echo 'Enter your SmartMail settings below:';
}

// Field callback
function smartmail_field_callback() {
    $options = get_option('smartmail_options');
    echo '<input type="text" name="smartmail_options[api_key]" value="' . esc_attr($options['api_key']) . '">';
}
?>
