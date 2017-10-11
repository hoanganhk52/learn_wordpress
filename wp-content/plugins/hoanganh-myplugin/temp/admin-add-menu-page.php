<?php

require_once HOANGANH_MP_PLUGIN_PATH . 'includes/support.php';

class HoanganhMpAdmin {

    private $_menuSlug = 'hoanganh-mp-mysetting';
    private $_settingOptions;

    public function __construct() {
        $this->_settingOptions = get_option('hoanganh_mp_name', array());
        add_action('admin_menu', array($this, 'settingMenu'));
        add_action('admin_init', array($this, 'register_setting_and_field'));
    }

    public function settingMenu() {
//        add_options_page('My setting title', 'My setting', 'manage_options', $this->_menuSlug, array($this, 'settingPage'));
        add_menu_page('My Setting title', 'My Setting', 'manage_options', $this->_menuSlug, array($this, 'settingPage'));
    }

    public function settingPage() {
        require_once HOANGANH_MP_PLUGIN_PATH . '/view/setting_page.php';
    }

    public function register_setting_and_field() {
        register_setting('hoanganh_mp_options', 'hoanganh_mp_name', array($this, 'validate_setting')); //gia tri thu 2 la truong` name trong wp_option

        // Main Section
        $mainSection = 'hoanganh_mp_main_section';
        add_settings_section($mainSection, 'Main Setting', array($this, 'main_section_view'), $this->_menuSlug);
        add_settings_field('hoanganh_mp_new_title', 'Site title', array($this, 'creat_form_element'), $this->_menuSlug, $mainSection, array('name' => 'new_title_input'));
        add_settings_field('hoanganh_mp_logo', 'Logo', array($this, 'creat_form_element'), $this->_menuSlug, $mainSection, array('name' => 'logo_input'));
        $tmp = get_settings_errors($this->_menuSlug);
    }

    public function validate_setting($data) {
        $errors = array();

        if (!$this->stringValidate($data['hoanganh_mp_new_title'])) {
            $errors['hoanganh_mp_new_title'] = 'Tiêu đề không được vượt quá 20 ký tự';
        }

        if (!empty($_FILES['hoanganh_mp_logo']['name'])) {
            if (!$this->fileExtensionValidate($_FILES['hoanganh_mp_logo']['name'], 'JPG|PNG|GIF')) {
                $errors['hoanganh_mp_logo'] = 'Phần mở rộng của logo không đúng quy định';
            } else {
                if (!empty($this->_settingOptions['hoanganh_mp_logo']['file'])) {
                    unlink($this->_settingOptions['hoanganh_mp_logo']['file']);
                }

                $overrides = array('test_form' => false);
                $data['hoanganh_mp_logo'] = wp_handle_upload($_FILES['hoanganh_mp_logo'], $overrides);
            }
        } else {
            $data['hoanganh_mp_logo'] = $this->_settingOptions['hoanganh_mp_logo'];
        }

        if (count($errors) > 0) {
            $data = $this->_settingOptions;
            $strErrors = implode('<br/>', $errors);
            add_settings_error($this->_menuSlug, 'my_setting', $strErrors, 'error');
        } else {
            add_settings_error($this->_menuSlug, 'my_setting', 'Cập nhật thành công', 'updated');
        }

        return $data;
    }

    public function main_section_view() {

    }

    public function creat_form_element($array) {
        $htmlObj = new ZendvnHtml();
        switch ($array['name']) {
            case 'new_title_input':
                $name = 'hoanganh_mp_name[hoanganh_mp_new_title]';
                $value = $this->_settingOptions['hoanganh_mp_new_title'];
                echo $htmlObj->textbox($name, $value);
                echo '<p class="description">nhập tối đa 20 ký tự</p>';
                break;
            case 'logo_input':
                $name = 'hoanganh_mp_logo';
                echo $htmlObj->fileupload($name);
                echo '<p class="description">chỉ chấp nhận phần mở rộng: JPG, PNG, GIF</p>';
                if (!empty($this->_settingOptions['hoanganh_mp_logo']['url'])) {
                    echo '<br/><img src="' . $this->_settingOptions['hoanganh_mp_logo']['url'] . '" width="200px">';
                }
                break;
        }
    }

    private function stringValidate($str, $length = 20) {
        if (is_string($str)) {
            $str = trim($str);
            if (strlen($str) <= $length) {
                return true;
            }
        }
        return false;
    }

    private function fileExtensionValidate($file_name, $file_type) {
        $flag = false;

        $pattern = '/^.*\.(' . strtolower($file_type) . ')$/i'; //$file_type = JPG|PNG|GIF
        if (preg_match($pattern, strtolower($file_name)) == 1) {
            $flag = true;
        }

        return $flag;
    }
}