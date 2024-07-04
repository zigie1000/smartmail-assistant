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

        <div id="priority-inbox" class="smartmail-section">
            <h2>Priority Inbox</h2>
            <div class="smartmail-feature">
                <?php echo do_shortcode('[sma_priority_inbox]'); ?>
            </div>
        </div>

        <div id="automated-responses" class="smartmail-section">
            <h2>Automated Responses</h2>
            <div class="smart
