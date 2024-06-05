<?php
/**
 * Plugin Name: SmartMail Assistant
 * Plugin URI: https://smartmail.store
 * Description: A comprehensive assistant for managing your SmartMail, including AI-driven features.
 * Version: 1.0.0
 * Author: Marco Zagato
 * Author URI: https://smartmail.store
 * License: MIT
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Function to log messages to a custom debug log file
function smartmail_log($message) {
    if (defined('SMARTMAIL_DEBUG_LOG')) {
        error_log($message . PHP_EOL, 3, SMARTMAIL_DEBUG_LOG);
    }
}

// Define plugin constants
define('SMARTMAIL_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('SMARTMAIL_PLUGIN_URL', plugin_dir_url(__FILE__));
define('SMARTMAIL_DEBUG_LOG', SMARTMAIL_PLUGIN_PATH . 'debug.log');

// Example usage of logging
smartmail_log('SmartMail Assistant plugin loaded.');

// Check for required dependencies
function smartmail_check_dependencies() {
    $bypass_dependencies = get_option('smartmail_bypass_dependencies', 'no');

    if ($bypass_dependencies === 'yes') {
        smartmail_log('Bypassing dependency checks.');
        return;
    }

    $missing_dependencies = array();

    if (!function_exists('wp_remote_get')) {
        $missing_dependencies[] = 'wp_remote_get function (WordPress core)';
        smartmail_log('Missing wp_remote_get function.');
    }

    if (!class_exists('WooCommerce')) {
        $missing_dependencies[] = 'WooCommerce';
        smartmail_log('WooCommerce is not installed or activated.');
    }

    if (!empty($missing_dependencies)) {
        deactivate_plugins(plugin_basename(__FILE__));
        $message = 'The following dependencies are missing: ' . implode(', ', $missing_dependencies);
        smartmail_log($message);
        wp_die($message);
    }
}
add_action('admin_init', 'smartmail_check_dependencies');

// Include necessary files
function smartmail_include_files() {
    $files = [
        'includes/admin-settings.php',
        'includes/api-functions.php',
        'includes/class-wc-gateway-pi.php',
        'includes/shortcodes.php',
        'includes/subscription-functions.php',
        'includes/ai-functions.php'
    ];

    foreach ($files as $file) {
        $file_path = SMARTMAIL_PLUGIN_PATH . $file;
        if (file_exists($file_path)) {
            require_once $file_path;
            smartmail_log("Included file: $file");
        } else {
            smartmail_log("Missing file: $file");
        }
    }
}
add_action('plugins_loaded', 'smartmail_include_files');

// Activation hook
function smartmail_activate() {
    try {
        // Add activation code here
        smartmail_log('SmartMail Assistant plugin activated successfully.');
    } catch (Exception $e) {
        $error_message = 'SmartMail Assistant activation error: ' . $e->getMessage();
        smartmail_log($error_message);
        wp_die($error_message);
    }
}
register_activation_hook(__FILE__, 'smartmail_activate');

// Deactivation hook
function smartmail_deactivate() {
    try {
        // Add deactivation code here
        smartmail_log('SmartMail Assistant plugin deactivated successfully.');
    } catch (Exception $e) {
        $error_message = 'SmartMail Assistant deactivation error: ' . $e->getMessage();
        smartmail_log($error_message);
        wp_die($error_message);
    }
}
register_deactivation_hook(__FILE__, 'smartmail_deactivate');

// Check if the function exists before declaring it
if (!function_exists('smartmail_admin_menu')) {
    // Admin menu
    function smartmail_admin_menu() {
        add_menu_page(
            'SmartMail Assistant',
            'SmartMail',
            'manage_options',
            'smartmail',
            'smartmail_admin_page',
            'dashicons-email-alt2',
            6
        );
        smartmail_log('Admin menu added.');
    }
}
add_action('admin_menu', 'smartmail_admin_menu');

// Admin page content
function smartmail_admin_page() {
    ?>
    <div class="wrap">
        <h1>SmartMail Assistant</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('smartmail_options_group');
            do_settings_sections('smartmail');
            submit_button();
            ?>
        </form>
        <h2>Dependency Check</h2>
        <?php
        $dependencies = smartmail_check_all_dependencies();
        if (empty($dependencies)) {
            echo '<p>All dependencies are met.</p>';
        } else {
            echo '<p>Missing dependencies:</p><ul>';
            foreach ($dependencies as $dependency) {
                echo '<li>' . esc_html($dependency) . '</li>';
            }
            echo '</ul>';
        }
        ?>
    </div>
    <?php
}

// Check all dependencies function
function smartmail_check_all_dependencies() {
    $missing_dependencies = array();

    if (!function_exists('wp_remote_get')) {
        $missing_dependencies[] = 'wp_remote_get function (WordPress core)';
    }

    if (!class_exists('WooCommerce')) {
        $missing_dependencies[] = 'WooCommerce';
    }

    return $missing_dependencies;
}

// Register settings
function smartmail_register_settings() {
    register_setting('smartmail_options_group', 'smartmail_option_name');
    register_setting('smartmail_options_group', 'smartmail_bypass_dependencies');
    add_settings_section('smartmail_main_section', 'Main Settings', 'smartmail_main_section_cb', 'smartmail');
    add_settings_field('smartmail_option_name', 'Option Name', 'smartmail_option_name_cb', 'smartmail', 'smartmail_main_section');
    add_settings_field('smartmail_bypass_dependencies', 'Bypass Dependency Checks', 'smartmail_bypass_dependencies_cb', 'smartmail', 'smartmail_main_section');
}
add_action('admin_init', 'smartmail_register_settings');

function smartmail_main_section_cb() {
    echo '<p>Main description of this section here.</p>';
}

function smartmail_option_name_cb() {
    $setting = get_option('smartmail_option_name');
    echo "<input type='text' name='smartmail_option_name' value='" . esc_attr($setting) . "'>";
}

function smartmail_bypass_dependencies_cb() {
    $setting = get_option('smartmail_bypass_dependencies', 'no');
    ?>
    <input type="checkbox" name="smartmail_bypass_dependencies" value="yes" <?php checked('yes', $setting); ?> />
    <label for="smartmail_bypass_dependencies">Check this box to bypass dependency checks</label>
    <?php
}

// Adding user menu and service page
if (!function_exists('smartmail_user_menu')) {
    function smartmail_user_menu() {
        add_menu_page(
            'SmartMail Services',
            'SmartMail Services',
            'read',
            'smartmail-services',
            'smartmail_user_page',
            'dashicons-email-alt2',
            6
        );
        smartmail_log('User menu added.');
    }
}
add_action('admin_menu', 'smartmail_user_menu');

function smartmail_user_page() {
    ?>
    <div class="wrap">
        <h1>SmartMail Services</h1>
        <p>Welcome to SmartMail Services. Here you can manage your email settings and subscriptions.</p>
        <h2>Services</h2>
        <ul>
            <li><a href="<?php echo admin_url('admin.php?page=smartmail-subscription-management'); ?>">Email Subscription Management</a></li>
            <li><a href="<?php echo admin_url('admin.php?page=smartmail-email-settings'); ?>">Email Settings</a></li>
            <li><a href="<?php echo admin_url('admin.php?page=smartmail-profile-management'); ?>">Profile Management</a></li>
            <li><a href="<?php echo admin_url('admin.php?page=smartmail-email-history'); ?>">Email History</a></li>
            <li><a href="<?php echo admin_url('admin.php?page=smartmail-feedback-support'); ?>">Feedback and Support</a></li>
            <li><a href="<?php echo admin_url('admin.php?page=smartmail-newsletter-archives'); ?>">Newsletter Archives</a></li>
            <li><a href="<?php echo admin_url('admin.php?page=smartmail-custom-templates'); ?>">Custom Email Templates</a></li>
            <li><a href="<?php echo admin_url('admin.php?page=smartmail-email-analytics'); ?>">Email Analytics</a></li>
        </ul>
    </div>
    <?php
}

// AI functions for various services
require_once SMARTMAIL_PLUGIN_PATH . 'includes/ai-functions.php';
smartmail_log('AI functions included.');

// Email Subscription Management Page
function smartmail_subscription_management_page() {
    ?>
    <div class="wrap">
        <h1>Email Subscription Management</h1>
        <p>Manage your email subscriptions here.</p>
    </div>
    <?php
}
add_action('admin_menu', function() {
    add_submenu_page('smartmail-services', 'Subscription Management', 'Subscription Management', 'read', 'smartmail-subscription-management', 'smartmail_subscription_management_page');
    smartmail_log('Subscription Management page added.');
});

// Email Settings Page
function smartmail_email_settings_page() {
    ?>
    <div class="wrap">
        <h1>Email Settings</h1>
        <p>Update your email settings here.</p>
    </div>
    <?php
}



add_action('admin_menu', function() {
    add_submenu_page('smartmail-services', 'Email Settings', 'Email Settings', 'read', 'smartmail-email-settings', 'smartmail_email_settings_page');
    smartmail_log('Email Settings page added.');
});

// Profile Management Page
function smartmail_profile_management_page() {
    ?>
    <div class="wrap">
        <h1>Profile Management</h1>
        <p>Update your profile information here.</p>
    </div>
    <?php
}
add_action('admin_menu', function() {
    add_submenu_page('smartmail-services', 'Profile Management', 'Profile Management', 'read', 'smartmail-profile-management', 'smartmail_profile_management_page');
    smartmail_log('Profile Management page added.');
});

// Email History Page
function smartmail_email_history_page() {
    ?>
    <div class="wrap">
        <h1>Email History</h1>
        <p>View your email history here.</p>
    </div>
    <?php
}
add_action('admin_menu', function() {
    add_submenu_page('smartmail-services', 'Email History', 'Email History', 'read', 'smartmail-email-history', 'smartmail_email_history_page');
    smartmail_log('Email History page added.');
});

// Feedback and Support Page
function smartmail_feedback_support_page() {
    ?>
    <div class="wrap">
        <h1>Feedback and Support</h1>
        <p>Send feedback or contact support here.</p>
    </div>
    <?php
}
add_action('admin_menu', function() {
    add_submenu_page('smartmail-services', 'Feedback and Support', 'Feedback and Support', 'read', 'smartmail-feedback-support', 'smartmail_feedback_support_page');
    smartmail_log('Feedback and Support page added.');
});

// Newsletter Archives Page
function smartmail_newsletter_archives_page() {
    ?>
    <div class="wrap">
        <h1>Newsletter Archives</h1>
        <p>View past newsletters here.</p>
    </div>
    <?php
}
add_action('admin_menu', function() {
    add_submenu_page('smartmail-services', 'Newsletter Archives', 'Newsletter Archives', 'read', 'smartmail-newsletter-archives', 'smartmail_newsletter_archives_page');
    smartmail_log('Newsletter Archives page added.');
});

// Custom Email Templates Page
function smartmail_custom_templates_page() {
    ?>
    <div class="wrap">
        <h1>Custom Email Templates</h1>
        <p>Customize your email templates here.</p>
    </div>
    <?php
}
add_action('admin_menu', function() {
    add_submenu_page('smartmail-services', 'Custom Email Templates', 'Custom Email Templates', 'read', 'smartmail-custom-templates', 'smartmail_custom_templates_page');
    smartmail_log('Custom Email Templates page added.');
});

// Email Analytics Page
function smartmail_email_analytics_page() {
    ?>
    <div class="wrap">
        <h1>Email Analytics</h1>
        <p>View email analytics here.</p>
    </div>
    <?php
}
add_action('admin_menu', function() {
    add_submenu_page('smartmail-services', 'Email Analytics', 'Email Analytics', 'read', 'smartmail-email-analytics', 'smartmail_email_analytics_page');
    smartmail_log('Email Analytics page added.');
});
?>
           
