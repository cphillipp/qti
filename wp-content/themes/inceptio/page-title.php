<?php if (is_search() || (!is_front_page() && inc_is_page_title_bar_visible())) { ?>
<!-- begin page title -->
<section id="page-title">
    <div class="container clearfix">
        <h1 <?php global $post; if ($post && inc_is_breadcrumb_enabled()) { ?>class="one-half"<?php } ?>>
            <?php if(is_404()) { ?>
                <?php _e('404 Error Page', INCEPTIO_THEME_NAME); ?>
            <?php } elseif(is_search()) { ?>
                <?php _e('Search Results', INCEPTIO_THEME_NAME); ?>
            <?php } else { ?>
                <?php the_title(); ?>
            <?php } ?>
        </h1>
        <?php get_template_part('breadcrumb'); ?>
    </div>
</section>
<!-- begin page title -->
<?php } ?>