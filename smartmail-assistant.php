<?php
/*
Plugin Name: SmartMail Assistant
Description: AI-driven email management for categorization, prioritization, automated responses, summarization, and more.
Version: 1.0
Author: Marco Zagato
Author URI: https://smartmail.store
*/

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Define constants
define('SMARTMAIL_PLUGIN_DIR', plugin_dir_path(__FILE__));

// Include necessary files
include_once SMARTMAIL_PLUGIN_DIR . 'includes/api-functions.php';
include_once SMARTMAIL_PLUGIN_DIR . 'includes/ai-functions.php';
include_once SMARTMAIL_PLUGIN_DIR . 'includes/admin-settings.php';

// Add menu item
function smartmail_admin_menu() {
    add_menu_page(
        'SmartMail Assistant',
        'SmartMail Assistant',
        'manage_options',
        'smartmail-assistant',
        'smartmail_settings_page'
    );
}
add_action('admin_menu', 'smartmail_admin_menu');

// Settings page content
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

// Register settings
function smartmail_register_settings() {
    register_setting('smartmail-settings-group', 'smartmail_openai_api_key');
}
add_action('admin_init', 'smartmail_register_settings');

// Shortcode functions
function smartmail_email_categorization_shortcode() {
    ob_start();
    ?>
    <form id="smartmail-categorization-form">
        <textarea id="categorization-email-content" placeholder="Enter email content here"></textarea>
        <button type="submit">Categorize Email</button>
    </form>
    <div id="categorization-result"></div>
    <?php
    return ob_get_clean();
}
add_shortcode('sma_email_categorization', 'smartmail_email_categorization_shortcode');

function smartmail_priority_inbox_shortcode() {
    ob_start();
    ?>
    <form id="smartmail-priority-form">
        <textarea id="priority-email-content" placeholder="Enter email content here"></textarea>
        <button type="submit">Determine Priority</button>
    </form>
    <div id="priority-result"></div>
    <?php
    return ob_get_clean();
}
add_shortcode('sma_priority_inbox', 'smartmail_priority_inbox_shortcode');

function smartmail_automated_responses_shortcode() {
    ob_start();
    ?>
    <form id="smartmail-automated-responses-form">
        <textarea id="automated-responses-email-content" placeholder="Enter email content here"></textarea>
        <button type="submit">Generate Response</button>
    </form>
    <div id="automated-responses-result"></div>
    <?php
    return ob_get_clean();
}
add_shortcode('sma_automated_responses', 'smartmail_automated_responses_shortcode');

function smartmail_email_summarization_shortcode() {
    ob_start();
    ?>
    <form id="smartmail-summarization-form">
        <textarea id="summarization-email-content" placeholder="Enter email content here"></textarea>
        <button type="submit">Summarize Email</button>
    </form>
    <div id="summarization-result"></div>
    <?php
    return ob_get_clean();
}
add_shortcode('sma_email_summarization', 'smartmail_email_summarization_shortcode');

function smartmail_meeting_scheduler_shortcode() {
    ob_start();
    ?>
    <form id="smartmail-meeting-scheduler-form">
        <textarea id="meeting-scheduler-email-content" placeholder="Enter email content here"></textarea>
        <button type="submit">Schedule Meeting</button>
    </form>
    <div id="meeting-scheduler-result"></div>
    <?php
    return ob_get_clean();
}
add_shortcode('sma_meeting_scheduler', 'smartmail_meeting_scheduler_shortcode');

function smartmail_follow_up_reminders_shortcode() {
    ob_start();
    ?>
    <form id="smartmail-follow-up-reminders-form">
        <textarea id="follow-up-reminders-email-content" placeholder="Enter email content here"></textarea>
        <button type="submit">Generate Follow-up Reminder</button>
    </form>
    <div id="follow-up-reminders-result"></div>
    <?php
    return ob_get_clean();
}
add_shortcode('sma_follow_up_reminders', 'smartmail_follow_up_reminders_shortcode');

function smartmail_sentiment_analysis_shortcode() {
    ob_start();
    ?>
    <form id="smartmail-sentiment-analysis-form">
        <textarea id="sentiment-analysis-email-content" placeholder="Enter email content here"></textarea>
        <button type="submit">Analyze Sentiment</button>
    </form>
    <div id="sentiment-analysis-result"></div>
    <?php
    return ob_get_clean();
}
add_shortcode('sma_sentiment_analysis', 'smartmail_sentiment_analysis_shortcode');

function smartmail_email_templates_shortcode() {
    ob_start();
    ?>
    <form id="smartmail-email-templates-form">
        <textarea id="email-templates-request" placeholder="Enter your request for an email template"></textarea>
        <button type="submit">Generate Template</button>
    </form>
    <div id="email-templates-result"></div>
    <?php
    return ob_get_clean();
}
add_shortcode('sma_email_templates', 'smartmail_email_templates_shortcode');

function smartmail_forensic_analysis_shortcode() {
    ob_start();
    ?>
    <form id="smartmail-forensic-analysis-form">
        <textarea id="forensic-analysis-email-content" placeholder="Enter email content here"></textarea>
        <button type="submit">Perform Analysis</button>
    </form>
    <div id="forensic-analysis-result"></div>
    <?php
    return ob_get_clean();
}
add_shortcode('sma_forensic_analysis', 'smartmail_forensic_analysis_shortcode');

// Add template path
function smartmail_template_include($template) {
    if (is_page_template('smartmail-page.php')) {
        $template = plugin_dir_path(__FILE__) . 'includes/templates/smartmail-page.php';
    }
    if (is_page_template('smartmail-dashboard.php')) {
        $template = plugin_dir_path(__FILE__) . 'includes/templates/smartmail-dashboard.php';
    }
    return $template;
}
add_filter('template_include', 'smartmail_template_include');

// Enqueue scripts for the frontend
function smartmail_enqueue_scripts() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('smartmail-ajax', plugin_dir_url(__FILE__) . 'assets/js/smartmail-ajax.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'smartmail_enqueue_scripts');

// AJAX handlers for AI functions
function smartmail_ajax_handler() {
    $action = $_POST['action'];
    $content = sanitize_text_field($_POST['content']);

    switch ($action) {
        case 'smartmail_email_categorization':
            $result = smartmail_email_categorization($content);
            break;
        case 'smartmail_priority_inbox':
            $result = smartmail_priority_inbox($content);
            break;
        case 'smartmail_automated_responses':
            $result = smartmail_automated_responses($content);
            break;
        case 'smartmail_email_summarization':
            $result = smartmail_email_summarization($content);
            break;
        case 'smartmail_meeting_scheduler':
            $result = smartmail_meeting_scheduler($content);
            break;
        case 'smartmail_follow_up_reminders':
            $result = smartmail_follow_up_reminders($content);
            break;
        case 'smartmail_sentiment_analysis':
            $result = smartmail_sentiment_analysis($content);
            break;
        case 'smartmail_email_templates':
            $result = smartmail_email_templates($content);
            break;
        case 'smartmail_forensic_analysis':
            $result = smartmail_forensic_analysis($content);
            break;
        default:
            $result = 'Invalid action';
    }

    echo $result;
    wp_die();
}
add_action('wp_ajax_smartmail_ajax_handler', 'smartmail_ajax_handler');
add_action('wp_ajax_nopriv_smartmail_ajax_handler', 'smartmail_ajax_handler');

?>
