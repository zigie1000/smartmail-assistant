<?php
/**
 * Template Name: SmartMail Assistant
 */

get_header();
?>

<div class="smartmail-assistant">
    <h1>SmartMail Assistant</h1>
    <div class="smartmail-feature">
        <h2>Email Categorization</h2>
        <?php echo do_shortcode('[sma_email_categorization]'); ?>
    </div>

    <div class="smartmail-feature">
        <h2>Priority Inbox</h2>
        <?php echo do_shortcode('[sma_priority_inbox]'); ?>
    </div>

    <div class="smartmail-feature">
        <h2>Automated Responses</h2>
        <?php echo do_shortcode('[sma_automated_responses]'); ?>
    </div>

    <div class="smartmail-feature">
        <h2>Email Summarization</h2>
        <?php echo do_shortcode('[sma_email_summarization]'); ?>
    </div>

    <div class="smartmail-feature">
        <h2>Meeting Scheduler</h2>
        <?php echo do_shortcode('[sma_meeting_scheduler]'); ?>
    </div>

    <div class="smartmail-feature">
        <h2>Follow-up Reminders</h2>
        <?php echo do_shortcode('[sma_follow_up_reminders]'); ?>
    </div>

    <div class="smartmail-feature">
        <h2>Sentiment Analysis</h2>
        <?php echo do_shortcode('[sma_sentiment_analysis]'); ?>
    </div>

    <div class="smartmail-feature">
        <h2>Email Templates</h2>
        <?php echo do_shortcode('[sma_email_templates]'); ?>
    </div>

    <div class="smartmail-feature">
        <h2>Forensic Analysis</h2>
        <?php echo do_shortcode('[sma_forensic_analysis]'); ?>
    </div>
</div>

<style>
.smartmail-assistant {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

.smartmail-feature {
    margin-bottom: 40px;
}

.smartmail-feature h2 {
    border-bottom: 2px solid #333;
    padding-bottom: 10px;
    margin-bottom: 20px;
}
</style>

<?php
get_footer();
?>
