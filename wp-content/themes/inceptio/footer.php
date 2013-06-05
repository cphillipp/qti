<!-- begin footer -->
<footer id="footer">

    <?php if ( inc_has_footer_featured() ) {?>
    <?php get_footer('featured'); ?>
    <?php } ?>

    <!-- begin footer top -->
    <?php if ( function_exists('dynamic_sidebar') && is_active_sidebar(INCEPTIO_SIDEBAR_FOOTER) ) {?>
    <div id="footer-top">
        <div class="container clearfix">
            <?php if ( dynamic_sidebar(INCEPTIO_SIDEBAR_FOOTER) ) {?>
            <?php } ?>
        </div>
    </div>
    <?php } ?>
    <!-- end footer top -->

    <!-- begin footer bottom -->
    <div id="footer-bottom">
        <div class="container clearfix">
            <div class="one-half">
                <p><?php echo inc_get_footer_copyright(); ?> Created by <a href="http://www.claymoredesigns.com/" target="_blank">Claymoredesign</a>.</p>
            </div>

            <div class="one-half column-last">
                <?php get_footer('social'); ?>
            </div>
        </div>
    </div>
    <!-- end footer bottom -->
</footer>
<!-- end footer -->
</div>
<!-- end container -->
<?php echo inc_get_footer_tracking_code(); ?>
<?php wp_footer(); ?>
</body>
</html>