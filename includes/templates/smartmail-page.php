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
        <form id="smartmail-categorization-form">
            <textarea id="categorization-email-content" placeholder="Enter email content here"></textarea>
            <button type="submit">Categorize Email</button>
        </form>
        <div id="categorization-result"></div>
    </div>

    <div class="smartmail-section">
        <h2>Priority Inbox</h2>
        <form id="smartmail-priority-form">
            <textarea id="priority-email-content" placeholder="Enter email content here"></textarea>
            <button type="submit">Determine Priority</button>
        </form>
        <div id="priority-result"></div>
    </div>

    <div class="smartmail-section">
        <h2>Automated Responses</h2>
        <form id="smartmail-automated-responses-form">
            <textarea id="automated-responses-email-content" placeholder="Enter email content here"></textarea>
            <button type="submit">Generate Response</button>
        </form>
        <div id="automated-responses-result"></div>
    </div>

    <div class="smartmail-section">
        <h2>Email Summarization</h2>
        <form id="smartmail-summarization-form">
            <textarea id="summarization-email-content" placeholder="Enter email content here"></textarea>
            <button type="submit">Summarize Email</button>
        </form>
        <div id="summarization-result"></div>
    </div>

    <div class="smartmail-section">
        <h2>Meeting Scheduler</h2>
        <form id="smartmail-meeting-scheduler-form">
            <textarea id="meeting-scheduler-email-content" placeholder="Enter email content here"></textarea>
            <button type="submit">Schedule Meeting</button>
        </form>
        <div id="meeting-scheduler-result"></div>
    </div>

    <div class="smartmail-section">
        <h2>Follow-up Reminders</h2>
        <form id="smartmail-follow-up-reminders-form">
            <textarea id="follow-up-reminders-email-content" placeholder="Enter email content here"></textarea>
            <button type="submit">Generate Follow-up Reminder</button>
        </form>
        <div id="follow-up-reminders-result"></div>
    </div>

    <div class="smartmail-section">
        <h2>Sentiment Analysis</h2>
        <form id="smartmail-sentiment-analysis-form">
            <textarea id="sentiment-analysis-email-content" placeholder="Enter email content here"></textarea>
            <button type="submit">Analyze Sentiment</button>
        </form>
        <div id="sentiment-analysis-result"></div>
    </div>

    <div class="smartmail-section">
        <h2>Email Templates</h2>
        <form id="smartmail-email-templates-form">
            <textarea id="email-templates-request" placeholder="Enter your request for an email template"></textarea>
            <button type="submit">Generate Template</button>
        </form>
        <div id="email-templates-result"></div>
    </div>

    <div class="smartmail-section">
        <h2>Forensic Analysis</h2>
        <form id="smartmail-forensic-analysis-form">
            <textarea id="forensic-analysis-email-content" placeholder="Enter email content here"></textarea>
            <button type="submit">Perform Analysis</button>
        </form>
        <div id="forensic-analysis-result"></div>
    </div>
</div>

<script>
    jQuery(document).ready(function($) {
        function ajaxFormSubmit(formId, resultId, action) {
            $(formId).on('submit', function(event) {
                event.preventDefault();
                var content = $(formId + ' textarea').val();
                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'POST',
                    data: {
                        action: action,
                        content: content
                    },
                    success: function(response) {
                        $(resultId).text(response);
                    },
                    error: function() {
                        $(resultId).text('An error occurred.');
                    }
                });
            });
        }

        ajaxFormSubmit('#smartmail-categorization-form', '#categorization-result', 'smartmail_email_categorization');
        ajaxFormSubmit('#smartmail-priority-form', '#priority-result', 'smartmail_priority_inbox');
        ajaxFormSubmit('#smartmail-automated-responses-form', '#automated-responses-result', 'smartmail_automated_responses');
        ajaxFormSubmit('#smartmail-summarization-form', '#summarization-result', 'smartmail_email_summarization');
        ajaxFormSubmit('#smartmail-meeting-scheduler-form', '#meeting-scheduler-result', 'smartmail_meeting_scheduler');
        ajaxFormSubmit('#smartmail-follow-up-reminders-form', '#follow-up-reminders-result', 'smartmail_follow_up_reminders');
        ajaxFormSubmit('#smartmail-sentiment-analysis-form', '#sentiment-analysis-result', 'smartmail_sentiment_analysis');
        ajaxFormSubmit('#smartmail-email-templates-form', '#email-templates-result', 'smartmail_email_templates');
        ajaxFormSubmit('#smartmail-forensic-analysis-form', '#forensic-analysis-result', 'smartmail_forensic_analysis');
    });
</script>

<?php get_footer(); ?>
