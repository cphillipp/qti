<?php $social_networks = inc_get_sharing_social_networks(); ?>
<?php if(!empty($social_networks)) { ?>
<div class="share-wrap">
    <h4><?php _e('Share This Story', INCEPTIO_THEME_NAME); ?></h4>
    <?php
    $post_url_encoded = urlencode(get_permalink());
    $post_title_encoded = urlencode(get_the_title());
    $sc = '[social';
    foreach($social_networks as $id=>$val){
        $tag_name = $id;
        $p = $id;
        if($id == 'googleplus'){
            $tag_name = 'gplus';
        }
        $tag_name = ($id=='google-plus')? 'gplus': $id;
        $href = "http://www.share-widget.com/myshare.php5?p=$p&u=$post_url_encoded&t=$post_title_encoded&shrt=1";
        $sc .= " $tag_name=\"$href\"";
    }
    $sc .= '][/social]';
    echo do_shortcode($sc); ?>
</div>
<?php } ?>