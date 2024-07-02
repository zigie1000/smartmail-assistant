<?php

if (!function_exists('smartmail_register_shortcodes')) {
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
    add_action('init', 'smartmail_register_shortcodes');
}

// Shortcode functions
if (!function_exists('smartmail_email_categorization_shortcode')) {
    function smartmail_email_categorization_shortcode() {
        ob_start();
        ?>
        <form id="email-categorization-form">
            <textarea name="email_content" placeholder="Enter email content here"></textarea>
            <button type="submit">Categorize</button>
        </form>
        <div id="email-categorization-result"></div>
        <script>
            jQuery(document).ready(function($) {
                $('#email-categorization-form').on('submit', function(event) {
                    event.preventDefault();
                    var emailContent = $(this).find('textarea[name="email_content"]').val();
                    $.ajax({
                        url: '<?php echo admin_url('admin-ajax.php'); ?>',
                        method: 'POST',
                        data: {
                            action: 'smartmail_email_categorization',
                            email_content: emailContent
                        },
                        success: function(response) {
                            $('#email-categorization-result').html(response);
                        }
                    });
                });
            });
        </script>
        <?php
        return ob_get_clean();
    }
}

if (!function_exists('smartmail_priority_inbox_shortcode')) {
    function smartmail_priority_inbox_shortcode() {
        ob_start();
        ?>
        <form id="priority-inbox-form">
            <textarea name="email_content" placeholder="Enter email content here"></textarea>
            <button type="submit">Determine Priority</button>
        </form>
        <div id="priority-inbox-result"></div>
        <script>
            jQuery(document).ready(function($) {
                $('#priority-inbox-form').on('submit', function(event) {
                    event.preventDefault();
                    var emailContent = $(this).find('textarea[name="email_content"]').val();
                    $.ajax({
                        url: '<?php echo admin_url('admin-ajax.php'); ?>',
                        method: 'POST',
                        data: {
                            action: 'smartmail_priority_inbox',
                            email_content: emailContent
                        },
                        success: function(response) {
                            $('#priority-inbox-result').html(response);
                        }
                    });
                });
            });
        </script>
        <?php
        return ob_get_clean();
    }
}

if (!function_exists('smartmail_automated_responses_shortcode')) {
    function smartmail_automated_responses_shortcode() {
        ob_start();
        ?>
        <form id="automated-responses-form">
            <textarea name="email_content" placeholder="Enter email content here"></textarea>
            <button type="submit">Generate Response</button>
        </form>
        <div id="automated-responses-result"></div>
        <script>
            jQuery(document).ready(function($) {
                $('#automated-responses-form').on('submit', function(event) {
                    event.preventDefault();
                    var emailContent = $(this).find('textarea[name="email_content"]').val();
                    $.ajax({
                        url: '<?php echo admin_url('admin-ajax.php'); ?>',
                        method: 'POST',
                        data: {
                            action: 'smartmail_automated_responses',
                            email_content: emailContent
                        },
                        success: function(response) {
                            $('#automated-responses-result').html(response);
                        }
                    });
                });
            });
        </script>
        <?php
        return ob_get_clean();
    }
}

if (!function_exists('smartmail_email_summarization_shortcode')) {
    function smartmail_email_summarization_shortcode() {
        ob_start();
        ?>
        <form id="email-summarization-form">
            <textarea name="email_content" placeholder="Enter email content here"></textarea>
            <button type="submit">Summarize</button>
        </form>
        <div id="email-summarization-result"></div>
        <script>
            jQuery(document).ready(function($) {
                $('#email-summarization-form').on('submit', function(event) {
                    event.preventDefault();
                    var emailContent = $(this).find('textarea[name="email_content"]').val();
                    $.ajax({
                        url: '<?php echo admin_url('admin-ajax.php'); ?>',
                        method: 'POST',
                        data: {
                            action: 'smartmail_email_summarization',
                            email_content: emailContent
                        },
                        success: function(response) {
                            $('#email-summarization-result').html(response);
                        }
                    });
                });
            });
        </script>
        <?php
        return ob_get_clean();
    }
}

if (!function_exists('smartmail_meeting_scheduler_shortcode')) {
    function smartmail_meeting_scheduler_shortcode() {
        ob_start();
        ?>
        <form id="meeting-scheduler-form">
            <textarea name="email_content" placeholder="Enter email content here"></textarea>
            <button type="submit">Schedule Meeting</button>
        </form>
        <div id="meeting-scheduler-result"></div>
        <script>
            jQuery(document).ready(function($) {
                $('#meeting-scheduler-form').on('submit', function(event) {
                    event.preventDefault();
                    var emailContent = $(this).find('textarea[name="email_content"]').val();
                    $.ajax({
                        url: '<?php echo admin_url('admin-ajax.php'); ?>',
                        method: 'POST',
                        data: {
                            action: 'smartmail_meeting_scheduler',
                            email_content: emailContent
                        },
                        success: function(response) {
                            $('#meeting-scheduler-result').html(response);
                        }
                    });
                });
            });
        </script>
        <?php
        return ob_get_clean();
    }
}

if (!function_exists('smartmail_follow_up_reminders_shortcode')) {
    function smartmail_follow_up_reminders_shortcode() {
        ob_start();
        ?>
        <form id="follow-up-reminders-form">
            <textarea name="email_content" placeholder="Enter email content here"></textarea>
            <button type="submit">Generate Follow-up Reminders</button>
        </form>
        <div id="follow-up-reminders-result"></div>
        <script>
            jQuery(document).ready(function($) {
                $('#follow-up-reminders-form').on('submit', function(event) {
                    event.preventDefault();
                    var emailContent = $(this).find('textarea[name="email_content"]').val();
                    $.ajax({
                        url: '<?php echo admin_url('admin-ajax.php'); ?>',
                        method: 'POST',
                        data: {
                            action: 'smartmail_follow_up_reminders',
                            email_content: emailContent
                        },
                        success: function(response) {
                            $('#follow-up-reminders-result').html(response);
                        }
                    });
                });
            });
        </script>
        <?php
        return ob_get_clean();
    }
}

if (!function_exists('smartmail_sentiment_analysis_shortcode')) {
    function smartmail_sentiment_analysis_shortcode() {
        ob_start();
        ?>
        <form id="sentiment-analysis-form">
            <textarea name="email_content" placeholder="Enter email content here"></textarea>
            <button type="submit">Analyze Sentiment</button>
        </form>
        <div id="sentiment-analysis-result"></div>
        <script>
            jQuery(document).
            ready(function($) {
                $('#sentiment-analysis-form').on('submit', function(event) {
                    event.preventDefault();
                    var emailContent = $(this).find('textarea[name="email_content"]').val();
                    $.ajax({
                        url: '<?php echo admin_url('admin-ajax.php'); ?>',
                        method: 'POST',
                        data: {
                            action: 'smartmail_sentiment_analysis',
                            email_content: emailContent
                        },
                        success: function(response) {
                            $('#sentiment-analysis-result').html(response);
                        }
                    });
                });
            });
        </script>
        <?php
        return ob_get_clean();
    }
}

if (!function_exists('smartmail_email_templates_shortcode')) {
    function smartmail_email_templates_shortcode() {
        ob_start();
        ?>
        <form id="email-templates-form">
            <textarea name="template_request" placeholder="Describe the email template you need"></textarea>
            <button type="submit">Generate Template</button>
        </form>
        <div id="email-templates-result"></div>
        <script>
            jQuery(document).ready(function($) {
                $('#email-templates-form').on('submit', function(event) {
                    event.preventDefault();
                    var templateRequest = $(this).find('textarea[name="template_request"]').val();
                    $.ajax({
                        url: '<?php echo admin_url('admin-ajax.php'); ?>',
                        method: 'POST',
                        data: {
                            action: 'smartmail_email_templates',
                            template_request: templateRequest
                        },
                        success: function(response) {
                            $('#email-templates-result').html(response);
                        }
                    });
                });
            });
        </script>
        <?php
        return ob_get_clean();
    }
}

if (!function_exists('smartmail_forensic_analysis_shortcode')) {
    function smartmail_forensic_analysis_shortcode() {
        ob_start();
        ?>
        <form id="forensic-analysis-form">
            <textarea name="email_content" placeholder="Enter email content here"></textarea>
            <button type="submit">Perform Forensic Analysis</button>
        </form>
        <div id="forensic-analysis-result"></div>
        <script>
            jQuery(document).ready(function($) {
                $('#forensic-analysis-form').on('submit', function(event) {
                    event.preventDefault();
                    var emailContent = $(this).find('textarea[name="email_content"]').val();
                    $.ajax({
                        url: '<?php echo admin_url('admin-ajax.php'); ?>',
                        method: 'POST',
                        data: {
                            action: 'smartmail_forensic_analysis',
                            email_content: emailContent
                        },
                        success: function(response) {
                            $('#forensic-analysis-result').html(response);
                        }
                    });
                });
            });
        </script>
        <?php
        return ob_get_clean();
    }
}

?>        
