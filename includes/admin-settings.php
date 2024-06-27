<?php
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
        smartmail_log('Admin menu added.');
    }
}
add_action('admin_menu', 'smartmail_admin_menu');

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

if (!function_exists('smartmail_register_settings')) {
    function smartmail_register_settings() {
        register_setting('smartmail_options_group', 'smartmail_openai_api_key');
        add_settings_section('smartmail_section', 'API Settings', null, 'smartmail');
        add_settings_field('smartmail_openai_api_key', 'OpenAI API Key', 'smartmail_openai_api_key_callback', 'smartmail', 'smartmail_section');
    }
}
add_action('admin_init', 'smartmail_register_settings');

function smartmail_openai_api_key_callback() {
    $api_key = get_option('smartmail_openai_api_key');
    echo '<input type="text" id="smartmail_openai_api_key" name="smartmail_openai_api_key" value="' . esc_attr($api_key) . '" />';
}

function smartmail_log($message) {
    if (defined('SMARTMAIL_DEBUG_LOG')) {
        error_log($message . PHP_EOL, 3, SMARTMAIL_DEBUG_LOG);
    }
}
?>
