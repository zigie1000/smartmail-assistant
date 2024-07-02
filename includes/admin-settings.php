<?php
/*
Template Name: Admin Settings
*/

if (!current_user_can('manage_options')) {
    return;
}

if (isset($_POST['smartmail_save_settings'])) {
    update_option('smartmail_openai_api_key', sanitize_text_field($_POST['smartmail_openai_api_key']));
    echo '<div id="message" class="updated notice is-dismissible"><p>Settings saved.</p></div>';
}

$api_key = get_option('smartmail_openai_api_key', '');
?>

<div class="wrap">
    <h1>SmartMail Assistant Settings</h1>
    <form method="post" action="">
        <table class="form-table">
            <tr>
                <th scope="row">OpenAI API Key</th>
                <td>
                    <input type="text" name="smartmail_openai_api_key" value="<?php echo esc_attr($api_key); ?>" class="regular-text" />
                </td>
            </tr>
        </table>
        <p class="submit">
            <input type="submit" name="smartmail_save_settings" class="button-primary" value="Save Settings" />
        </p>
    </form>
</div>
