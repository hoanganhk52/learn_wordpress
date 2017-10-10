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
define('HOANGANH_MP_PLUGIN_PATH', plugin_dir_path(__FILE__));

if (!is_admin()) {
    require_once HOANGANH_MP_PLUGIN_PATH . 'public.php';
    HoanganhMp::init();
} else {
    require_once HOANGANH_MP_PLUGIN_PATH . 'admin.php';
    new HoanganhMpAdmin();
}
