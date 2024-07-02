<?php
/*
Template Name: Admin Dashboard
*/
get_header(); ?>

<div class="wrap">
    <h1>Admin Dashboard</h1>
    <div id="dashboard-widgets-wrap">
        <div id="dashboard-widgets" class="metabox-holder">
            <div class="postbox-container">
                <div class="meta-box-sortables">
                    <div class="postbox">
                        <h2 class="hndle">Widget Title</h2>
                        <div class="inside">
                            <p>Content for the widget.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="postbox-container">
                <div class="meta-box-sortables">
                    <div class="postbox">
                        <h2 class="hndle">Another Widget</h2>
                        <div class="inside">
                            <p>More content for another widget.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
