<?php

function sma_register_settings() {
    add_option('sma_email_server_incoming', '');
    add_option('sma_email_server_outgoing', '');
    add_option('sma_email_username', '');
    add_option('sma_email_password', '');
    register_setting('sma_options_group', 'sma_email_server_incoming', 'sanitize_text_field');
    register_setting('sma_options_group', 'sma_email_server_outgoing', 'sanitize_text_field');
    register_setting('sma_options_group', 'sma_email_username', 'sanitize_text_field');
    register_setting('sma_options_group', 'sma_email_password', 'sanitize_text_field');
}
add_action('admin_init', 'sma_register_settings');

function sma_register_options_page() {
    add_options_page('SmartMail Settings', 'SmartMail', 'manage_options', 'sma', 'sma_options_page');
}
add_action('admin_menu', 'sma_register_options_page');

function sma_options_page() {
?>
  <div>
  <h2>SmartMail Settings</h2>
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
  </div>
<?php
}
