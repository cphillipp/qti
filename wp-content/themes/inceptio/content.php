<article id="post-<?php the_ID(); ?>" <?php post_class('entry clearfix') ?>>
    <?php $post_format = get_post_format(); ?>
    <?php if ($post_format == 'gallery') { ?>
        <?php if (inc_has_page_slider()) { ?>
            <!-- begin entry slider -->
            <div class="entry-slider">
                <?php echo Page_Media_Manager::render_page_slider(); ?>
            </div>
            <!-- end entry slider -->
        <?php } ?>
    <?php } elseif ($post_format == 'video') { ?>
        <?php if (inc_has_page_video()) { ?>
            <div class="entry-video">
                <?php echo Page_Media_Manager::render_page_video(); ?>
            </div>
        <?php } ?>
    <?php } else { ?>
        <?php if (has_post_thumbnail()){ ?>
            <?php $thumbnail_id = get_post_thumbnail_id();
            echo Page_Media_Manager::render_page_image($thumbnail_id); ?>
        <?php } ?>
    <?php } ?>


    <div class="entry-date">
        <div class="entry-day"><?php the_time('d'); ?></div>
        <div class="entry-month"><?php the_time('M'); ?></div>
    </div>
    <div class="entry-body">
        <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <div class="entry-meta">
            <span class="author"><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a></span>
            <span class="category"><?php printf('%s', get_the_category_list(', ')); ?></span>
            <span class="comments"><?php comments_popup_link(__('No Comments', INCEPTIO_THEME_NAME), __('1 Comment', INCEPTIO_THEME_NAME), __('% Comments', INCEPTIO_THEME_NAME)); ?></span>
        </div>
        <div class="entry-content">
            <?php echo Post_Util::get_post_excerpt(); ?>
        </div>
    </div>
</article>

