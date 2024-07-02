<?php
if (!defined('ABSPATH')) {
    exit;
}

// Email Categorization shortcode
function sma_email_categorization_shortcode($atts) {
    ob_start();
    if (is_user_logged_in()) {
        ?>
        <div class="smartmail-email-categorization">
            <h3>Email Categorization</h3>
            <form id="smartmail-email-categorization-form">
                <textarea name="email_content" placeholder="Paste your email content here..." required></textarea>
                <button type="submit">Categorize</button>
            </form>
            <div id="smartmail-email-categorization-result"></div>
        </div>
        <?php
    } else {
        echo '<p>Please log in to use this feature.</p>';
    }
    return ob_get_clean();
}
add_shortcode('sma_email_categorization', 'sma_email_categorization_shortcode');

// Priority Inbox shortcode
function sma_priority_inbox_shortcode($atts) {
    ob_start();
    if (is_user_logged_in()) {
        ?>
        <div class="smartmail-priority-inbox">
            <h3>Priority Inbox</h3>
            <form id="smartmail-priority-inbox-form">
                <textarea name="email_content" placeholder="Paste your email content here..." required></textarea>
                <button type="submit">Determine Priority</button>
            </form>
            <div id="smartmail-priority-inbox-result"></div>
        </div>
        <?php
    } else {
        echo '<p>Please log in to use this feature.</p>';
    }
    return ob_get_clean();
}
add_shortcode('sma_priority_inbox', 'sma_priority_inbox_shortcode');

// Automated Responses shortcode
function sma_automated_responses_shortcode($atts) {
    ob_start();
    if (is_user_logged_in()) {
        ?>
        <div class="smartmail-automated-responses">
            <h3>Automated Responses</h3>
            <form id="smartmail-automated-responses-form">
                <textarea name="email_content" placeholder="Paste your email content here..." required></textarea>
                <button type="submit">Generate Response</button>
            </form>
            <div id="smartmail-automated-responses-result"></div>
        </div>
        <?php
    } else {
        echo '<p>Please log in to use this feature.</p>';
    }
    return ob_get_clean();
}
add_shortcode('sma_automated_responses', 'sma_automated_responses_shortcode');

// Email Summarization shortcode
function sma_email_summarization_shortcode($atts) {
    ob_start();
    if (is_user_logged_in()) {
        ?>
        <div class="smartmail-email-summarization">
            <h3>Email Summarization</h3>
            <form id="smartmail-email-summarization-form">
                <textarea name="email_content" placeholder="Paste your email content here..." required></textarea>
                <button type="submit">Summarize</button>
            </form>
            <div id="smartmail-email-summarization-result"></div>
        </div>
        <?php
    } else {
        echo '<p>Please log in to use this feature.</p>';
    }
    return ob_get_clean();
}
add_shortcode('sma_email_summarization', 'sma_email_summarization_shortcode');

// Meeting Scheduler shortcode
function sma_meeting_scheduler_shortcode($atts) {
    ob_start();
    if (is_user_logged_in()) {
        ?>
        <div class="smartmail-meeting-scheduler">
            <h3>Meeting Scheduler</h3>
            <form id="smartmail-meeting-scheduler-form">
                <textarea name="email_content" placeholder="Paste your email content here..." required></textarea>
                <button type="submit">Schedule Meeting</button>
            </form>
            <div id="smartmail-meeting-scheduler-result"></div>
        </div>
        <?php
    } else {
        echo '<p>Please log in to use this feature.</p>';
    }
    return ob_get_clean();
}
add_shortcode('sma_meeting_scheduler', 'sma_meeting_scheduler_shortcode');

// Follow-up Reminders shortcode
function sma_follow_up_reminders_shortcode($atts) {
    ob_start();
    if (is_user_logged_in()) {
        ?>
        <div class="smartmail-follow-up-reminders">
            <h3>Follow-up Reminders</h3>
            <form id="smartmail-follow-up-reminders-form">
                <textarea name="email_content" placeholder="Paste your email content here..." required></textarea>
                <button type="submit">Generate Reminders</button>
            </form>
            <div id="smartmail-follow-up-reminders-result"></div>
        </div>
        <?php
    } else {
        echo '<p>Please log in to use this feature.</p>';
    }
    return ob_get_clean();
}
add_shortcode('sma_follow_up_reminders', 'sma_follow_up_reminders_shortcode');

// Sentiment Analysis shortcode
function sma_sentiment_analysis_shortcode($atts) {
    ob_start();
    if (is_user_logged_in()) {
        ?>
        <div class="smartmail-sentiment-analysis">
            <h3>Sentiment Analysis</h3>
            <form id="smartmail-sentiment-analysis-form">
                <textarea name="email_content" placeholder="Paste your email content here..." required></textarea>
                <button type="submit">Analyze Sentiment</button>
            </form>
            <div id="smartmail-sentiment-analysis-result"></div>
        </div>
        <?php
    } else {
        echo '<p>Please log in to use this feature.</p>';
    }
    return ob_get_clean();
}
add_shortcode('sma_sentiment_analysis', 'sma_sentiment_analysis_shortcode');

// Email Templates shortcode
function sma_email_templates_shortcode($atts) {
    ob_start();
    if (is_user_logged_in()) {
        ?>
        <div class="smartmail-email-templates">
            <h3>Email Templates</h3>
            <form id="smartmail-email-templates-form">
                <button type="submit">Generate Template</button>
            </form>
            <div id="smartmail-email-templates-result"></div>
        </div>
        <?php
    } else {
        echo '<p>Please log in to use this feature.</p>';
    }
    return ob_get_clean();
}
add_shortcode('sma_email_templates', 'sma_email_templates_shortcode');

// Forensic Analysis shortcode
function sma_forensic_analysis_shortcode($atts) {
    ob_start();
    if (is_user_logged_in()) {
        ?>
        <div class="smartmail-forensic-analysis">
            <h3>Forensic Analysis</h3>
            <form id="smartmail-forensic-analysis-form">
                <textarea name="email_content" placeholder="Paste your email content here..." required></textarea>
                <button type="submit">Perform Analysis</button>
            </form>
            <div id="smartmail-forensic-analysis-result"></div>
        </div>
        <?php
    } else {
        echo '<p>Please log in to use this feature.</p>';
    }
    return ob_get_clean();
}
add_shortcode('sma_forensic_analysis', 'sma_forensic_analysis_shortcode');
?>
