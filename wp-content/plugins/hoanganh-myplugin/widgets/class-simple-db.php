<?php

class Simple_Db {
    public function __construct() {
        add_action('wp_dashboard_setup', array($this, 'hoanganh_mp_wg_db'));
    }

    function hoanganh_mp_wg_db() {
        wp_add_dashboard_widget('hoanganh_mp_wg_db_simple', 'My plugin information', array($this, 'ordering'));
    }

    function hoanganh_mp_wg_db_simple_display() {
        $arrquery = array('author' => 1);

        $wp_query = new WP_Query(array( 'tag' => 'funny+football' ));

        echo '<pre>';
        print_r($wp_query);
        echo '</pre>';

        //        $link_post = '#';
        //        if ($wp_query->have_posts()) {
        //            while ($wp_query->have_posts()) {
        //                $wp_query->the_post();
        //                $link_post = admin_url('post.php?post=' . get_the_ID() . '&action=edit');
        //                echo '<li><a href="' . $link_post . '">' . get_the_title() . '</a></li>';
        //            }
        //        } else {
        //            echo '<p>' . translate('No post found') . '</p>';
        //        }
        //        wp_reset_postdata();
    }

    public function ordering() {
        $wpQuery = new WP_Query(  array ( 'orderby' => 'post_title', 'posts_per_page' => '5' ));

        if($wpQuery->have_posts()){
            echo '<ul>';
            while ($wpQuery->have_posts()){
                $wpQuery->the_post();
                echo '<li>' . get_the_ID() . ' - ' . get_the_title() . '</li>';

            }
            echo '</ul>';
        }else{
            echo '<p>' . translate('No post found') . '</p>';
        }
    }
}