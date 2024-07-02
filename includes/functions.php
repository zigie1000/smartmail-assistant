<?php
if (!defined('ABSPATH')) {
    exit;
}

// Function to retrieve and display the customer's email
function smartmail_get_customer_email($customer_id) {
    $user_info = get_userdata($customer_id);
    return $user_info->user_email;
}

// Example function to use customer email in AI functions
function smartmail_process_customer_email($customer_id) {
    $email_content = smartmail_get_customer_email($customer_id);
    return smartmail_email_categorization($email_content);
}
