<?php

function smartmail_email_categorization_shortcode() {
    ob_start(); ?>
    <form id="smartmail-categorization-form">
        <textarea id="categorization-email-content" placeholder="Enter email content here"></textarea>
        <button type="submit">Categorize Email</button>
    </form>
    <div id="categorization-result"></div>
    <script>
        jQuery(document).ready(function($) {
            $('#smartmail-categorization-form').on('submit', function(event) {
                event.preventDefault();
                var content = $('#categorization-email-content').val();
                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'POST',
                    data: {
                        action: 'smartmail_email_categorization',
                        content: content
                    },
                    success: function(response) {
                        $('#categorization-result').text(response);
                    },
                    error: function() {
                        $('#categorization-result').text('An error occurred.');
                    }
                });
            });
        });
    </script>
    <?php return ob_get_clean();
}

function smartmail_priority_inbox_shortcode() {
    ob_start(); ?>
    <form id="smartmail-priority-form">
        <textarea id="priority-email-content" placeholder="Enter email content here"></textarea>
        <button type="submit">Determine Priority</button>
    </form>
    <div id="priority-result"></div>
    <script>
        jQuery(document).ready(function($) {
            $('#smartmail-priority-form').on('submit', function(event) {
                event.preventDefault();
                var content = $('#priority-email-content').val();
                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'POST',
                    data: {
                        action: 'smartmail_priority_inbox',
                        content: content
                    },
                    success: function(response) {
                        $('#priority-result').text(response);
                    },
                    error: function() {
                        $('#priority-result').text('An error occurred.');
                    }
                });
            });
        });
    </script>
    <?php return ob_get_clean();
}

// Similarly, define other shortcodes for automated responses, email summarization, meeting scheduler, follow-up reminders, sentiment analysis, email templates, forensic analysis.

add_action('wp_ajax_smartmail_email_categorization', 'smartmail_email_categorization');
add_action('wp_ajax_nopriv_smartmail_email_categorization', 'smartmail_email_categorization');
add_action('wp_ajax_smartmail_priority_inbox', 'smartmail_priority_inbox');
add_action('wp_ajax_nopriv_smartmail_priority_inbox', 'smartmail_priority_inbox');
add_action('wp_ajax_smartmail_automated_responses', 'smartmail_automated_responses');
add_action('wp_ajax_nopriv_smartmail_automated_responses', 'smartmail_automated_responses');
add_action('wp_ajax_smartmail_email_summarization', 'smartmail_email_summarization');
add_action('wp_ajax_nopriv_smartmail_email_summarization', 'smartmail_email_summarization');
add_action('wp_ajax_smartmail_meeting_scheduler', 'smartmail_meeting_scheduler');
add_action('wp_ajax_nopriv_smartmail_meeting_scheduler', 'smartmail_meeting_scheduler');
add_action('wp_ajax_smartmail_follow_up_reminders', 'smartmail_follow_up_reminders');
add_action('wp_ajax_nopriv_smartmail_follow_up_reminders', 'smartmail_follow_up_reminders');
add_action('wp_ajax_smartmail_sentiment_analysis', 'smartmail_sentiment_analysis');
add_action('wp_ajax_nopriv_smartmail_sentiment_analysis', 'smartmail_sentiment_analysis');
add_action('wp_ajax_smartmail_email_templates', 'smartmail_email_templates');
add_action('wp_ajax_nopriv_smartmail_email_templates', 'smartmail_email_templates');
add_action('wp_ajax_smartmail_forensic_analysis', 'smartmail_forensic_analysis');
add_action('wp_ajax_nopriv_smartmail_forensic_analysis', 'smartmail_forensic_analysis');
