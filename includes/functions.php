<?php

if (!defined('ABSPATH')) {
    exit;
}

// Include shortcodes file
require_once plugin_dir_path(__FILE__) . 'shortcodes.php';

if (!function_exists('smartmail_register_shortcodes')) {
    function smartmail_register_shortcodes() {
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
}
add_action('init', 'smartmail_register_shortcodes');

?>
