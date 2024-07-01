<?php
// API functions for interacting with external services

// Example function to get data from an API
if (!function_exists('smartmail_get_api_data')) {
    function smartmail_get_api_data($url) {
        $response = wp_remote_get($url);

        if (is_wp_error($response)) {
            return false;
        }

        $body = wp_remote_retrieve_body($response);
        return json_decode($body, true);
    }
}
?>
