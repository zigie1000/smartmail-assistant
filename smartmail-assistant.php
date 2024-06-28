<?php
/**
 * Plugin Name: SmartMail Assistant
 * Plugin URI: https://smartmail.store
 * Description: A comprehensive assistant for managing your SmartMail, including AI-driven features.
 * Version: 1.0.0
 * Author: Marco Zagato
 * Author URI: https://smartmail.store
 * License: MIT
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Define constants
define('SMARTMAIL_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('SMARTMAIL_PLUGIN_URL', plugin_dir_url(__FILE__));
define('SMARTMAIL_DEBUG_LOG', SMARTMAIL_PLUGIN_PATH . 'debug.log');

// Function to log messages
function smartmail_log($message) {
    if (defined('SMARTMAIL_DEBUG_LOG')) {
        error_log($message . PHP_EOL, 3, SMARTMAIL_DEBUG_LOG);
    }
}
smartmail_log('SmartMail Assistant plugin loaded.');

// Check dependencies
function smartmail_check_dependencies() {
    smartmail_log('Checking dependencies.');
    if (!function_exists('wp_remote_get')) {
        smartmail_log('Missing wp_remote_get function.');
        wp_die('Missing wp_remote_get function.');
    }

    if (!class_exists('WooCommerce')) {
        smartmail_log('WooCommerce is not installed or activated.');
        wp_die('WooCommerce is not installed or activated.');
    }
    smartmail_log('All dependencies are met.');
}
add_action('admin_init', 'smartmail_check_dependencies');

// Include necessary files
$files = [
    'includes/admin-settings.php',
    'includes/api-functions.php',
    'includes/class-wc-gateway-pi.php',
    'includes/functions.php',
    'includes/shortcodes.php',
    'includes/subscription-functions.php',
    'includes/ai-functions.php'
];

foreach ($files as $file) {
    $file_path = SMARTMAIL_PLUGIN_PATH . $file;
    if (file_exists($file_path)) {
        require_once $file_path;
        smartmail_log("Included file: $file");
    } else {
        smartmail_log("Missing file: $file");
    }
}

// Activation and deactivation hooks
register_activation_hook(__FILE__, function() {
    try {
        update_option('smartmail_plugin_activated', true);
        smartmail_log('SmartMail Assistant plugin activated successfully.');
        smartmail_create_pages(); // Function to create the necessary pages
    } catch (Exception $e) {
        $error_message = 'SmartMail Assistant activation error: ' . $e->getMessage();
        smartmail_log($error_message);
        wp_die($error_message);
    }
});

register_deactivation_hook(__FILE__, function() {
    try {
        delete_option('smartmail_plugin_activated');
        smartmail_log('SmartMail Assistant plugin deactivated successfully.');
    } catch (Exception $e) {
        $error_message = 'SmartMail Assistant deactivation error: ' . $e->getMessage();
        smartmail_log($error_message);
        wp_die($error_message);
    }
});

// Create necessary pages
function smartmail_create_pages() {
    $pages = [
        'smartmail-dashboard' => [
            'title' => 'SmartMail Dashboard',
            'content' => '[smartmail_dashboard_shortcode]'
        ],
        'smartmail-ebooks' => [
            'title' => 'SmartMail Ebooks',
            'content' => '[smartmail_ebooks_shortcode]'
        ],
        'smartmail-software' => [
            'title' => 'SmartMail Software',
            'content' => '[smartmail_software_shortcode]'
        ],
        // Add other pages as needed
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

// Add admin menu for user settings
if (!function_exists('smartmail_admin_menu')) {
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
            'Dashboard',
            'Dashboard',
            'manage_options',
            'smartmail-dashboard',
            'smartmail_dashboard_template'
        );
        smartmail_log('Admin menu added.');
    }
}
add_action('admin_menu', 'smartmail_admin_menu');

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

// Dashboard template
function smartmail_dashboard_template() {
    if (is_user_logged_in() && current_user_can('manage_options')) {
        include plugin_dir_path(__FILE__) . 'includes/templates/admin-dashboard.php';
    } else {
        wp_die('You do not have sufficient permissions to access this page.');
    }
}

// Ensure the AI functions are included
if (!function_exists('smartmail_email_categorization')) {
    function smartmail_email_categorization($email_content) {
        $client = get_openai_client();
        try {
            $response = $client->completions()->create([
                'model' => 'text-davinci-003',
                'prompt' => "Categorize the following email content:\n\n" . $email_content,
                'max_tokens' => 150
            ]);
            return trim($response['choices'][0]['text']);
        } catch (Exception $e) {
            smartmail_log('OpenAI error: ' . $e->getMessage());
            return 'Error categorizing email.';
        }
    }
}

if (!function_exists('smartmail_priority_inbox')) {
    function smartmail_priority_inbox($email_content) {
        $client = get_openai_client();
        try {
            $response = $client->completions()->create([
                'model' => 'text-davinci-003',
                'prompt' => "Determine the priority of the following email content:\n\n" . $email_content,
                'max_tokens' => 150
            ]);
            return trim($response['choices'][0]['text']);
        } catch (Exception $e) {
            smartmail_log('OpenAI error: ' . $e->getMessage());
            return 'Error determining priority.';
        }
    }
}

if (!function_exists('smartmail_automated_responses')) {
    function smartmail_automated_responses($email_content) {
        $client = get_openai_client();
        try {
            $response = $client->completions()->create([
                'model' => 'text-davinci-003',
                'prompt' => "Generate an automated response for the following email content:\n\n" . $email_content,
                'max_tokens' => 150
            ]);
            return trim($response['choices'][0]['text']);
        } catch (Exception $e) {
            smartmail_log('OpenAI error: ' . $e->getMessage());
            return 'Error generating automated response.';
        }
    }
}

if (!function_exists('smartmail_email_summarization')) {
    function smartmail_email_summarization($email_content) {
        $client = get_openai_client();
        try {
            $response = $client->completions()->create([
                'model' => 'text-davinci-003',
                'prompt' => "Summarize the following email content:\n\n" . $email_content,
                'max_tokens' => 150
            ]);
            return trim($response['choices'][0]['text']);
        } catch (Exception $e) {
            smartmail_log('OpenAI error: ' . $e->getMessage());
            return 'Error summarizing email.';
        }
    }
}

if (!function_exists('smartmail_meeting_scheduler')) {
    function smartmail_meeting_scheduler($email_content) {
        $client = get_openai_client();
        try {
            $response = $client->completions()->create([
                'model' => 'text-davinci-003',
                'prompt' => "Schedule a meeting based on the following email content:\n\n" . $email_content,
                'max_tokens' => 150
            ]);
            return trim($response['choices'][0]['text']);
        } catch (Exception $e) {
            smartmail_log('OpenAI error: ' . $e->getMessage());
            return 'Error scheduling meeting.';
        }
    }
}

if (!function_exists('smartmail_follow_up_reminders')) {
    function smartmail_follow_up_reminders($email_content) {
        $client = get_openai_client();
        try {
            $response = $client->completions()->create([
                'model' => 'text-davinci-003',
                'prompt' => "Generate follow-up reminders for the following email content:\n\n" . $email_content,
                'max_tokens' => 150
            ]);
            return trim($response['choices'][0]['text']);
        } catch (Exception $e) {
            smartmail_log('OpenAI error: ' . $e->getMessage());
            return 'Error generating follow-up reminders.';
        }
    }
}

if (!function_exists('smartmail_sentiment_analysis')) {
    function smartmail_sentiment_analysis($email_content) {
        $client = get_openai_client();
        try {
            $response = $client->completions()->create([
                'model' => 'text-davinci-003',
                'prompt' => "Analyze the sentiment of the following email content:\n\n" . $email_content,
                'max_tokens' => 150
            ]);
            return trim($response['choices'][0]['text']);
        } catch (Exception $e) {
            smartmail_log('OpenAI error: ' . $e->getMessage());
            return 'Error analyzing sentiment.';
        }
    }
}

if (!function_exists('smartmail_email_templates')) {
    function smartmail_email_templates() {
        $client = get_openai_client();
        try {
            $response = $client->completions()->create([
                'model' => 'text-davinci-003',
                'prompt' => "Generate an email template.",
                'max_tokens' => 150
            ]);
            return trim($response['choices'][0]['text']);
        } catch (Exception $e) {
            smartmail_log('OpenAI error: ' . $e->getMessage());
            return 'Error generating email template.';
        }
    }
}

if (!function_exists('smartmail_forensic_analysis')) {
    function smartmail_forensic_analysis($email_content) {
        $client = get_openai_client();
        try {
            $response = $client->completions()->create([
                'model' => 'text-davinci-003',
                'prompt' => "Perform a forensic analysis of the following email content:\n\n" . $email_content,
                'max_tokens' => 150
            ]);
            return trim($response['choices'][0]['text']);
        } catch (Exception $e) {
            smartmail_log('OpenAI error: ' . $e->getMessage());
            return 'Error performing forensic analysis.';
        }
    }
}

// Shortcodes to use AI functions in posts or pages
if (!function_exists('smartmail_register_shortcodes')) {
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
}
add_action('init', 'smartmail_register_shortcodes');

function smartmail_email_categorization_shortcode($atts, $content = null) {
    return smartmail_email_categorization($content);
}

function smartmail_priority_inbox_shortcode($atts, $content = null) {
    return smartmail_priority_inbox($content);
}

function smartmail_automated_responses_shortcode($atts, $content = null) {
    return smartmail_automated_responses($content);
}

function smartmail_email_summarization_shortcode($atts, $content = null) {
    return smartmail_email_summarization($content);
}

function smartmail_meeting_scheduler_shortcode($atts, $content = null) {
    return smartmail_meeting_scheduler($content);
}

function smartmail_follow_up_reminders_shortcode($atts, $content = null) {
    return smartmail_follow_up_reminders($content);
}

function smartmail_sentiment_analysis_shortcode($atts, $content = null) {
    return smartmail_sentiment_analysis($content);
}

function smartmail_email_templates_shortcode($atts, $content = null) {
    return smartmail_email_templates();
}

function smartmail_forensic_analysis_shortcode($atts, $content = null) {
    return smartmail_forensic_analysis($content);
}
?>                
