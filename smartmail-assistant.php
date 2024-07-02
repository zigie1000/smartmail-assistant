<?php
/*
Plugin Name: SmartMail Assistant
Description: AI-driven email management assistant for WordPress.
Author: Marco Zagato
Author URI: https://smartmail.store
Version: 1.0.0
*/

if (!defined('ABSPATH')) {
    exit;
}

// Autoload Composer dependencies
require_once plugin_dir_path(__FILE__) . 'vendor/autoload.php';

// Include required files
require_once plugin_dir_path(__FILE__) . 'includes/admin-settings.php';
require_once plugin_dir_path(__FILE__) . 'includes/ai-functions.php';
require_once plugin_dir_path(__FILE__) . 'includes/api-functions.php';
require_once plugin_dir_path(__FILE__) . 'includes/shortcodes.php';

// Ensure WooCommerce is activated
if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    require_once plugin_dir_path(__FILE__) . 'includes/class-wc-gateway-pi.php';
}

// Register settings
add_action('admin_init', 'smartmail_register_settings');
function smartmail_register_settings() {
    register_setting('smartmail_options_group', 'smartmail_openai_api_key');
    add_settings_section('smartmail_main_section', 'SmartMail Settings', 'smartmail_main_section_cb', 'smartmail');
    add_settings_field('smartmail_openai_api_key', 'OpenAI API Key', 'smartmail_openai_api_key_cb', 'smartmail', 'smartmail_main_section');
}

function smartmail_main_section_cb() {
    echo '<p>Enter your OpenAI API key to enable AI features.</p>';
}

function smartmail_openai_api_key_cb() {
    $api_key = get_option('smartmail_openai_api_key');
    echo '<input type="text" id="smartmail_openai_api_key" name="smartmail_openai_api_key" value="' . esc_attr($api_key) . '" />';
}

// Activation and deactivation hooks
register_activation_hook(__FILE__, 'smartmail_activate');
function smartmail_activate() {
    if (!get_option('smartmail_activated')) {
        update_option('smartmail_activated', true);
    }
    smartmail_create_pages();
}

register_deactivation_hook(__FILE__, 'smartmail_deactivate');
function smartmail_deactivate() {
    delete_option('smartmail_activated');
}

function smartmail_create_pages() {
    $pages = [
        [
            'title' => 'SmartMail Dashboard',
            'content' => '[smartmail_dashboard]',
        ],
        [
            'title' => 'SmartMail Assistant',
            'content' => '[sma_email_categorization][sma_priority_inbox][sma_automated_responses][sma_email_summarization][sma_meeting_scheduler][sma_follow_up_reminders][sma_sentiment_analysis][sma_email_templates][sma_forensic_analysis]',
        ],
    ];

    foreach ($pages as $page) {
        if (!get_page_by_title($page['title'])) {
            wp_insert_post([
                'post_title' => $page['title'],
                'post_content' => $page['content'],
                'post_status' => 'publish',
                'post_type' => 'page',
            ]);
        }
    }
}

// Ensure no duplicate function declarations
if (!function_exists('smartmail_log')) {
    function smartmail_log($message) {
        if (defined('SMARTMAIL_DEBUG_LOG')) {
            error_log($message . PHP_EOL, 3, SMARTMAIL_DEBUG_LOG);
        }
    }
}

if (!function_exists('get_openai_client')) {
    function get_openai_client() {
        require_once plugin_dir_path(__FILE__) . 'vendor/autoload.php';
        $api_key = get_option('smartmail_openai_api_key');
        if (!$api_key) {
            throw new Exception('OpenAI API key is missing.');
        }
        return OpenAI\Client::factory(['api_key' => $api_key]);
    }
}

if (!function_exists('smartmail_create_pages')) {
    function smartmail_create_pages() {
        $pages = [
            [
                'title' => 'SmartMail Dashboard',
                'content' => '[smartmail_dashboard]',
            ],
            [
                'title' => 'SmartMail Assistant',
                'content' => '[sma_email_categorization][sma_priority_inbox][sma_automated_responses][sma_email_summarization][sma_meeting_scheduler][sma_follow_up_reminders][sma_sentiment_analysis][sma_email_templates][sma_forensic_analysis]',
            ],
        ];

        foreach ($pages as $page) {
            if (!get_page_by_title($page['title'])) {
                wp_insert_post([
                    'post_title' => $page['title'],
                    'post_content' => $page['content'],
                    'post_status' => 'publish',
                    'post_type' => 'page',
                ]);
            }
        }
    }
}

// Add admin menu for settings
add_action('admin_menu', 'smartmail_admin_menu');
function smartmail_admin_menu() {
    add_menu_page(
        'SmartMail Assistant',
        'SmartMail',
        'manage_options',
        'smartmail',
        'smartmail_admin_page',
        'dashicons-email-alt2',
        6
    );
    add_submenu_page(
        'smartmail',
        'Settings',
        'Settings',
        'manage_options',
        'smartmail-settings',
        'smartmail_settings_page'
    );
}

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

function smartmail_settings_page() {
    ?>
    <div class="wrap">
        <h1>SmartMail Assistant API Settings</h1>
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

set_error_handler(function($errno, $errstr, $errfile, $errline) {
    $log_message = "Error [{$errno}]: {$errstr} in {$errfile} on line {$errline}";
    smartmail_log($log_message);
    return false; // Let the normal error handler run as well
});

set_exception_handler(function($exception) {
    $log_message = "Exception: " . $exception->getMessage();
    smartmail_log($log_message);
    wp_die($log_message);
});

?>
