<?php

/*
Plugin Name: hoanganh-myplugin
Plugin URI: http://wordpress.org
Description: tim hieu plugin
Author: Hoang Anh
Version: 1.0
Author URI: http://24h.com.vn
*/

define('HOANGANH_MP_PLUGIN_URL', plugin_dir_url(__FILE__));
define('HOANGANH_MP_CSS_URL', HOANGANH_MP_PLUGIN_URL . 'css/');
define('HOANGANH_MP_JS_URL', HOANGANH_MP_PLUGIN_URL . 'js/');
define('HOANGANH_MP_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('HOANGANH_MP_INCLUDE_PATH', HOANGANH_MP_PLUGIN_PATH . '/includes/');
define('HOANGANH_MP_WIDGET_PATH', HOANGANH_MP_PLUGIN_PATH . '/widgets/');
define('HOANGANH_MP_SHORTCODE_PATH', HOANGANH_MP_PLUGIN_PATH . '/shortcode/');
define('HOANGANH_MP_METABOX_PATH', HOANGANH_MP_PLUGIN_PATH . '/metabox/');

if (!is_admin()) {
    require_once HOANGANH_MP_PLUGIN_PATH . 'public.php';
    $hoanganh_mp = new HoanganhMp();
    $hoanganh_mp->init();
} else {
    require_once HOANGANH_MP_INCLUDE_PATH . 'html.php';
    require_once HOANGANH_MP_PLUGIN_PATH . 'admin.php';
//    require_once HOANGANH_MP_WIDGET_PATH . 'class-simple-db.php';
    new HoanganhMpAdmin();
//    new Simple_Db();

    require_once HOANGANH_MP_METABOX_PATH . 'main.php';
    new Hoanganh_Mp_Metabox_Main();
}

//require_once HOANGANH_MP_WIDGET_PATH . 'simple.php';
//
//add_action('widgets_init', 'hoanganh_mp_widget_simple');
//function hoanganh_mp_widget_simple() {
//    register_widget('Hoanganh_Mp_Widget_simple');
//}

//add_action('widgets_init', 'hoanganh_mp_widget_simple_remove');
//function hoanganh_mp_widget_simple_remove() {
//    unregister_widget('Hoanganh_Mp_Widget_simple');
//}

//require_once HOANGANH_MP_WIDGET_PATH . 'class-last-post.php';
//
//function last_post_widget_init() {
//    register_widget('Hoanganh_Mp_Widget_Last_Post');
//}
//
//add_action('widgets_init', 'last_post_widget_init');
//
//
//
//require_once HOANGANH_MP_SHORTCODE_PATH . 'main.php';
//new Hoanganh_Mp_Sc_Main();


