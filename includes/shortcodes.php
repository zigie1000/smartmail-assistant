<?php
if (!defined('ABSPATH')) {
    exit;
}

// Shortcodes

function smartmail_dashboard_shortcode() {
    ob_start();
    if (is_user_logged_in() && current_user_can('manage_options')) {
        include plugin_dir_path(__FILE__) . 'templates/admin-dashboard.php';
    } else {
        echo '<p>You do not have sufficient permissions to access this page.</p>';
    }
    return ob_get_clean();
}
add_shortcode('smartmail_dashboard', 'smartmail_dashboard_shortcode');
?>
