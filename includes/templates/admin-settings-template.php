<?php
/*
Template Name: SmartMail Admin Settings
*/
get_header(); ?>

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

<?php get_footer(); ?>
