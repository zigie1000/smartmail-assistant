<?php
// API functions file for SmartMail Assistant

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

function smartmail_api_call($endpoint, $args = array()) {
    $response = wp_remote_get($endpoint, $args);
    if (is_wp_error($response)) {
        return false;
    }
    $body = wp_remote_retrieve_body($response);
    return json_decode($body);
}
