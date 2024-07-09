<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

function smartmail_register_settings() {
    register_setting('smartmail-settings-group', 'smartmail_openai_api_key');
}

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
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

add_action('admin_init', 'smartmail_register_settings');
add_action('admin_menu', 'smartmail_settings_page');
?>
