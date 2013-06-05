<?php

abstract class Abstract_Inc_Shortcode
{
    function register_shortcode()
    {
        $names = $this->get_names();
        if (is_array($names)) {
            foreach ($names as $name) {
                add_shortcode($name, array($this, 'render_shortcode'));
            }
        } else {
            add_shortcode($names, array($this, 'render_shortcode'));
        }
    }

    final function render_shortcode($attr, $inner_content = null, $code = "")
    {
        return $this->render($attr, $inner_content, $code);
    }

    abstract function render($attr, $inner_content = null, $code = "");

    abstract function get_names();

    protected function prepare_content($inner_content)
    {
        $inner_content = shortcode_unautop($inner_content);
        $inner_content = trim($inner_content, "\x00..\x1F");
        return $inner_content;
    }

    protected function get_attribute($attr_name, $attr_value, $attr_default_value = '')
    {
        if (empty($attr_value)) {
            $attr_value = $attr_default_value;
        }
        return empty($attr_value) ? '' : " $attr_name=\"$attr_value\"";
    }

    protected function get_error($error_msg){
        $sc_names = $this->get_names();
        if (is_array($sc_names)) {
            $sc_names = $sc_names[0];
        }
        return "<p style=\"color:red\">SHORTCODE '.$sc_names.' ERROR: $error_msg</p>";
    }
}
