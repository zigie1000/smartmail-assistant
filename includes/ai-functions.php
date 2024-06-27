<?php
// AI functions for various services using OpenAI

// Including Composer's autoload file
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
} else {
    wp_die('Composer autoload file not found. Please run "composer install" in the plugin directory.');
}

use OpenAI\ApiClient;
use OpenAI\Configuration;

// Function to get OpenAI client
function get_openai_client() {
    $apiKey = 'YOUR_OPENAI_API_KEY'; // Replace with your OpenAI API key
    $config = Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'Bearer ' . $apiKey);
    return new ApiClient($config);
}

if (!function_exists('smartmail_email_categorization')) {
    function smartmail_email_categorization($email_content) {
        try {
            $client = get_openai_client();
            $response = $client->completions()->create([
                'model' => 'text-davinci-002',
                'prompt' => 'Categorize this email: ' . $email_content,
                'max_tokens' => 50,
            ]);
            return $response['choices'][0]['text'];
        } catch (Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}

if (!function_exists('smartmail_priority_inbox')) {
    function smartmail_priority_inbox($email_content) {
        try {
            $client = get_openai_client();
            $response = $client->completions()->create([
                'model' => 'text-davinci-002',
                'prompt' => 'Determine the priority of this email: ' . $email_content,
                'max_tokens' => 50,
            ]);
            return $response['choices'][0]['text'];
        } catch (Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}

if (!function_exists('smartmail_automated_responses')) {
    function smartmail_automated_responses($email_content) {
        try {
            $client = get_openai_client();
            $response = $client->completions()->create([
                'model' => 'text-davinci-002',
                'prompt' => 'Generate an automated response to this email: ' . $email_content,
                'max_tokens' => 150,
            ]);
            return $response['choices'][0]['text'];
        } catch (Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}

if (!function_exists('smartmail_email_summarization')) {
    function smartmail_email_summarization($email_content) {
        try {
            $client = get_openai_client();
            $response = $client->completions()->create([
                'model' => 'text-davinci-002',
                'prompt' => 'Summarize this email: ' . $email_content,
                'max_tokens' => 100,
            ]);
            return $response['choices'][0]['text'];
        } catch (Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}

if (!function_exists('smartmail_meeting_scheduler')) {
    function smartmail_meeting_scheduler($email_content) {
        try {
            $client = get_openai_client();
            $response = $client->completions()->create([
                'model' => 'text-davinci-002',
                'prompt' => 'Schedule a meeting based on this email: ' . $email_content,
                'max_tokens' => 100,
            ]);
            return $response['choices'][0]['text'];
        } catch (Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}

if (!function_exists('smartmail_follow_up_reminders')) {
    function smartmail_follow_up_reminders($email_content) {
        try {
            $client = get_openai_client();
            $response = $client->completions()->create([
                'model' => 'text-davinci-002',
                'prompt' => 'Generate follow-up reminders for this email: ' . $email_content,
                'max_tokens' => 100,
            ]);
            return $response['choices'][0]['text'];
        } catch (Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}

if (!function_exists('smartmail_sentiment_analysis')) {
    function smartmail_sentiment_analysis($email_content) {
        try {
            $client = get_openai_client();
            $response = $client->completions()->create([
                'model' => 'text-davinci-002',
                'prompt' => 'Perform sentiment analysis on this email: ' . $email_content,
                'max_tokens' => 100,
            ]);
            return $response['choices'][0]['text'];
        } catch (Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}

if (!function_exists('smartmail_email_templates')) {
    function smartmail_email_templates() {
        try {
            $client = get_openai_client();
            $response = $client->completions()->create([
                'model' => 'text-davinci-002',
                'prompt' => 'Generate a custom email template.',
                'max_tokens' => 150,
            ]);
            return $response['choices'][0]['text'];
        } catch (Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}
?>
