<?php

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

function sma_get_email_summary($email_content) {
    $api_key = get_option('sma_api_key');
    $endpoint = 'https://api.openai.com/v1/engines/davinci-codex/completions';
    
    $args = array(
        'body' => json_encode(array(
            'prompt' => 'Summarize the following email:\n\n' . sanitize_text_field($email_content),
            'max_tokens' => 100
        )),
        'headers' => array(
            'Authorization' => 'Bearer ' . esc_attr($api_key),
            'Content-Type' => 'application/json'
        ),
        'timeout' => 15,
    );

    $response = wp_remote_post($endpoint, $args);

    if (is_wp_error($response)) {
        return 'Error: ' . esc_html($response->get_error_message());
    }

    $body = json_decode(wp_remote_retrieve_body($response), true);
    if (isset($body['choices'][0]['text'])) {
        return esc_html($body['choices'][0]['text']);
    }

    return 'Error: Invalid response from API.';
}