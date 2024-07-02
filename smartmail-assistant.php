<?php
/*
Plugin Name: SmartMail Assistant
Description: A plugin that provides various email-related features using OpenAI.
Author: Marco Zagato
Author URI: https://smartmail.store
Version: 1.0.0
*/

defined('ABSPATH') or die('No script kiddies please!');

// Define plugin path
define('SMARTMAIL_PLUGIN_PATH', plugin_dir_path(__FILE__));

// Include required files
include_once SMARTMAIL_PLUGIN_PATH . 'includes/admin-settings.php';
include_once SMARTMAIL_PLUGIN_PATH . 'includes/ai-functions.php';
include_once SMARTMAIL_PLUGIN_PATH . 'includes/api-functions.php';
include_once SMARTMAIL_PLUGIN_PATH . 'includes/class-wc-gateway-pi.php';
include_once SMARTMAIL_PLUGIN_PATH . 'includes/functions.php';
include_once SMARTMAIL_PLUGIN_PATH . 'includes/templates/smartmail-dashboard.php';
include_once SMARTMAIL_PLUGIN_PATH . 'includes/templates/smartmail-page.php';

// Register activation and deactivation hooks
register_activation_hook(__FILE__, 'smartmail_activate');
register_deactivation_hook(__FILE__, 'smartmail_deactivate');

function smartmail_activate() {
    // Create required pages
    $pages = [
        'SmartMail Dashboard' => 'smartmail-dashboard',
        'SmartMail Page' => 'smartmail-page'
    ];
    
    foreach ($pages as $title => $slug) {
        if (!get_page_by_path($slug)) {
            wp_insert_post([
                'post_title' => $title,
                'post_name' => $slug,
                'post_status' => 'publish',
                'post_type' => 'page',
                'page_template' => $slug . '.php'
            ]);
        }
    }
}

function smartmail_deactivate() {
    // Optionally remove pages or other deactivation tasks
}

add_action('admin_menu', 'smartmail_admin_menu');

function smartmail_admin_menu() {
    add_menu_page('SmartMail Assistant Settings', 'SmartMail Assistant', 'manage_options', 'smartmail-assistant', 'smartmail_settings_page');
}

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

add_action('admin_init', 'smartmail_settings');

function smartmail_settings() {
    register_setting('smartmail-settings-group', 'smartmail_openai_api_key');
}
?>
