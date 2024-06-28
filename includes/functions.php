<?php
// AI functions for various services

if (!function_exists('smartmail_email_categorization')) {
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
}

if (!function_exists('smartmail_priority_inbox')) {
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
}

if (!function_exists('smartmail_automated_responses')) {
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
}

if (!function_exists('smartmail_email_summarization')) {
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
}

if (!function_exists('smartmail_meeting_scheduler')) {
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
}

if (!function_exists('smartmail_follow_up_reminders')) {
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
}

if (!function_exists('smartmail_sentiment_analysis')) {
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
}

if (!function_exists('smartmail_email_templates')) {
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
}

if (!function_exists('smartmail_forensic_analysis')) {
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
}

// Register shortcodes
if (!function_exists('smartmail_register_shortcodes')) {
    function smartmail_register_shortcodes() {
        add_shortcode('sma_email_categorization', 'smartmail_email_categorization_shortcode');
        add_shortcode('sma_priority_inbox', 'smartmail_priority_inbox_shortcode');
        add_shortcode('sma_automated_responses', 'smartmail_automated_responses_shortcode');
        add_shortcode('sma_email_summarization', 'smartmail_email_summarization_shortcode');
        add_shortcode('sma_meeting_scheduler', 'smartmail_meeting_scheduler_shortcode');
        add_shortcode('sma_follow_up_reminders', 'smartmail_follow_up_reminders_shortcode');
        add_shortcode('sma_sentiment_analysis', 'smartmail_sentiment_analysis_shortcode');
        add_shortcode('sma_email_templates', 'smartmail_email_templates_shortcode');
        add_shortcode('sma_forensic_analysis', 'smartmail_forensic_analysis_shortcode');
    }
}
add_action('init', 'smartmail_register_shortcodes');

if (!function_exists('smartmail_email_categorization_shortcode')) {
    function smartmail_email_categorization_shortcode($atts, $content = null) {
        return smartmail_email_categorization($content);
    }
}

if (!function_exists('smartmail_priority_inbox_shortcode')) {
    function smartmail_priority_inbox_shortcode($atts, $content = null) {
        return smartmail_priority_inbox($content);
    }
}

if (!function_exists('smartmail_automated_responses_shortcode')) {
    function smartmail_automated_responses_shortcode($atts, $content = null) {
        return smartmail_automated_responses($content);
    }
}

if (!function_exists('smartmail_email_summarization_shortcode')) {
    function smartmail_email_summarization_shortcode($atts, $content = null) {
        return smartmail_email_summarization($content);
    }
}

if (!function_exists('smartmail_meeting_scheduler_shortcode')) {
    function smartmail_meeting_scheduler_shortcode($atts, $content = null) {
        return smartmail_meeting_scheduler($content);
    }
}

if (!function_exists('smartmail_follow_up_reminders_shortcode')) {
    function smartmail_follow_up_reminders_shortcode($atts, $content = null) {
        return smartmail_follow_up_reminders($content);
    }
}

if (!function_exists('smartmail_sentiment_analysis_shortcode')) {
    function smartmail_sentiment_analysis_shortcode($atts, $content = null) {
        return smartmail_sentiment_analysis($content);
    }
}

if (!function_exists('smartmail_email_templates_shortcode')) {
    function smartmail_email_templates_shortcode($atts, $content = null) {
        return smartmail_email_templates();
    }
}

if (!function_exists('smartmail_forensic_analysis_shortcode')) {
    function smartmail_forensic_analysis_shortcode($atts, $content = null) {
        return smartmail_forensic_analysis($content);
    }
}

// Function to log messages
if (!function_exists('smartmail_log')) {
    function smartmail_log($message) {
        if (defined('SMARTMAIL_DEBUG_LOG')) {
            error_log($message . PHP_EOL, 3, SMARTMAIL_DEBUG_LOG);
        }
    }
}
