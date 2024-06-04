<?php
/**
 * Plugin Name: SmartMail Assistant
 * Plugin URI: https://smartmail.store
 * Description: Core functionalities for SmartMail Assistant, including email categorization, priority inbox, email summarization, and sentiment analysis.
 * Version: 1.0.0
 * Author: Marco Zagato
 * Author URI: https://smartmail.store
 * License: MIT
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Define plugin constants
define('SMARTMAIL_ASSISTANT_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('SMARTMAIL_ASSISTANT_PLUGIN_URL', plugin_dir_url(__FILE__));

// Include necessary files with error handling
$includes = [
    'includes/functions.php',
    'includes/class-wc-gateway-pi.php',
    'includes/admin-settings.php',
    'includes/api-functions.php',
    'includes/shortcodes.php',
    'includes/subscription-functions.php',
    'includes/pi-functions.php'
];

foreach ($includes as $file) {
    $filepath = SMARTMAIL_ASSISTANT_PLUGIN_PATH . $file;
    if (file_exists($filepath)) {
        require_once $filepath;
    } else {
        error_log("Missing file: $filepath");
    }
}

// Activation hook
function smartmail_assistant_activate() {
    // Activation code here
    if (!class_exists('WC_Gateway_Pi')) {
        error_log('WC_Gateway_Pi class not found during activation');
    }
}
register_activation_hook(__FILE__, 'smartmail_assistant_activate');

// Deactivation hook
function smartmail_assistant_deactivate() {
    // Deactivation code here
}
register_deactivation_hook(__FILE__, 'smartmail_assistant_deactivate');

// Plugin initialization code
function smartmail_assistant_init() {
    // Initialization code here
}
add_action('plugins_loaded', 'smartmail_assistant_init');
?>
