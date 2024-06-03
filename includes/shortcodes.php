<?php
// Shortcodes file for SmartMail Assistant

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Function to display email categorization
function sma_display_email_categorization() {
    if ( current_user_can( 'sma_use_pro_features' ) ) {
        return '<div class="sma-feature">Email Categorization is enabled for Pro users only.</div>';
    }
    return '<div class="sma-feature">Email Categorization is available for Pro users only. <a href="/subscribe">Subscribe</a> to unlock this feature.</div>';
}
add_shortcode( 'sma_email_categorization', 'sma_display_email_categorization' );

// Function to display priority inbox
function sma_display_priority_inbox() {
    if ( current_user_can( 'sma_use_pro_features' ) ) {
        return '<div class="sma-feature">Priority Inbox is enabled for Pro users only.</div>';
    }
    return '<div class="sma-feature">Priority Inbox is available for Pro users only. <a href="/subscribe">Subscribe</a> to unlock this feature.</div>';
}
add_shortcode( 'sma_priority_inbox', 'sma_display_priority_inbox' );

// Function to display email summarization
function sma_display_email_summarization($atts, $content = null) {
    if ( current_user_can( 'sma_use_pro_features' ) ) {
        $summary = sma_get_email_summary($content);
        return '<div class="sma-feature">Email Summary: ' . esc_html($summary) . '</div>';
    }
    return '<div class="sma-feature">Email Summarization is available for Pro users only. <a href="/subscribe">Subscribe</a> to unlock this feature.</div>';
}
add_shortcode( 'sma_email_summarization', 'sma_display_email_summarization' );

// Example shortcode function for SmartMail Assistant
function smartmail_shortcode_function() {
    return '<p>SmartMail shortcode content here.</p>';
}
add_shortcode( 'smartmail', 'smartmail_shortcode_function' );
