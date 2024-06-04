<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Admin menu
function smartmail_admin_menu() {
    add_menu_page(
        'SmartMail Assistant',
        'SmartMail',
        'manage_options',
        'smartmail',
        'smartmail_admin_page',
        'dashicons-admin-generic',
        6
    );
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
    </div>
    <?php
}

// Register settings
function smartmail_register_settings() {
    register_setting('smartmail_options_group', 'smartmail_option_name');
    add_settings_section('smartmail_main_section', 'Main Settings', 'smartmail_main_section_cb', 'smartmail');
    add_settings_field('smartmail_option_name', 'Option Name', 'smartmail_option_name_cb', 'smartmail', 'smartmail_main_section');
}
add_action('admin_init', 'smartmail_register_settings');

function smartmail_main_section_cb() {
    echo '<p>Main description of this section here.</p>';
}

function smartmail_option_name_cb() {
    $setting = get_option('smartmail_option_name');
    echo "<input type='text' name='smartmail_option_name' value='" . esc_attr($setting) . "'>";
}
?>
