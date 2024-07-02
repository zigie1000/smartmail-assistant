<?php

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

// Repeat similar pattern for other AI functions...

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

function smartmail_log($message) {
    if (WP_DEBUG === true) {
        if (is_array($message) || is_object($message)) {
            error_log(print_r($message, true));
        } else {
            error_log($message);
        }
    }
}
