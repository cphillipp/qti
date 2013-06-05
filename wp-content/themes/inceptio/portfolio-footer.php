<?php if(inc_is_display_portfolio_related_posts_enabled()){ ?>
<!-- begin related projects -->
<?php $related_posts = do_shortcode('[post_gallery count="8" related="true" display_mode="carousel"][/post_gallery]'); ?>
<?php if(!empty($related_posts)){ ?>
<section>
    <h2><?php _e('Related Projects', INCEPTIO_THEME_NAME) ?></h2>
    <!-- begin project carousel -->
    <?php echo $related_posts; ?>
    <!-- end project carousel -->
</section>
<?php } ?>
<!-- end related projects -->
<?php } ?>