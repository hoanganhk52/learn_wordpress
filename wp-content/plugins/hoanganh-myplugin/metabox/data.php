<?php

class Hoanganh_Mp_Mb_Data {

    public function __construct() {
        add_action('add_meta_boxes', array($this, 'create'));
        add_action('save_post', array($this, 'save'));
    }

    public function create() {
        add_action('admin_enqueue_scripts', array($this, 'add_css'));
        add_meta_box('hoanganh-mp-mb-data', 'My Data', array($this, 'display'), 'post');
    }

    public function display($post) {
        echo '<pre>';
        print_r($post);
        echo '</pre>';
        $html_obj = new ZendvnHtml();

        echo '<div class="hoanganh-mb-wrap">';
        echo '<p><b><i>Welcome to my metabox</i></b></p>';
        //create price input
        $input_name  = 'hoanganh-mp-mb-data-price';
        $input_id    = 'hoanganh-mp-mb-data-price';
        $input_value = get_post_meta($post->ID, '_hoanganh_mp_mb_data_price', true) ? get_post_meta($post->ID, '_hoanganh_mp_mb_data_price', true) : '';
        $arrParam    = array(
            'size' => '30',
            'id' => $input_id,
            'value' => $input_value
        );
        echo '<p><label for="' . $input_id . '">' . translate('Price:') . '</label>' . $html_obj->textbox($input_name, $input_value, $arrParam) . '</p>';

        //create author input
        $input_name  = 'hoanganh-mp-mb-data-author';
        $input_id    = 'hoanganh-mp-mb-data-author';
        $input_value = get_post_meta($post->ID, '_hoanganh_mp_mb_data_author', true) ? get_post_meta($post->ID, '_hoanganh_mp_mb_data_author', true) : '';
        $arrParam    = array(
            'size' => '30',
            'id' => $input_id,
            'value' => $input_value
        );
        echo '<p><label for="' . $input_id . '">' . translate('Author:') . '</label>' . $html_obj->textbox($input_name, $input_value, $arrParam) . '</p>';

        //create level selectbox
        $input_name  = 'hoanganh-mp-mb-data-level';
        $input_id    = 'hoanganh-mp-mb-data-level';
        $input_value = get_post_meta($post->ID, '_hoanganh_mp_mb_data_level', true) ? get_post_meta($post->ID, '_hoanganh_mp_mb_data_level', true) : '';
        $arrParam    = array(
            'id' => $input_id,
        );
        $options['data'] = array(
            'beginner' => translate('Beginer'),
            'intermediate' => translate('Intermediate'),
            'advanced' => translate('Advanced')
        );
        echo '<p><label for="' . $input_id . '">' . translate('Level:') . '</label>' . $html_obj->selectbox($input_name, $input_value, $arrParam, $options) . '</p>';

        //create profile area
        $input_name  = 'hoanganh-mp-mb-data-profile';
        $input_id    = 'hoanganh-mp-mb-data-profile';
        $input_value = get_post_meta($post->ID, '_hoanganh_mp_mb_data_profile', true) ? get_post_meta($post->ID, '_hoanganh_mp_mb_data_profile', true) : '';
        $arrParam    = array(
            'rows' => 6,
            'cols' => 60,
            'id' => $input_id,
        );
        echo '<p><label for="' . $input_id . '">' . translate('Profile:') . '</label>' . $html_obj->textarea($input_name, $input_value, $arrParam) . '</p>';
        echo '</div>';
    }

    public function add_css() {
        wp_register_style('hoanganh_mp_mb_data', HOANGANH_MP_CSS_URL . 'mb-data.css', array(), '1.0');
        wp_enqueue_style('hoanganh_mp_mb_data');
    }

    public function save($post_id) {
        update_post_meta($post_id, '_hoanganh_mp_mb_data_price', sanitize_text_field($_POST['hoanganh-mp-mb-data-price']));
        update_post_meta($post_id, '_hoanganh_mp_mb_data_author', sanitize_text_field($_POST['hoanganh-mp-mb-data-author']));
        update_post_meta($post_id, '_hoanganh_mp_mb_data_level', sanitize_text_field($_POST['hoanganh-mp-mb-data-level']));
        update_post_meta($post_id, '_hoanganh_mp_mb_data_profile', strip_tags($_POST['hoanganh-mp-mb-data-profile']));
    }
}