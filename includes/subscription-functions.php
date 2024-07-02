<?php

// Subscription management functions

function smartmail_handle_subscription() {
    if (isset($_POST['smartmail_subscribe'])) {
        $email = sanitize_email($_POST['email']);
        if (is_email($email)) {
            // Add email to subscription list (this could be a custom table or an external service)
            smartmail_add_email_to_subscription($email);
            echo '<p>Subscription successful!</p>';
        } else {
            echo '<p>Invalid email address.</p>';
        }
    }
}
add_action('init', 'smartmail_handle_subscription');

function smartmail_add_email_to_subscription($email) {
    // Add the email to the subscription list
    // For demonstration purposes, let's just log it
    smartmail_log('New subscription: ' . $email);
}

function smartmail_remove_email_from_subscription($email) {
    // Remove the email from the subscription list
    // For demonstration purposes, let's just log it
    smartmail_log('Unsubscribed: ' . $email);
}
