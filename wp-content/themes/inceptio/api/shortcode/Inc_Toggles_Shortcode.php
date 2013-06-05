<?php

class Inc_Toggles_Shortcode extends Abstract_Inc_Shortcode implements Inc_Shortcode_Designer
{

    static $TOGGLES_TYPE_ATTR = "type";
    static $TOGGLE_TITLE_ATTR = "title";
    static $TOGGLE_STATE_ATTR = "state";
    var $toggles = array();

    private function init()
    {
        unset($this->toggles);
        $this->toggles = array();
    }

    function render($attr, $inner_content = null, $code = "")
    {
        $content = '';
        switch ($code) {
            case "toggles":
                $this->init();
                do_shortcode($this->prepare_content($inner_content));
                $content .= $this->render_toggles($attr);
                break;
            case "toggle":
                $inner_content = do_shortcode($this->prepare_content($inner_content));
                $this->render_toggle($attr, $inner_content);
                break;
        }
        return $content;
    }

    private function render_toggles($attr)
    {
        extract(shortcode_atts(array(Inc_Toggles_Shortcode::$TOGGLES_TYPE_ATTR => 'default'), $attr));
        if ($type == 'accordion') {
            $content = '<div class="accordion">';
            foreach ($this->toggles as $v) {
                $content .= '<div>';
                $content .= "<span class=\"accordion-title\">" . $v['title'] . "</span>";
                $content .= '<div class="accordion-inner">';
                $content .= $v['value'];
                $content .= '</div>';
                $content .= '</div>';
            }
            $content .= '</div>';
        } else {
            $content = '';
            foreach ($this->toggles as $v) {
                $content .= '<div data-id="' . $v['state'] . '" class="toggle">';
                $content .= "<span class=\"toggle-title\">" . $v['title'] . "</span>";
                $content .= '<div class="toggle-inner">';
                $content .= $v['value'];
                $content .= '</div>';
                $content .= '</div>';
            }
        }
        return $content;
    }

    private function render_toggle($attr, $inner_content = null)
    {
        extract(shortcode_atts(array(
            Inc_Toggles_Shortcode::$TOGGLE_TITLE_ATTR => '',
            Inc_Toggles_Shortcode::$TOGGLE_STATE_ATTR => 'closed'), $attr));
        $title = __inc($title);
        $inner_content = __inc($inner_content);
        array_push($this->toggles, array('title' => $title, 'value' => $inner_content, 'state' => $state));
    }

    function get_names()
    {
        return array('toggles', 'toggle');
    }

    function get_visual_editor_form()
    {
        $example = '[toggle '.Inc_Toggles_Shortcode::$TOGGLE_STATE_ATTR.'="open" '.Inc_Toggles_Shortcode::$TOGGLE_TITLE_ATTR.'="TOGGLE1_TITLE"]TAB1_CONTENT[/toggle][toggle '.Inc_Toggles_Shortcode::$TOGGLE_STATE_ATTR.'="closed" '.Inc_Toggles_Shortcode::$TOGGLE_TITLE_ATTR.'="TOGGLE2_TITLE"]TAB2_CONTENT[/toggle]';
        $example = str_replace(array('[', ']'), array('&#91;', '&#93;'), $example);
        $content = '<form id="sc-toggle-form" class="generic-form" method="post" action="#" data-sc="toggles">';
        $content .= '<fieldset>';
        $content .= '<div>';
        $content .= '<label for="sc-toggles-content">' . __('Content', INCEPTIO_THEME_NAME) . ':</label>';
        $content .= '<textarea id="sc-toggles-content" name="sc-toggles-content" class="required" data-attr-type="content">'.$example.'</textarea>';
        $content .= '</div>';
        $content .= '<div>';
        $content .= '<label for="sc-toggles-type">' . __('Type', INCEPTIO_THEME_NAME) . ':</label>';
        $content .= '<select id="sc-toggles-type" name="sc-toggles-type" data-attr-name="' . Inc_Toggles_Shortcode::$TOGGLES_TYPE_ATTR . '" data-attr-type="attr">';
        $content .= '<option value="default" selected>' . __('Default', INCEPTIO_THEME_NAME) . '</option>';
        $content .= '<option value="accordion">' . __('Accordion', INCEPTIO_THEME_NAME) . '</option>';
        $content .= '</select>';
        $content .= '</div>';
        $content .= '<div >';
        $content .= '<input id="sc-toggle-form-submit" type="submit" name="submit" value="' . __('Insert Toggles', INCEPTIO_THEME_NAME) . '" class="button-primary">';
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
        return __('Toggles', INCEPTIO_THEME_NAME);
    }
}
