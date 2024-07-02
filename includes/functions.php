<?php
if (!defined('ABSPATH')) {
    exit;
}

// Register custom shortcodes
function sma_register_shortcodes() {
    add_shortcode('sma_email_categorization', 'sma_email_categorization_shortcode');
    add_shortcode('sma_priority_inbox', 'sma_priority_inbox_shortcode');
    add_shortcode('sma_automated_responses', 'sma_automated_responses_shortcode');
    add_shortcode('sma_email_summarization', 'sma_email_summarization_shortcode');
    add_shortcode('sma_meeting_scheduler', 'sma_meeting_scheduler_shortcode');
    add_shortcode('sma_follow_up_reminders', 'sma_follow_up_reminders_shortcode');
    add_shortcode('sma_sentiment_analysis', 'sma_sentiment_analysis_shortcode');
    add_shortcode('sma_email_templates', 'sma_email_templates_shortcode');
    add_shortcode('sma_forensic_analysis', 'sma_forensic_analysis_shortcode');
}
add_action('init', 'sma_register_shortcodes');

// Enqueue scripts and styles
function sma_enqueue_scripts() {
    wp_enqueue_style('sma-styles', plugins_url('/assets/css/styles.css', __FILE__));
    wp_enqueue_script('sma-scripts', plugins_url('/assets/js/scripts.js', __FILE__), array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'sma_enqueue_scripts');

// AJAX handlers for AI functions
function sma_handle_ajax_request() {
    check_ajax_referer('sma_nonce', 'nonce');

    $email_content = sanitize_textarea_field($_POST['email_content']);
    $action = sanitize_text_field($_POST['action_type']);

    try {
        switch ($action) {
            case 'categorize':
                $result = smartmail_email_categorization($email_content);
                break;
            case 'priority':
                $result = smartmail_priority_inbox($email_content);
                break;
            case 'respond':
                $result = smartmail_automated_responses($email_content);
                break;
            case 'summarize':
                $result = smartmail_email_summarization($email_content);
                break;
            case 'schedule':
                $result = smartmail_meeting_scheduler($email_content);
                break;
            case 'schedule':
                $result = smartmail_meeting_scheduler($email_content);
                break;
            case 'remind':
                $result = smartmail_follow_up_reminders($email_content);
                break;
            case 'analyze_sentiment':
                $result = smartmail_sentiment_analysis($email_content);
                break;
            case 'template':
                $result = smartmail_email_templates();
                break;
            case 'forensic':
                $result = smartmail_forensic_analysis($email_content);
                break;
            default:
                $result = 'Invalid action.';
                break;
        }
        wp_send_json_success($result);
    } catch (Exception $e) {
        wp_send_json_error($e->getMessage());
    }
}
add_action('wp_ajax_sma_handle_ajax_request', 'sma_handle_ajax_request');
add_action('wp_ajax_nopriv_sma_handle_ajax_request', 'sma_handle_ajax_request');
?>     
