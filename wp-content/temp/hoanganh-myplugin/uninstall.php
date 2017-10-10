<?php

defined('WP_UNINSTALL_PLUGIN') || exit();

function hoanganh_mp_uninstall() {
    global $wpdb;
    //OPTION API
    delete_option('zendvn_mp_options');
    delete_option('zendvn_mp_version');

    $table_name =  $wpdb->prefix . 'hoanganh_mp_test';
    $sql = 'DROP TABLE IF EXISTS ' . $table_name;
    $wpdb->query($sql);
}

hoanganh_mp_uninstall();