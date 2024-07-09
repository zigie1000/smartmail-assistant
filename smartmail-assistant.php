<?php
/**
 * Plugin Name: SmartMail Assistant
 * Description: AI-powered email assistant for WordPress.
 * Version: 1.0.0
 * Author: Marco Zagato
 * Author URI: https://smartmail.store
 * License: MIT
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

define('SMARTMAIL_PLUGIN_DIR', plugin_dir_path(__FILE__));

require_once SMARTMAIL_PLUGIN_DIR . 'includes/admin-settings.php';
require_once SMARTMAIL_PLUGIN_DIR . 'includes/shortcodes.php';

function smartmail_register_scripts() {
    wp_register_script('smartmail-assistant-script', plugins_url('assets/js/script.js', __FILE__), array('jquery'), '1.0.0', true);
    wp_enqueue_script('smartmail-assistant-script');
}

add_action('wp_enqueue_scripts', 'smartmail_register_scripts');

function smartmail_admin_register_scripts() {
    wp_register_script('smartmail-assistant-admin-script', plugins_url('assets/js/admin-script.js', __FILE__), array('jquery'), '1.0.0', true);
    wp_enqueue_script('smartmail-assistant-admin-script');
}

add_action('admin_enqueue_scripts', 'smartmail_admin_register_scripts');

function smartmail_create_menu() {
    add_menu_page('SmartMail Assistant Settings', 'SmartMail Assistant', 'manage_options', 'smartmail-assistant', 'smartmail_settings_page', 'dashicons-email', 110);
}

add_action('admin_menu', 'smartmail_create_menu');

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

function smartmail_register_settings() {
    register_setting('smartmail-settings-group', 'smartmail_openai_api_key');
}
?>
