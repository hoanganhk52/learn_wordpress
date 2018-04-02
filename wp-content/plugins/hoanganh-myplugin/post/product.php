<?php

class Hoangnh_mp_cp_product {
	public function __construct() {
		add_action('init', array($this, 'create'));
	}

	public function create () {
		$labels = array(
			'name' => 'Products',
			'singular_name' => 'product',
			'menu_name' => 'Products',
			'name_admin_bar' => 'Product',
			'add_new' => 'Add new product',
			'add_new_item' => 'Add new product'

		);
		$args = array(
			'labels' => $labels,
			'description' => '',
			'public' => true
		);
		register_post_type('product', $args);
	}
}