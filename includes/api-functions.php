<?php
// API functions for SmartMail Assistant

function smartmail_get_api_key() {
    $options = get_option('smartmail_options');
    return isset($options['api_key']) ? $options['api_key'] : '';
}

function smartmail_api_request($endpoint, $data = array()) {
    $api_key = smartmail_get_api_key();
    if (empty($api_key)) {
        return new WP_Error('no_api_key', 'API key is missing');
    }

    $response = wp_remote_post($endpoint, array(
        'body' => json_encode($data),
        'headers' => array(
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $api_key
        )
    ));

    if (is_wp_error($response)) {
        return $response;
    }

    $body = wp_remote_retrieve_body($response);
    return json_decode($body);
}
?>
