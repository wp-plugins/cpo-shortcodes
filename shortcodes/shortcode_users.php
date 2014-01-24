<?php

/* Register Form Shortcode */
if(!function_exists('ctsc_shortcode_register')){
	function ctsc_shortcode_register($atts, $content = null){
		wp_enqueue_style('ctsc-shortcodes');
		
		$attributes = extract(shortcode_atts(array(
		'title' => '',
		'first_name' => '',
		'last_name' => '',
		'color' => '',
		'icon' => ''), $atts));
		
		
		global $post;
		if(isset($post->ID)) 
			$action = get_permalink($post->ID);
		else
			$action = get_permalink(get_bloginfo('url'));
		
		$output = '';
		
		
		$output .= '<form id="ctsc_register_form" name="ctsc_register_form" action="'.$action.'" method="post">';
		
		
		$output .= '<p>';
		$output .= '<label>'._e('Username', 'cpo-shortcodes').'</label>';
		$output .= '<input name="ctsc_name" class="text" value="" type="text">';
		$output .= '</p>';
			
		$output .= '<p>';
		$output .= '<label>'._e('First Name', 'cpo-shortcodes').'</label>';
		$output .= '<input name="ctsc_first_name" class="text" value="" type="text">';
		$output .= '</p>';
		
		$output .= '<p>';
		$output .= '<label>'._e('Last Name', 'cpo-shortcodes').'</label>';
		$output .= '<input name="ctsc_last_name" class="text" value="" type="text">';
		$output .= '</p>';
		
		$output .= '<p>';
		$output .= '<label>'._e('Email', 'cpo-shortcodes').'</label>';
		$output .= '<input name="ctsc_email" class="text" value="" type="text">';
		$output .= '</p>';
		
		$output .= '<p>';
		$output .= '<input name="ctsc_register" value="'._e('Register', 'cpo-shortcodes').'" type="submit" />';
		$output .= '</p>';
		
		$output .= '</form>';
		
		return $output;
	}
	add_shortcode('register', 'ctsc_shortcode_register');
}

if(!function_exists('ctsc_shortcode_register_user')){
	add_action('init', 'ctsc_shortcode_register_user');
	function ctsc_shortcode_register_user($atts, $content = null){
		if(isset($_POST['ctsc_register'])){
			
			$error = false;
			$registration = get_option('users_can_register');
			
			if($registration == 1){
			
				//Validate all fields
				$user_name = trim($_POST['ctsc_username']);
				$user_first_name = trim($_POST['ctsc_first_name']);
				$user_last_name = trim($_POST['ctsc_last_name']);
				$user_email = trim($_POST['ctsc_email']);
				
				//Validate Fields
				if($user_name == '' || $user_first_name == '' || $user_last_name == '' || $user_email == '')
					$error = __('All fields are required.', 'cpo-shortcodes');
					
				//Validation pending for no numbers in name and last name, as well as email format
					
				//If validation is ok, attempt to register user
				if(!$error){
					$user_pass = wp_generate_password();
					
					$args = array(
					'first_name' => $user_first_name,
					'last_name' => $user_last_name,
					'user_email' => $user_email,
					'user_login' => $user_name,
					'user_pass' => $user_pass);
					
					$registered_id = wp_insert_user($args);
					
					//If user has been registered, proceed to insert metadata
					if(is_object($registered_id)){
						$error = $registered_id->get_error_message();	
					}else{
						//Insert additional data
						
						
						//Send email to user
						$email_address = $user_email;
						$email_sender = get_bloginfo('admin_email'); 
						$email_subject = get_bloginfo('name').' - '.__('New User Account.', 'cpo-shortcodes');
						$email_body = $user_first_name.",\n\n";
						$email_body .= __('Thanks for registering. Your account is now ready to use, and you can access the site with the following user information:', 'cpo-shortcodes')."\n\n";
						$email_body .= __('Username', 'cpo-shortcodes').': '.$user_name."\n";
						$email_body .= __('Password', 'cpo-shortcodes').': '.$user_pass."\n\n";
						$email_headers = 'From: '.' <'.$email_sender.'>'."\r\n".'Reply-To: '.$email_sender;
						wp_mail($email_address, $email_subject, $email_body, $email_headers);
						$email_sent = true;
					}
				}
			}
		}
	}
}
