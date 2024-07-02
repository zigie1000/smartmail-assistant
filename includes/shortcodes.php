<?php

function smartmail_register_shortcodes() {
    add_shortcode('sma_email_categorization', 'smartmail_email_categorization_shortcode');
    add_shortcode('sma_priority_inbox', 'smartmail_priority_inbox_shortcode');
    add_shortcode('sma_automated_responses', 'smartmail_automated_responses_shortcode');
    add_shortcode('sma_email_summarization', 'smartmail_email_summarization_shortcode');
    add_shortcode('sma_meeting_scheduler', 'smartmail_meeting_scheduler_shortcode');
    add_shortcode('sma_follow_up_reminders', 'smartmail_follow_up_reminders_shortcode');
    add_shortcode('sma_sentiment_analysis', 'smartmail_sentiment_analysis_shortcode');
    add_shortcode('sma_email_templates', 'smartmail_email_templates_shortcode');
    add_shortcode('sma_forensic_analysis', 'smartmail_forensic_analysis_shortcode');
}

function smartmail_email_categorization_shortcode() {
    ob_start();
    ?>
    <form id="sma_email_categorization_form">
        <textarea name="email_content" placeholder="Enter email content"></textarea>
        <button type="submit">Categorize</button>
    </form>
    <div id="sma_email_categorization_result"></div>
    <script>
        jQuery(document).ready(function($) {
            $('#sma_email_categorization_form').on('submit', function(e) {
                e.preventDefault();
                var email_content = $(this).find('textarea[name="email_content"]').val();
                $.ajax({
                    url: '<?php echo admin_url("admin-ajax.php"); ?>',
                    type: 'POST',
                    data: {
                        action: 'smartmail_email_categorization',
                        email_content: email_content
                    },
                    success: function(response) {
                        $('#sma_email_categorization_result').html(response);
                    }
                });
            });
        });
    </script>
    <?php
    return ob_get_clean();
}

function smartmail_email_categorization_callback() {
    if (!isset($_POST['email_content'])) {
        echo 'No email content provided.';
        wp_die();
    }
    $email_content = sanitize_text_field($_POST['email_content']);
    echo smartmail_email_categorization($email_content);
    wp_die();
}

add_action('wp_ajax_smartmail_email_categorization', 'smartmail_email_categorization_callback');
add_action('wp_ajax_nopriv_smartmail_email_categorization', 'smartmail_email_categorization_callback');

// Repeat similar pattern for other shortcodes...

function smartmail_priority_inbox_shortcode() {
    ob_start();
    ?>
    <form id="sma_priority_inbox_form">
        <textarea name="email_content" placeholder="Enter email content"></textarea>
        <button type="submit">Determine Priority</button>
    </form>
    <div id="sma_priority_inbox_result"></div>
    <script>
        jQuery(document).ready(function($) {
            $('#sma_priority_inbox_form').on('submit', function(e) {
                e.preventDefault();
                var email_content = $(this).find('textarea[name="email_content"]').val();
                $.ajax({
                    url: '<?php echo admin_url("admin-ajax.php"); ?>',
                    type: 'POST',
                    data: {
                        action: 'smartmail_priority_inbox',
                        email_content: email_content
                    },
                    success: function(response) {
                        $('#sma_priority_inbox_result').html(response);
                    }
                });
            });
        });
    </script>
    <?php
    return ob_get_clean();
}

function smartmail_priority_inbox_callback() {
    if (!isset($_POST['email_content'])) {
        echo 'No email content provided.';
        wp_die();
    }
    $email_content = sanitize_text_field($_POST['email_content']);
    echo smartmail_priority_inbox($email_content);
    wp_die();
}

add_action('wp_ajax_smartmail_priority_inbox', 'smartmail_priority_inbox_callback');
add_action('wp_ajax_nopriv_smartmail_priority_inbox', 'smartmail_priority_inbox_callback');

?>
