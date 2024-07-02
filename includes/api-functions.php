<?php
if (!defined('ABSPATH')) {
    exit;
}

function smartmail_get_api_client() {
    $api_key = get_option('smartmail_openai_api_key');
    if (!$api_key) {
        throw new Exception('OpenAI API key is missing.');
    }
    return OpenAI\Client::factory(['api_key' => $api_key]);
}

function smartmail_handle_api_request($endpoint, $data) {
    $client = smartmail_get_api_client();
    $response = $client->completions()->create($data);
    return $response['choices'][0]['text'];
}

function smartmail_categorize_email($email_content) {
    return smartmail_handle_api_request('completions', [
        'model' => 'text-davinci-003',
        'prompt' => "Categorize the following email content:\n\n" . $email_content,
        'max_tokens' => 150
    ]);
}

function smartmail_determine_priority($email_content) {
    return smartmail_handle_api_request('completions', [
        'model' => 'text-davinci-003',
        'prompt' => "Determine the priority of the following email content:\n\n" . $email_content,
        'max_tokens' => 150
    ]);
}

function smartmail_generate_response($email_content) {
    return smartmail_handle_api_request('completions', [
        'model' => 'text-davinci-003',
        'prompt' => "Generate an automated response for the following email content:\n\n" . $email_content,
        'max_tokens' => 150
    ]);
}

function smartmail_summarize_email($email_content) {
    return smartmail_handle_api_request('completions', [
        'model' => 'text-davinci-003',
        'prompt' => "Summarize the following email content:\n\n" . $email_content,
        'max_tokens' => 150
    ]);
}

function smartmail_schedule_meeting($email_content) {
    return smartmail_handle_api_request('completions', [
        'model' => 'text-davinci-003',
        'prompt' => "Schedule a meeting based on the following email content:\n\n" . $email_content,
        'max_tokens' => 150
    ]);
}

function smartmail_generate_reminders($email_content) {
    return smartmail_handle_api_request('completions', [
        'model' => 'text-davinci-003',
        'prompt' => "Generate follow-up reminders for the following email content:\n\n" . $email_content,
        'max_tokens' => 150
    ]);
}

function smartmail_analyze_sentiment($email_content) {
    return smartmail_handle_api_request('completions', [
        'model' => 'text-davinci-003',
        'prompt' => "Analyze the sentiment of the following email content:\n\n" . $email_content,
        'max_tokens' => 150
    ]);
}

function smartmail_generate_template() {
    return smartmail_handle_api_request('completions', [
        'model' => 'text-davinci-003',
        'prompt' => "Generate an email template.",
        'max_tokens' => 150
    ]);
}

function smartmail_perform_forensic_analysis($email_content) {
    return smartmail_handle_api_request('completions', [
        'model' => 'text-davinci-003',
        'prompt' => "Perform a forensic analysis of the following email content:\n\n" . $email_content,
        'max_tokens' => 150
    ]);
}
?>
