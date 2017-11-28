<?php

class Hoanganh_Mp_Mb_Media {

    private $_metabox_id = 'hoanganh-mp-mb-media';
    private $_prefix_key = '_hoanganh_mp_mb_media_';
    private $_prefix_input = 'hoanganh-mp-mb-media-';

    public function __construct() {
        add_action('add_meta_boxes', array($this, 'create'));
        add_action('save_post', array($this, 'save'));
//        echo __METHOD__;
    }

    public function create() {
        add_action('admin_enqueue_scripts', array($this, 'add_css'));
        add_action('admin_enqueue_scripts', array($this, 'add_js_file'));
        add_meta_box($this->_metabox_id, 'My media', array($this, 'display'), 'post');
    }

    public function display($post) {
        $html_obj = new ZendvnHtml();

        wp_nonce_field($this->_metabox_id, $this->_metabox_id . '-nonce');

        echo '<div class="hoanganh-mb-wrap">';
        echo '<p><b><i>Welcome to my media</i></b></p>';

        //create button
        $input_name  = $this->create_input_name('button');
        $input_id    = $this->create_input_name('button');
        $input_value = translate('Media Library play');
        $options = array('type' => 'button');
        $arrParam    = array(
            'class' => 'button-secondary',
            'id' => $input_id,
        );
        $btn = $html_obj->button($input_name, $input_value, $arrParam, $options);

        //create price input
        $input_name  = $this->create_input_name('file');
        $input_id    = $this->create_input_name('file');
        $input_value = get_post_meta($post->ID, $this->create_input_id('file'), true) ? get_post_meta($post->ID, $this->create_input_id('file'), true) : '';
        $arrParam    = array(
            'size' => '30',
            'id' => $input_id,
            'value' => $input_value
        );
        echo '<p><label for="' . $input_id . '">' . translate('File :') . '</label>' . $html_obj->textbox($input_name, $input_value, $arrParam) . $btn . '</p>';

        echo    "<script>
                    jQuery(document).ready(function(){
                        jQuery('#{$this->create_input_name('button')}').hoanganhBtnMedia('{$this->create_input_name('file')}');
                    });
                </script>";
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
            'file' => esc_url($_POST[$this->create_input_name('file')])
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

    public function add_js_file() {
        wp_register_script('hoanganh_mp_mb_btn_media', HOANGANH_MP_JS_URL . 'hoanganh-media-button.js', array('jquery', 'media-upload', 'thickbox'), '1.0');
        wp_enqueue_script('hoanganh_mp_mb_btn_media');
    }
}