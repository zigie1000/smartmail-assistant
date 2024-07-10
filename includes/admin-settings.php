<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

function smartmail_register_settings() {
    register_setting('smartmail-settings-group', 'smartmail_openai_api_key');
    register_setting('smartmail-settings-group', 'smartmail_email_username');
    register_setting('smartmail-settings-group', 'smartmail_email_password');
    register_setting('smartmail-settings-group', 'smartmail_email_server');
    register_setting('smartmail-settings-group', 'smartmail_email_protocol');
}
add_action('admin_init', 'smartmail_register_settings');

function smartmail_settings_page() {
    ?>
    <div class="wrap">
        <h1>SmartMail Assistant Settings</h1>
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
                <tr valign="top">
                    <th scope="row">Email Server</th>
                    <td><input type="text" name="smartmail_email_server" value="<?php echo esc_attr(get_option('smartmail_email_server')); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Email Protocol (IMAP/POP)</th>
                    <td>
                        <select name="smartmail_email_protocol">
                            <option value="imap" <?php selected(get_option('smartmail_email_protocol'), 'imap'); ?>>IMAP</option>
                            <option value="pop" <?php selected(get_option('smartmail_email_protocol'), 'pop'); ?>>POP</option>
                        </select>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}
