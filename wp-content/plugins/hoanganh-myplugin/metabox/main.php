<?php

class Hoanganh_Mp_Metabox_Main {

    private $_metaboxname_name = 'hoanganh_mp_mb_options';
    private $_metabox_option = array();

    public function __construct() {
        $default_option = array(
            'hoanganh_mp_mb_simple' => false,
            'hoanganh_mp_mb_data' => false,
            'hoanganh_mp_mb_data2' => true,
            'hoanganh_mp_mb_editor' => false,
            'hoanganh_mp_mb_media' => false
        );
        $this->_metabox_option = get_option($this->_metaboxname_name, $default_option);
        $this->simple();
        $this->data();
        $this->data2();
        $this->editor();
        $this->editor();
        $this->media();
    }

    public function simple() {
        if ($this->_metabox_option['hoanganh_mp_mb_simple']) {
            require_once HOANGANH_MP_METABOX_PATH . 'simple.php';
            new Hoanganh_mp_mb_simple();
        } else {

        }
    }

    public function media() {
        if ($this->_metabox_option['hoanganh_mp_mb_media']) {
            require_once HOANGANH_MP_METABOX_PATH . 'media.php';
            new Hoanganh_Mp_Mb_Media();
        } else {

        }
    }

    public function editor() {
        if ($this->_metabox_option['hoanganh_mp_mb_editor']) {
            require_once HOANGANH_MP_METABOX_PATH . 'editor.php';
            new Hoanganh_Mp_Mb_Editor();
        } else {

        }
    }

    public function data() {
        if ($this->_metabox_option['hoanganh_mp_mb_data']) {
            require_once HOANGANH_MP_METABOX_PATH . 'data.php';
            new Hoanganh_Mp_Mb_Data();
        } else {

        }
    }

    public function data2() {
        if ($this->_metabox_option['hoanganh_mp_mb_data2']) {
            require_once HOANGANH_MP_METABOX_PATH . 'data2.php';
            new Hoanganh_Mp_Mb_Data_2();
        } else {

        }
    }
}