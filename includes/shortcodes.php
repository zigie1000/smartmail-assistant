<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

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
    <?php
    return ob_get_clean();
}

function smartmail_priority_inbox_shortcode() {
    ob_start();
    ?>
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
    <?php
    return ob_get_clean();
}

function smartmail_automated_responses_shortcode() {
    ob_start();
    ?>
    <form id="smartmail-automated-responses-form">
        <textarea id="automated-responses-email-content" placeholder="Enter email content here"></textarea>
        <button type="submit">Generate Response</button>
    </form>
    <div id="automated-responses-result"></div>
    <script>
        jQuery(document).ready(function($) {
            $('#smartmail-automated-responses-form').on('submit', function(event) {
                event.preventDefault();
                var content = $('#automated-responses-email-content').val();
                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'POST',
                    data: {
                        action: 'smartmail_automated_responses',
                        content: content
                    },
                    success: function(response) {
                        $('#automated-responses-result').text(response);
                    },
                    error: function() {
                        $('#automated-responses-result').text('An error occurred.');
                    }
                });
            });
        });
    </script>
    <?php
    return ob_get_clean();
}

function smartmail_email_summarization_shortcode() {
    ob_start();
    ?>
    <form id="smartmail-summarization-form">
        <textarea id="summarization-email-content" placeholder="Enter email content here"></textarea>
        <button type="submit">Summarize Email</button>
    </form>
    <div id="summarization-result"></div>
    <script>
        jQuery(document).ready(function($) {
            $('#smartmail-summarization-form').on('submit', function(event) {
                event.preventDefault();
                var content = $('#summarization-email-content').val();
                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'POST',
                    data: {
                        action: 'smartmail_email_summarization',
                        content: content
                    },
                    success: function(response) {
                        $('#summarization-result').text(response);
                    },
                    error: function() {
                        $('#summarization-result').text('An error occurred.');
                    }
                });
            });
        });
    </script>
    <?php
    return ob_get_clean();
}

function smartmail_meeting_scheduler_shortcode() {
    ob_start();
    ?>
    <form id="smartmail-meeting-scheduler-form">
        <textarea id="meeting-scheduler-email-content" placeholder="Enter email content here"></textarea>
        <button type="submit">Schedule Meeting</button>
    </form>
    <div id="meeting-scheduler-result"></div>
    <script>
        jQuery(document).ready(function($) {
            $('#smartmail-meeting-scheduler-form').on('submit', function(event) {
                event.preventDefault();
                var content = $('#meeting-scheduler-email-content').val();
                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'POST',
                    data: {
                        action: 'smartmail_meeting_scheduler',
                        content: content
                    },
                    success: function(response) {
                        $('#meeting-scheduler-result').text(response);
                    },
                    error: function() {
                        $('#meeting-scheduler-result').text('An error occurred.');
                    }
                });
            });
        });
    </script>
    <?php
    return ob_get_clean();
}

function smartmail_follow_up_reminders_shortcode() {
    ob_start();
    ?>
    <form id="smartmail-follow-up-reminders-form">
        <textarea id="follow-up-reminders-email-content" placeholder="Enter email content here"></textarea>
        <button type="submit">Generate Follow-up Reminder</button>
    </form>
    <div id="follow-up-reminders-result"></div>
    <script>
        jQuery(document).ready(function($) {
            $('#smartmail-follow-up-reminders-form').on('submit', function(event) {
                event.preventDefault();
                var content = $('#follow-up-reminders-email-content').val();
                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'POST',
                    data: {
                        action: 'smartmail_follow_up_reminders',
                        content: content
                    },
                    success: function(response) {
                        $('#follow-up-reminders-result').text(response);
                    },
                    error: function() {
                        $('#follow-up-reminders-result').text('An error occurred.');
                    }
                });
            });
        });
    </script>
    <?php
    return ob_get_clean();
}

function smartmail_sentiment_analysis_shortcode() {
    ob_start();
    ?>
    <form id="smartmail-sentiment-analysis-form">
        <textarea id="sentiment-analysis-email-content" placeholder="Enter email content here"></textarea>
        <button type="submit">Analyze Sentiment</button>
    </form>
    <div id="sentiment-analysis-result"></div>
    <script>
        jQuery(document).ready(function($) {
            $('#smartmail-sentiment-analysis-form').on('submit', function(event) {
                event.preventDefault();
                var content = $('#sentiment-analysis-email-content').val();
                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'POST',
                    data: {
                        action: 'smartmail_sentiment_analysis',
                        content: content
                    },
                    success: function(response) {
                        $('#sentiment-analysis-result').text(response);
                    },
                    error: function() {
                        $('#sentiment-analysis-result').text('An error occurred.');
                    }
                });
            });
        });
    </script>
    <?php
    return ob_get_clean();
}

function smartmail_email_templates_shortcode() {
    ob_start();
    ?>
    <form id="smartmail-email-templates-form">
        <textarea id="email-templates-request" placeholder="Enter your request for an email template"></textarea>
        <button type="submit">Generate Template</button>
    </form>
    <div id="email-templates-result"></div>
    <script>
        jQuery(document).ready(function($) {
            $('#smartmail-email-templates-form').on('submit', function(event) {
                event.preventDefault();
                var content = $('#email-templates-request').val();
                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'POST',
                    data: {
                        action: 'smartmail_email_templates',
                        content: content
                    },
                    success: function(response) {
                        $('#email-templates-result').text(response);
                        },
                    error: function() {
                        $('#email-templates-result').text('An error occurred.');
                    }
                });
            });
        });
    </script>
    <?php
    return ob_get_clean();
}

function smartmail_forensic_analysis_shortcode() {
    ob_start();
    ?>
    <form id="smartmail-forensic-analysis-form">
        <textarea id="forensic-analysis-email-content" placeholder="Enter email content here"></textarea>
        <button type="submit">Perform Analysis</button>
    </form>
    <div id="forensic-analysis-result"></div>
    <script>
        jQuery(document).ready(function($) {
            $('#smartmail-forensic-analysis-form').on('submit', function(event) {
                event.preventDefault();
                var content = $('#forensic-analysis-email-content').val();
                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'POST',
                    data: {
                        action: 'smartmail_forensic_analysis',
                        content: content
                    },
                    success: function(response) {
                        $('#forensic-analysis-result').text(response);
                    },
                    error: function() {
                        $('#forensic-analysis-result').text('An error occurred.');
                    }
                });
            });
        });
    </script>
    <?php
    return ob_get_clean();
}

add_action('init', 'smartmail_register_shortcodes');
?>
