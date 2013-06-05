<?php


class Inc_Social_Icons_Shortcode extends Abstract_Inc_Shortcode implements Inc_Shortcode_Designer
{
    static $CLASS = "class";
    static $MAIL_ATTR = "mail";
    static $TWITTER_ATTR = "twitter";
    static $FACEBOOK_ATTR = "facebook";
    static $GPLUS_ATTR = "gplus";
    static $LINKEDIN_ATTR = "linkedin";
    static $VIMEO_ATTR = "vimeo";
    static $YOUTUBE_ATTR = "youtube";
    static $SKYPE_ATTR = "skype";
    static $DIGG_ATTR = "digg";
    static $DELICIOUS_ATTR = "delicious";
    static $TUMBLR_ATTR = "tumblr";
    static $DRIBBBLE_ATTR = "dribbble";
    static $STUMBLEUPON_ATTR = "stumbleupon";

    function render($attr, $inner_content = null, $code = "")
    {
        extract(shortcode_atts(array(
            Inc_Social_Icons_Shortcode::$CLASS => '',
            Inc_Social_Icons_Shortcode::$MAIL_ATTR => '',
            Inc_Social_Icons_Shortcode::$TWITTER_ATTR => '',
            Inc_Social_Icons_Shortcode::$FACEBOOK_ATTR => '',
            Inc_Social_Icons_Shortcode::$GPLUS_ATTR => '',
            Inc_Social_Icons_Shortcode::$LINKEDIN_ATTR => '',
            Inc_Social_Icons_Shortcode::$VIMEO_ATTR => '',
            Inc_Social_Icons_Shortcode::$YOUTUBE_ATTR => '',
            Inc_Social_Icons_Shortcode::$SKYPE_ATTR => '',
            Inc_Social_Icons_Shortcode::$DIGG_ATTR => '',
            Inc_Social_Icons_Shortcode::$DELICIOUS_ATTR => '',
            Inc_Social_Icons_Shortcode::$TUMBLR_ATTR => '',
            Inc_Social_Icons_Shortcode::$DRIBBBLE_ATTR => '',
            Inc_Social_Icons_Shortcode::$STUMBLEUPON_ATTR => ''), $attr));
        $class_name = "social-links";
        if (!empty($class)) {
            $class_name .= " $class";
        }
        $content = '';
        if (!empty($twitter)) {
            $content .= "<li class=\"twitter\"><a href=\"$twitter\" title=\"Twitter\" target=\"_blank\">Twitter</a></li>";
        }
        if (!empty($facebook)) {
            $content .= "<li class=\"facebook\"><a href=\"$facebook\" title=\"Facebook\" target=\"_blank\">Facebook</a></li>";
        }
        if (!empty($gplus)) {
            $content .= "<li class=\"google-plus\"><a href=\"$gplus\" title=\"Google+\" target=\"_blank\">Google+</a></li>";
        }
        if (!empty($linkedin)) {
            $content .= "<li class=\"linkedin\"><a href=\"$linkedin\" title=\"LinkedIn\" target=\"_blank\">LinkedIn</a></li>";
        }
        if (!empty($vimeo)) {
            $content .= "<li class=\"vimeo\"><a href=\"$vimeo\" title=\"Vimeo\" target=\"_blank\">Vimeo</a></li>";
        }
        if (!empty($youtube)) {
            $content .= "<li class=\"youtube\"><a href=\"$youtube\" title=\"YouTube\" target=\"_blank\">YouTube</a></li>";
        }
        if (!empty($skype)) {
            $content .= "<li class=\"skype\"><a href=\"$skype\" title=\"Skype\" target=\"_blank\">Skype</a></li>";
        }
        if (!empty($digg)) {
            $content .= "<li class=\"digg\"><a href=\"$digg\" title=\"Digg\" target=\"_blank\">Digg</a></li>";
        }
        if (!empty($delicious)) {
            $content .= "<li class=\"delicious\"><a href=\"$delicious\" title=\"Delicious\" target=\"_blank\">Delicious</a></li>";
        }
        if (!empty($tumblr)) {
            $content .= "<li class=\"tumbler\"><a href=\"$tumblr\" title=\"Tumblr\" target=\"_blank\">Tumblr</a></li>";
        }
        if (!empty($dribbble)) {
            $content .= "<li class=\"dribbble\"><a href=\"$dribbble\" title=\"Dribbble\" target=\"_blank\">Dribbble</a></li>";
        }
        if (!empty($stumbleupon)) {
            $content .= "<li class=\"stumbleupon\"><a href=\"$stumbleupon\" title=\"StumbleUpon\" target=\"_blank\">StumbleUpon</a></li>";
        }
        if (!empty($mail)) {
            $mail_name = __("Mail", INCEPTIO_THEME_NAME);
            $content .= "<li class=\"mail\"><a href=\"mailto:$mail\" title=\"$mail_name\" target=\"_blank\">$mail_name</a></li>";
        }

        if (!empty($content)) {
            $content = "<ul class=\"$class_name\">" . $content . "</ul>";
        }
        return $content;
    }

    function get_names()
    {
        return array('social');
    }

    function get_visual_editor_form()
    {
        $content = '<form id="sc-social-form" class="generic-form" method="post" action="#" data-sc="social">';
        $content .= '<fieldset>';
        $content .= '<div>';
        $content .= '<label for="sc-social-class">' . __('Class', INCEPTIO_THEME_NAME) . ':</label>';
        $content .= '<input id="sc-social-class" name="sc-social-class" type="text" data-attr-name="' . Inc_Social_Icons_Shortcode::$CLASS . '" data-attr-type="attr">';
        $content .= '</div>';
        $content .= '<div>';
        $content .= '<label for="sc-social-twitter">' . __('Twitter URL', INCEPTIO_THEME_NAME) . ':</label>';
        $content .= '<input id="sc-social-twitter" name="sc-social-twitter" type="text" data-attr-name="' . Inc_Social_Icons_Shortcode::$TWITTER_ATTR . '" data-attr-type="attr">';
        $content .= '</div>';
        $content .= '<div>';
        $content .= '<label for="sc-social-facebook">' . __('Facebook URL', INCEPTIO_THEME_NAME) . ':</label>';
        $content .= '<input id="sc-social-facebook" name="sc-social-facebook" type="text" data-attr-name="' . Inc_Social_Icons_Shortcode::$FACEBOOK_ATTR . '" data-attr-type="attr">';
        $content .= '</div>';
        $content .= '<div>';
        $content .= '<label for="sc-social-gplus">' . __('Google+ URL', INCEPTIO_THEME_NAME) . ':</label>';
        $content .= '<input id="sc-social-gplus" name="sc-social-gplus" type="text" data-attr-name="' . Inc_Social_Icons_Shortcode::$GPLUS_ATTR . '" data-attr-type="attr">';
        $content .= '</div>';
        $content .= '<div>';
        $content .= '<label for="sc-social-linkedin">' . __('LinkedIn URL', INCEPTIO_THEME_NAME) . ':</label>';
        $content .= '<input id="sc-social-linkedin" name="sc-social-linkedin" type="text" data-attr-name="' . Inc_Social_Icons_Shortcode::$LINKEDIN_ATTR . '" data-attr-type="attr">';
        $content .= '</div>';
        $content .= '<div>';
        $content .= '<label for="sc-social-vimeo">' . __('Vimeo URL', INCEPTIO_THEME_NAME) . ':</label>';
        $content .= '<input id="sc-social-vimeo" name="sc-social-vimeo" type="text" data-attr-name="' . Inc_Social_Icons_Shortcode::$VIMEO_ATTR . '" data-attr-type="attr">';
        $content .= '</div>';
        $content .= '<div>';
        $content .= '<label for="sc-social-youtube">' . __('YouTube URL', INCEPTIO_THEME_NAME) . ':</label>';
        $content .= '<input id="sc-social-youtube" name="sc-social-youtube" type="text" data-attr-name="' . Inc_Social_Icons_Shortcode::$YOUTUBE_ATTR . '" data-attr-type="attr">';
        $content .= '</div>';
        $content .= '<div>';
        $content .= '<label for="sc-social-skype">' . __('Skype URL', INCEPTIO_THEME_NAME) . ':</label>';
        $content .= '<input id="sc-social-skype" name="sc-social-skype" type="text" data-attr-name="' . Inc_Social_Icons_Shortcode::$SKYPE_ATTR . '" data-attr-type="attr">';
        $content .= '</div>';
        $content .= '<div>';
        $content .= '<label for="sc-social-digg">' . __('Digg URL', INCEPTIO_THEME_NAME) . ':</label>';
        $content .= '<input id="sc-social-digg" name="sc-social-digg" type="text" data-attr-name="' . Inc_Social_Icons_Shortcode::$DIGG_ATTR . '" data-attr-type="attr">';
        $content .= '</div>';
        $content .= '<div>';
        $content .= '<label for="sc-social-delicious">' . __('Delicious URL', INCEPTIO_THEME_NAME) . ':</label>';
        $content .= '<input id="sc-social-delicious" name="sc-social-delicious" type="text" data-attr-name="' . Inc_Social_Icons_Shortcode::$DELICIOUS_ATTR . '" data-attr-type="attr">';
        $content .= '</div>';
        $content .= '<div>';
        $content .= '<label for="sc-social-tumbler">' . __('Tumbler URL', INCEPTIO_THEME_NAME) . ':</label>';
        $content .= '<input id="sc-social-tumbler" name="sc-social-tumbler" type="text" data-attr-name="' . Inc_Social_Icons_Shortcode::$TUMBLR_ATTR . '" data-attr-type="attr">';
        $content .= '</div>';
        $content .= '<div>';
        $content .= '<label for="sc-social-dribbble">' . __('Dribbble URL', INCEPTIO_THEME_NAME) . ':</label>';
        $content .= '<input id="sc-social-dribbble" name="sc-social-dribbble" type="text" data-attr-name="' . Inc_Social_Icons_Shortcode::$DRIBBBLE_ATTR . '" data-attr-type="attr">';
        $content .= '</div>';
        $content .= '<div>';
        $content .= '<label for="sc-social-stumbleupon">' . __('StumbleUpon URL', INCEPTIO_THEME_NAME) . ':</label>';
        $content .= '<input id="sc-social-stumbleupon" name="sc-social-stumbleupon" type="text" data-attr-name="' . Inc_Social_Icons_Shortcode::$STUMBLEUPON_ATTR . '" data-attr-type="attr">';
        $content .= '</div>';
        $content .= '<div>';
        $content .= '<label for="sc-social-mail">' . __('Mail Address', INCEPTIO_THEME_NAME) . ':</label>';
        $content .= '<input id="sc-social-mail" name="sc-social-mail" type="text" data-attr-name="' . Inc_Social_Icons_Shortcode::$MAIL_ATTR . '" data-attr-type="attr">';
        $content .= '</div>';
        $content .= '<div >';
        $content .= '<input id="sc-social-form-submit" type="submit" name="submit" value="' . __('Insert Social Icons', INCEPTIO_THEME_NAME) . '" class="button-primary">';
        $content .= '</div>';
        $content .= '</fieldset>';
        $content .= '</form>';
        return $content;
    }

    function get_group_title()
    {
        return __('Elements', INCEPTIO_THEME_NAME);
    }

    function get_title()
    {
        return __('Social Icons', INCEPTIO_THEME_NAME);
    }
}