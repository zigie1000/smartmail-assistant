<?php

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

function sma_admin_menu() {
    add_menu_page(
        'SmartMail Assistant Settings',
        'SmartMail Assistant',
        'manage_options',
        'sma-settings',
        'sma_settings_page',
        'dashicons-email',
        100
    );
}
add_action('admin_menu', 'sma_admin_menu');

function sma_settings_page() {
    ?>
    <div class="wrap">
        <h1>SmartMail Assistant Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('sma_settings_group');
            do_settings_sections('sma-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

function sma_register_settings() {
    register_setting('sma_settings_group', 'sma_api_key', 'sanitize_text_field');
    add_settings_section('sma_main_section', 'Main Settings', 'sma_main_section_callback', 'sma-settings');
    add_settings_field('sma_api_key', 'API Key', 'sma_api_key_callback', 'sma-settings', 'sma_main_section');
}
add_action('admin_init', 'sma_register_settings');

function sma_main_section_callback() {
    echo '<p>Enter your API key to enable the SmartMail Assistant features.</p>';
}

function sma_api_key_callback() {
    $api_key = get_option('sma_api_key');
    echo '<input type="text" name="sma_api_key" value="' . esc_attr($api_key) . '" class="regular-text" />';
}