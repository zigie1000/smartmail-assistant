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
                        content: content,
                        security: '<?php echo wp_create_nonce('smartmail_nonce'); ?>'
                    },
                    success: function(response) {
                        if (response.success) {
                            $(resultId).text(response.data);
                        } else {
                            $(resultId).text('An error occurred: ' + response.data);
                        }
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

<style>
.smartmail-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

.smartmail-header h1 {
    text-align: center;
}

.smartmail-section {
    margin-bottom: 30px;
}

.smartmail-section h2 {
    margin-bottom: 10px;
}

.smartmail-section form {
    display: flex;
    flex-direction: column;
}

.smartmail-section textarea {
    margin-bottom: 10px;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    resize: vertical;
}

.smartmail-section button {
    padding: 10px;
    background-color: #0073aa;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.smartmail-section button:hover {
    background-color: #005177;
}

.smartmail-section div {
    margin-top: 10px;
    padding: 10px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
}
</style>
