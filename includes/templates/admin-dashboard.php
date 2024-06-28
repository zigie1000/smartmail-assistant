<?php
/*
Template Name: SmartMail Dashboard
*/
get_header(); ?>

<div class="smartmail-dashboard">
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
        <!-- Repeat for other sections... -->
    </div>
</div>

<style>
.smartmail-dashboard {
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

<?php get_footer(); ?>    margin-bottom: 40px;
}
.smartmail-section h2 {
    border-bottom: 2px solid #333;
    padding-bottom: 10px;
}
</style>

<?php get_footer(); ?>


