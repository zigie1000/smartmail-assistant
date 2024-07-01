<?php
// Add admin menu for user settings
if (!function_exists('smartmail_admin_menu')) {
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
        add_submenu_page(
            'smartmail',
            'Settings',
            'Settings',
            'manage_options',
            'smartmail-settings',
            'smartmail_settings_page'
        );
        add_submenu_page(
            'smartmail',
            'Dashboard',
            'Dashboard',
            'manage_options',
            'smartmail-dashboard',
            'smartmail_dashboard_template'
        );
    }
}
add_action('admin_menu', 'smartmail_admin_menu');

if (!function_exists('smartmail_admin_page')) {
    function smartmail_admin_page() {
        ?>
        <div class="wrap">
            <h1>SmartMail Assistant Settings</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('smartmail_options_group');
                do_settings_sections('smartmail');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }
}

if (!function_exists('smartmail_settings_page')) {
    function smartmail_settings_page() {
        ?>
        <div class="wrap">
            <h1>SmartMail Assistant API Settings</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('smartmail_options_group');
                do_settings_sections('smartmail');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }
}

if (!function_exists('smartmail_dashboard_template')) {
    function smartmail_dashboard_template() {
        if (is_user_logged_in() && current_user_can('manage_options')) {
            include plugin_dir_path(__FILE__) . 'templates/admin-dashboard.php';
        } else {
            wp_die('You do not have sufficient permissions to access this page.');
        }
    }
}

// Register settings
if (!function_exists('smartmail_register_settings')) {
    function smartmail_register_settings() {
        register_setting('smartmail_options_group', 'smartmail_openai_api_key', [
            'type' => 'string',
            'description' => 'OpenAI API Key',
            'sanitize_callback' => 'sanitize_text_field',
            'default' => ''
        ]);

        add_settings_section(
            'smartmail_settings_section',
            'SmartMail Assistant Settings',
            null,
            'smartmail'
        );

        add_settings_field(
            'smartmail_openai_api_key',
            'OpenAI API Key',
            'smartmail_openai_api_key_render',
            'smartmail',
            'smartmail_settings_section'
        );
    }
}
add_action('admin_init', 'smartmail_register_settings');

if (!function_exists('smartmail_openai_api_key_render')) {
    function smartmail_openai_api_key_render() {
        $value = get_option('smartmail_openai_api_key');
        ?>
        <input type="text" name="smartmail_openai_api_key" value="<?php echo esc_attr($value); ?>" />
        <?php
    }
}
