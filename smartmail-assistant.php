<?php
/**
 * Plugin Name: SmartMail Assistant
 * Description: A WordPress plugin integrating OpenAI for various email-related functions.
 * Version: 1.0
 * Author: Marco Zagato
 * Author URI: https://smartmail.store
 */

if (!defined('ABSPATH')) {
    exit;
}

// Load dependencies
require_once plugin_dir_path(__FILE__) . 'includes/admin-settings.php';
require_once plugin_dir_path(__FILE__) . 'includes/ai-functions.php';
require_once plugin_dir_path(__FILE__) . 'includes/shortcodes.php';

// Create pages upon activation
function smartmail_create_pages() {
    $pages = [
        'smartmail-dashboard' => [
            'title' => 'SmartMail Dashboard',
            'content' => '[smartmail_dashboard]',
            'template' => 'smartmail-dashboard.php'
        ],
        'smartmail-settings' => [
            'title' => 'SmartMail Settings',
            'content' => '[smartmail_settings]',
            'template' => 'smartmail-settings.php'
        ],
        'smartmail-page' => [
            'title' => 'SmartMail Page',
            'content' => '[smartmail_page]',
            'template' => 'smartmail-page.php'
        ]
    ];

    foreach ($pages as $slug => $page) {
        $existing_page = get_page_by_path($slug);
        if (!$existing_page) {
            wp_insert_post([
                'post_title' => $page['title'],
                'post_content' => $page['content'],
                'post_status' => 'publish',
                'post_type' => 'page',
                'post_name' => $slug,
                'page_template' => $page['template']
            ]);
        }
    }
}
register_activation_hook(__FILE__, 'smartmail_create_pages');

// Include templates
function smartmail_load_templates($template) {
    if (is_page_template('smartmail-dashboard.php')) {
        $template = plugin_dir_path(__FILE__) . 'templates/smartmail-dashboard.php';
    } elseif (is_page_template('smartmail-settings.php')) {
        $template = plugin_dir_path(__FILE__) . 'templates/smartmail-settings.php';
    } elseif (is_page_template('smartmail-page.php')) {
        $template = plugin_dir_path(__FILE__) . 'templates/smartmail-page.php';
    }
    return $template;
}
add_filter('template_include', 'smartmail_load_templates');

// Admin menu
function smartmail_admin_menu() {
    add_menu_page(
        'SmartMail Assistant',
        'SmartMail Assistant',
        'manage_options',
        'smartmail-assistant',
        'smartmail_admin_page',
        'dashicons-email-alt',
        6
    );
}
add_action('admin_menu', 'smartmail_admin_menu');

// Admin page content
function smartmail_admin_page() {
    ?>
    <div class="wrap">
        <h1>SmartMail Assistant Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('smartmail_options_group');
            do_settings_sections('smartmail');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Register settings
function smartmail_register_settings() {
    register_setting('smartmail_options_group', 'smartmail_openai_api_key');
    add_settings_section('smartmail_section', 'API Settings', null, 'smartmail');
    add_settings_field('smartmail_openai_api_key', 'OpenAI API Key', 'smartmail_openai_api_key_render', 'smartmail', 'smartmail_section');
}
add_action('admin_init', 'smartmail_register_settings');

function smartmail_openai_api_key_render() {
    ?>
    <input type='text' name='smartmail_openai_api_key' value='<?php echo get_option('smartmail_openai_api_key'); ?>'>
    <?php
}
?>
