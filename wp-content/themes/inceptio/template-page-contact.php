<?php
/**
 * Template Name: Contact Page - Right Sidebar
 */
get_header(); ?>

<?php get_template_part('page-title'); ?>

<!-- begin content -->
<section id="content">
    <div class="container clearfix">
        <!-- begin google map -->
        <?php echo Page_Contact_Manager::get_map(); ?>
        <!-- end google map -->

        <?php if (have_posts()) while (have_posts()) { the_post(); ?>
        <!-- begin main -->
        <section id="main" class="three-fourths">
            <?php $contact_page_content = apply_filters('inc_contact_page_content', 'content-contact'); ?>
            <?php get_template_part($contact_page_content); ?>
        </section>
        <!-- end main -->
        <?php } ?>

        <!-- begin sidebar -->
        <?php get_sidebar(); ?>
        <!-- end sidebar -->
    </div>
</section>
<!-- end content -->
<?php get_footer(); ?>