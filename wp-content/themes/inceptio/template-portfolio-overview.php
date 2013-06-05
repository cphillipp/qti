<?php
/**
 * Template Name: Portfolio Overview
 */
get_header(); ?>

<?php get_template_part('page-title'); ?>

    <!-- begin content -->
    <section id="content">
        <div class="container clearfix">
            <?php $settings = inc_get_posts_overview_settings();
            $thumb_click_action = array_key_exists('thumb_click_action', $settings) ? $settings['thumb_click_action'] : 'lightbox';
            $items_count = array_key_exists('items_count', $settings) ? $settings['items_count'] : '-1';?>
            <?php echo do_shortcode('[post_gallery type="portfolio" terms="' . $settings['terms'] . '" count="'.$items_count.'" tca="'.$thumb_click_action.'" display_filters="true" display_filters_all_btn="' . $settings['display_filter_all'] . '" columns="' . $settings['columns'] . '" class="portfolio-grid"][/post_gallery]'); ?>
        </div>
    </section>
    <!-- end content -->

<?php get_footer(); ?>