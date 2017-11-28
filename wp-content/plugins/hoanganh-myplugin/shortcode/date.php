<?php

class Hoanganh_mp_Sc_Date {
    public function __construct() {
        add_shortcode('hoanganh_mp_sc_date', array($this, 'show'));
    }

    public function show() {
        $post = get_post();
        the_ID();
        if (has_shortcode($post->post_content, 'hoanganh_mp_sc_date')) {
            wp_enqueue_style('hoanganh_sc_css', HOANGANH_MP_CSS_URL . 'abc.css', array(), '1.0');
        }

        $str = '<div class="hoanganh_sc_css">' . date('l jS \of F Y h:i:s A') . '</div>';

        return $str;
    }
}