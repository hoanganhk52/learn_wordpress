<?php

class Hoanganh_Mp_Sc_Main {

    private $_shortcode_name = 'hoanganh_mp_sc_options';
    private $_shortcode_option = array();

    public function __construct() {
        $default_option = array(
            'hoanganh_mp_sc_date' => true,
            'hoanganh_mp_sc_title' => true
        );
        $this->_shortcode_option = get_option($this->_shortcode_name, $default_option);
        $this->date();
        $this->title();
//        add_action('the_content', array($this, 'sdfsdfdsf'));
        add_action('the_content', array($this, 'get_shortcode_regex'));
    }

    public function date() {
        if ($this->_shortcode_option['hoanganh_mp_sc_date']) {
            require_once HOANGANH_MP_SHORTCODE_PATH . 'date.php';
            new Hoanganh_mp_Sc_Date();
        } else {
            remove_shortcode('hoanganh_mp_sc_date');
            add_shortcode('hoanganh_mp_sc_date', '__return_false');
        }
    }

    public function title() {
        if ($this->_shortcode_option['hoanganh_mp_sc_title']) {
            require_once HOANGANH_MP_SHORTCODE_PATH . 'title.php';
            new Hoanganh_mp_Sc_Title();
        } else {
            remove_shortcode('hoanganh_mp_sc_title');
            add_shortcode('hoanganh_mp_sc_title', '__return_false');
        }
    }

    public function sdfsdfdsf($abc) { //remove shortcode
        echo $abc;
        $abc = strip_shortcodes($abc);

        return $abc;
    }

    public function get_shortcode_regex($content) {
        $pattern = '/' . get_shortcode_regex() . '/s';
        preg_match_all($pattern, $content, $match);
        if (array_key_exists(2, $match)) {
            echo '<pre>';
            print_r($match[2]);
            echo '</pre>';
        }

        return $content;
    }
}
