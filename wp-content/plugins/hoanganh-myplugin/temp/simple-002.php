<?php

class Hoanganh_Mp_Widget_simple extends WP_Widget {
    public function __construct() {
        $id_base = 'hoanganh-mp-widget-simple';
        $name = 'ABC Simple widget';
        $widget_options = array('classname' => 'hoanganh-mp-wg-css-simple', 'description' => 'day la 1 widget don gian');
        $control_options = array('width' => '250px');

        parent::__construct($id_base, $name, $widget_options, $control_options);

        add_action('wp_enqueue_scripts', array($this, 'add_file_css_2'));
    }

    public function widget($args, $instance) {
        extract($args);

        $title = apply_filters('widget_title', $instance['title']);
        $title = (!empty($title)) ? $title : 'ABC Simple widget';
        $movie = (!empty($instance['movie'])) ? $instance['movie'] : '&nbsp;';
        $css = (!empty($instance['css'])) ? $instance['css'] : '';
        $class_name = $this->widget_options['classname'];

        $before_widget = str_replace($class_name, $class_name . ' ' .$css, $before_widget);

        echo $before_widget;
        echo $before_title . $title. $after_title;
        echo '<ul>';
        echo '<li>My favorite movie: ' . $movie . '</li>';
        echo '</ul>';
        echo $after_widget;
    }

    public function form($instance) {
        $html_obj = new ZendvnHtml();

        //create title input
        $input_name = $this->get_field_name('title');
        $input_id = $this->get_field_id('title');
        $input_value = $instance['title'];
        $arrParam = array('class' => 'widefat', 'id' => $input_id, 'value' => $input_value);
        echo '<p><label for="' . $input_id . '">' . translate('Title:') . '</label>' . $html_obj->textbox($input_name, $input_value, $arrParam) . '</p>';

        //create movie input
        $input_name = $this->get_field_name('movie');
        $input_id = $this->get_field_id('movie');
        $input_value = $instance['movie'];
        $arrParam = array('class' => 'widefat', 'id' => $input_id, 'value' => $input_value);
        echo '<p><label for="' . $input_id . '">' . translate('Movie:') . '</label>' . $html_obj->textbox($input_name, $input_value, $arrParam) . '</p>';

        //create css class
        $input_name = $this->get_field_name('css');
        $input_id = $this->get_field_id('css');
        $input_value = $instance['css'];
        $arrParam = array('class' => 'widefat', 'id' => $input_id, 'value' => $input_value);
        echo '<p><label for="' . $input_id . '">' . translate('Css class:') . '</label>' . $html_obj->textbox($input_name, $input_value, $arrParam) . '</p>';
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title']  = strip_tags($new_instance['title']);
        $instance['movie']  = strip_tags($new_instance['movie']);
        $instance['css']    = strip_tags($new_instance['css']);

        return $instance;
    }

    public function add_file_css_2() {
        wp_register_style('wg-simple-03', HOANGANH_MP_CSS_URL . 'wp-simple-03.css', array(), '1.0', 'all');
        wp_enqueue_style('wg-simple-03');
    }
}