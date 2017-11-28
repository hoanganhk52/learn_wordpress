<?php

class Hoanganh_mp_Sc_Title {
    public function __construct() {
        add_shortcode('hoanganh_mp_sc_title', array(
            $this,
            'show'
        ));
    }

    public function show($attr) {
        extract($attr);
        $html = '';
        $ids  = explode(',', $ids);
        $list = '';

        if (is_single()) {
            if (count($ids) > 0) {
                $list .= '<p><b><i>' . $title . '</i></b></p>';
                $args = array(
                    'post_type' => 'post',
                    'post__in' => $ids,
                    'post_status' => 'publish',
                    'ignore_sticky_note'
                );

                $wp_query = new WP_Query($args);

                if ($wp_query->have_posts()) {
                    $list .= '<ul>';

                    while ($wp_query->have_posts()) {
                        $wp_query->the_post();
                        $link = $wp_query->post->guid;
                        $list .= '<li><a href="' . $link . '">' . get_the_title() . '</a></li>';
                    }

                    $list .= '</ul>';
                }
            }
        }

        return $list;
    }
}