<?php

//--------------------------------------------- GET THEME OPTIONS ------------------------------------------------------
if (!function_exists('inc_is_custom_seo_enabled')) {
    function inc_is_custom_seo_enabled()
    {
        $val = get_theme_option(OPTION_CUSTOM_SEO_ENABLED);
        return isset($val) && (strtolower($val) == 'on');
    }
}

if (!function_exists('inc_get_meta_keywords')) {
    function inc_get_meta_keywords()
    {
        $post_id = get_real_post_ID();
        if (isset($post_id)) {
            $keywords = get_post_meta($post_id, OPTION_HEAD_META_KEYWORDS, true);
        }
        if (!isset($keywords) || empty($keywords)) {
            $keywords = get_theme_option(OPTION_HEAD_META_KEYWORDS);
        }
        if (!isset($keywords) || empty($keywords)) {
            $keywords = '';
        }
        return $keywords;
    }
}

if (!function_exists('inc_has_meta_keywords')) {
    function inc_has_meta_keywords()
    {
        $keywords = inc_get_meta_keywords();
        return !empty($keywords);
    }
}

if (!function_exists('inc_get_meta_description')) {
    function inc_get_meta_description()
    {
        $post_id = get_real_post_ID();
        if (isset($post_id)) {
            $description = get_post_meta($post_id, OPTION_HEAD_META_DESCRIPTION, true);
        }
        if (!isset($description) || empty($description)) {
            $description = get_theme_option(OPTION_HEAD_META_DESCRIPTION);
        }
        if (!isset($description) || empty($description)) {
            $description = get_bloginfo('description');
        }
        return $description;
    }
}

if (!function_exists('inc_has_meta_description')) {
    function inc_has_meta_description()
    {
        $description = inc_get_meta_description();
        return !empty($description);
    }
}

if (!function_exists('inc_get_meta_author')) {
    function inc_get_meta_author()
    {
        global $post;
        if (isset($post)) {
            $author = get_post_meta(get_the_ID(), OPTION_HEAD_META_AUTHOR, true);
            if ((!isset($author) || empty($author)) &&
                (property_exists($post, 'post_author') && isset($post->post_author))
            ) {
                $author = get_the_author_meta('display_name', $post->post_author);
            }
        } else {
            $author = get_bloginfo('name');
        }
        return $author;
    }
}

if (!function_exists('inc_has_meta_author')) {
    function inc_has_meta_author()
    {
        $author = inc_get_meta_author();
        return !empty($author);
    }
}

if (!function_exists('inc_get_meta_appname')) {
    function inc_get_meta_appname()
    {
        $post_id = get_real_post_ID();
        if (isset($post_id)) {
            $app_name = get_post_meta($post_id, OPTION_HEAD_META_APPNAME, true);
        }
        if (!isset($app_name) || empty($app_name)) {
            $app_name = get_theme_option(OPTION_HEAD_META_APPNAME);
        }
        if (!isset($app_name) || empty($app_name)) {
            $app_name = '';
        }
        return $app_name;
    }
}

if (!function_exists('inc_has_meta_appname')) {
    function inc_has_meta_appname()
    {
        $app_name = inc_get_meta_appname();
        return !empty($app_name);
    }
}

if (!function_exists('inc_get_meta_generator')) {
    function inc_get_meta_generator()
    {
        $post_id = get_real_post_ID();
        if (isset($post_id)) {
            $generator = get_post_meta($post_id, OPTION_HEAD_META_GENERATOR, true);
        }
        if (!isset($generator) || empty($generator)) {
            $generator = get_theme_option(OPTION_HEAD_META_GENERATOR);
        }
        if (!isset($generator) || empty($generator)) {
            $generator = '';
        }
        return $generator;
    }
}

if (!function_exists('inc_has_meta_generator')) {
    function inc_has_meta_generator()
    {
        $generator = inc_get_meta_generator();
        return !empty($generator);
    }
}

if (!function_exists('inc_get_footer_copyright')) {
    function inc_get_footer_copyright()
    {
        return __inc(get_theme_option(OPTION_FOOTER_COPYRIGHT));
    }
}

if (!function_exists('inc_get_footer_tracking_code')) {
    function inc_get_footer_tracking_code()
    {
        return get_theme_option(OPTION_FOOTER_TRACKING_CODE);
    }
}

if (!function_exists('inc_has_footer_featured')) {
    function inc_has_footer_featured()
    {
        $enabled = get_theme_option(OPTION_FOOTER_FEATURED_ENABLED);
        if ($enabled == 'on') {
            $title = inc_get_footer_featured_title();
            $body = inc_get_footer_featured_body();
            $content = inc_get_footer_featured_content();

            return (isset($title) && !empty($title)) ||
                (isset($body) && !empty($body)) ||
                (isset($content) && !empty($content));
        } else {
            return false;
        }
    }
}

if (!function_exists('inc_get_footer_featured_title')) {
    function inc_get_footer_featured_title()
    {
        $post_id = get_real_post_ID();
        if (isset($post_id)) {
            $title = get_post_meta($post_id, OPTION_FOOTER_FEATURED_TITLE, true);
        }
        if (!isset($title) || empty($title)) {
            $title = get_theme_option(OPTION_FOOTER_FEATURED_TITLE);
        }
        return (isset($title) && !empty($title)) ? __inc($title) : false;
    }
}

if (!function_exists('inc_get_footer_featured_body')) {
    function inc_get_footer_featured_body()
    {
        $post_id = get_real_post_ID();
        if (isset($post_id)) {
            $body = get_post_meta($post_id, OPTION_FOOTER_FEATURED_BODY, true);
        }
        if (!isset($body) || empty($body)) {
            $body = get_theme_option(OPTION_FOOTER_FEATURED_BODY);
        }
        return (isset($body) && !empty($body)) ? __inc($body) : false;
    }
}

if (!function_exists('inc_get_footer_featured_url')) {
    function inc_get_footer_featured_url()
    {
        $post_id = get_real_post_ID();
        if (isset($post_id)) {
            $url = get_post_meta($post_id, OPTION_FOOTER_FEATURED_URL, true);
        }
        if (!isset($url) || empty($url)) {
            $url = get_theme_option(OPTION_FOOTER_FEATURED_URL);
        }
        return (isset($url) && !empty($url)) ? $url : '#';
    }
}

if (!function_exists('inc_get_footer_featured_icon')) {
    function inc_get_footer_featured_icon()
    {
        $post_id = get_real_post_ID();
        if (isset($post_id)) {
            $icon = get_post_meta($post_id, OPTION_FOOTER_FEATURED_ICON, true);
        }
        if (!isset($icon) || empty($icon)) {
            $icon = get_theme_option(OPTION_FOOTER_FEATURED_ICON);
        }
        return (isset($icon) && !empty($icon)) ? Media_Util::get_image_src($icon) : Media_Util::get_image_src('/images/mail.png');
    }
}

if (!function_exists('inc_get_content_featured')) {
    function inc_get_content_featured()
    {
        $post_id = get_real_post_ID();
        if (isset($post_id)) {
            $content = get_post_meta($post_id, OPTION_CONTENT_FEATURED, true);
        }
        return (isset($content) && !empty($content)) ? __inc($content) : false;
    }
}

if (!function_exists('inc_get_footer_featured_content')) {
    function inc_get_footer_featured_content()
    {
        $post_id = get_real_post_ID();
        if (isset($post_id)) {
            $content = get_post_meta($post_id, OPTION_FOOTER_FEATURED_CONTENT, true);
        }
        return (isset($content) && !empty($content)) ? __inc($content) : false;
    }
}

if (!function_exists('inc_is_responsive_enabled')) {
    function inc_is_responsive_enabled()
    {
        $val = get_theme_option(OPTION_RESPONSIVE_ENABLED);
        return isset($val) && (strtolower($val) == 'on');
    }
}

if (!function_exists('inc_is_breadcrumb_enabled')) {
    function inc_is_breadcrumb_enabled()
    {
        $val = get_theme_option(OPTION_BREADCRUMB_ENABLED);
        return isset($val) && (strtolower($val) == 'on');
    }
}

if (!function_exists('inc_get_header_logo')) {
    function inc_get_header_logo()
    {
        $logo = get_theme_option(OPTION_HEADER_LOGO);
        if (isset($logo) && strlen($logo) > 0) {
            return $logo;
        } else {
            return '#';
        }
    }
}

if (!function_exists('inc_get_header_logo_alt')) {
    function inc_get_header_logo_alt()
    {
        return get_theme_option(OPTION_HEADER_LOGO_ALT);
    }
}

if (!function_exists('inc_is_header_search_visible')) {
    function inc_is_header_search_visible()
    {
        $val = get_theme_option(OPTION_HEADER_SEARCH_VISIBLE);
        return isset($val) && (strtolower($val) == 'on');
    }
}

if (!function_exists('inc_get_fav_icon')) {
    function inc_get_fav_icon()
    {
        $favicon = get_theme_option(OPTION_HEADER_FAV_ICON);
        if (!isset($favicon) || trim($favicon) == '') {
            $favicon = get_template_directory_uri() . '/images/favicon.ico';
        }
        return $favicon;
    }
}

if (!function_exists('inc_is_display_sn_icons_in_footer_enabled')) {
    function inc_is_display_sn_icons_in_footer_enabled()
    {
        $val = get_theme_option(OPTION_SN_FOOTER_DISPLAY);
        return isset($val) && (strtolower($val) == 'on');
    }
}

if (!function_exists('inc_get_sn_data')) {
    function inc_get_sn_data($sn)
    {
        $val = get_theme_option($sn);
        return isset($val) && !empty($val) ? $val : false;
    }
}

if (!function_exists('inc_get_contact_details')) {
    function inc_get_contact_details($setting)
    {
        $val = get_theme_option($setting);
        if (!isset($val)) {
            $val = '';
        }
        return $val;
    }
}

if (!function_exists('inc_is_captcha_form_enabled')) {
    function inc_is_captcha_form_enabled()
    {
        $val = get_theme_option(OPTION_CAPTCHA_ENABLED);
        return inc_is_captcha_plugin_activated() && isset($val) && (strtolower($val) == 'on');
    }
}

if (!function_exists('inc_is_display_portfolio_navigation_enabled')) {
    function inc_is_display_portfolio_navigation_enabled()
    {
        $val = get_theme_option(OPTION_PORTFOLIO_DISPLAY_POST_NAVIGATION);
        return isset($val) && (strtolower($val) == 'on');
    }
}

if (!function_exists('inc_is_display_portfolio_related_posts_enabled')) {
    function inc_is_display_portfolio_related_posts_enabled()
    {
        $val = get_theme_option(OPTION_PORTFOLIO_DISPLAY_RELATED_POSTS);
        return isset($val) && (strtolower($val) == 'on');
    }
}

if (!function_exists('inc_is_display_blog_navigation_enabled')) {
    function inc_is_display_blog_navigation_enabled()
    {
        $val = get_theme_option(OPTION_BLOG_DISPLAY_POST_NAVIGATION);
        return isset($val) && (strtolower($val) == 'on');
    }
}

if (!function_exists('inc_is_display_blog_tags_enabled')) {
    function inc_is_display_blog_tags_enabled()
    {
        $val = get_theme_option(OPTION_BLOG_DISPLAY_POST_TAGS);
        return isset($val) && (strtolower($val) == 'on');
    }
}

if (!function_exists('inc_is_display_blog_related_posts_enabled')) {
    function inc_is_display_blog_related_posts_enabled()
    {
        $val = get_theme_option(OPTION_BLOG_DISPLAY_RELATED_POSTS);
        return isset($val) && (strtolower($val) == 'on');
    }
}

if (!function_exists('inc_is_display_blog_sharing_post_enabled')) {
    function inc_is_display_blog_sharing_post_enabled()
    {
        $val = get_theme_option(OPTION_BLOG_DISPLAY_POST_SHARING);
        return isset($val) && (strtolower($val) == 'on');
    }
}

if (!function_exists('inc_is_display_about_author_post_enabled')) {
    function inc_is_display_about_author_post_enabled()
    {
        $val = get_theme_option(OPTION_BLOG_DISPLAY_POST_ABOUT_AUTHOR);
        return isset($val) && (strtolower($val) == 'on');
    }
}

//Social Networks
if (!function_exists('inc_get_social_network_url')) {
    function inc_get_social_network_url($social_network)
    {
        $val = get_theme_option($social_network);
        if (!isset($val)) {
            $val = '';
        }
        return $val;
    }
}

//Layout
if (!function_exists('inc_get_layout_type')) {
    function inc_get_layout_type()
    {
        if (IS_STYLE_SWITCHER_ENABLED) {
            if (array_key_exists('ly', $_REQUEST)) {
                if ($_REQUEST['ly'] == 'boxed') {
                    return 'boxed';
                } else {
                    return 'wide';
                }
            }
        }

        $val = get_theme_option(OPTION_LAYOUT_TYPE);
        if (!isset($val)) {
            $val = 'wide';
        }

        return $val;
    }
}

if (!function_exists('inc_get_site_color_scheme')) {
    function inc_get_site_color_scheme()
    {
        $val = get_theme_option(OPTION_CUSTOM_COLOR_SCHEME);
        if (!isset($val) || empty($val)) {
            $val = get_theme_option(OPTION_COLOR_SCHEME);
            if (!isset($val)) {
                $val = 'green';
            }
        } else {
            $val = str_replace('.css', '', $val);
        }
        return $val;
    }
}

if (!function_exists('inc_is_internationalization_enabled')) {
    function inc_is_internationalization_enabled()
    {
        $val = get_theme_option(OPTION_INTERNATIONALIZATION_ENABLED);
        return isset($val) && (strtolower($val) == 'on');
    }
}

//--------------------------------------------- UTILITY FUNCTIONS ------------------------------------------------------

if (!function_exists('inc_is_captcha_plugin_activated')) {
    function inc_is_captcha_plugin_activated()
    {
        global $recaptcha;
        return class_exists('reCAPTCHA') && isset($recaptcha);
    }
}

if (!function_exists('inc_get_page_slider')) {
    function inc_get_page_slider($post_id = null)
    {
        $post_id = get_real_post_ID($post_id);
        if ($post_id) {
            $media_settings_json = get_post_meta($post_id, SETTINGS_PAGE_MEDIA_SETTINGS, true);
            if (isset($media_settings_json) && !empty($media_settings_json)) {
                $media_settings = json_decode($media_settings_json, true);
                if ($media_settings['type'] == 'slider') {
                    return $media_settings['config'];
                }
            }
        }
        return false;
    }
}

if (!function_exists('inc_get_page_contact_settings')) {
    function inc_get_page_contact_settings($post_id = null)
    {
        $post_id = get_real_post_ID($post_id);
        if ($post_id) {
            $media_settings_json = get_post_meta($post_id, SETTINGS_PAGE_MEDIA_SETTINGS, true);
            if (isset($media_settings_json) && !empty($media_settings_json)) {
                $media_settings = json_decode($media_settings_json, true);
                if ($media_settings['type'] == 'contact') {
                    return $media_settings['config'];
                }
            }
        }
        return false;
    }
}

if (!function_exists('inc_get_posts_overview_settings')) {
    function inc_get_posts_overview_settings($post_id = null)
    {
        $post_id = get_real_post_ID($post_id);
        if ($post_id) {
            $settings_json = get_post_meta($post_id, SETTINGS_PAGE_MEDIA_SETTINGS, true);
            if (isset($settings_json) && !empty($settings_json)) {
                $settings = json_decode($settings_json, true);
                if ($settings['type'] == 'posts-overview-settings') {
                    return $settings['config'];
                }
            }
        }
        return array(
            'columns' => '4',
            'terms' => '',
            'display_filter_all' => 'true');
    }
}

if (!function_exists('inc_has_page_slider')) {
    function inc_has_page_slider()
    {
        global $post;
        if (isset($post)) {
            $slider_config = inc_get_page_slider();
            if ($slider_config && is_array($slider_config) &&
                array_key_exists('type', $slider_config) && $slider_config['type'] != 'none'
            ) {
                return true;
            }
        }
        return false;
    }
}

if (!function_exists('inc_get_page_video')) {
    function inc_get_page_video($post_id = null)
    {
        $post_id = get_real_post_ID($post_id);
        if ($post_id) {
            $media_settings_json = get_post_meta($post_id, SETTINGS_PAGE_MEDIA_SETTINGS, true);
            if (isset($media_settings_json) && !empty($media_settings_json)) {
                $media_settings = json_decode($media_settings_json, true);
                if ($media_settings['type'] == 'video') {
                    return $media_settings['config'];
                }
            }
        }
        return false;
    }
}

if (!function_exists('inc_has_page_video')) {
    function inc_has_page_video()
    {
        global $post;
        if (isset($post)) {
            $slider_config = inc_get_page_video();
            if ($slider_config && is_array($slider_config)) {
                return true;
            }
        }
        return false;
    }
}

if (!function_exists('inc_get_page_sidebar')) {
    function inc_get_page_sidebar()
    {
        global $wp_registered_sidebars;
        $post_id = get_real_post_ID();
        if (isset($post_id) && isset($wp_registered_sidebars)) {
            $sidebar_name = get_post_meta($post_id, SETTINGS_PAGE_SIDEBAR_NAME, true);
            if (is_string($sidebar_name) && array_key_exists(sanitize_title($sidebar_name), $wp_registered_sidebars)) {
                return $sidebar_name;
            }
        }
        return 'default-sidebar';
    }
}

if (!function_exists('inc_is_page_title_bar_visible')) {
    function inc_is_page_title_bar_visible()
    {
        $post_id = get_real_post_ID();
        if (isset($post_id)) {
            $title_bar_visible = get_post_meta($post_id, SETTINGS_PAGE_TITLE_BAR_VISIBLE, true);
            if (isset($title_bar_visible) && $title_bar_visible == 'off') {
                return false;
            }
        }
        return true;
    }
}

if (!function_exists('inc_get_all_sidebars')) {
    function inc_get_all_sidebars()
    {
        global $sidebar_manager;
        return $sidebar_manager->get_all_sidebars();
    }
}

if (!function_exists('inc_get_portfolio_template')) {
    function inc_get_portfolio_template()
    {
        $post_id = get_real_post_ID();
        if (isset($post_id)) {
            $template = get_post_meta($post_id, SETTINGS_PORTFOLIO_TEMPLATE, true);
        }
        if (isset($template) && !empty($template)) {
            return $template;
        } else {
            return 'default';
        }
    }
}

if (!function_exists('inc_get_portfolio_param')) {
    function inc_get_portfolio_param($param)
    {
        $post_id = get_real_post_ID();
        if (isset($post_id)) {
            $value = get_post_meta($post_id, $param, true);
        }
        if (isset($value) && !empty($value)) {
            return $value;
        } else {
            return false;
        }
    }
}

if (!function_exists('inc_is_ie_version')) {
    function inc_is_ie_version($ie_version)
    {
        preg_match('/MSIE (.*?);/', $_SERVER['HTTP_USER_AGENT'], $matches);
        if (count($matches) > 1) {
            //Then we're using IE
            $version = $matches[1];
            return intval($ie_version) == intval($version);
        }
        return false;
    }
}

if (!function_exists('inc_has_at_least_one_menu_item_defined')) {
    function inc_has_at_least_one_menu_item_defined()
    {
        global $wpdb;
        $c = $wpdb->get_var("select count(*) as c from $wpdb->posts p where p.post_type='nav_menu_item'");
        return intval($c) > 0;
    }
}

if (!function_exists('inc_get_related_taxonomies_query_args')) {
    function inc_get_related_taxonomies_query_args($post_id = null)
    {
        $post_id = get_real_post_ID($post_id);
        if (isset($post_id)) {
            $post_type = get_post_type();
            $taxonomy = ($post_type == 'portfolio') ? 'filter' : 'category';
            $terms_array = get_the_terms($post_id, $taxonomy);
            if ($terms_array && count($terms_array) > 0) {
                $query_terms = array();
                foreach ($terms_array as $term) {
                    array_push($query_terms, $term->slug);
                }
                $query_args = array(
                    'posts_per_page' => -1,
                    'post_type' => $post_type,
                    'post__not_in' => array($post_id),
                    'tax_query' => array(array(
                        'taxonomy' => $taxonomy,
                        'field' => 'slug',
                        'terms' => $query_terms,
                        'operator' => 'IN'
                    )));
                $query_args = apply_filters("inc_related_taxonomies_query_args", $query_args);
                return $query_args;
            }
        }
        return false;
    }
}

if (!function_exists('inc_get_sharing_social_networks')) {
    function inc_get_sharing_social_networks()
    {
        $social_networks = array(
            'twitter' => 'Twitter',
            'facebook' => 'Facebook',
            'googleplus' => 'Google+',
            'linkedin' => 'LinkedIn',
            'digg' => 'Digg',
            'delicious' => 'Delicious',
            'tumblr' => 'Tumblr',
            'dribbble' => 'Dribbble',
            'stumbleupon' => 'StumbleUpon',
        );
        $social_networks = apply_filters("inc_sharing_social_networks", $social_networks);
        return $social_networks;
    }
}


if (!function_exists('inc_contains_string')) {
    function inc_contains_string($haystack, $needle)
    {
        $pos = strpos($haystack, $needle);
        if ($pos === false) {
            return false;
        } else {
            return true;
        }
    }
}

if (!function_exists('inc_start_with')) {
    function inc_start_with($haystack, $needle)
    {
        $length = strlen($needle);
        return (substr($haystack, 0, $length) === $needle);
    }
}

if (!function_exists('inc_end_with')) {
    function inc_end_with($haystack, $needle)
    {
        $length = strlen($needle);
        $start = $length * -1; //negative
        return (substr($haystack, $start) === $needle);
    }
}

if (!function_exists('inc_shrink_without_strip_tags')) {
    function inc_shrink_without_strip_tags($content, $limit = 350, $read_more_symbol = '&hellip;')
    {
        if (strlen($content) > $limit) {
            if ($read_more_symbol == '') {
                $read_more_symbol = '.';
            } else {
                $read_more_symbol = ' ' . $read_more_symbol;
            }
            $content = substr($content, 0, strpos($content, " ", $limit)) . $read_more_symbol;
        }
        return $content;
    }
}

if (!function_exists('inc_shrink')) {
    function inc_shrink($content, $limit = 350, $read_more_symbol = '&hellip;')
    {
        $content = strip_tags($content);
        if (strlen($content) > $limit) {
            if (!empty($read_more_symbol)) {
                $read_more_symbol = ' ' . $read_more_symbol;
            }
            $pos = strpos($content, " ", $limit);
            if ($pos) {
                $content = substr($content, 0, $pos) . $read_more_symbol;
            }
        }
        return $content;
    }
}

if (!function_exists('inc_shrink_starting_from')) {
    function inc_shrink_starting_from($haystack, $needle, $limit = 350, $read_more_symbol = '&hellip;')
    {
        $haystack = strip_tags($haystack);
        $tmp_haystack = stristr($haystack, $needle);
        if ($tmp_haystack) {
            $haystack = $read_more_symbol . ' ' . $tmp_haystack;
        }
        if (strlen($haystack) > $limit) {
            if ($read_more_symbol == '') {
                $read_more_symbol = '.';
            } else {
                $read_more_symbol = ' ' . $read_more_symbol;
            }
            $haystack = substr($haystack, 0, strpos($haystack, " ", $limit)) . $read_more_symbol;
        }
        return $haystack;
    }
}

if (!function_exists('inc_emphasize')) {
    function inc_emphasize($haystack, $needle)
    {
        return preg_replace("/$needle/i", '<strong>$0</strong>', $haystack);
    }
}

if (!function_exists('inc_has_menu_at_least_one_item_defined')) {
    function inc_has_menu_at_least_one_item_defined()
    {
        global $wpdb;
        $c = $wpdb->get_var("select count(*) as c from $wpdb->posts p where p.post_type='nav_menu_item'");
        return intval($c) > 0;
    }
}

if (!function_exists('inc_pagination')) {
    function inc_pagination($max_num_pages = '')
    {
        global $paged;
        global $wp_query;

        $first_text = __('First', INCEPTIO_THEME_NAME);
        $last_text = __('Last', INCEPTIO_THEME_NAME);
        $page_text = __('Page', INCEPTIO_THEME_NAME);
        $of_text = __('of', INCEPTIO_THEME_NAME);
        $big = 999999999; // need an unlikely integer

        $paginate_links = paginate_links(array(
            'type' => 'array',
            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format' => '?paged=%#%',
            'current' => max(1, get_query_var('paged')),
            'total' => $wp_query->max_num_pages,
            'prev_text' => __('&laquo; Previous', INCEPTIO_THEME_NAME),
            'next_text' => __('Next &raquo;', INCEPTIO_THEME_NAME),
        ));

        if ($max_num_pages == '') {
            global $wp_query;
            $max_num_pages = $wp_query->max_num_pages;
            if (!$max_num_pages) {
                $max_num_pages = 1;
            }
        }
        if (empty($paged)) {
            $paged = 1;
        }
        $prev_page = ($paged - 1 > 0) ? $paged - 1 : -1;
        $next_page = ($paged + 1 <= $max_num_pages) ? $paged + 1 : -1;

        if ($prev_page >= 0 || $next_page >= 0) {
            echo "<nav class=\"page-nav\">\n";
            echo "<span>$page_text $paged $of_text $max_num_pages</span>\n";
            echo "<ul>\n";
            echo "<li><a href=\"" . get_pagenum_link(1) . "\">&laquo; $first_text</a></li>\n";
            foreach ($paginate_links as $link) {
                $link = str_replace('<span', '<li', $link);
                $link = str_replace('</span>', '</li>', $link);
                $link = str_replace('<a', '<li><a', $link);
                $link = str_replace('</a>', '</a></li>', $link);
                echo $link;
            }
            echo "<li><a href=\"" . get_pagenum_link($max_num_pages) . "\">$last_text &raquo;</a></li>\n";
            echo "</ul>\n";
            echo "</nav>\n";
        }

    }
}

if (!function_exists('inc_is_captcha_code_valid')) {
    function inc_is_captcha_code_valid()
    {
        if (inc_is_captcha_plugin_activated()) {
            global $recaptcha;
            $resp = $recaptcha->validate_recaptcha_response(new WP_Error());
            $error_codes = $resp->get_error_codes();
            return empty($error_codes);
        } else {
            return false;
        }
    }
}

function inc_html2rgb($color)
{
    if ($color[0] == '#') {
        $color = substr($color, 1);
    }
    if (strlen($color) == 6) {
        list($r, $g, $b) = array($color[0] . $color[1],
            $color[2] . $color[3],
            $color[4] . $color[5]);
    } elseif (strlen($color) == 3) {
        list($r, $g, $b) = array($color[0] . $color[0],
            $color[1] . $color[1],
            $color[2] . $color[2]);
    } else {
        return false;
    }

    $r = hexdec($r);
    $g = hexdec($g);
    $b = hexdec($b);

    return array($r, $g, $b);
}

if (!function_exists('get_real_post_ID')) {
    function get_real_post_ID($post_id = null)
    {
        global $post;
        if ($post_id == null && isset($post)) {
            $post_id = get_the_ID();
            global $wp_query;
            if (isset($wp_query) && $wp_query && is_object($wp_query) && method_exists($wp_query, 'get_queried_object')) {
                $queried_object = $wp_query->get_queried_object();
                if (isset($queried_object) && $queried_object && is_object($queried_object) &&
                    property_exists($queried_object, 'ID') && $queried_object->ID
                ) {
                    $real_post_id = $queried_object->ID;
                    if ($post_id != $real_post_id) {
                        $post_id = $real_post_id;
                    }
                }
            }
        }

        return $post_id;
    }
}