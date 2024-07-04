<?php
/*
Template Name: SmartMail Assistant
*/
get_header(); ?>

<div class="smartmail-assistant">
    <h1>Welcome to the SmartMail Assistant</h1>
    <p>Access all the features provided by SmartMail Assistant here.</p>

    <div id="email-categorization" class="smartmail-section">
        <h2>Email Categorization</h2>
        <div class="smartmail-feature">
            <?php echo do_shortcode('[sma_email_categorization]'); ?>
        </div>
    </div>
    <div id="priority-inbox" class="smartmail-section">
        <h2>Priority Inbox</h2>
        <div class="smartmail-feature">
            <?php echo do_shortcode('[sma_priority_inbox]'); ?>
        </div>
    </div>
    <div id="automated-responses" class="smartmail-section">
        <h2>Automated Responses</h2>
        <div class="smartmail-feature">
            <?php echo do_shortcode('[sma_automated_responses]'); ?>
        </div>
    </div>
    <div id="email-summarization" class="smartmail-section">
        <h2>Email Summarization</h2>
        <div class="smartmail-feature">
            <?php echo do_shortcode('[sma_email_summarization]'); ?>
        </div>
    </div>
    <div id="meeting-scheduler" class="smartmail-section">
        <h2>Meeting Scheduler</h2>
        <div class="smartmail-feature">
            <?php echo do_shortcode('[sma_meeting_scheduler]'); ?>
        </div>
    </div>
    <div id="follow-up-reminders" class="smartmail-section">
        <h2>Follow-up Reminders</h2>
        <div class="smartmail-feature">
            <?php echo do_shortcode('[sma_follow_up_reminders]'); ?>
        </div>
    </div>
    <div id="sentiment-analysis" class="smartmail-section">
        <h2>Sentiment Analysis</h2>
        <div class="smartmail-feature">
            <?php echo do_shortcode('[sma_sentiment_analysis]'); ?>
        </div>
    </div>
    <div id="email-templates" class="smartmail-section">
        <h2>Email Templates</h2>
        <div class="smartmail-feature">
            <?php echo do_shortcode('[sma_email_templates]'); ?>
        </div>
    </div>
    <div id="forensic-analysis" class="smartmail-section">
        <h2>Forensic Analysis</h2>
        <div class="smartmail-feature">
            <?php echo do_shortcode('[sma_forensic_analysis]'); ?>
        </div>
    </div>
</div>

<style>
.smartmail-assistant {
    padding: 20px;
}
.smartmail-section {
    margin-bottom: 40px;
}
.smartmail-section h2 {
    border-bottom: 2px solid #333;
    padding-bottom: 10px;
}
</style>

<?php get_footer(); ?>
