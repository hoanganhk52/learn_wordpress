<?php

class Hoanganh_mp_mb_simple {

    public function __construct() {
        add_action('add_meta_boxes', array($this, 'create'));
    }

    public function create() {
        add_meta_box('hoanganh_mp_mb_simple', 'My Custom Meta Box', array($this, 'display'), 'post');
    }

    public function display() {
        echo 'metabox';
    }
}