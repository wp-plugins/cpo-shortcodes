<?php
/*
Plugin Name: CPO Shortcodes
Description: Lets you use over 30 different shortcodes to create incredible, rich-media pages. You can easily insert them using a shortcode generator added to the WordPress visual editor toolbar.
Author: CPOThemes
Version: 1.1.0
Author URI: http://www.cpothemes.com
*/

//Add Public scripts
add_action('wp_enqueue_scripts', 'ctsc_scripts_front');
function ctsc_scripts_front( ){
    $scripts_path = plugins_url('scripts/' , __FILE__);
	
	//Enqueue necessary scripts already in the WordPress core
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-widget');
	wp_enqueue_script('jquery-effects-core');
	wp_enqueue_script('jquery-effects-fade');
	
	//Register custom scripts for later enqueuing
	wp_register_script('ctsc-cycle', $scripts_path.'jquery-cycle.js', array());
	wp_register_script('ctsc-waypoints', $scripts_path.'jquery-waypoints.js', array());
	wp_register_script('ctsc-toggles', $scripts_path.'shortcodes-toggles.js', array('jquery-ui-accordion', 'jquery-ui-tabs'));
	wp_enqueue_script('ctsc-core', $scripts_path.'core.js', array(), false, true);
}


//Add public stylesheets
add_action('wp_enqueue_scripts', 'ctsc_add_styles');
function ctsc_add_styles(){
	$stylesheets_path = plugins_url('css/' , __FILE__);
	wp_enqueue_style('ctsc-shortcodes', $stylesheets_path.'shortcodes.css');
	wp_register_style('ctsc-fontawesome', $stylesheets_path.'fontawesome.css');
	
}

add_action('admin_enqueue_scripts', 'ctsc_add_admin_styles');
function ctsc_add_admin_styles() {
	$stylesheets_path = plugins_url('css/' , __FILE__);
	wp_enqueue_style('ctsc-shortcodes-admin', $stylesheets_path.'mce.css');
}


//Custom function to do some cleanup on nested shortcodes
//Used for columns and layout-related shortcodes
function ctsc_do_shortcode($content){ 
	$content = do_shortcode(shortcode_unautop($content)); 
	$content = preg_replace('#^<\/p>|^<br\s?\/?>|<p>$|<p>\s*(&nbsp;)?\s*<\/p>#', '', $content);
	return $content;
}


//Add localized vars
//add_action('admin_enqueue_scripts', 'ctsc_shortcode_tinymce_vars');
function ctsc_shortcode_tinymce_vars($plugin_array) {  
	$core_path = plugins_url('images/' , __FILE__);
	wp_localize_script('jquery-ui-core', 'ctsc_shortcodes_vars', array('toolbar_icon' => $core_path.'icon_shortcodes.png'));
}
	

//Add TinyMCE button script
add_filter('mce_external_plugins', 'ctsc_shortcode_tinymce');  
function ctsc_shortcode_tinymce($plugin_array) {  
	$core_path = plugins_url('scripts/' , __FILE__);	
	$plugin_array['ctsc_shortcodes'] = $core_path.'shortcodes-tinymce.js';
	return $plugin_array; 
}


//Add TinyMCE button
add_filter('mce_buttons', 'ctsc_shortcode_tinymce_buttons'); 
function ctsc_shortcode_tinymce_buttons($button_list){
   array_push($button_list, "ctsc_shortcodes_button");
   return $button_list; 
} 	


//Add all Shortcode components
$core_path = plugin_dir_path(__FILE__).'shortcodes/';
require_once($core_path.'shortcode_elements.php');
require_once($core_path.'shortcode_layout.php');
require_once($core_path.'shortcode_content.php');
require_once($core_path.'shortcode_social.php');
require_once($core_path.'shortcode_toggles.php');