<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

function smartmail_admin_menu() {
    add_menu_page(
        'SmartMail Assistant Settings',
        'SmartMail Assistant',
        'manage_options',
        'smartmail-assistant',
        'smartmail_settings_page',
        'dashicons-email-alt2'
    );
}
add_action('admin_menu', 'smartmail_admin_menu');

function smartmail_settings_page() {
    ?>
    <div class="wrap">
        <h1>SmartMail Assistant Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('smartmail_settings_group');
            do_settings_sections('smartmail_settings_group');
            ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">OpenAI API Key</th>
                    <td><input type="text" name="smartmail_openai_api_key" value="<?php echo esc_attr(get_option('smartmail_openai_api_key')); ?>" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

function smartmail_register_settings() {
    register_setting('smartmail_settings_group', 'smartmail_openai_api_key');
}
add_action('admin_init', 'smartmail_register_settings');
