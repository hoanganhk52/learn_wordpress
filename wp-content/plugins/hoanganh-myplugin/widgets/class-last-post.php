<?php

class Hoanganh_Mp_Widget_Last_Post extends WP_Widget {

    private $_cache_name = 'hoanganh_mp_wg_last_post_caching';

    public function __construct() {
        $id_base         = 'hoanganh-mp-widget-last-post';
        $name            = 'Abc last post';
        $widget_options  = array(
            'classname' => 'hoanganh-mp-wg-css-last-post',
            'description' => 'Hien thi nhung bai viet moi nhat'
        );
        $control_options = array('width' => '250px');

        parent::__construct($id_base, $name, $widget_options, $control_options);
    }


    public function widget($args, $instance) {
        echo '<h1>' . 'Last posts' . '</h1>';
        extract($args);

        $title = apply_filters('widget_title', $instance['title']);
        $title = (!empty($title)) ? $title : 'ABC Simple widget';
        $format = (!empty($instance['format'])) ? $instance['format'] : 'standard';
        $items = (!empty($instance['items'])) ? $instance['items'] : 5;
        $odering= (!empty($instance['odering'])) ? $instance['odering'] : 'asc';
        $tax_query = array();

        $cache = get_transient($this->_cache_name);

        if (!$cache) {
            echo '<br/> Khong su dung cache';
            $arguments = array(
                'post_type' => 'post',
                'order' => $odering,
                'orderby' => 'ID',
                'posts_per_page' => $items,
                'post_status' => 'publish',
                'ignore_sticky_posts' => true
            );

            if ($format != 'standard') {
                $tax_query = array(
                    array(
                        'field' => 'slug',
                        'terms' => 'post-format-' . $format,
                        'taxonomy' => 'post_format',
                        'operator' => 'In'
                    )
                );
            }

            $arguments['tax_query'] = $tax_query;

            $wp_query = new WP_Query($arguments);

            set_transient($this->_cache_name, $wp_query, 60);
        } else {
            echo '<br/> Su dung cache';
            $wp_query = $cache;
        }

        if ($wp_query->have_posts()) {
            echo '<ul>';
            while ($wp_query->have_posts()) {
                $wp_query->the_post();
                $link = $wp_query->post->guid;
                echo '<li><a href="' . $link . '">' . get_the_title() . '</a></li>';
            }
            echo '</ul>';
        }
        wp_reset_postdata();

//        echo do_shortcode('[hoanganh_mp_sc_date]');
//        echo do_shortcode("[hoanganh_mp_sc_title ids='36,33' title='những bài viết liên quan đến post 3']");
        $attr = array(
            'src'      => 'http://localhost/Cham-Khe-Tim-Anh-Mot-Chut-Thoi-Noo-Phuoc-Thinh.mp3',
            'loop'     => '',
            'autoplay' => '',
            'preload' => 'none'
        );
        echo wp_audio_shortcode( $attr );


    }

    public function form($instance) {
        $html_obj = new ZendvnHtml();

        //create title input
        $input_name  = $this->get_field_name('title');
        $input_id    = $this->get_field_id('title');
        $input_value = $instance['title'];
        $arrParam    = array(
            'class' => 'widefat',
            'id' => $input_id,
            'value' => $input_value
        );
        echo '<p><label for="' . $input_id . '">' . translate('Title:') . '</label>' . $html_obj->textbox($input_name, $input_value, $arrParam) . '</p>';

        //create post format selecbox
        $formats         = get_theme_support('post-formats');
        $input_name      = $this->get_field_name('format');
        $input_id        = $this->get_field_id('format');
        $input_value     = $instance['format'];
        $arrParam        = array(
            'class' => 'widefat',
            'id' => $input_id,
            'value' => $input_value
        );
        $options['data'] = array(
            'standard' => 'Standard'
        );

        foreach ($formats[0] as $format) {
            $options['data'][strtolower($format)] = ucfirst(strtolower($format));
        }
        echo '<p><label for="' . $input_id . '">' . translate('Format:') . '</label>' . $html_obj->selectbox($input_name, $input_value, $arrParam, $options) . '</p>';

        //create number of items input
        $input_name  = $this->get_field_name('items');
        $input_id    = $this->get_field_id('items');
        $input_value = $instance['items'];
        $arrParam    = array(
            'class' => 'widefat',
            'id' => $input_id,
            'value' => $input_value
        );
        echo '<p><label for="' . $input_id . '">' . translate('Number of items:') . '</label>' . $html_obj->textbox($input_name, $input_value, $arrParam) . '</p>';

        //create odering input
        $input_name      = $this->get_field_name('odering');
        $input_id        = $this->get_field_id('odering');
        $input_value     = $instance['odering'];
        $options['data'] = array(
            'asc' => 'A-Z',
            'desc' => 'Z-A'
        );
        $arrParam        = array(
            'class' => 'widefat',
            'id' => $input_id,
            'value' => $input_value
        );
        echo '<p><label for="' . $input_id . '">' . translate('Odering:') . '</label>' . $html_obj->selectbox($input_name, $input_value, $arrParam, $options) . '</p>';
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['title']   = strip_tags($new_instance['title']);
        $instance['format']  = strip_tags($new_instance['format']);
        $instance['items']   = strip_tags($new_instance['items']);
        $instance['odering'] = strip_tags($new_instance['odering']);
        delete_transient($this->_cache_name);
        return $instance;
    }
}