<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use OpenAI\OpenAI;

function get_openai_client() {
    $api_key = get_option('smartmail_openai_api_key');
    if (!$api_key) {
        return null;
    }
    return OpenAI::client($api_key);
}

function smartmail_email_categorization() {
    $content = sanitize_text_field($_POST['content']);
    $client = get_openai_client();
    if (!$client) {
        echo 'Error: OpenAI API key is missing.';
        wp_die();
    }
    $response = $client->completions()->create([
        'model' => 'text-davinci-003',
        'prompt' => "Categorize this email content:\n\n$content",
        'max_tokens' => 60,
    ]);
    echo esc_html($response['choices'][0]['text']);
    wp_die();
}
add_action('wp_ajax_smartmail_email_categorization', 'smartmail_email_categorization');
add_action('wp_ajax_nopriv_smartmail_email_categorization', 'smartmail_email_categorization');

function smartmail_priority_inbox() {
    $content = sanitize_text_field($_POST['content']);
    $client = get_openai_client();
    if (!$client) {
        echo 'Error: OpenAI API key is missing.';
        wp_die();
    }
    $response = $client->completions()->create([
        'model' => 'text-davinci-003',
        'prompt' => "Determine the priority of this email content:\n\n$content",
        'max_tokens' => 60,
    ]);
    echo esc_html($response['choices'][0]['text']);
    wp_die();
}
add_action('wp_ajax_smartmail_priority_inbox', 'smartmail_priority_inbox');
add_action('wp_ajax_nopriv_smartmail_priority_inbox', 'smartmail_priority_inbox');

function smartmail_automated_responses() {
    $content = sanitize_text_field($_POST['content']);
    $client = get_openai_client();
    if (!$client) {
        echo 'Error: OpenAI API key is missing.';
        wp_die();
    }
    $response = $client->completions()->create([
        'model' => 'text-davinci-003',
        'prompt' => "Generate an automated response for this email content:\n\n$content",
        'max_tokens' => 60,
    ]);
    echo esc_html($response['choices'][0]['text']);
    wp_die();
}
add_action('wp_ajax_smartmail_automated_responses', 'smartmail_automated_responses');
add_action('wp_ajax_nopriv_smartmail_automated_responses', 'smartmail_automated_responses');

function smartmail_email_summarization() {
    $content = sanitize_text_field($_POST['content']);
    $client = get_openai_client();
    if (!$client) {
        echo 'Error: OpenAI API key is missing.';
        wp_die();
    }
    $response = $client->completions()->create([
        'model' => 'text-davinci-003',
        'prompt' => "Summarize this email content:\n\n$content",
        'max_tokens' => 60,
    ]);
    echo esc_html($response['choices'][0]['text']);
    wp_die();
}
add_action('wp_ajax_smartmail_email_summarization', 'smartmail_email_summarization');
add_action('wp_ajax_nopriv_smartmail_email_summarization', 'smartmail_email_summarization');

function smartmail_meeting_scheduler() {
    $content = sanitize_text_field($_POST['content']);
    $client = get_openai_client();
    if (!$client) {
        echo 'Error: OpenAI API key is missing.';
        wp_die();
    }
    $response = $client->completions()->create([
        'model' => 'text-davinci-003',
        'prompt' => "Schedule a meeting based on this email content:\n\n$content",
        'max_tokens' => 60,
    ]);
    echo esc_html($response['choices'][0]['text']);
    wp_die();
}
add_action('wp_ajax_smartmail_meeting_scheduler', 'smartmail_meeting_scheduler');
add_action('wp_ajax_nopriv_smartmail_meeting_scheduler', 'smartmail_meeting_scheduler');

function smartmail_follow_up_reminders() {
    $content = sanitize_text_field($_POST['content']);
    $client = get_openai_client();
    if (!$client) {
        echo 'Error: OpenAI API key is missing.';
        wp_die();
    }
    $response = $client->completions()->create([
        'model' => 'text-davinci-003',
        'prompt' => "Generate a follow-up reminder for this email content:\n\n$content",
        'max_tokens' => 60,
    ]);
    echo esc_html($response['choices'][0]['text']);
    wp_die();
}
add_action('wp_ajax_smartmail_follow_up_reminders', 'smartmail_follow_up_reminders');
add_action('wp_ajax_nopriv_smartmail_follow_up_reminders', 'smartmail_follow_up_reminders');

function smartmail_sentiment_analysis() {
    $content = sanitize_text_field($_POST['content']);
    $client = get_openai_client();
    if (!$client) {
        echo 'Error: OpenAI API key is missing.';
        wp_die();
    }
    $response = $client->completions()->create([
        'model' => 'text-davinci-003',
        'prompt' => "Analyze the sentiment of this email content:\n\n$content",
        'max_tokens' => 60,
    ]);
    echo esc_html($response['choices'][0]['text']);
    wp_die();
}
add_action('wp_ajax_smartmail_sentiment_analysis', 'smartmail_sentiment_analysis');
add_action('wp_ajax_nopriv_smartmail_sentiment_analysis', 'smartmail_sentiment_analysis');

function smartmail_email_templates() {
    $content = sanitize_text_field($_POST['content']);
    $client = get_openai_client();
    if (!$client) {
        echo 'Error: OpenAI API key is missing.';
        wp_die();
    }
    $response = $client->completions()->create([
        'model' => 'text-davinci-003',
        'prompt' => "Generate an email template based on this request:\n\n$content",
        'max_tokens' => 60,
    ]);
    echo esc_html($response['choices'][0]['text']);
    wp_die();
}
add_action('wp_ajax_smartmail_email_templates', 'smartmail_email_templates');
add_action('wp_ajax_nopriv_smartmail_email_templates', 'smartmail_email_templates');

function smartmail_forensic_analysis() {
    $content = sanitize_text_field($_POST['content']);
    $client = get_openai_client();
    if (!$client) {
        echo 'Error: OpenAI API key is missing.';
        wp_die();
    }
    $response = $client->completions()->create([
        'model' => 'text-davinci-003',
        'prompt' => "Perform a forensic analysis on this email content:\n\n$content",
        'max_tokens' => 60,
    ]);
    echo esc_html($response['choices'][0]['text']);
    wp_die();
}
add_action('wp_ajax_smartmail_forensic_analysis', 'smartmail_forensic_analysis');
add_action('wp_ajax_nopriv_smartmail_forensic_analysis', 'smartmail_forensic_analysis');
?>                                               
