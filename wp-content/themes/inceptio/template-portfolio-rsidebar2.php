<?php get_header(); ?>
<?php

add_filter('inc_flex_slider_settings', 'inc_portfolio_sidebar_flex_slider_settings');
if (!function_exists('inc_portfolio_sidebar_flex_slider_settings')) {
    function inc_portfolio_sidebar_flex_slider_settings($slider_settings){
        return array_merge($slider_settings, array('img_size' => 'inc-portfolio-sidebar'));
    }
}

add_filter('inc_page_image_settings', 'inc_portfolio_sidebar_image_settings');
if (!function_exists('inc_portfolio_sidebar_image_settings')) {
    function inc_portfolio_sidebar_image_settings($img_settings){
        return array_merge($img_settings, array('img_size' => 'inc-portfolio-sidebar'));
    }
}
?>

<?php if ( have_posts() ) while ( have_posts() ) { the_post(); ?>
<?php get_template_part('page-title'); ?>

<!-- begin content -->
<section id="content">
    <div class="container clearfix">
        <?php get_template_part('posts-navigation'); ?>

        <!-- begin project -->
        <section>
            <!-- begin project media -->
            <div class="three-fourths">
                <!-- begin project media -->
                <?php get_template_part('portfolio-media'); ?>
                <!-- end project media -->
            </div>

            <!-- begin project content -->
            <div class="one-fourth column-last">
                <!-- begin project details -->
                <?php get_sidebar('portfolio'); ?>
                <!-- end project details -->
            </div>
            <!-- end project content -->
            <div class="clear"></div>

            <!-- begin project description -->
            <div class="project-description">
                <h2><?php _e('Project Description', INCEPTIO_THEME_NAME) ?></h2>
                <?php the_content(); ?>
            </div>
            <!-- begin project description -->
        </section>
        <!-- end project -->

        <?php get_template_part('portfolio-footer'); ?>

        <!-- begin comments -->
        <?php comments_template('', true); ?>
        <!-- end comments -->
    </div>

</section>
<!-- end content -->
<?php }?>
<?php get_footer(); ?>