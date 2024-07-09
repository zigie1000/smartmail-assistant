<?php
/*
Plugin Name: SmartMail Assistant
Plugin URI: https://smartmail.store
Description: A plugin to assist with SmartMail features.
Version: 1.0.0
Author: Marco Zagato
Author URI: https://smartmail.store
License: MIT
*/

if (!defined('WPINC')) {
    die;
}

// Ensure vendor autoload is available
function sma_check_composer_install() {
    $vendor_dir = plugin_dir_path(__FILE__) . 'vendor';
    if (!file_exists($vendor_dir . '/autoload.php')) {
        $composer_json_path = plugin_dir_path(__FILE__) . 'composer.json';
        if (file_exists($composer_json_path)) {
            shell_exec('cd ' . escapeshellarg(plugin_dir_path(__FILE__)) . ' && composer install');
        }
    }
}
add_action('admin_init', 'sma_check_composer_install');

// Include Composer autoload
require plugin_dir_path(__FILE__) . 'vendor/autoload.php';

// Include necessary files
include_once plugin_dir_path(__FILE__) . 'includes/admin-settings.php';
include_once plugin_dir_path(__FILE__) . 'includes/api-functions.php';
include_once plugin_dir_path(__FILE__) . 'includes/shortcodes.php';

// Admin menu
function smartmail_admin_menu() {
    add_menu_page(
        'SmartMail Assistant Settings',
        'SmartMail Assistant',
        'manage_options',
        'smartmail-assistant',
        'smartmail_settings_page',
        'dashicons-email-alt',
        20
    );
}
add_action('admin_menu', 'smartmail_admin_menu');

// Settings page
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

function register_smartmail_settings() {
    register_setting('smartmail-settings-group', 'smartmail_openai_api_key');
}
add_action('admin_init', 'register_smartmail_settings');

// Create necessary pages
function create_smartmail_pages() {
    $pages = [
        'smartmail-assistant' => [
            'title' => 'SmartMail Assistant',
            'content' => '[sma_assistant]'
        ],
        'smartmail-dashboard' => [
            'title' => 'SmartMail Dashboard',
            'content' => '[sma_dashboard]'
        ],
    ];

    foreach ($ pages as $slug => $page) {
        if (!get_page_by_path($slug)) {
            wp_insert_post([
                'post_title' => $page['title'],
                'post_name' => $slug,
                'post_content' => $page['content'],
                'post_status' => 'publish',
                'post_type' => 'page',
            ]);
        }
    }
}
add_action('init', 'create_smartmail_pages');
?>
