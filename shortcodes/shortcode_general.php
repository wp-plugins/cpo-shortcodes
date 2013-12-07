<?php

if(!function_exists('ctsc_shortcode_tinymce_vars')){
	add_action('admin_enqueue_scripts', 'ctsc_shortcode_tinymce_vars');
	function ctsc_shortcode_tinymce_vars($plugin_array) {  
		$core_path = get_template_directory_uri().'/core/';
		if(defined('WP_CPODEV')) $core_path = get_template_directory_uri().'/../cpoframework/core/';
		wp_localize_script('script_general_admin', 'ctsc_shortcodes_vars', array('toolbar_icon' => $core_path.'/images/icon_shortcodes.png'));
	}
}
  
if(!function_exists('ctsc_shortcode_tinymce')){
	add_filter('mce_external_plugins', 'ctsc_shortcode_tinymce');
	function ctsc_shortcode_tinymce($plugin_array) {  
		$core_path = get_template_directory_uri().'/core/';
		if(defined('WP_CPODEV')) $core_path = get_template_directory_uri().'/../cpoframework/core/';
		
		$plugin_array['ctsc_shortcodes'] = $core_path.'scripts/shortcodes-tinymce.js';
		return $plugin_array; 
	}
}

if(!function_exists('ctsc_shortcode_tinymce_buttons')){
	add_filter('mce_buttons', 'ctsc_shortcode_tinymce_buttons'); 
	function ctsc_shortcode_tinymce_buttons($button_list){
	   array_push($button_list, "ctsc_shortcodes_button");
	   return $button_list; 
	}
}
