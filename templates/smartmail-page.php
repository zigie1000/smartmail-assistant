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
            <?php echo do_shortcode('[sma_email_categorization]'); ?>
        </div>
    </div>

    <div class="smartmail-section">
        <h2>Priority
    Inbox</h2>
        <div class="smartmail-feature">
            <?php echo do_shortcode('[sma_priority_inbox]'); ?>
        </div>
    </div>

    <div class="smartmail-section">
        <h2>Additional Features</h2>
        <div class="smartmail-feature">
            <?php echo do_shortcode('[sma_email_summarization]'); ?>
        </div>
        <div class="smartmail-feature">
            <?php echo do_shortcode('[sma_meeting_scheduler]'); ?>
        </div>
        <div class="smartmail-feature">
            <?php echo do_shortcode('[sma_follow_up_reminders]'); ?>
        </div>
        <div class="smartmail-feature">
            <?php echo do_shortcode('[sma_sentiment_analysis]'); ?>
        </div>
        <div class="smartmail-feature">
            <?php echo do_shortcode('[sma_email_templates]'); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
