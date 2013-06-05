<?php global $post; if (empty($post->post_content)){ ?>
<!-- begin contact form -->
<h2><?php _e('Contact Us', INCEPTIO_THEME_NAME) ?></h2>
<p><?php _e('We would be glad to have feedback from you. Drop us a line, whether it is a comment, a question, a work proposition or just a hello. You can use either the form below or the contact details on the right.', INCEPTIO_THEME_NAME) ?></p>
<div id="contact-notification-box-success" class="notification-box notification-box-success" style="display: none;">
    <p><?php _e('Your message has been successfully sent. We will get back to you as soon as possible.', INCEPTIO_THEME_NAME) ?></p>
    <a href="#" class="notification-close notification-close-success">x</a>
</div>

<div id="contact-notification-box-error" class="notification-box notification-box-error " style="display: none;">
    <p id="contact-notification-box-error-p" data-default-msg="<?php _e('Your message couldn\'t be sent because a server error occurred. Please try again.', INCEPTIO_THEME_NAME) ?>"></p>
    <a href="#" class="notification-close notification-close-error">x</a>
</div>
<form id="contact-form" class="content-form" method="post" action="<?php echo site_url('wp-admin/admin-ajax.php'); ?>">
    <p>
        <label for="name"><?php _e('Name:', INCEPTIO_THEME_NAME) ?><span class="note">*</span></label>
        <input id="name" type="text" name="name" class="required">
    </p>
    <p>
        <label for="email"><?php _e('Email:', INCEPTIO_THEME_NAME) ?><span class="note">*</span></label>
        <input id="email" type="email" name="email" class="required">
    </p>
    <p>
        <label for="url"><?php _e('Website:', INCEPTIO_THEME_NAME) ?></label>
        <input id="url" type="url" name="url">
    </p>
    <p>
        <label for="subject"><?php _e('Subject:', INCEPTIO_THEME_NAME) ?><span class="note">*</span></label>
        <input id="subject" type="text" name="subject" class="required">
    </p>
    <p>
        <label for="message"><?php _e('Message:', INCEPTIO_THEME_NAME) ?><span class="note">*</span></label>
        <textarea id="message" cols="68" rows="8" name="message" class="required"></textarea>
    </p>
    <?php if(inc_is_captcha_form_enabled()){ ?>
    <p>
        <?php echo do_shortcode('[captcha][/captcha]'); ?>
    </p>
    <?php } ?>
    <p>
        <input id="submit-contact" class="button" type="submit" name="submit" value="<?php _e('Send Message', INCEPTIO_THEME_NAME) ?>">
    </p>
</form>
<p><span class="note">*</span> <?php _e('Required fields', INCEPTIO_THEME_NAME) ?></p>
<script type="text/javascript">
    if(!document['formsSettings']){
        document['formsSettings'] = [];
    }
    document['formsSettings'].push({
        submitButtonId: 'submit-contact',
        action: 'process_contact_form',
        successBoxId: 'contact-notification-box-success',
        errorBoxId: 'contact-notification-box-error'
    });
</script>

<!-- end contact form -->
<?php } else{ the_content(); } ?>
