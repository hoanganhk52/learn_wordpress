<?php

require_once HOANGANH_MP_PLUGIN_PATH . 'include/include.php';

class HoanganhMpAdmin {

    private $_menuSlug = 'hoanganh-mp-mysetting';
    private $_settingOptions;

    public function __construct() {
        $this->_settingOptions = get_option('hoanganh_mp_name', array());
        add_action('admin_menu', array($this, 'settingMenu'));
        add_action('admin_init', array($this, 'register_setting_and_field'));
    }

    public function settingMenu() {
        add_menu_page('My setting title', 'My setting', 'manage_options', $this->_menuSlug, array($this, 'settingPage'));
    }

    public function settingPage() {
        require_once HOANGANH_MP_PLUGIN_PATH . '/view/setting_page.php';
    }

    public function register_setting_and_field() {
        register_setting('hoanganh_mp_options', 'hoanganh_mp_name', array($this, 'validate_setting')); //gia tri thu 2 la truong` name trong wp_option

        // Main Section
        $mainSection = 'hoanganh_mp_main_section';
        add_settings_section($mainSection, 'Main Setting', array($this, 'main_section_view'), $this->_menuSlug);
        add_settings_field('hoanganh_mp_new_title', 'Site title', array($this, 'new_title_input'), $this->_menuSlug, $mainSection);

        // Exttend Section
        $extSection = 'hoanganh_mp_ext_section';
        add_settings_section($extSection, 'Extend Setting', array($this, 'main_section_view'), $this->_menuSlug);
        add_settings_field('hoanganh_mp_slogan', 'Slogan', array($this, 'slogan_input'), $this->_menuSlug, $extSection);

        // None section
//        add_settings_field('hoanganh_mp_security_code', 'Security code', array($this, 'security_code_input'), $this->_menuSlug, '');
    }

    public function validate_setting($data) {
        update_option('hoanganh_mp_slogan', $_POST['hoanganh_mp_slogan']);
        return $data;
    }

    public function main_section_view() {

    }

    public function new_title_input() {
        echo '<input type="text" name="hoanganh_mp_name[hoanganh_mp_new_title]" value="' . $this->_settingOptions['hoanganh_mp_new_title'] . '"/>';
    }

    public function slogan_input() {
        $value = get_option('hoanganh_mp_slogan', array());
        echo '<input type="text" name="hoanganh_mp_slogan" value="' . $value . '"/>';
    }

    public function security_code_input() {
        echo '<input type="text" name="hoanganh_mp_name[hoanganh_mp_security_code]" value=""/>';
    }
}