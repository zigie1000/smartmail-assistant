<?php
/**
 * Plugin Name: SmartMail Assistant
 * Description: A plugin to assist with managing emails using AI.
 * Author: Marco Zagato
 * Author URI: https://smartmail.store
 * Version: 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

define('SMARTMAIL_PLUGIN_DIR', plugin_dir_path(__FILE__));

require_once SMARTMAIL_PLUGIN_DIR . 'includes/api-functions.php';
require_once SMARTMAIL_PLUGIN_DIR . 'includes/ai-functions.php';
require_once SMARTMAIL_PLUGIN_DIR . 'includes/admin-settings.php';

function smartmail_create_required_pages() {
    $pages = [
        'smartmail-dashboard' => [
            'title' => 'SmartMail Dashboard',
            'content' => '[sma_dashboard]'
        ],
        'smartmail-page' => [
            'title' => 'SmartMail Page',
            'content' => '[sma_page]'
        ]
    ];

    foreach ($pages as $slug => $page) {
        if (!get_page_by_path($slug)) {
            wp_insert_post([
                'post_title' => $page['title'],
                'post_content' => $page['content'],
                'post_status' => 'publish',
                'post_type' => 'page',
                'post_name' => $slug
            ]);
        }
    }
}
register_activation_hook(__FILE__, 'smartmail_create_required_pages');

function smartmail_register_templates($templates) {
    $templates[SMARTMAIL_PLUGIN_DIR . 'includes/templates/smartmail-dashboard.php'] = 'SmartMail Dashboard';
    $templates[SMARTMAIL_PLUGIN_DIR . 'includes/templates/smartmail-page.php'] = 'SmartMail Page';
    return $templates;
}
add_filter('theme_page_templates', 'smartmail_register_templates');

function smartmail_load_template($template) {
    global $post;

    if (!$post) return $template;

    $template_name = get_post_meta($post->ID, '_wp_page_template', true);
    $plugin_template = SMARTMAIL_PLUGIN_DIR . 'includes/templates/' . $template_name;

    if ($template_name && file_exists($plugin_template)) {
        return $plugin_template;
    }

    return $template;
}
add_filter('template_include', 'smartmail_load_template');

// Enqueue scripts and styles for the plugin
function smartmail_enqueue_scripts() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('smartmail-script', plugins_url('assets/js/smartmail.js', __FILE__), ['jquery'], '1.0.0', true);
    wp_enqueue_style('smartmail-style', plugins_url('assets/css/smartmail.css', __FILE__), [], '1.0.0');
}
add_action('wp_enqueue_scripts', 'smartmail_enqueue_scripts');

function smartmail_admin_menu() {
    add_menu_page(
        'SmartMail Assistant Settings',
        'SmartMail Assistant',
        'manage_options',
        'smartmail-assistant',
        'smartmail_settings_page'
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
