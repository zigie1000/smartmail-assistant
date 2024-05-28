<?php
/*
Template Name: Admin Dashboard
*/

if (!current_user_can('manage_options')) {
    wp_die(__('You do not have sufficient permissions to access this page.'));
}

get_header(); ?>

<div class="admin-dashboard-container">
    <h1>SmartMail Assistant Admin Dashboard</h1>
    <p>Welcome to the SmartMail Assistant Admin Dashboard. Here you can manage all settings related to the plugin.</p>

    <h2>Email Server Settings</h2>
    <form method="post" action="options.php">
        <?php settings_fields('sma_options_group'); ?>
        <table>
            <tr valign="top">
                <th scope="row"><label for="sma_email_server_incoming">Incoming Mail Server</label></th>
                <td><input type="text" id="sma_email_server_incoming" name="sma_email_server_incoming" value="<?php echo esc_attr(get_option('sma_email_server_incoming')); ?>" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="sma_email_server_outgoing">Outgoing Mail Server</label></th>
                <td><input type="text" id="sma_email_server_outgoing" name="sma_email_server_outgoing" value="<?php echo esc_attr(get_option('sma_email_server_outgoing')); ?>" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="sma_email_username">Email Username</label></th>
                <td><input type="text" id="sma_email_username" name="sma_email_username" value="<?php echo esc_attr(get_option('sma_email_username')); ?>" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="sma_email_password">Email Password</label></th>
                <td><input type="password" id="sma_email_password" name="sma_email_password" value="<?php echo esc_attr(get_option('sma_email_password')); ?>" /></td>
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>

    <h2>Subscription Management</h2>
    <form method="post" action="options.php">
        <?php settings_fields('sma_subscription_group'); ?>
        <table>
            <tr valign="top">
                <th scope="row"><label for="sma_free_plan_price">Free Plan Price</label></th>
                <td><input type="number" id="sma_free_plan_price" name="sma_free_plan_price" value="<?php echo esc_attr(get_option('sma_free_plan_price')); ?>" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="sma_trial_plan_price">Trial Plan Price</label></th>
                <td><input type="number" id="sma_trial_plan_price" name="sma_trial_plan_price" value="<?php echo esc_attr(get_option('sma_trial_plan_price')); ?>" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="sma_subscribed_plan_price">Subscribed Plan Price</label></th>
                <td><input type="number" id="sma_subscribed_plan_price" name="sma_subscribed_plan_price" value="<?php echo esc_attr(get_option('sma_subscribed_plan_price')); ?>" /></td>
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>

    <h2>Send Updates</h2>
    <form method="post" action="">
        <table>
            <tr valign="top">
                <th scope="row"><label for="update_message">Update Message</label></th>
                <td><textarea id="update_message" name="update_message" rows="5" cols="50"></textarea></td>
            </tr>
        </table>
        <input type="submit" name="send_update" value="Send Update" class="button button-primary" />
    </form>

    <?php
    if (isset($_POST['send_update'])) {
        $update_message = sanitize_textarea_field($_POST['update_message']);
        // Send the update message to the app users, e.g., via email or notification system
        echo '<div class="updated"><p>Update sent successfully!</p></div>';
    }
    ?>
</div>

<?php get_footer(); ?>
