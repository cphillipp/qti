<?php


class Inc_Video_Shortcode extends Abstract_Inc_Shortcode implements Inc_Shortcode_Designer
{
    static $ALIGN_ATTR = "align";

    function render($attr, $inner_content = null, $code = "")
    {
        extract(shortcode_atts(array(Inc_Video_Shortcode::$ALIGN_ATTR => ''), $attr));
        $div_class = "entry-video";
        if ($align == 'right') {
            $div_class .= " alignright";
        } elseif ($align == 'left') {
            $div_class .= " alignleft";
        }
        return "<div class=\"$div_class\">$inner_content</div>";
    }

    function get_names()
    {
        return array('video');
    }

    function get_visual_editor_form()
    {
        $content = '<form id="sc-video-form" class="generic-form" method="post" action="#" data-sc="video">';
        $content .= '<fieldset>';
        $content .= '<div>';
        $content .= '<label for="sc-video-align">' . __('Align', INCEPTIO_THEME_NAME) . ':</label>';
        $content .= '<select id="sc-video-align" name="sc-video-align">';
        $content .= '<option value="">' . __('None', INCEPTIO_THEME_NAME) . '</option>';
        $content .= '<option value="left">' . __('Left', INCEPTIO_THEME_NAME) . '</option>';
        $content .= '<option value="right">' . __('Right', INCEPTIO_THEME_NAME) . '</option>';
        $content .= '</select>';
        $content .= '</div>';
        $content .= '<div>';
        $content .= '<label for="sc-video-content">' . __('Embedded Video', INCEPTIO_THEME_NAME) . ':</label>';
        $content .= '<textarea id="sc-video-content" name="sc-video-content" class="required" data-attr-type="content"></textarea>';
        $content .= '</div>';
        $content .= '<div >';
        $content .= '<input id="sc-video-form-submit" type="submit" name="submit" value="' . __('Insert Video', INCEPTIO_THEME_NAME) . '" class="button-primary">';
        $content .= '</div>';
        $content .= '</fieldset>';
        $content .= '</form>';
        return $content;
    }

    function get_group_title()
    {
        return __('Media', INCEPTIO_THEME_NAME);
    }

    function get_title()
    {
        return __('Video', INCEPTIO_THEME_NAME);
    }
}