<?php $contentFeatured = inc_get_content_featured(); ?>
<?php if ($contentFeatured) { ?>
    <!-- begin featured content -->
    <section>
        <div class="content-featured">
            <div class="container">
                <?php echo $contentFeatured; ?>
            </div>
        </div>
    </section>
    <!-- end featured content -->
<?php } ?>