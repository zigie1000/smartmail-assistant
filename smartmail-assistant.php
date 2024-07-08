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

smartmail-sidebar ul li a {
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
