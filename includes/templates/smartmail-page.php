<?php
/*
Template Name: SmartMail Assistant
*/
get_header(); ?>

<div class="smartmail-page">
    <div class="smartmail-page-header">
        <h1>Welcome to SmartMail Assistant</h1>
        <p>Your AI-powered email assistant</p>
    </div>
    <div class="smartmail-page-content">
        <p>Enhance your email management with SmartMail Assistant's powerful features.</p>
        <a class="smartmail-page-button" href="<?php echo site_url('/smartmail-dashboard'); ?>">Go to Dashboard</a>
    </div>
</div>

<style>
.smartmail-page {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 50px;
    background: #f5f5f5;
    font-family: Arial, sans-serif;
}

.smartmail-page-header {
    background: #0073aa;
    color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 30px;
}

.smartmail-page-header h1 {
    font-size: 2.5em;
    margin: 0;
    letter-spacing: 1px;
}

.smartmail-page-header p {
    font-size: 1.2em;
    margin: 10px 0 0;
}

.smartmail-page-content {
    max-width: 600px;
}

.smartmail-page-content p {
    font-size: 1.2em;
    color: #333;
    margin-bottom: 30px;
}

.smartmail-page-button {
    display: inline-block;
    padding: 15px 30px;
    background-color: #0073aa;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    font-size: 1.1em;
    transition: background-color 0.3s ease;
}

.smartmail-page-button:hover {
    background-color: #005b8a;
}

.smartmail-page-button:focus,
.smartmail-page-button:active {
    background-color: #004c70;
    outline: none;
}
</style>

<?php get_footer(); ?>
