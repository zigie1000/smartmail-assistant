<?php
if (!defined('ABSPATH')) {
    exit;
}

function smartmail_get_openai_client() {
    require_once plugin_dir_path(__FILE__) . '../vendor/autoload.php';
    $api_key = get_option('smartmail_openai_api_key');
    if (!$api_key) {
        throw new Exception('OpenAI API key is missing.');
    }
    return OpenAI\Client::factory(['api_key' => $api_key]);
}

function smartmail_create_openai_completions($prompt, $max_tokens = 150) {
    $client = smartmail_get_openai_client();
    try {
        $response = $client->completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => $prompt,
            'max_tokens' => $max_tokens
        ]);
        return trim($response['choices'][0]['text']);
    } catch (Exception $e) {
        smartmail_log('OpenAI error: ' . $e->getMessage());
        return 'Error processing request.';
    }
}
?>
