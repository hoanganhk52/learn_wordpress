<?php

class Hoanganh_Ajax_Taps {
	private $_menu_slug = 'hoanganh-mp-st-tabs';

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'setting_menu' ) );
		add_action('wp_ajax_hoanganh_load_content', array($this, 'hoanganh_load_content'));
	}

	public function setting_menu() {
		if (isset($_GET['page']) && $_GET['page'] == 'hoanganh-mp-st-tabs') {
			add_action('admin_enqueue_scripts', array($this, 'add_js_file'));
			add_action('admin_enqueue_scripts', array($this, 'add_css_file'));
		}

		add_menu_page( 'My tabs tittle', 'My Tabs', 'manage_options', $this->_menu_slug, array(
			$this,
			'display'
		) );
	}

	public function display() {
		require_once HOANGANH_MP_VIEW_PATH . 'tabs_page.php';
	}

	public function main_section_view() {

	}

	public function hoanganh_load_content () {
		echo 'hahahahahahaha';
		die;
	}

	public function add_js_file () {
		wp_register_script($this->_menu_slug, HOANGANH_MP_JS_URL . 'tabs.js', array('jquery'), '1.0');
		wp_enqueue_script($this->_menu_slug);
	}

	public function add_css_file () {
		wp_register_style($this->_menu_slug, HOANGANH_MP_CSS_URL . 'tabs.css', array(), '1.0');
		wp_enqueue_style($this->_menu_slug);
	}
}