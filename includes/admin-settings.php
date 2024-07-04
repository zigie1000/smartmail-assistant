<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!function_exists('smartmail_register_settings')) {
    function smartmail_register_settings() {
        register_setting('smartmail-settings-group', 'smartmail_openai_api_key');
        register_setting('smartmail-settings-group', 'smartmail_email_username');
        register_setting('smartmail-settings-group', 'smartmail_email_password');
    }
}

if (!function_exists('smartmail_settings_page')) {
    function smartmail_settings_page() {
        add_options_page('SmartMail Settings', 'SmartMail', 'manage_options', 'smartmail-settings', 'smartmail_render_settings_page');
    }
}

if (!function_exists('smartmail_render_settings_page')) {
    function smartmail_render_settings_page() {
        ?>
        <div class="wrap">
            <h1>SmartMail Settings</h1>
            <form method="post" action="options.php">
                <?php settings_fields('smartmail-settings-group'); ?>
                <?php do_settings_sections('smartmail-settings-group'); ?>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">OpenAI API Key</th>
                        <td><input type="text" name="smartmail_openai_api_key" value="<?php echo esc_attr(get_option('smartmail_openai_api_key')); ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Email Username</th>
                        <td><input type="text" name="smartmail_email_username" value="<?php echo esc_attr(get_option('smartmail_email_username')); ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Email Password</th>
                        <td><input type="password" name="smartmail_email_password" value="<?php echo esc_attr(get_option('smartmail_email_password')); ?>" /></td>
                    </tr>
                </table>
                <?php submit_button(); ?>
            </form>
        </div>
        <?php
    }
}

add_action('admin_init', 'smartmail_register_settings');
add_action('admin_menu', 'smartmail_settings_page');
?>
