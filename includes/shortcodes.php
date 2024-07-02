<?php

function smartmail_register_shortcodes() {
    add_shortcode('smartmail_categorization', 'smartmail_categorization_shortcode');
    add_shortcode('smartmail_priority', 'smartmail_priority_shortcode');
    add_shortcode('smartmail_automated_response', 'smartmail_automated_response_shortcode');
    add_shortcode('smartmail_summarization', 'smartmail_summarization_shortcode');
    add_shortcode('smartmail_meeting_scheduler', 'smartmail_meeting_scheduler_shortcode');
    add_shortcode('smartmail_follow_up', 'smartmail_follow_up_shortcode');
    add_shortcode('smartmail_sentiment', 'smartmail_sentiment_shortcode');
    add_shortcode('smartmail_template', 'smartmail_template_shortcode');
    add_shortcode('smartmail_forensic', 'smartmail_forensic_shortcode');
}

function smartmail_categorization_shortcode($atts) {
    ob_start();
    ?>
    <form id="smartmail_categorization_form">
        <textarea name="email_content" placeholder="Enter email content"></textarea>
        <button type="submit">Categorize Email</button>
    </form>
    <div id="smartmail_categorization_result"></div>
    <script>
        (function($) {
            $('#smartmail_categorization_form').on('submit', function(e) {
                e.preventDefault();
                var data = {
                    action: 'smartmail_categorization',
                    email_content: $('textarea[name="email_content"]').val()
                };
                $.post('<?php echo admin_url('admin-ajax.php'); ?>', data, function(response) {
                    $('#smartmail_categorization_result').html(response);
                });
            });
        })(jQuery);
    </script>
    <?php
    return ob_get_clean();
}

function smartmail_priority_shortcode($atts) {
    ob_start();
    ?>
    <form id="smartmail_priority_form">
        <textarea name="email_content" placeholder="Enter email content"></textarea>
        <button type="submit">Determine Priority</button>
    </form>
    <div id="smartmail_priority_result"></div>
    <script>
        (function($) {
            $('#smartmail_priority_form').on('submit', function(e) {
                e.preventDefault();
                var data = {
                    action: 'smartmail_priority',
                    email_content: $('textarea[name="email_content"]').val()
                };
                $.post('<?php echo admin_url('admin-ajax.php'); ?>', data, function(response) {
                    $('#smartmail_priority_result').html(response);
                });
            });
        })(jQuery);
    </script>
    <?php
    return ob_get_clean();
}

function smartmail_automated_response_shortcode($atts) {
    ob_start();
    ?>
    <form id="smartmail_automated_response_form">
        <textarea name="email_content" placeholder="Enter email content"></textarea>
        <button type="submit">Generate Response</button>
    </form>
    <div id="smartmail_automated_response_result"></div>
    <script>
        (function($) {
            $('#smartmail_automated_response_form').on('submit', function(e) {
                e.preventDefault();
                var data = {
                    action: 'smartmail_automated_response',
                    email_content: $('textarea[name="email_content"]').val()
                };
                $.post('<?php echo admin_url('admin-ajax.php'); ?>', data, function(response) {
                    $('#smartmail_automated_response_result').html(response);
                });
            });
        })(jQuery);
    </script>
    <?php
    return ob_get_clean();
}

function smartmail_summarization_shortcode($atts) {
    ob_start();
    ?>
    <form id="smartmail_summarization_form">
        <textarea name="email_content" placeholder="Enter email content"></textarea>
        <button type="submit">Summarize Email</button>
    </form>
    <div id="smartmail_summarization_result"></div>
    <script>
        (function($) {
            $('#smartmail_summarization_form').on('submit', function(e) {
                e.preventDefault();
                var data = {
                    action: 'smartmail_summarization',
                    email_content: $('textarea[name="email_content"]').val()
                };
                $.post('<?php echo admin_url('admin-ajax.php'); ?>', data, function(response) {
                    $('#smartmail_summarization_result').html(response);
                });
            });
        })(jQuery);
    </script>
    <?php
    return ob_get_clean();
}

function smartmail_meeting_scheduler_shortcode($atts) {
    ob_start();
    ?>
    <form id="smartmail_meeting_scheduler_form">
        <textarea name="email_content" placeholder="Enter email content"></textarea>
        <button type="submit">Schedule Meeting</button>
    </form>
    <div id="smartmail_meeting_scheduler_result"></div>
    <script>
        (function($) {
            $('#smartmail_meeting_scheduler_form').on('submit', function(e) {
                e.preventDefault();
                var data = {
                    action: 'smartmail_meeting_scheduler',
                    email_content: $('textarea[name="email_content"]').val()
                };
                $.post('<?php echo admin_url('admin-ajax.php'); ?>', data, function(response) {
                    $('#smartmail_meeting_scheduler_result').html(response);
                });
            });
        })(jQuery);
    </script>
    <?php
    return ob_get_clean();
}

function smartmail_follow_up_shortcode($atts) {
    ob_start();
    ?>
    <form id="smartmail_follow_up_form">
        <textarea name="email_content" placeholder="Enter email content"></textarea>
        <button type="submit">Generate Follow-up</button>
    </form>
    <div id="smartmail_follow_up_result"></div>
    <script>
        (function($) {
            $('#smartmail_follow_up_form').on('submit', function(e) {
                e.preventDefault();
                var data = {
                    action: 'smartmail_follow_up',
                    email_content: $('textarea[name="email_content"]').val()
                };
                $.post('<?php echo admin_url('admin-ajax.php'); ?>', data, function(response) {
                    $('#smartmail_follow_up_result').html(response);
                });
            });
        })(jQuery);
    </script>
    <?php
    return ob_get_clean();
}

function smartmail_sentiment_shortcode($atts) {
    ob_start();
    ?>
    <form id="smartmail_sentiment_form">
        <textarea name="email_content" placeholder="Enter email content"></textarea>
        <button type="submit">Analyze Sentiment</button>
    </form>
    <div id="smartmail_sentiment_result"></div>
    <script>
        (function($) {
            $('#smartmail_sentiment_form').on('submit', function(e) {
                e.preventDefault();
                var data = {
                    action: 'smartmail_sentiment',
                    email_content: $('textarea[name="email_content"]').val()
                };
                $.post('<?php echo admin_url('admin-ajax.php'); ?>', data, function(response) {
                    $('#smartmail_sentiment_result').html(response);
                });
            });
        })(jQuery);
    </script>
    <?php
    return ob_get_clean();
}

function smartmail_template_shortcode($atts) {
    ob_start();
    ?>
    <form id="smartmail_template_form">
        <textarea name="template_request" placeholder="Enter template request"></textarea>
        <button type="submit">Generate Template</button>
    </form>
    <div id="smartmail_template_result"></div>
    <script>
        (function($) {
            $('#smartmail_template_form').on('submit', function(e) {
                e.preventDefault();
                var data = {
                    action: 'smartmail_template',
                    template_request: $('textarea[name="template_request"]').val()
                };
                $.post('<?php echo admin_url('admin-ajax.php'); ?>', data, function(response) {
                    $('#smartmail_template_result').html(response);
                });
            });
        })(jQuery);
    </script>
    <?php
    return ob_get_clean();
}

function smartmail_forensic_shortcode($atts) {
    ob_start();
    ?>
    <form id="smartmail_forensic_form">
        <textarea name="email_content" placeholder="Enter email content"></textarea>
        <button type="submit">Perform Forensic Analysis</button>
    </form>
    <div id="smartmail_forensic_result"></div>
    <script>
        (function($) {
            $('#smartmail_forensic_form').on('submit', function(e) {
                e.preventDefault();
                var data = {
                    action: 'smartmail_forensic',
                    email_content: $('textarea[name="email_content"]').val()
                };
                $.post('<?php echo admin_url('admin-ajax.php'); ?>', data, function(response) {
                    $('#smartmail_forensic_result').html(response);
                });
            });
        })(jQuery);
    </script>
    <?php
    return ob_get_clean();
}

add_action('wp_ajax_smartmail_categorization', 'smartmail_categorization_ajax');
add_action('wp_ajax_nopriv_smartmail_categorization', 'smartmail_categorization_ajax');

function smartmail_categorization_ajax() {
    $email_content = sanitize_textarea_field($_POST['email_content']);
    $result = smartmail_email_categorization($email_content);
    echo $result;
    wp_die();
}

add_action('wp_ajax_smartmail_priority', 'smartmail_priority_ajax');
add_action('wp_ajax_nopriv_smartmail_priority', 'smartmail_priority_ajax');

function smartmail_priority_ajax() {
    $email_content = sanitize_textarea_field($_POST['email_content']);
    $result = smartmail_priority_inbox($email_content);
    echo $result;
    wp_die();
}

add_action('wp_ajax_smartmail_automated_response', 'smartmail_automated_response_ajax');
add_action('wp_ajax_nopriv_smartmail_automated_response', 'smartmail_automated_response_ajax');

function smartmail_automated_response_ajax() {
    $email_content = sanitize_textarea_field($_POST['email_content']);
    $result = smartmail_automated_responses($email_content);
    echo $result;
    wp_die();
}

add_action('wp_ajax_smartmail_summarization', 'smartmail_summarization_ajax');
add_action('wp_ajax_nopriv_smartmail_summarization', 'smartmail_summarization_ajax');

function smartmail_summarization_ajax() {
    $email_content = sanitize_textarea_field($_POST['email_content']);
    $result = smartmail_email_summarization($email_content);
    echo $result;
    wp_die();
}

add_action('wp_ajax_smartmail_meeting_scheduler', 'smartmail_meeting_scheduler_ajax');
add_action('wp_ajax_nopriv_smartmail_meeting_scheduler', 'smartmail_meeting_scheduler_ajax');

function smartmail_meeting_scheduler_ajax() {
    $email_content = sanitize_textarea_field($_POST['email_content']);
    $result = smartmail_meeting_scheduler($email_content);
    echo $result;
    wp_die();
}

add_action('wp_ajax_smartmail_follow_up', 'smartmail_follow_up_ajax');
add_action('wp_ajax_nopriv_smartmail_follow_up', 'smartmail_follow_up_ajax');

function smartmail_follow_up_ajax() {
    $email_content = sanitize_textarea_field($_POST['email_content']);
    $result = smartmail_follow_up_reminders($email_content);
    echo $result;
    wp_die();
}

add_action('wp_ajax_smartmail_sentiment', 'smartmail_sentiment_ajax');
add_action('wp_ajax_nopriv_smartmail_sentiment', 'smartmail_sentiment_ajax');

function smartmail_sentiment_ajax() {
    $email_content = sanitize_textarea_field($_POST['email_content']);
    $result = smartmail_sentiment_analysis($email_content);
    echo $result;
    wp_die();
}

add_action('wp_ajax_smartmail_template', 'smartmail_template_ajax');
add_action('wp_ajax_nopriv_smartmail_template', 'smartmail_template_ajax');

function smartmail_template_ajax() {
    $template_request = sanitize_textarea_field($_POST['template_request']);
    $result = smartmail_email_templates($template_request);
    echo $result;
    wp_die();
}

add_action('wp_ajax_smartmail_forensic', 'smartmail_forensic_ajax');
add_action('wp_ajax_nopriv_smartmail_forensic', 'smartmail_forensic_ajax');

function smartmail_forensic_ajax() {
    $email_content = sanitize_textarea_field($_POST['email_content']);
    $result = smartmail_forensic_analysis($email_content);
    echo $result;
    wp_die();
}
