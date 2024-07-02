<?php

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('WC_Payment_Gateway')) {
    return; // Exit if WooCommerce is not active
}

// Add additional admin settings for SmartMail
function smartmail_additional_settings() {
    // Register settings, add sections, fields, etc.
    register_setting('smartmail_options_group', 'smartmail_custom_setting', [
        'type' => 'string',
        'description' => 'Custom Setting',
        'sanitize_callback' => 'sanitize_text_field',
        'default' => ''
    ]);

    add_settings_section(
        'smartmail_custom_settings_section',
        'SmartMail Custom Settings',
        null,
        'smartmail'
    );

    add_settings_field(
        'smartmail_custom_setting',
        'Custom Setting',
        'smartmail_custom_setting_render',
        'smartmail',
        'smartmail_custom_settings_section'
    );
}

add_action('admin_init', 'smartmail_additional_settings');

function smartmail_custom_setting_render() {
    $value = get_option('smartmail_custom_setting');
    ?>
    <input type="text" name="smartmail_custom_setting" value="<?php echo esc_attr($value); ?>" />
    <?php
}
