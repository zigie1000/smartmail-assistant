<?php
// Subscription functions file for SmartMail Assistant

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function sma_check_subscription() {
    $user_id = get_current_user_id();
    $response = wp_remote_get("https://smartmail.store/api/check-subscription?user_id={$user_id}");

    if (is_wp_error($response)) {
        return false;
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

    return isset($data['active']) && $data['active'] === true;
}

function sma_subscribe_user($email) {
    $response = wp_remote_post('https://smartmail.store/api/subscribe', array(
        'body' => array(
            'email' => $email
        )
    ));

    if (is_wp_error($response)) {
        return false;
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

    return isset($data['success']) && $data['success'] === true;
}
