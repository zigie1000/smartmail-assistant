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

function smartmail_email_categorization($email_content) {
    $client = get_openai_client();
    try {
        $response = $client->completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => "Categorize the following email content:\n\n" . $email_content,
            'max_tokens' => 150
        ]);
        return trim($response['choices'][0]['text']);
    } catch (Exception $e) {
        smartmail_log('OpenAI error: ' . $e->getMessage());
        return 'Error categorizing email.';
    }
}

function smartmail_priority_inbox($email_content) {
    $client = get_openai_client();
    try {
        $response = $client->completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => "Determine the priority of the following email content:\n\n" . $email_content,
            'max_tokens' => 150
        ]);
        return trim($response['choices'][0]['text']);
    } catch (Exception $e) {
        smartmail_log('OpenAI error: ' . $e->getMessage());
        return 'Error determining priority.';
    }
}

function smartmail_automated_responses($email_content) {
    $client = get_openai_client();
    try {
        $response = $client->completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => "Generate an automated response for the following email content:\n\n" . $email_content,
            'max_tokens' => 150
        ]);
        return trim($response['choices'][0]['text']);
    } catch (Exception $e) {
        smartmail_log('OpenAI error: ' . $e->getMessage());
        return 'Error generating automated response.';
    }
}

function smartmail_email_summarization($email_content) {
    $client = get_openai_client();
    try {
        $response = $client->completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => "Summarize the following email content:\n\n" . $email_content,
            'max_tokens' => 150
        ]);
        return trim($response['choices'][0]['text']);
    } catch (Exception $e) {
        smartmail_log('OpenAI error: ' . $e->getMessage());
        return 'Error summarizing email.';
    }
}

function smartmail_meeting_scheduler($email_content) {
    $client = get_openai_client();
    try {
        $response = $client->completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => "Schedule a meeting based on the following email content:\n\n" . $email_content,
            'max_tokens' => 150
        ]);
        return trim($response['choices'][0]['text']);
    } catch (Exception $e) {
        smartmail_log('OpenAI error: ' . $e->getMessage());
        return 'Error scheduling meeting.';
    }
}

function smartmail_follow_up_reminders($email_content) {
    $client = get_openai_client();
    try {
        $response = $client->completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => "Generate follow-up reminders for the following email content:\n\n" . $email_content,
            'max_tokens' => 150
        ]);
        return trim($response['choices'][0]['text']);
    } catch (Exception $e) {
        smartmail_log('OpenAI error: ' . $e->getMessage());
        return 'Error generating follow-up reminders.';
    }
}

function smartmail_sentiment_analysis($email_content) {
    $client = get_openai_client();
    try {
        $response = $client->completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => "Analyze the sentiment of the following email content:\n\n" . $email_content,
            'max_tokens' => 150
        ]);
        return trim($response['choices'][0]['text']);
    } catch (Exception $e) {
        smartmail_log('OpenAI error: ' . $e->getMessage());
        return 'Error analyzing sentiment.';
    }
}

function smartmail_email_templates() {
    $client = get_openai_client();
    try {
        $response = $client->completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => "Generate an email template.",
            'max_tokens' => 150
        ]);
        return trim($response['choices'][0]['text']);
    } catch (Exception $e) {
        smartmail_log('OpenAI error: ' . $e->getMessage());
        return 'Error generating email template.';
    }
}

function smartmail_forensic_analysis($email_content) {
    $client = get_openai_client();
    try {
        $response = $client->completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => "Perform a forensic analysis of the following email content:\n\n" . $email_content,
            'max_tokens' => 150
        ]);
        return trim($response['choices'][0]['text']);
    } catch (Exception $e) {
        smartmail_log('OpenAI error: ' . $e->getMessage());
        return 'Error performing forensic analysis.';
    }
}
