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

// AI functions for various services
if (!function_exists('smartmail_email_categorization')) {
    function smartmail_email_categorization() {
        $email_content = sanitize_text_field($_POST['content']);
        $client = get_openai_client();
        try {
            $response = $client->completions()->create([
                'model' => 'text-davinci-003',
                'prompt' => "Categorize the following email content:\n\n" . $email_content,
                'max_tokens' => 150
            ]);
            echo trim($response['choices'][0]['text']);
        } catch (Exception $e) {
            smartmail_log('OpenAI error: ' . $e->getMessage());
            echo 'Error categorizing email.';
        }
        wp_die(); // This is required to terminate immediately and return a proper response
    }
}

if (!function_exists('smartmail_priority_inbox')) {
    function smartmail_priority_inbox() {
        $email_content = sanitize_text_field($_POST['content']);
        $client = get_openai_client();
        try {
            $response = $client->completions()->create([
                'model' => 'text-davinci-003',
                'prompt' => "Determine the priority of the following email content:\n\n" . $email_content,
                'max_tokens' => 150
            ]);
            echo trim($response['choices'][0]['text']);
        } catch (Exception $e) {
            smartmail_log('OpenAI error: ' . $e->getMessage());
            echo 'Error determining priority.';
        }
        wp_die(); // This is required to terminate immediately and return a proper response
    }
}

if (!function_exists('smartmail_automated_responses')) {
    function smartmail_automated_responses() {
        $email_content = sanitize_text_field($_POST['content']);
        $client = get_openai_client();
        try {
            $response = $client->completions()->create([
                'model' => 'text-davinci-003',
                'prompt' => "Generate an automated response for the following email content:\n\n" . $email_content,
                'max_tokens' => 150
            ]);
            echo trim($response['choices'][0]['text']);
        } catch (Exception $e) {
            smartmail_log('OpenAI error: ' . $e->getMessage());
            echo 'Error generating automated response.';
        }
        wp_die(); // This is required to terminate immediately and return a proper response
    }
}

if (!function_exists('smartmail_email_summarization')) {
    function smartmail_email_summarization() {
        $email_content = sanitize_text_field($_POST['content']);
        $client = get_openai_client();
        try {
            $response = $client->completions()->create([
                'model' => 'text-davinci-003',
                'prompt' => "Summarize the following email content:\n\n" . $email_content,
                'max_tokens' => 150
            ]);
            echo trim($response['choices'][0]['text']);
        } catch (Exception $e) {
            smartmail_log('OpenAI error: ' . $e->getMessage());
            echo 'Error summarizing email.';
        }
        wp_die(); // This is required to terminate immediately and return a proper response
    }
}

if (!function_exists('smartmail_meeting_scheduler')) {
    function smartmail_meeting_scheduler() {
        $email_content = sanitize_text_field($_POST['content']);
        $client = get_openai_client();
        try {
            $response = $client->completions()->create([
                'model' => 'text-davinci-003',
                'prompt' => "Schedule a meeting based on the following email content:\n\n" . $email_content,
                'max_tokens' => 150
            ]);
            echo trim($response['choices'][0]['text']);
        } catch (Exception $e) {
            smartmail_log('OpenAI error: ' . $e->getMessage());
            echo 'Error scheduling meeting.';
        }
        wp_die(); // This is required to terminate immediately and return a proper response
    }
}

if (!function_exists('smartmail_follow_up_reminders')) {
    function smartmail_follow_up_reminders() {
        $email_content = sanitize_text_field($_POST['content']);
        $client = get_openai_client();
        try {
            $response = $client->completions()->create([
                'model' => 'text-davinci-003',
                'prompt' => "Generate follow-up reminders for the following email content:\n\n" . $email_content,
                'max_tokens' => 150
            ]);
            echo trim($response['choices'][0]['text']);
        } catch (Exception $e) {
            smartmail_log('OpenAI error: ' . $e->getMessage());
            echo 'Error generating follow-up reminders.';
        }
        wp_die(); // This is required to terminate immediately and return a proper response
    }
}

if (!function_exists('smartmail_sentiment_analysis')) {
    function smartmail_sentiment_analysis() {
        $email_content = sanitize_text_field($_POST['content']);
        $client = get_openai_client();
        try {
            $response = $client->completions()->create([
                'model' => 'text-davinci-003',
                'prompt' => "Analyze the sentiment of the following email content:\n\n" . $email_content,
                'max_tokens' => 150
            ]);
            echo trim($response['choices'][0]['text']);
        } catch (Exception $e) {
            smartmail_log('OpenAI error: ' . $e->getMessage());
            echo 'Error analyzing sentiment.';
        }
        wp_die(); // This is required to terminate immediately and return a proper response
    }
}

if (!function_exists('smartmail_email_templates')) {
    function smartmail_email_templates() {
        $request = sanitize_text_field($_POST['content']);
        $client = get_openai_client();
        try {
            $response = $client->completions()->create([
                'model' => 'text-davinci-003',
                'prompt' => "Generate an email template based on the following request:\n\n" . $request,
                'max_tokens' => 150
            ]);
            echo trim($response['choices'][0]['text']);
        } catch (Exception $e) {
            smartmail_log('OpenAI error: ' . $e->getMessage());
            echo 'Error generating email template.';
        }
        wp_die(); // This is required to terminate immediately and return a proper response
    }
}

if (!function_exists('smartmail_forensic_analysis')) {
    function smartmail_forensic_analysis() {
        $email_content = sanitize_text_field($_POST['content']);
        $client = get_openai_client();
        try {
            $response = $client->completions()->create([
                'model' => 'text-davinci-003',
                'prompt' => "Perform a forensic analysis of the following email content:\n\n" . $email_content,
                'max_tokens' => 150
            ]);
            echo trim($response['choices'][0]['text']);
        } catch (Exception $e) {
            smartmail_log('OpenAI error: ' . $e->getMessage());
            echo 'Error performing forensic analysis.';
        }
        wp_die(); // This is required to terminate immediately and return a proper response
    }
}                
