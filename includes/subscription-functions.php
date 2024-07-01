<?php
// Functions for managing subscriptions

if (!function_exists('smartmail_handle_subscription')) {
    function smartmail_handle_subscription($user_id, $plan) {
        // Handle subscription logic here
        update_user_meta($user_id, 'smartmail_subscription_plan', $plan);
    }
}

if (!function_exists('smartmail_check_subscription_status')) {
    function smartmail_check_subscription_status($user_id) {
        // Check subscription status logic here
        $plan = get_user_meta($user_id, 'smartmail_subscription_plan', true);
        return $plan ? $plan : 'free';
    }
}
?>
