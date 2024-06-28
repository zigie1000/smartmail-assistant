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
?>
