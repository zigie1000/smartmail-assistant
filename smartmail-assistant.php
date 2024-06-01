<?php
/**
 * Plugin Name: SmartMail Assistant
 * Plugin URI: https://example.com/
 * Description: Main version of SmartMail Assistant for managing subscriptions and API integrations.
 * Version: 1.0.0
 * Author: Marco Zagato
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('SMARTMAIL_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('SMARTMAIL_PLUGIN_URL', plugin_dir_url(__FILE__));

// Include necessary files
require_once SMARTMAIL_PLUGIN_PATH . 'includes/admin-settings.php';
require_once SMARTMAIL_PLUGIN_PATH . 'includes/api-functions.php';

// Activation hook
function smartmail_activate() {
    // Activation code here
}
register_activation_hook(__FILE__, 'smartmail_activate');

// Deactivation hook
function smartmail_deactivate() {
    // Deactivation code here
}
register_deactivation_hook(__FILE__, 'smartmail_deactivate');

// Admin menu
function smartmail_admin_menu() {
    add_menu_page(
        'SmartMail Assistant',
        'SmartMail',
        'manage_options',
        'smartmail',
        'smartmail_admin_page',
        'dashicons-admin-generic',
        90
    );
}
add_action('admin_menu', 'smartmail_admin_menu');

// Admin page content
function smartmail_admin_page() {
    ?>
    <div class="wrap">
        <h1>SmartMail Assistant</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('smartmail_settings');
            do_settings_sections('smartmail');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Register settings
function smartmail_register_settings() {
    register_setting('smartmail_settings', 'smartmail_api_key');
    add_settings_section('smartmail_section', 'API Settings', null, 'smartmail');
    add_settings_field('smartmail_api_key', 'API Key', 'smartmail_api_key_callback', 'smartmail', 'smartmail_section');
}
add_action('admin_init', 'smartmail_register_settings');

// API Key field callback
function smartmail_api_key_callback() {
    $api_key = get_option('smartmail_api_key');
    echo '<input type="text" name="smartmail_api_key" value="' . esc_attr($api_key) . '" class="regular-text">';
}
?>
