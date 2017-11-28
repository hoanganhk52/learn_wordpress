<?php

class Hoanganh_Mp_Mb_Editor {

    private $_metabox_id = 'hoanganh-mp-mb-editor';
    private $_prefix_key = '_hoanganh_mp_mb_editor_';
    private $_prefix_input = 'hoanganh-mp-mb-editor';

    public function __construct() {
        add_action('add_meta_boxes', array($this, 'create'));
        add_action('save_post', array($this, 'save'));
    }

    public function create() {
        add_action('admin_enqueue_scripts', array($this, 'add_css'));
        add_meta_box($this->_metabox_id, 'My Editor', array($this, 'display'), 'post');
    }

    public function display($post) {
        $html_obj = new ZendvnHtml();

        wp_nonce_field($this->_metabox_id, $this->_metabox_id . '-nonce');

        echo '<div class="hoanganh-mb-wrap">';
        echo '<p><b><i>Welcome to my editor</i></b></p>';
        $content     = get_post_meta($post->ID, $this->create_input_id('content'), true) ? get_post_meta($post->ID, $this->create_input_id('content'), true) : '';
        $input_id    = $this->create_input_name('content');
        $options     = array(
            'wpautop'             => true,
            'media_buttons'       => true,
            'default_editor'      => '',
            'drag_drop_upload'    => false,
            'textarea_name'       => $input_id,
            'textarea_rows'       => 20,
            'tabindex'            => '',
            'tabfocus_elements'   => ':prev,:next',
            'editor_css'          => '',
            'editor_class'        => '',
            'teeny'               => false,
            'dfw'                 => false,
            '_content_editor_dfw' => false,
            'tinymce'             => true,
            'quicktags'           => true
        );
        echo '<p>';
        wp_editor($content, $input_id, $options);
        echo '</p>';
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
            'content' => wp_filter_post_kses($_POST[$this->create_input_name('content')])
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