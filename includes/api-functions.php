<?php

if (!defined('ABSPATH')) {
    exit;
}

function smartmail_assistant_register_api_endpoints() {
    register_rest_route(
        'smartmail/v1',
        '/data',
        array(
            'methods'  => 'GET',
            'callback' => 'smartmail_assistant_get_data',
        )
    );
}

add_action('rest_api_init', 'smartmail_assistant_register_api_endpoints');

function smartmail_assistant_get_data($request) {
    return new WP_REST_Response(array('message' => 'SmartMail API is working'), 200);
}
?>
