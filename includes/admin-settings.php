<?php
if (!function_exists('smartmail_admin_menu')) {
    function smartmail_admin_menu() {
        add_menu_page(
            'SmartMail Assistant Settings',
            'SmartMail Settings',
            'manage_options',
            'smartmail-settings',
            'smartmail_settings_page',
            'dashicons-admin-generic',
            6
        );
        smartmail_log('Admin menu added.');
    }
}
add_action('admin_menu', 'smartmail_admin_menu');

function smartmail_settings_page() {
    ?>
    <div class="wrap">
        <h1>SmartMail Assistant Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('smartmail_options_group');
            do_settings_sections('smartmail-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

function smartmail_register_settings() {
    register_setting('smartmail_options_group', 'smartmail_openai_api_key');
    add_settings_section('smartmail_main_section', 'Main Settings', null, 'smartmail-settings');

    add_settings_field(
        'smartmail_openai_api_key',
        'OpenAI API Key',
        'smartmail_openai_api_key_callback',
        'smartmail-settings',
        'smartmail_main_section'
    );
}
add_action('admin_init', 'smartmail_register_settings');

function smartmail_openai_api_key_callback() {
    $openai_api_key = get_option('smartmail_openai_api_key');
    echo '<input type="text" name="smartmail_openai_api_key" value="' . esc_attr($openai_api_key) . '" />';
}
?>
