<?php
/*
Template Name: SmartMail Assistant
*/
get_header(); ?>

<div class="smartmail-assistant">
    <div class="smartmail-sidebar">
        <h2>SmartMail Assistant</h2>
        <ul>
            <li><a href="#email-categorization">Email Categorization</a></li>
            <li><a href="#priority-inbox">Priority Inbox</a></li>
            <li><a href="#automated-responses">Automated Responses</a></li>
            <li><a href="#email-summarization">Email Summarization</a></li>
            <li><a href="#meeting-scheduler">Meeting Scheduler</a></li>
            <li><a href="#follow-up-reminders">Follow-up Reminders</a></li>
            <li><a href="#sentiment-analysis">Sentiment Analysis</a></li>
            <li><a href="#email-templates">Email Templates</a></li>
            <li><a href="#forensic-analysis">Forensic Analysis</a></li>
        </ul>
    </div>
    <div class="smartmail-content">
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
</div>

<style>
.smartmail-assistant {
    display: flex;
}

.smartmail-sidebar {
    width: 200px;
    background-color: #f4f4f4;
    padding: 20px;
}

.smartmail-sidebar h2 {
    margin: 0;
    padding: 0 0 20px 0;
    border-bottom: 1px solid #ccc;
}

.smartmail-sidebar ul {
    list-style-type: none;
    padding: 0;
}

.smartmail-sidebar ul li {
    margin: 10px 0;
}

.smartmail-sidebar ul li a {
    text-decoration: none;
    color: #333;
}

.smartmail-content {
    flex: 1;
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
