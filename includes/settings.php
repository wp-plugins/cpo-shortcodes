<?php
	
//Create settings page
add_action('admin_menu', 'ctsc_settings');
function ctsc_settings(){
	add_options_page('CPO Shortcodes', 'CPO Shortcodes', 'manage_options', 'ctsc_settings', 'ctsc_settings_page');
}

//Render settings page
function ctsc_settings_page(){
	echo '<div class="wrap">';
	echo '<h2>CPO Shortcodes</h2>';
	//settings_errors();
	echo '<form method="post" action="options.php">';
    settings_fields('ctsc_settings');
    do_settings_sections('ctsc_settings');          
    submit_button();
    echo '</form>';
	echo '</div>';
}


//Create settings fields
add_action('admin_init', 'ctsc_settings_fields');
function ctsc_settings_fields(){
	$option_values = get_option('ctsc_settings');
	
	//Register new setting
	register_setting('ctsc_settings', 'ctsc_settings');		
	
	//Add sections to the settings page
	$settings = ctsc_metadata_sections();
	foreach($settings as $setting_id => $setting_data){
		add_settings_section($setting_id, $setting_data['label'], 'ctsc_settings_section', 'ctsc_settings');
	}
	
	//Add settings & controls
	$settings = ctsc_metadata_settings();
	foreach($settings as $setting_id => $setting_data){
		$setting_data['id'] = $setting_id;
		$setting_data['value'] = isset($option_values[$setting_id]) ? $option_values[$setting_id] : '';
		add_settings_field($setting_id, $setting_data['label'], 'ctsc_settings_field', 'ctsc_settings' , $setting_data['section'], $setting_data);
	}
}


function ctsc_settings_section($args){
	$settings = ctsc_metadata_sections();
	foreach($settings as $setting_id => $setting_data){
		if($args['id'] == $setting_id)
			echo '<p>'.$setting_data['description'].'</p>';
	}
}


function ctsc_settings_field($args){ 
	if(!isset($args['class'])) $args['class'] = '';
	if(!isset($args['placeholder'])) $args['placeholder'] = '';
	switch($args['type']){
		case 'text': 
		echo '<input name="ctsc_settings['.$args['id'].']" type="text" id="'.$args['id'].'" value="'.$args['value'].'" placeholder="'.$args['placeholder'].'" class="'.$args['class'].'"/>';
		break;
		
		case 'checkbox':
		echo '<label for="'.$args['id'].'"><input name="ctsc_settings['.$args['id'].']" type="checkbox" value="1" id="'.$args['id'].'" '.checked(1, $args['value'], false).'" placeholder="'.$args['placeholder'].'" class="'.$args['class'].'"/> '.$args['description'].'</label>';
		break;
	}
}

//Install settings upon theme switch
if(!function_exists('ctsc_settings_defaults')){
	function ctsc_settings_defaults(){
		$option_name = 'ctsc_settings';
		$options_list = get_option($option_name, false);
		foreach(ctsc_metadata_settings() as $current_id => $current_option){
			if(!isset($options_list[$current_id])){
				if(isset($current_option['default'])){
					$field_default = $current_option['default'];
					$options_list[$current_id] = $field_default;
				}
			}
		}
		update_option($option_name, $options_list);
	}
}