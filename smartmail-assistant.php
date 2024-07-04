<?php
/*
Plugin Name: SmartMail Assistant
Description: SmartMail Assistant provides AI-powered email management features.
Version: 1.0
Author: Marco Zagato
Author URI: https://smartmail.store
*/

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Include dependencies
require_once plugin_dir_path(__FILE__) . 'vendor/autoload.php';
require_once plugin_dir_path(__FILE__) . 'includes/admin-settings.php';
require_once plugin_dir_path(__FILE__) . 'includes/api-functions.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-wc-gateway-pi.php';
require_once plugin_dir_path(__FILE__) . 'includes/shortcodes.php';

// Activation hook
register_activation_hook(__FILE__, 'smartmail_activate');
function smartmail_activate() {
    // Ensure Composer dependencies are loaded
    if (!file_exists(plugin_dir_path(__FILE__) . 'vendor/autoload.php')) {
        die('Composer dependencies not installed. Please run `composer install`.');
    }
    // Add activation tasks if needed
}

// Deactivation hook
register_deactivation_hook(__FILE__, 'smartmail_deactivate');
function smartmail_deactivate() {
    // Add deactivation tasks if needed
}

// Admin menu
function smartmail_admin_menu() {
    add_menu_page(
        'SmartMail Assistant',
        'manage_options',
        'smartmail-assistant',
        'smartmail_settings_page',
        'dashicons-email-alt',
        6
    );
}
add_action('admin_menu', 'smartmail_admin_menu');

// Admin settings page
function smartmail_settings_page() {
    ?>
    <div class="wrap">
        <h1>SmartMail Assistant Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('smartmail-assistant-settings-group');
            do_settings_sections('smartmail-assistant-settings-group');
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
add_action('admin_init', 'smartmail_register_settings');
function smartmail_register_settings() {
    register_setting('smartmail-assistant-settings-group', 'smartmail_openai_api_key');
}

// Register shortcodes
function smartmail_register_shortcodes() {
    add_shortcode('sma_email_categorization', 'smartmail_email_categorization_shortcode');
    add_shortcode('sma_priority_inbox', 'smartmail_priority_inbox_shortcode');
    add_shortcode('sma_automated_responses', 'smartmail_automated_responses_shortcode');
    add_shortcode('sma_email_summarization', 'smartmail_email_summarization_shortcode');
    add_shortcode('sma_meeting_scheduler', 'smartmail_meeting_scheduler_shortcode');
    add_shortcode('sma_follow_up_reminders', 'smartmail_follow_up_reminders_shortcode');
    add_shortcode('sma_sentiment_analysis', 'smartmail_sentiment_analysis_shortcode');
    add_shortcode('sma_email_templates', 'smartmail_email_templates_shortcode');
    add_shortcode('sma_forensic_analysis', 'smartmail_forensic_analysis_shortcode');
}
add_action('init', 'smartmail_register_shortcodes');

// Create required pages
function smartmail_create_required_pages() {
    $pages = [
        'smartmail-page' => [
            'title' => 'SmartMail Page',
            'content' => '[sma_email_categorization][sma_priority_inbox][sma_automated_responses][sma_email_summarization][sma_meeting_scheduler][sma_follow_up_reminders][sma_sentiment_analysis][sma_email_templates][sma_forensic_analysis]'
        ],
    ];

    foreach ($pages as $slug => $page) {
        if (!get_page_by_path($slug)) {
            wp_insert_post([
                'post_name' => $slug,
                'post_title' => $page['title'],
                'post_content' => $page['content'],
                'post_status' => 'publish',
                'post_type' => 'page'
            ]);
        }
    }
}
add_action('after_switch_theme', 'smartmail_create_required_pages');    
