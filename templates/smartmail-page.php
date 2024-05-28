<?php
/*
Template Name: SmartMail Page
*/

get_header(); ?>

<div class="smartmail-container">
    <h1>SmartMail Assistant</h1>
    <p>Welcome to the SmartMail Assistant page. Here you can access all the features provided by the plugin.</p>

    <!-- Email Categorization -->
    <div id="email-categorization">
        <h2>Email Categorization</h2>
        <?php echo do_shortcode('[sma_email_categorization]'); ?>
    </div>

    <!-- Priority Inbox -->
    <div id="priority-inbox">
        <h2>Priority Inbox</h2>
        <?php echo do_shortcode('[sma_priority_inbox]'); ?>
    </div>

    <!-- Additional functionalities -->
    <div id="additional-features">
        <h2>Other Features</h2>
        <?php echo do_shortcode('[sma_email_summarization]'); ?>
        <?php echo do_shortcode('[sma_meeting_scheduler]'); ?>
        <?php echo do_shortcode('[sma_follow_up_reminders]'); ?>
        <?php echo do_shortcode('[sma_sentiment_analysis]'); ?>
        <?php echo do_shortcode('[sma_email_templates]'); ?>
    </div>
</div>

<?php get_footer(); ?>
