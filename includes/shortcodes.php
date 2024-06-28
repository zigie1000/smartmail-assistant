<?php
// Register shortcodes
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

if (!function_exists('smartmail_email_categorization_shortcode')) {
    function smartmail_email_categorization_shortcode($atts, $content = null) {
        return smartmail_email_categorization($content);
    }
}

if (!function_exists('smartmail_priority_inbox_shortcode')) {
    function smartmail_priority_inbox_shortcode($atts, $content = null) {
        return smartmail_priority_inbox($content);
    }
}

if (!function_exists('smartmail_automated_responses_shortcode')) {
    function smartmail_automated_responses_shortcode($atts, $content = null) {
        return smartmail_automated_responses($content);
    }
}

if (!function_exists('smartmail_email_summarization_shortcode')) {
    function smartmail_email_summarization_shortcode($atts, $content = null) {
        return smartmail_email_summarization($content);
    }
}

if (!function_exists('smartmail_meeting_scheduler_shortcode')) {
    function smartmail_meeting_scheduler_shortcode($atts, $content = null) {
        return smartmail_meeting_scheduler($content);
    }
}

if (!function_exists('smartmail_follow_up_reminders_shortcode')) {
    function smartmail_follow_up_reminders_shortcode($atts, $content = null) {
        return smartmail_follow_up_reminders($content);
    }
}

if (!function_exists('smartmail_sentiment_analysis_shortcode')) {
    function smartmail_sentiment_analysis_shortcode($atts, $content = null) {
        return smartmail_sentiment_analysis($content);
    }
}

if (!function_exists('smartmail_email_templates_shortcode')) {
    function smartmail_email_templates_shortcode($atts, $content = null) {
        return smartmail_email_templates();
    }
}

if (!function_exists('smartmail_forensic_analysis_shortcode')) {
    function smartmail_forensic_analysis_shortcode($atts, $content = null) {
        return smartmail_forensic_analysis($content);
    }
}
