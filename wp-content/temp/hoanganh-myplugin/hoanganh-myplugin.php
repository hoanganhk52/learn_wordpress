<?php

/*
Plugin Name: hoanganh-myplugin
Plugin URI: http://wordpress.org
Description: tim hieu plugin
Author: Hoang Anh
Version: 1.0
Author URI: http://24h.com.vn
*/

register_activation_hook(__FILE__, 'hoanganh_mp_active');

function hoanganh_mp_active() {
    global $wpdb;

    $zendvn_mp_options = array(
        'course' 	=> 'Wordpress Pro',
        'author' 	=> 'ZendVN group',
        'website' 	=> 'www.zend.vn'
    );

    add_option("zendvn_mp_options",$zendvn_mp_options,'','yes');

    $zendvn_mp_version = "1.0";

    add_option("zendvn_mp_version",$zendvn_mp_version,'','yes');

    $wpdb->update(
        $wpdb->prefix . 'options',
        array('autoload' => 'yes'),
        array('option_name' => 'hoanganh_mp_options')
    );

    $table_name = $wpdb->prefix . "hoanganh_mp_test";

    if ($wpdb->get_var("SHOW TABLES LIKE '" . $table_name . "'") != $table_name) {
        $sql = "CREATE TABLE `" . $table_name . "` (
		`myid` tinyint(4) unsigned NOT NULL AUTO_INCREMENT,
		`my_name` varchar(50) DEFAULT NULL,
		PRIMARY KEY (`myid`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta($sql);
    }
}

register_deactivation_hook(__FILE__, 'hoanganh_mp_deactive');

function hoanganh_mp_deactive(){
    global $wpdb;
    $table_name = $wpdb->prefix . "options";
    $wpdb->update(
        $table_name,
        array('autoload'=>'no'),
        array('option_name'=>'hoanganh_mp_options'),
        array('%s'),
        array('%s')
    );

}
