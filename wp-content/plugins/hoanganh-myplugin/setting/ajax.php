<?php

class Hoanganh_Ajax {
	private $_menu_slug = 'hoanganh-mp-st-ajax';
	private $_option_name = 'hoanganh_mp_st_ajax';
	private $_setting_options;

	public function __construct() {
		$this->_setting_options = get_option( $this->_option_name, array() );
		add_action( 'admin_menu', array( $this, 'setting_menu' ) );
		add_action( 'admin_init', array( $this, 'register_setting_and_fields' ) );
	}

	public function setting_menu() {
		add_menu_page( 'My setting tittle', 'My setting', 'manage_options', $this->_menu_slug, array(
			$this,
			'display'
		) );
	}

	public function display() {
		require_once HOANGANH_MP_VIEW_PATH . 'setting_page.php';
	}

	public function register_setting_and_fields() {
		add_action('admin_enqueue_scripts', array($this,'add_js_file'));
		add_action('wp_ajax_hoanganh_check_form', array($this, 'hoanganh_check_form'));

		register_setting( $this->_menu_slug, $this->_option_name, array( $this, 'validate_setting' ) );

		//MAIN SETTING
		$mainSection = 'hoanganh_mp_main_section';
		add_settings_section( $mainSection, "Main setting", array( $this, 'main_section_view' ), $this->_menu_slug );

		add_settings_field( 'hoanganh_mp_title', 'Site title', array(
			$this,
			'create_form'
		), $this->_menu_slug, $mainSection, array( 'name' => 'title' ) );

		//		add_settings_field( 'hoanganh_mp_logo', 'Site logo', array(
		//			$this,
		//			'create_form'
		//		), $this->_menu_slug, $mainSection, array( 'name' => 'logo' ) );
	}

	public function main_section_view() {

	}

	public function hoanganh_check_form () {
		$postVal = $_POST;
		$errors = array();

		if(!empty($postVal['value'])){
			if($this->stringMaxValidate($postVal['value'], 20) == false){
				$errors['hoanganh_mp_st_ajax_title'] = "Chuoi dai qua 20 ky tu";
			}
		}

		$msg = array();
		if(count($errors)>0){
			$msg['status'] = false;
			$msg['errors'] = $errors;
		}else{
			$msg['status'] = true;
		}

		echo json_encode($msg);

		die;
	}

	public function create_form( $args ) {
		$html_obj = new ZendvnHtml();

		if ( $args['name'] == 'title' ) {
			$inputID 	= $this->create_id('title');
			$inputName 	= $this->create_input_name('title');
			$inputValue = isset($this->_setting_options['title']) ? $this->_setting_options['title'] : '';
			$arr 		= array('size' =>'25','id' => $inputID);
			$html 		= $html_obj->textbox($inputName,$inputValue,$arr)
			               . $html_obj->pTag('Nhập vào một chuỗi không quá 20 ký tự',array('class'=>'description'));
			echo $html;
		}

	}

	private function create_id( $val ) {
		return $this->_option_name . "_$val";
	}

	private function create_input_name( $val ) {
		return $this->_option_name . '[' . $val . ']';
	}

	public function validate_setting($data_input){

		//Mang chua cac thong bao loi cua form
		$errors = array();

		if($this->stringMaxValidate($data_input['title'], 20) == false){
			$errors['title'] = "Site title: Chuoi dai qua so ky tu da qui dinh";
		}


		if(count($errors)>0){
			$data_input = $this->_setting_options;
			$strErrors = '';
			foreach ($errors as $key => $val){
				$strErrors .= $val . '<br/>';
			}

			add_settings_error($this->_menu_slug, 'my-setting', $strErrors,'error');
		}else{
			add_settings_error($this->_menu_slug, 'my-setting', 'Cap nhat du lieu thanh cong','updated');
		}
		//die();
		return $data_input;
	}

	private function stringMaxValidate($val, $max){
		$flag = false;

		$str = trim($val);
		if(strlen($str) <= $max){
			$flag = true;
		}

		return $flag;
	}

	public function add_js_file () {
		wp_register_script($this->_menu_slug, HOANGANH_MP_JS_URL . 'ajax.js', array('jquery'), '1.0');
		wp_enqueue_script($this->_menu_slug);
	}
}