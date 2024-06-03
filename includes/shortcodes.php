<?php
// Shortcodes file for SmartMail Assistant

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

function smartmail_shortcode_function() {
    return '<p>SmartMail shortcode content here.</p>';
}
add_shortcode('smartmail', 'smartmail_shortcode_function');
