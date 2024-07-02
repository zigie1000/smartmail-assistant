<?php

// Register shortcodes for AI functions
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

function smartmail_email_categorization_shortcode($atts, $content = null) {
    ob_start();
    ?>
    <form method="post" action="">
        <textarea name="email_content" rows="10" cols="50"></textarea>
        <button type="submit" name="categorize_email">Categorize Email</button>
    </form>
    <?php
    if (isset($_POST['categorize_email'])) {
        $result = smartmail_email_categorization(sanitize_text_field($_POST['email_content']));
        echo '<pre>' . esc_html($result) . '</pre>';
    }
    return ob_get_clean();
}

function smartmail_priority_inbox_shortcode($atts, $content = null) {
    ob_start();
    ?>
    <form method="post" action="">
        <textarea name="email_content" rows="10" cols="50"></textarea>
        <button type="submit" name="priority_email">Determine Priority</button>
    </form>
    <?php
    if (isset($_POST['priority_email'])) {
        $result = smartmail_priority_inbox(sanitize_text_field($_POST['email_content']));
        echo '<pre>' . esc_html($result) . '</pre>';
    }
    return ob_get_clean();
}

function smartmail_automated_responses_shortcode($atts, $content = null) {
    ob_start();
    ?>
    <form method="post" action="">
        <textarea name="email_content" rows="10" cols="50"></textarea>
        <button type="submit" name="automated_response">Generate Response</button>
    </form>
    <?php
    if (isset($_POST['automated_response'])) {
        $result = smartmail_automated_responses(sanitize_text_field($_POST['email_content']));
        echo '<pre>' . esc_html($result) . '</pre>';
    }
    return ob_get_clean();
}

function smartmail_email_summarization_shortcode($atts, $content = null) {
    ob_start();
    ?>
    <form method="post" action="">
        <textarea name="email_content" rows="10" cols="50"></textarea>
        <button type="submit" name="summarize_email">Summarize Email</button>
    </form>
    <?php
    if (isset($_POST['summarize_email'])) {
        $result = smartmail_email_summarization(sanitize_text_field($_POST['email_content']));
        echo '<pre>' . esc_html($result) . '</pre>';
    }
    return ob_get_clean();
}

function smartmail_meeting_scheduler_shortcode($atts, $content = null) {
    ob_start();
    ?>
    <form method="post" action="">
        <textarea name="email_content" rows="10" cols="50"></textarea>
        <button type="submit" name="schedule_meeting">Schedule Meeting</button>
    </form>
    <?php
    if (isset($_POST['schedule_meeting'])) {
        $result = smartmail_meeting_scheduler(sanitize_text_field($_POST['email_content']));
        echo '<pre>' . esc_html($result) . '</pre>';
    }
    return ob_get_clean();
}

function smartmail_follow_up_reminders_shortcode($atts, $content = null) {
    ob_start();
    ?>
    <form method="post" action="">
        <textarea name="email_content" rows="10" cols="50"></textarea>
        <button type="submit" name="follow_up_reminders">Generate Follow-up Reminders</button>
    </form>
    <?php
    if (isset($_POST['follow_up_reminders'])) {
        $result = smartmail_follow_up_reminders(sanitize_text_field($_POST['email_content']));
        echo '<pre>' . esc_html($result) . '</pre>';
    }
    return ob_get_clean();
}

function smartmail_sentiment_analysis_shortcode($atts, $content = null) {
    ob_start();
    ?>
    <form method="post" action="">
        <textarea name="email_content" rows="10" cols="50"></textarea>
        <button type="submit" name="analyze_sentiment">Analyze Sentiment</button>
    </form>
    <?php
    if (isset($_POST['analyze_sentiment'])) {
        $result = smartmail_sentiment_analysis(sanitize_text_field($_POST['email_content']));
        echo '<pre>' . esc_html($result) . '</pre>';
    }
    return ob_get_clean();
}

function smartmail_email_templates_shortcode($atts, $content = null) {
    ob_start();
    ?>
    <form method="post" action="">
        <textarea name="email_content" rows="10" cols="50"></textarea>
        <button type="submit" name="generate_template">Generate Template</button>
    </form>
    <?php
    if (isset($_POST['generate_template'])) {
        $result = smartmail_email_templates();
        echo '<pre>' . esc_html($result) . '</pre>';
    }
    return ob_get_clean();
}

function smartmail_forensic_analysis_shortcode($atts, $content = null) {
    ob_start();
    ?>
    <form method="post" action="">
        <textarea name="email_content" rows="10" cols="50"></textarea>
        <button type="submit" name="forensic_analysis">Perform Forensic Analysis</button>
    </form>
    <?php
    if (isset($_POST['forensic_analysis'])) {
        $result = smartmail_forensic_analysis(sanitize_text_field($_POST['email_content']));
        echo '<pre>' . esc_html($result) . '</pre>';
    }
    return ob_get_clean();
}
