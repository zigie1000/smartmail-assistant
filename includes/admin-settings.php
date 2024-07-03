<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!function_exists('get_openai_client')) {
    function get_openai_client() {
        $api_key = get_option('smartmail_openai_api_key');
        if (!$api_key) {
            throw new Exception('OpenAI API key is missing.');
        }
        return OpenAI\Client::factory(['api_key' => $api_key]);
    }
}

// AI functions for various services
function smartmail_email_categorization() {
    check_ajax_referer('smartmail_nonce', 'nonce');
    $email_content = sanitize_textarea_field($_POST['content']);
    $client = get_openai_client();
    try {
        $response = $client->completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => "Categorize the following email content:\n\n" . $email_content,
            'max_tokens' => 150
        ]);
        wp_send_json_success(trim($response['choices'][0]['text']));
    } catch (Exception $e) {
        smartmail_log('OpenAI error: ' . $e->getMessage());
        wp_send_json_error('Error categorizing email.');
    }
}
add_action('wp_ajax_smartmail_email_categorization', 'smartmail_email_categorization');

function smartmail_priority_inbox() {
    check_ajax_referer('smartmail_nonce', 'nonce');
    $email_content = sanitize_textarea_field($_POST['content']);
    $client = get_openai_client();
    try {
        $response = $client->completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => "Determine the priority of the following email content:\n\n" . $email_content,
            'max_tokens' => 150
        ]);
        wp_send_json_success(trim($response['choices'][0]['text']));
    } catch (Exception $e) {
        smartmail_log('OpenAI error: ' . $e->getMessage());
        wp_send_json_error('Error determining priority.');
    }
}
add_action('wp_ajax_smartmail_priority_inbox', 'smartmail_priority_inbox');

// Repeat similar function definitions for other features like smartmail_automated_responses, smartmail_email_summarization, etc.
