<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

function smartmail_email_categorization() {
    check_ajax_referer('smartmail_nonce', 'security');
    $content = sanitize_text_field($_POST['content']);

    $response = wp_remote_post('https://api.openai.com/v1/engines/davinci-codex/completions', [
        'headers' => [
            'Authorization' => 'Bearer ' . get_option('smartmail_openai_api_key'),
            'Content-Type' => 'application/json',
        ],
        'body' => json_encode([
            'prompt' => "Categorize this email content: $content",
            'max_tokens' => 60,
        ]),
    ]);

    if (is_wp_error($response)) {
        wp_send_json_error('API request failed.');
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body);

    if (isset($data->choices[0]->text)) {
        wp_send_json_success($data->choices[0]->text);
    } else {
        wp_send_json_error('No response from API.');
    }
}
add_action('wp_ajax_smartmail_email_categorization', 'smartmail_email_categorization');
add_action('wp_ajax_nopriv_smartmail_email_categorization', 'smartmail_email_categorization');

// Similarly, enhance usability and customer satisfaction with easy-to-use functions for features like:
function smartmail_priority_inbox() {
    check_ajax_referer('smartmail_nonce', 'security');
    $content = sanitize_text_field($_POST['content']);

    $response = wp_remote_post('https://api.openai.com/v1/engines/davinci-codex/completions', [
        'headers' => [
            'Authorization' => 'Bearer ' . get_option('smartmail_openai_api_key'),
            'Content-Type' => 'application/json',
        ],
        'body' => json_encode([
            'prompt' => "Determine the priority of this email content: $content",
            'max_tokens' => 60,
        ]),
    ]);

    if (is_wp_error($response)) {
        wp_send_json_error('API request failed.');
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body);

    if (isset($data->choices[0]->text)) {
        wp_send_json_success($data->choices[0]->text);
    } else {
        wp_send_json_error('No response from API.');
    }
}
add_action('wp_ajax_smartmail_priority_inbox', 'smartmail_priority_inbox');
add_action('wp_ajax_nopriv_smartmail_priority_inbox', 'smartmail_priority_inbox');

// Automated Responses
function smartmail_automated_responses() {
    check_ajax_referer('smartmail_nonce', 'security');
    $content = sanitize_text_field($_POST['content']);

    $response = wp_remote_post('https://api.openai.com/v1/engines/davinci-codex/completions', [
        'headers' => [
            'Authorization' => 'Bearer ' . get_option('smartmail_openai_api_key'),
            'Content-Type' => 'application/json',
        ],
        'body' => json_encode([
            'prompt' => "Generate an automated response for this email content: $content",
            'max_tokens' => 100,
        ]),
    ]);

    if (is_wp_error($response)) {
        wp_send_json_error('API request failed.');
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body);

    if (isset($data->choices[0]->text)) {
        wp_send_json_success($data->choices[0]->text);
    } else {
        wp_send_json_error('No response from API.');
    }
}
add_action('wp_ajax_smartmail_automated_responses', 'smartmail_automated_responses');
add_action('wp_ajax_nopriv_smartmail_automated_responses', 'smartmail_automated_responses');

// Email Summarization
function smartmail_email_summarization() {
    check_ajax_referer('smartmail_nonce', 'security');
    $content = sanitize_text_field($_POST['content']);

    $response = wp_remote_post('https://api.openai.com/v1/engines/davinci-codex/completions', [
        'headers' => [
            'Authorization' => 'Bearer ' . get_option('smartmail_openai_api_key'),
            'Content-Type' => 'application/json',
        ],
        'body' => json_encode([
            'prompt' => "Summarize this email content: $content",
            'max_tokens' => 100,
        ]),
    ]);

    if (is_wp_error($response)) {
        wp_send_json_error('API request failed.');
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body);

    if (isset($data->choices[0]->text)) {
        wp_send_json_success($data->choices[0]->text);
    } else {
        wp_send_json_error('No response from API.');
    }
}
add_action('wp_ajax_smartmail_email_summarization', 'smartmail_email_summarization');
add_action('wp_ajax_nopriv_smartmail_email_summarization', 'smartmail_email_summarization');

// Meeting Scheduler
function smartmail_meeting_scheduler() {
    check_ajax_referer('smartmail_nonce', 'security');
    $content = sanitize_text_field($_POST['content']);

    $response = wp_remote_post('https://api.openai.com/v1/engines/davinci-codex/completions', [
        'headers' => [
            'Authorization' => 'Bearer ' . get_option('smartmail_openai_api_key'),
            'Content-Type' => 'application/json',
        ],
        'body' => json_encode([
            'prompt' => "Schedule a meeting based on this email content: $content",
                                         'max_tokens' => 100,
        ]),
    ]);

    if (is_wp_error($response)) {
        wp_send_json_error('API request failed.');
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body);

    if (isset($data->choices[0]->text)) {
        wp_send_json_success($data->choices[0]->text);
    } else {
        wp_send_json_error('No response from API.');
    }
}
add_action('wp_ajax_smartmail_meeting_scheduler', 'smartmail_meeting_scheduler');
add_action('wp_ajax_nopriv_smartmail_meeting_scheduler', 'smartmail_meeting_scheduler');

// Follow-up Reminders
function smartmail_follow_up_reminders() {
    check_ajax_referer('smartmail_nonce', 'security');
    $content = sanitize_text_field($_POST['content']);

    $response = wp_remote_post('https://api.openai.com/v1/engines/davinci-codex/completions', [
        'headers' => [
            'Authorization' => 'Bearer ' . get_option('smartmail_openai_api_key'),
            'Content-Type' => 'application/json',
        ],
        'body' => json_encode([
            'prompt' => "Generate a follow-up reminder for this email content: $content",
            'max_tokens' => 100,
        ]),
    ]);

    if (is_wp_error($response)) {
        wp_send_json_error('API request failed.');
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body);

    if (isset($data->choices[0]->text)) {
        wp_send_json_success($data->choices[0]->text);
    } else {
        wp_send_json_error('No response from API.');
    }
}
add_action('wp_ajax_smartmail_follow_up_reminders', 'smartmail_follow_up_reminders');
add_action('wp_ajax_nopriv_smartmail_follow_up_reminders', 'smartmail_follow_up_reminders');

// Sentiment Analysis
function smartmail_sentiment_analysis() {
    check_ajax_referer('smartmail_nonce', 'security');
    $content = sanitize_text_field($_POST['content']);

    $response = wp_remote_post('https://api.openai.com/v1/engines/davinci-codex/completions', [
        'headers' => [
            'Authorization' => 'Bearer ' . get_option('smartmail_openai_api_key'),
            'Content-Type' => 'application/json',
        ],
        'body' => json_encode([
            'prompt' => "Analyze the sentiment of this email content: $content",
            'max_tokens' => 60,
        ]),
    ]);

    if (is_wp_error($response)) {
        wp_send_json_error('API request failed.');
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body);

    if (isset($data->choices[0]->text)) {
        wp_send_json_success($data->choices[0]->text);
    } else {
        wp_send_json_error('No response from API.');
    }
}
add_action('wp_ajax_smartmail_sentiment_analysis', 'smartmail_sentiment_analysis');
add_action('wp_ajax_nopriv_smartmail_sentiment_analysis', 'smartmail_sentiment_analysis');

// Email Templates
function smartmail_email_templates() {
    check_ajax_referer('smartmail_nonce', 'security');
    $content = sanitize_text_field($_POST['content']);

    $response = wp_remote_post('https://api.openai.com/v1/engines/davinci-codex/completions', [
        'headers' => [
            'Authorization' => 'Bearer ' . get_option('smartmail_openai_api_key'),
            'Content-Type' => 'application/json',
        ],
        'body' => json_encode([
            'prompt' => "Generate an email template for this request: $content",
            'max_tokens' => 100,
        ]),
    ]);

    if (is_wp_error($response)) {
        wp_send_json_error('API request failed.');
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body);

    if (isset($data->choices[0]->text)) {
        wp_send_json_success($data->choices[0]->text);
    } else {
        wp_send_json_error('No response from API.');
    }
}
add_action('wp_ajax_smartmail_email_templates', 'smartmail_email_templates');
add_action('wp_ajax_nopriv_smartmail_email_templates', 'smartmail_email_templates');

// Forensic Analysis
function smartmail_forensic_analysis() {
    check_ajax_referer('smartmail_nonce', 'security');
    $content = sanitize_text_field($_POST['content']);

    $response = wp_remote_post('https://api.openai.com/v1/engines/davinci-codex/completions', [
        'headers' => [
            'Authorization' => 'Bearer ' . get_option('smartmail_openai_api_key'),
            'Content-Type' => 'application/json',
        ],
        'body' => json_encode([
            'prompt' => "Perform a forensic analysis on this email content: $content",
            'max_tokens' => 100,
        ]),
    ]);

    if (is_wp_error($response)) {
        wp_send_json_error('API request failed.');
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body);

    if (isset($data->choices[0]->text)) {
        wp_send_json_success($data->choices[0]->text);
    } else {
        wp_send_json_error('No response from API.');
    }
}
add_action('wp_ajax_smartmail_forensic_analysis', 'smartmail_forensic_analysis');
add_action('wp_ajax_nopriv_smartmail_forensic_analysis', 'smartmail_forensic_analysis');
    width: 250px;
    padding: 20px;
    background-color: #f1f1f1;
    border-right: 1px solid #ddd;
}

.smartmail-sidebar h2 {
    margin-top: 0;
}

.smartmail-sidebar ul {
    list-style-type: none;
    padding-left: 0;
}

.smartmail-sidebar ul li {
    margin-bottom: 10px;
}

.smartmail-sidebar ul li a {
    text-decoration: none;
    color: #0073aa;
}

.smartmail-sidebar ul li a:hover {
    color: #005177;
}

.smartmail-content {
    flex-grow: 1;
    padding: 20px;
}

.smartmail-section {
    margin-bottom: 40px;
}

.smartmail-section h2 {
    margin-top: 0;
}

.smartmail-feature {
    background-color: #fff;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
}
</style>
