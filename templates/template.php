<?php
/*
Template Name: SmartMail Page
*/
get_header(); ?>

<div class="smartmail-container">
    <div class="smartmail-header">
        <h1>SmartMail Assistant</h1>
        <p>Welcome to the SmartMail Assistant page. Here you can access all the features provided by SmartMail Assistant.</p>
    </div>

    <div class="smartmail-section">
        <h2>Email Categorization</h2>
        <div class="smartmail-feature">
            <?php echo do_shortcode('[smartmail_email_categorization]'); ?>
        </div>
    </div>

    <div class="smartmail-section">
        <h2>Priority Inbox</h2>
        <div class="smartmail-feature">
            <?php echo do_shortcode('[smartmail_priority_inbox]'); ?>
        </div>
    </div>

    <div class="smartmail-section">
        <h2>Automated Responses</h2>
        <div class="smartmail-feature">
            <?php echo do_shortcode('[smartmail_automated_responses]'); ?>
        </div>
    </div>

    <div class="smartmail-section">
        <h2>Email Summarization</h2>
        <div class="smartmail-feature">
            <?php echo do_shortcode('[smartmail_email_summarization]'); ?>
        </div>
    </div>

    <div class="smartmail-section">
        <h2>Meeting Scheduler</h2>
        <div class="smartmail-feature">
            <?php echo do_shortcode('[smartmail_meeting_scheduler]'); ?>
        </div>
    </div>

    <div class="smartmail-section">
        <h2>Follow-up Reminders</h2>
        <div class="smartmail-feature">
            <?php echo do_shortcode('[smartmail_follow_up_reminders]'); ?>
        </div>
    </div>

    <div class="smartmail-section">
        <h2>Sentiment Analysis</h2>
        <div class="smartmail-feature">
            <?php echo do_shortcode('[smartmail_sentiment_analysis]'); ?>
        </div>
    </div>

    <div class="smartmail-section">
        <h2>Email Templates</h2>
        <div class="smartmail-feature">
            <?php echo do_shortcode('[smartmail_email_templates]'); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>