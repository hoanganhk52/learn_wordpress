<?php
//<script type='text/javascript' src='http://localhost/wordpress/wp-content/themes/zendvn/js/jquery/jquery.js'></script>
//<script type='text/javascript' src='http://localhost/wordpress/wp-content/themes/zendvn/js/jquery/jquery-migrate.min.js'></script>
//<script type='text/javascript' src='http://localhost/wordpress/wp-content/themes/zendvn/js/jquery.form.min.js'></script>
//<script type='text/javascript' src='http://localhost/wordpress/wp-content/themes/zendvn/js/scripts.js'></script>
//<script type='text/javascript' src='http://localhost/wordpress/wp-content/themes/zendvn/js/plugins.js'></script>
//<script type='text/javascript'>
//    /*           */
//    var wpexLocalize = {
//    "mobileMenuOpen": "Browse Categories",
//        "mobileMenuClosed": "Close navigation",
//        "homeSlideshow": "false",
//        "homeSlideshowSpeed": "7000",
//        "UsernamePlaceholder": "Username",
//        "PasswordPlaceholder": "Password",
//        "enableFitvids": "true"
//    };
//    /*     */
//</script>
//<script type='text/javascript' src='http://localhost/wordpress/wp-content/themes/zendvn/js/global.js'></script>

// 2. add js
add_action('wp_enqueue_scripts', 'zendvn_theme_register_js');

function zendvn_theme_register_js(){
    $jsUrl = get_template_directory_uri() . '/js';
    wp_register_script('zendvn_theme_jquery_form_min', $jsUrl . '/jquery.form.min.js',array('jquery'),'1.0',true);
    wp_enqueue_script('zendvn_theme_jquery_form_min');

    wp_register_script('zendvn_theme_scripts', $jsUrl . '/scripts.js',array('jquery'),'1.0',true);
    wp_enqueue_script('zendvn_theme_scripts');

    wp_register_script('zendvn_theme_plugins', $jsUrl . '/plugins.js',array('jquery'),'1.0',true);
    wp_enqueue_script('zendvn_theme_plugins');


    wp_register_script('zendvn_theme_global', $jsUrl . '/global.js',array('jquery'),'1.0',true);
    wp_enqueue_script('zendvn_theme_global');
}

add_action('wp_footer', 'zendvn_theme_script_code');

function zendvn_theme_script_code(){
    echo '<script type=\'text/javascript\'>

	var wpexLocalize = {
		"mobileMenuOpen" : "Browse Categories",
		"mobileMenuClosed" : "Close navigation",
		"homeSlideshow" : "false",
		"homeSlideshowSpeed" : "7000",
		"UsernamePlaceholder" : "Username",
		"PasswordPlaceholder" : "Password",
		"enableFitvids" : "true"
	};

	</script>';
}

// 1. add css
add_action('wp_enqueue_scripts', 'zendvn_theme_register_style');
function zendvn_theme_register_style() {
    global $wp_styles;
    $css_url = get_template_directory_uri() . '/css/';
    wp_register_style('zendvn_theme_symple_shortcodes', $css_url . '/symple_shortcodes_styles.css',array(),'1.0');
    wp_enqueue_style('zendvn_theme_symple_shortcodes');

    wp_register_style('zendvn_theme_style', $css_url . '/style.css',array(),'1.0');
    wp_enqueue_style('zendvn_theme_style');

    wp_register_style('zendvn_theme_responsive', $css_url . '/responsive.css',array(),'1.0');
    wp_enqueue_style('zendvn_theme_responsive');

    wp_register_style('zendvn_theme_site', $css_url . '/site.css',array(),'1.0');
    //wp_enqueue_style('zendvn_theme_site');

    wp_register_style('zendvn_theme_ie8', $css_url . '/ie8.css',array(),'1.0');
    $wp_styles->add_data('zendvn_theme_ie8', 'conditional', 'IE 8');
    wp_enqueue_style('zendvn_theme_ie8');

    wp_register_style('zendvn_theme_customizer', $css_url . '/customizer.css',array(),'1.0');
    wp_enqueue_style('zendvn_theme_customizer');
}