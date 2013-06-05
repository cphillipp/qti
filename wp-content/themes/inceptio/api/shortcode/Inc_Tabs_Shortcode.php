<?php

class Inc_Tabs_Shortcode extends Abstract_Inc_Shortcode implements Inc_Shortcode_Designer
{
    static $TAB_TITLE_ATTR = "title";
    var $tabs = array();

    function render($attr, $inner_content = null, $code = "")
    {
        $content = '';
        switch ($code) {
            case "tabs":
                unset($this->tabs);
                $this->tabs = array();
                $inner_content = do_shortcode($this->prepare_content($inner_content));
                $content .= $this->render_tabs($attr, $inner_content);
                break;
            case "tab":
                $inner_content = do_shortcode($this->prepare_content($inner_content));
                $content .= $this->render_tab($attr, $inner_content);
                break;
        }
        return $content;
    }

    private function render_tabs($attr, $inner_content = null)
    {
        $content = '<div class="tabs">';
        $content .= '<ul class="tabs-nav clearfix">';
        foreach ($this->tabs as $k => $v) {
            $content .= $k;
        }
        $content .= '</ul>';
        foreach ($this->tabs as $k => $v) {
            $content .= $v;
        }
        $content .= '</div>';
        return $content;
    }

    private function render_tab($attr, $inner_content = null)
    {
        extract(shortcode_atts(array(Inc_Tabs_Shortcode::$TAB_TITLE_ATTR => ''), $attr));
        $i = count($this->tabs) + 1;
        $key = "<li><a href=\"#tab-$i\">$title</a></li>";
        $value = "<div id=\"tab-$i\" class=\"tab\">$inner_content</div>";
        $this->tabs[$key] = $value;
        return '';
    }

    function get_names()
    {
        return array('tabs', 'tab');
    }

    function get_visual_editor_form()
    {
        $example = '[tab '.Inc_Tabs_Shortcode::$TAB_TITLE_ATTR.'="TAB1_TITLE"]TAB1_CONTENT[/tab][tab '.Inc_Tabs_Shortcode::$TAB_TITLE_ATTR.'="TAB2_TITLE"]TAB2_CONTENT[/tab]';
        $example = str_replace(array('[', ']'), array('&#91;', '&#93;'), $example);
        $content = '<form id="sc-tabs-form" class="generic-form" method="post" action="#" data-sc="tabs">';
        $content .= '<fieldset>';
        $content .= '<div>';
        $content .= '<label for="sc-tabs-content">' . __('Template', INCEPTIO_THEME_NAME) . ':</label>';
        $content .= '<textarea id="sc-tabs-content" name="sc-tabs-content" class="required" data-attr-type="content">'.$example.'</textarea>';
        $content .= '</div>';
        $content .= '<div >';
        $content .= '<input id="sc-tabs-form-submit" type="submit" name="submit" value="' . __('Insert Tabs', INCEPTIO_THEME_NAME) . '" class="button-primary">';
        $content .= '</div>';
        $content .= '</fieldset>';
        $content .= '</form>';
        return $content;
    }

    function get_group_title()
    {
        return __('Dynamic Elements', INCEPTIO_THEME_NAME);
    }

    function get_title()
    {
        return __('Tabs', INCEPTIO_THEME_NAME);
    }
}
