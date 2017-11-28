<?php

class Hoanganh_Mp_Mb_Data_2 {

    private $_metabox_id = 'hoanganh-mp-mb-data2';
    private $_prefix_key = '_hoanganh_mp_mb_data2_';
    private $_prefix_input = 'hoanganh-mp-mb-data2';

    public function __construct() {
        add_action('add_meta_boxes', array($this, 'create'));
        add_action('save_post', array($this, 'save'));
    }

    public function create() {
        add_action('admin_enqueue_scripts', array($this, 'add_css'));
        add_meta_box($this->_metabox_id, 'My Data', array($this, 'display'), 'post');
    }

    public function display($post) {
        $html_obj = new ZendvnHtml();

        wp_nonce_field($this->_metabox_id, $this->_metabox_id . '-nonce');

        echo '<div class="hoanganh-mb-wrap">';
        echo '<p><b><i>Welcome to my metabox</i></b></p>';
        //create price input
        $input_name  = $this->create_input_name('price');
        $input_id    = $this->create_input_name('price');
        $input_value = get_post_meta($post->ID, $this->create_input_id('price'), true) ? get_post_meta($post->ID, $this->create_input_id('price'), true) : '';
        $arrParam    = array(
            'size' => '30',
            'id' => $input_id,
            'value' => $input_value
        );
        echo '<p><label for="' . $input_id . '">' . translate('Price:') . '</label>' . $html_obj->textbox($input_name, $input_value, $arrParam) . '</p>';

        //create author input
        $input_name  = $this->create_input_name('author');
        $input_id    = $this->create_input_name('author');
        $input_value = get_post_meta($post->ID, $this->create_input_id('author'), true) ? get_post_meta($post->ID, $this->create_input_id('author'), true) : '';
        $arrParam    = array(
            'size' => '30',
            'id' => $input_id,
            'value' => $input_value
        );
        echo '<p><label for="' . $input_id . '">' . translate('Author:') . '</label>' . $html_obj->textbox($input_name, $input_value, $arrParam) . '</p>';

        //create level selectbox
        $input_name  = $this->create_input_name('level');
        $input_id    = $this->create_input_name('level');
        $input_value = get_post_meta($post->ID, $this->create_input_id('level'), true) ? get_post_meta($post->ID, $this->create_input_id('level'), true) : '';
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
        $input_name  = $this->create_input_name('profile');
        $input_id    = $this->create_input_name('profile');
        $input_value = get_post_meta($post->ID, $this->create_input_id('profile'), true) ? get_post_meta($post->ID, $this->create_input_id('profile'), true) : '';
        $arrParam    = array(
            'rows' => 6,
            'cols' => 60,
            'id' => $input_id,
        );
        echo '<p><label for="' . $input_id . '">' . translate('Profile:') . '</label>' . $html_obj->textarea($input_name, $input_value, $arrParam) . '</p>';
        echo '</div>';
    }

    public function add_css() {
        wp_register_style($this->_metabox_id, HOANGANH_MP_CSS_URL . 'mb-data.css', array(), '1.0');
        wp_enqueue_style($this->_metabox_id);
    }

    public function save($post_id) {
        if (!isset($_POST[$this->_metabox_id . '-nonce'])) return $post_id;
        if (!wp_verify_nonce($_POST[$this->_metabox_id . '-nonce'], $this->_metabox_id)) return $post_id;
        if (defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE) return $post_id;
        if (!current_user_can('edit_post', $post_id)) return $post_id;

        $datas = array(
            'price' => sanitize_text_field($_POST[$this->create_input_name('price')]),
            'author' => sanitize_text_field($_POST[$this->create_input_name('author')]),
            'level' => sanitize_text_field($_POST[$this->create_input_name('level')]),
            'profile' => strip_tags($_POST[$this->create_input_name('profile')])
        );

        foreach ($datas as $key => $value) {
            update_post_meta($post_id, $this->create_input_id($key), $value);
        }

        return $post_id;
    }

    private function create_input_id($field) {
        return $this->_prefix_key . $field;
    }

    private function create_input_name($field) {
        return $this->_prefix_input . $field;
    }
}