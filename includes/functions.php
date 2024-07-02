<?php
if (!defined('ABSPATH')) {
    exit;
}

// General functions

function smartmail_log($message) {
    if (defined('SMARTMAIL_DEBUG_LOG')) {
        error_log($message . PHP_EOL, 3, SMARTMAIL_DEBUG_LOG);
    }
}

function smartmail_register_settings() {
    register_setting('smartmail_options_group', 'smartmail_openai_api_key', [
        'type' => 'string',
        'description' => 'OpenAI API Key',
        'sanitize_callback' => 'sanitize_text_field',
        'default' => ''
    ]);

    add_settings_section(
        'smartmail_settings_section',
        'SmartMail Assistant Settings',
        null,
        'smartmail'
    );

    add_settings_field(
        'smartmail_openai_api_key',
        'OpenAI API Key',
        'smartmail_openai_api_key_render',
        'smartmail',
        'smartmail_settings_section'
    );
}
add_action('admin_init', 'smartmail_register_settings');

function smartmail_openai_api_key_render() {
    $value = get_option('smartmail_openai_api_key');
    ?>
    <input type="text" name="smartmail_openai_api_key" value="<?php echo esc_attr($value); ?>" />
    <?php
}
?>
