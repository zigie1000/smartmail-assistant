<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

function smartmail_register_settings() {
    register_setting('smartmail-settings-group', 'smartmail_openai_api_key');
    register_setting('smartmail-settings-group', 'smartmail_smtp_host');
    register_setting('smartmail-settings-group', 'smartmail_smtp_port');
    register_setting('smartmail-settings-group', 'smartmail_smtp_encryption');
    register_setting('smartmail-settings-group', 'smartmail_smtp_username');
    register_setting('smartmail-settings-group', 'smartmail_smtp_password');
    register_setting('smartmail-settings-group', 'smartmail_email_protocol');
    register_setting('smartmail-settings-group', 'smartmail_imap_host');
    register_setting('smartmail-settings-group', 'smartmail_imap_port');
    register_setting('smartmail-settings-group', 'smartmail_imap_encryption');
    register_setting('smartmail-settings-group', 'smartmail_imap_username');
    register_setting('smartmail-settings-group', 'smartmail_imap_password');
    register_setting('smartmail-settings-group', 'smartmail_pop3_host');
    register_setting('smartmail-settings-group', 'smartmail_pop3_port');
    register_setting('smartmail-settings-group', 'smartmail_pop3_encryption');
    register_setting('smartmail-settings-group', 'smartmail_pop3_username');
    register_setting('smartmail-settings-group', 'smartmail_pop3_password');
}
add_action('admin_init', 'smartmail_register_settings');

function smartmail_settings_page() {
    add_options_page('SmartMail Settings', 'SmartMail', 'manage_options', 'smartmail-settings', 'smartmail_render_settings_page');
}
add_action('admin_menu', 'smartmail_settings_page');

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
                    <th scope="row">SMTP Host</th>
                    <td><input type="text" name="smartmail_smtp_host" value="<?php echo esc_attr(get_option('smartmail_smtp_host')); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">SMTP Port</th>
                    <td><input type="number" name="smartmail_smtp_port" value="<?php echo esc_attr(get_option('smartmail_smtp_port')); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">SMTP Encryption</th>
                    <td>
                        <select name="smartmail_smtp_encryption">
                            <option value="none" <?php selected(get_option('smartmail_smtp_encryption'), 'none'); ?>>None</option>
                            <option value="ssl" <?php selected(get_option('smartmail_smtp_encryption'), 'ssl'); ?>>SSL</option>
                            <option value="tls" <?php selected(get_option('smartmail_smtp_encryption'), 'tls'); ?>>TLS</option>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">SMTP Username</th>
                    <td><input type="text" name="smartmail_smtp_username" value="<?php echo esc_attr(get_option('smartmail_smtp_username')); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">SMTP Password</th>
                    <td><input type="password" name="smartmail_smtp_password" value="<?php echo esc_attr(get_option('smartmail_smtp_password')); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Email Protocol</th>
                    <td>
                        <select name="smartmail_email_protocol">
                            <option value="imap" <?php selected(get_option('smartmail_email_protocol'), 'imap'); ?>>IMAP</option>
                            <option value="pop3" <?php selected(get_option('smartmail_email_protocol'), 'pop3'); ?>>POP3</option>
                        </select>
                    </td>
                </tr>
                <tr valign="top" class="imap-settings" <?php if(get_option('smartmail_email_protocol') !== 'imap') echo 'style="display:none;"'; ?>>
                    <th scope="row">IMAP Host</th>
                    <td><input type="text" name="smartmail_imap_host" value="<?php echo esc_attr(get_option('smartmail_imap_host')); ?>" /></td>
                </tr>
                <tr valign="top" class="imap-settings" <?php if(get_option('smartmail_email_protocol') !== 'imap') echo 'style="display:none;"'; ?>>
                    <th scope="row">IMAP Port</th>
                    <td><input type="number" name="smartmail_imap_port" value="<?php echo esc_attr(get_option('smartmail_imap_port')); ?>" /></td>
                </tr>
                <tr valign="top" class="imap-settings" <?php if(get_option('smartmail_email_protocol') !== 'imap') echo 'style="display:none;"'; ?>>
                    <th scope="row">IMAP Encryption</th>
                    <td>
                        <select name="smartmail_imap_encryption">
                            <option value="none" <?php selected(get_option('smartmail_imap_encryption'), 'none'); ?>>None</option>
                            <option value="ssl" <?php selected(get_option('smartmail_imap_encryption'), 'ssl'); ?>>SSL</option>
                            <option value="tls" <?php selected(get_option('smartmail_imap_encryption'), 'tls'); ?>>TLS</option>
                        </select>
                    </td>
                </tr>
                <tr valign="top" class="imap-settings" <?php if(get_option('smartmail_email_protocol') !== 'imap') echo 'style="display:none;"'; ?>>
                    <th scope="row">IMAP Username</th>
                    <td><input type="text" name="smartmail_imap_username" value="<?php echo esc_attr(get_option('smartmail_imap_username')); ?>" /></td>
                </tr>
                <tr valign="top" class="imap-settings" <?php if(get_option('smartmail_email_protocol') !== 'imap') echo 'style="display:none;"'; ?>>
                    <th scope="row">IMAP Password</th>
                    <td><input type="password" name="smartmail_imap_password" value="<?php echo esc_attr(get_option('smartmail_imap_password')); ?>" /></td>
                </tr>
                <tr valign="top" class="pop3-settings" <?php if(get_option('smartmail_email_protocol') !== 'pop3') echo 'style="display:none;"'; ?>>
                    <th scope="row">POP3 Host</th>
                    <td><input type="text" name="smartmail_pop3_host" value="<?php echo esc_attr(get_option('smartmail_pop3_host')); ?>" /></td>
                </tr>
                <tr valign="top" class="pop3-settings" <?php if(get_option('smartmail_email_protocol') !== 'pop3') echo 'style="display:none;"'; ?>>
                    <th scope="row">POP3 Port</th>
                    <td><input type="number" name="smartmail_pop3_port" value="<?php echo esc_attr(get_option('smartmail_pop3_port')); ?>" /></td>
                </tr>
                <tr valign="top" class="pop3-settings" <?php if(get_option('smartmail_email_protocol') !== 'pop3') echo 'style="display:none;"'; ?>>
                    <th scope="row">POP3 Encryption</th>
                    <td>
                        <select name="smartmail_pop3_encryption">
                            <option value="none" <?php selected(get_option('smartmail_pop3_encryption'), 'none'); ?>>None</option>
                            <option value="ssl" <?php selected(get_option('smartmail_pop3_encryption'), 'ssl'); ?>>SSL</option>
                            <option value="tls" <?php selected(get_option('smartmail_pop3_encryption'), 'tls'); ?>>TLS</option>
                        </select>
                    </td>
                </tr>
                <tr valign="top" class="pop3-settings" <?php if(get_option('smartmail_email_protocol') !== 'pop3') echo 'style="display:none;"'; ?>>
                    <th scope="row">POP3 Username</th>
                    <td><input type="text" name="smartmail_pop3_username" value="<?php echo esc_attr(get_option('smartmail_pop3_username')); ?>" /></td>
                </tr>
                <tr valign="top" class="pop3-settings" <?php if(get_option('smartmail_email_protocol') !== 'pop3') echo 'style="display:none;"'; ?>>
                    <th scope="row">POP3 Password</th>
                    <td><input type="password" name="smartmail_pop3_password" value="<?php echo esc_attr(get_option('smartmail_pop3_password')); ?>" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <script>
        jQuery(document).ready(function($) {
            $('select[name="smartmail_email_protocol"]').change(function() {
                var protocol = $(this).val();
                if (protocol === 'imap') {
                    $('.imap-settings').show();
                    $('.pop3-settings').hide();
                } else if (protocol === 'pop3') {
                    $('.imap-settings').hide();
                    $('.pop3-settings').show();
                }
            }).trigger('change');
        });
    </script>
    <?php
}
?>    
