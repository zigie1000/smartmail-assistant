<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Ensure functions are not redeclared
if (!function_exists('smartmail_settings_page')) {
    function smartmail_settings_page() {
        ?>
        <div class="wrap">
            <h1>SmartMail Assistant Settings</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('smartmail-settings-group');
                do_settings_sections('smartmail-settings-group');
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
}

if (!function_exists('smartmail_admin_menu')) {
    function smartmail_admin_menu() {
        add_menu_page('SmartMail Assistant Settings', 'SmartMail Assistant', 'manage_options', 'smartmail-assistant', 'smartmail_settings_page');
    }
}

add_action('admin_menu', 'smartmail_admin_menu');

if (!function_exists('smartmail_settings')) {
    function smartmail_settings() {
        register_setting('smartmail-settings-group', 'smartmail_openai_api_key');
    }
}

add_action('admin_init', 'smartmail_settings');
?>
