<?php
global $post;
if ($post && !is_search() && !is_404() && inc_is_breadcrumb_enabled()) {
    $parent_page_ids = array();
    $parent_page_id = $post->post_parent;
    while ($parent_page_id) {
        array_push($parent_page_ids, $parent_page_id);
        $current_post = get_post($parent_page_id);
        $parent_page_id = $current_post->post_parent;
    }
    $parent_page_ids = array_reverse($parent_page_ids);
    $parent_page_ids = apply_filters('inc_breadcrumb', $parent_page_ids);

    echo '<nav id="breadcrumbs" class="one-half column-last">';
    echo '<ul>';
    echo '<li><a href="' . home_url() . '">' . __('Home', INCEPTIO_THEME_NAME) . '</a> &rsaquo;</li>' . "\n";
    foreach ($parent_page_ids as $page_id) {
        echo '<li><a href="' . get_page_link($page_id) . '">' . get_the_title($page_id) . '</a> &rsaquo;</li>' . "\n";
    }
    echo '<li>' . get_the_title() . '</li>';
    echo '</ul>';
    echo '</nav>';
}
