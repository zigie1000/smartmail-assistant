<?php

if (!defined('ABSPATH')) {
    exit;
}

class SmartMailAdminSettings {
    public function __construct() {
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_init', array($this, 'register_settings'));
    }

    public function add_admin_menu() {
        add_menu_page(
            'SmartMail Assistant',
            'SmartMail',
            'manage_options',
            'smartmail',
            array($this, 'admin_page'),
            'dashicons-email-alt2',
            6
        );
        add_submenu_page(
            'smartmail',
            'Settings',
            'Settings',
            'manage_options',
            'smartmail-settings',
            array($this, 'settings_page')
        );
        add_submenu_page(
            'smartmail',
            'Dashboard',
            'Dashboard',
            'manage_options',
            'smartmail-dashboard',
            array($this, 'dashboard_template')
        );
    }

    public function register_settings() {
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
            array($this, 'render_openai_api_key_field'),
            'smartmail',
            'smartmail_settings_section'
        );
    }

    public function render_openai_api_key_field() {
        $value = get_option('smartmail_openai_api_key');
        ?>
        <input type="text" name="smartmail_openai_api_key" value="<?php echo esc_attr($value); ?>" />
        <?php
    }

    public function admin_page() {
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

    public function settings_page() {
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

    public function dashboard_template() {
        if (is_user_logged_in() && current_user_can('manage_options')) {
            include plugin_dir_path(__FILE__) . 'templates/admin-dashboard.php';
        } else {
            wp_die('You do not have sufficient permissions to access this page.');
        }
    }
}

new SmartMailAdminSettings();

?>
