<?php 

/* Button Shortcode */
if(!function_exists('ctsc_shortcode_button')){
	function ctsc_shortcode_button($atts, $content = null){
		wp_enqueue_style('ctsc-fontawesome');
		
		$attributes = extract(shortcode_atts(array(
			'url' => '',
			'position' => '',
			'size' => '',
			'icon' => '',
			'id' => '',
			'target' => '',
			'color' => ''
			), 
			$atts));
		
		$content = trim(strip_tags($content));
		$url = htmlentities($url);
		
		$size = trim(strip_tags($size));
		switch($size){
			case 'small': $button_size = ' ctsc-button-small'; break;
			case 'medium': $button_size = ' ctsc-button-medium'; break;
			case 'large': $button_size = ' ctsc-button-large'; break;
			default: $button_size = ' ctsc-button-normal'; break;
		}
		
		$button_style = '';
		$custom_color = false;
		if(strstr($color, '#')){
			$custom_color = true;
			$button_style = ' style="background:'.$color.';"';
		}
		
		if($color == '') 
			$color = 'default';
		elseif($custom_color)
			$color = '';
			
		if($position != '') $position = ' ctsc-button-'.$position;
		if($id != '') $id = ' id="'.$id.'"';
		
		if($target != '') $target = ' target="'.$target.'"';
		
		$button_class = '';
		if($icon != ''){
			$button_class .= ' ctsc-button-has-icon';
			$icon = '<span class="ctsc-button-icon icon-'.htmlentities($icon).'"></span> ';
		}
		
		$output = '';
		$output .= '<a class="ctsc-button ctsc-button-'.$color.$button_size.$position.' '.$button_class.'" href="'.$url.'"'.$button_style.$id.$target.'>'.$icon.$content.'</a>';
		
		
		return $output;
	}
	add_shortcode('button', 'ctsc_shortcode_button');
}


/* Message Shortcode */
if(!function_exists('ctsc_shortcode_message')){
	function ctsc_shortcode_message($atts, $content = null){
		wp_enqueue_style('ctsc-fontawesome');
		
		$attributes = extract(shortcode_atts(array(
			'type' => ''), 
			$atts));
		
		$content = trim(strip_tags($content));	
		$type = trim(strip_tags($type));
		switch($type){
			case 'ok': $type = 'ctsc-message-ok'; break;
			case 'error': $type = 'ctsc-message-error'; break;
			case 'warning': $type = 'ctsc-message-warn'; break;
			case 'info': $type = 'ctsc-message-info'; break;
			default: $type = ''; break;
		}
		
		return '<span class="ctsc-message '.$type.'">'.$content.'</span>';
	}
	add_shortcode('message', 'ctsc_shortcode_message');
}


/* Notice Shortcode */
if(!function_exists('ctsc_shortcode_notice')){
	function ctsc_shortcode_notice($atts, $content = null){
		$attributes = extract(shortcode_atts(array(
		'style' => '',
		'color' => '',
		'background' => ''), 
		$atts));
		$random_id = rand();
		
		if($color == 'dark') $color = ' ctsc-dark';
		if($style != '') $style = ' ctsc-notice-'.$style;
		
		$content = trim($content);	

		$output = '';
		$output .= '<div class="ctsc-notice ctsc-notice-'.$random_id.$style.$color.'">';
		$output .= '<style>';
		$output .= '.ctsc-notice-'.$random_id.' {';
		if($background != '') $output .= ' background-color:'.$background.';';
		$output .= ' }';
		$output .= '</style>';
		$output .= ctsc_do_shortcode($content);
		$output .= '</div>';
		return $output;
	}
	add_shortcode('notice', 'ctsc_shortcode_notice');
}


/* Banner Shortcode */
if(!function_exists('ctsc_shortcode_banner')){
	function ctsc_shortcode_banner($atts, $content = null){
		$attributes = extract(shortcode_atts(array(
		'image' => '',
		'type' => '',
		'title' => '',
		'url' => ''), 
		$atts));
		
		$output = '<div class="ctsc-banner image-'.$type.'">';
		if($url != '') $output .= '<a class="ctsc-banner-link" href="'.$url.'">';
		$output .= '<div class="ctsc-banner-overlay"></div>';
		if($title != '' || $content != '') $output .= '<div class="ctsc-banner-body">';
		if($title != '') $output .= '<div class="ctsc-banner-title">'.$title.'</div>';
		if($content != '') $output .= '<div class="ctsc-banner-content">'.$content.'</div>';
		if($title != '' || $content != '') $output .= '</div>';	
		if($image != '') $output .= '<img class="ctsc-banner-image" src="'.$image.'"/>';
		if($url != '') $output .= '</a>';	
		$output .= '</div>';	
		
		return $output;
	}
	add_shortcode('banner', 'ctsc_shortcode_banner');
}


/* Progress Bar Shortcode */
if(!function_exists('ctsc_shortcode_bar')){
	function ctsc_shortcode_bar($atts, $content = null){
		wp_enqueue_script('ctsc-waypoints');
		wp_enqueue_script('ctsc-core');
		wp_enqueue_style('ctsc-fontawesome');
		
		$attributes = extract(shortcode_atts(array(
		'style' => '',
		'title' => '',
		'value' => '100',
		'size' => '',
		'icon' => '',
		'color' => '',
		'direction' => ''
		), 
		$atts));
		wp_enqueue_script('ctsc_waypoints');
		
		$content = trim(strip_tags($content));		
		$style = $style != '' ? ' ctsc-progress-'.trim(strip_tags($style)) : '';
		$size = $size != '' ? ' ctsc-progress-'.trim(strip_tags($size)) : '';
		$direction = $direction != '' ? ' ctsc-progress-'.trim(strip_tags($direction)) : '';
		
		
		$value = htmlentities($value);
		if($value < 0) $value = 0;
		if($value > 100) $value = 100;
		
		switch($color){
			case 'red': $bar_color = ' ctsc-gradient-red'; break;
			case 'blue': $bar_color = ' ctsc-gradient-blue'; break;
			case 'green': $bar_color = ' ctsc-gradient-green'; break;
			case 'gray': $bar_color = ' ctsc-gradient-gray'; break;
			case 'pink': $bar_color = ' ctsc-gradient-pink'; break;
			case 'orange': $bar_color = ' ctsc-gradient-orange'; break;
			case 'purple': $bar_color = ' ctsc-gradient-purple'; break;
			case 'teal': $bar_color = ' ctsc-gradient-teal'; break;
			case 'yellow': $bar_color = ' ctsc-gradient-yellow'; break;
			case 'black': $bar_color = ' ctsc-gradient-black'; break;
			case 'white': $bar_color = ' ctsc-gradient-white'; break;
			default: $bar_color = ' ctsc-gradient-orange'; break;
		}
		if($icon != '') $icon = '<span class="bar-icon icon-'.htmlentities($icon).'"></span> ';
		
		$output = '';
		$output .= '<div class="ctsc-progress'.$direction.$size.$style.'">';
		$output .= '<div class="bar-content '.$bar_color.'" data-value="'.$value.'">';
		if($title != '') $output .= '<div class="bar-title">'.$icon.' '.$title.'</div>';
		$output .= '</div>';
		$output .= '</div>';
		return $output;
	}
	add_shortcode('progress', 'ctsc_shortcode_bar');
}


/* Counter Shortcode */
if(!function_exists('ctsc_shortcode_counter')){
	function ctsc_shortcode_counter($atts, $content = null){
		wp_enqueue_style('ctsc-fontawesome');
		
		$attributes = extract(shortcode_atts(array(
		'title' => '',
		'size' => '',
		'icon' => '',
		'color' => '',
		'number' => '',
		'description' => ''
		), 
		$atts));
		$random_id = rand();
				
		$size = 'counter-'.trim(strip_tags($size));
		
		if($color == '') $color = 'default';
		
		$counter_class = '';
		if($icon != '')
			$counter_class .= ' counter-has-icon';
		
		$output = '';
		$output .= '<style>';
		//Section Styling
		$output .= '.ctsc-counter-'.$random_id.' .ctsc-counter-icon {';
		if($color != '') $output .= ' color:'.$color.';';
		$output .= ' }';
		$output .= '</style>';
		//Element Styling
		$output .= '<div class="ctsc-counter ctsc-counter-'.$random_id.' ctsc-counter-'.$color.' '.$size.' '.$counter_class.'">';
		$output .= '<div class="ctsc-counter-number">';
		if($icon != '') $output .= '<div class="ctsc-counter-icon icon-'.$icon.'"></div>';
		$output .= $number;
		$output .= '</div>';
		$output .= '<div class="ctsc-counter-title heading">'.$title.'</div>';
		$output .= '<div class="ctsc-counter-content">'.$content.'</div>';
		$output .= '</div>';
		
		
		return $output;
	}
	add_shortcode('counter', 'ctsc_shortcode_counter');
}


/* Feature Block Shortcode */
if(!function_exists('ctsc_shortcode_feature')){
	function ctsc_shortcode_feature($atts, $content = null){
		wp_enqueue_style('ctsc-fontawesome');
		
		$attributes = extract(shortcode_atts(array(
		'title' => '(No Title)', 
		'icon' => '', 
		'color' => '', 
		'style' => ''),
		$atts));
		
		$content = trim($content);
		$title = trim(htmlentities(strip_tags($title), ENT_QUOTES, "UTF-8"));
		$icon_color = '';
		if($color != '') $icon_color = ' style="color:'.$color.';"';
		
		$output = '<div class="ctsc-feature ctsc-feature-'.$style.'">';
		if($icon != ''){
			wp_enqueue_style('style_fontawesome');
			$output .= '<div class="ctsc-feature-icon icon-'.$icon.'"'.$icon_color.'></div>';
		}
		$output .= '<h4 class="ctsc-feature-title">'.$title.'</h4>';
		$output .= '<div class="ctsc-feature-content">'.ctsc_do_shortcode($content).'</div>';
		$output .= '</div>';
		
		return $output;
	}
	add_shortcode('feature', 'ctsc_shortcode_feature');
}


/* Tooltip Shortcode */
if(!function_exists('ctsc_shortcode_tooltip')){
	function ctsc_shortcode_tooltip($atts, $content = null){
		wp_enqueue_style('ctsc-fontawesome');
		
		$attributes = extract(shortcode_atts(array(
		'icon' => 'question-sign', 
		'color' => ''),
		$atts));
		
		if($color != '') $color = ' style="color:'.$color.';"';
		
		$output = '<span class="ctsc-tooltip">';		
		wp_enqueue_style('style_fontawesome');
		$output .= '<span class="ctsc-tooltip-icon icon-'.$icon.'" '.$color.'></span>';
		$output .= '<span class="ctsc-tooltip-content ctsc-dark">'.strip_tags($content).'</span>';
		$output .= '</span>';
		
		return $output;
	}
	add_shortcode('tooltip', 'ctsc_shortcode_tooltip');
}


/* Testimonial Shortcode */
if(!function_exists('ctsc_shortcode_testimonial')){
	function ctsc_shortcode_testimonial($atts, $content = null){
		$attributes = extract(shortcode_atts(array(
			'name' => '(No Name)', 
			'image' => '', 
			'style' => 'left', 
			'title' => ''),
			$atts));
		
		$content = trim($content);
		$style = trim(htmlentities(strip_tags($style), ENT_QUOTES, "UTF-8"));
		$name = trim(htmlentities(strip_tags($name), ENT_QUOTES, "UTF-8"));
		
		$classes = 'ctsc-testimonial-'.$style;
		if($image == '') $classes .= 'noimage';
		$output = "<div class='ctsc-testimonial $classes'>";
		$output .= '<div class="ctsc-testimonial-content">';
		$output .= $content;
		$output .= '</div>';
		if($image != '') $output .= "<div><img class='ctsc-testimonial-image' src='$image' alt='$title'/></div>";
		$output .= '<div class="ctsc-testimonial-meta">';
		$output .= '<div class="ctsc-testimonial-name heading">'.$name.'</div>';
		if($title != '') $output .= "<span class='ctsc-testimonial-title'>$title</span>";
		$output .= '</div>';
		$output .= '</div>';
		
		return $output;
	}
	add_shortcode('testimonial', 'ctsc_shortcode_testimonial');
}


/* Team Member Shortcode */
if(!function_exists('ctsc_shortcode_team')){
	function ctsc_shortcode_team($atts, $content = null){
		$attributes = extract(shortcode_atts(array(
			'name' => '(No Name)', 
			'image' => '', 
			'title' => '', 
			'facebook' => '', 
			'twitter' => '', 
			'gplus' => '', 
			'linkedin' => '', 
			'pinterest' => '', 
			'tumblr' => '', 
			'web' => '', 
			'state' => ''),
			$atts));
		
		$content = trim($content);
		$name = trim(htmlentities(strip_tags($name), ENT_QUOTES, "UTF-8"));
		
		$classes = '';
		if($image == '') $classes .= 'noimage';
		$output = "<div class='ctsc-team $classes'>";
		if($image != '')
			$output .= "<img class='ctsc-member-image' src='$image' alt='$title'/>";
		$output .= '<div class="ctsc-member-content">';
		$output .= '<h3 class="ctsc-member-name">'.$name.'</h3>';
		if($title != '') $output .= "<span class='ctsc-member-title'>$title</span>";
		$output .= $content;
		$output .= '<div class="ctsc-member-meta">';
		if($web != '') $output .= "<a href='$web'><span class='icon-link'></span></a>";
		if($facebook != '') $output .= "<a href='$facebook'><span class='icon-facebook'></span></a>";
		if($twitter != '') $output .= "<a href='$twitter'><span class='icon-twitter'></span></a>";
		if($gplus != '') $output .= "<a href='$gplus'><span class='icon-google-plus'></span></a>";
		if($linkedin != '') $output .= "<a href='$linkedin'><span class='icon-linkedin'></span></a>";
		if($pinterest != '') $output .= "<a href='$pinterest'><span class='icon-pinterest'></span></a>";
		if($tumblr != '') $output .= "<a href='$tumblr'><span class='icon-tumblr'></span></a>";
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';
		
		return $output;
	}
	add_shortcode('team', 'ctsc_shortcode_team');
}


/* Pricing Table Shortcode */
if(!function_exists('ctsc_shortcode_pricing_table')){
	function ctsc_shortcode_pricing_table($atts, $content = null){
		wp_enqueue_style('ctsc-fontawesome');
		$attributes = extract(shortcode_atts(array(
			'columns' => 1, 
			'state' => ''),
			$atts));
		
		$content = ctsc_do_shortcode($content);
		
		$output = '<div class="ctsc-pricing-table ctsc-pricing-col'.$columns.'">';
		$output .= do_shortcode($content);
		$output .= '<div class="clear"></div>';
		$output .= '</div>';
		
		return $output;
	}
	add_shortcode('pricing_table', 'ctsc_shortcode_pricing_table');
}

/* Pricing Item Shortcode */
if(!function_exists('ctsc_shortcode_pricing_cell')){
	function ctsc_shortcode_pricing_cell($atts, $content = null){
		$attributes = extract(shortcode_atts(array(
		'type' => 'none',
		'title' => '',
		'subtitle' => '',
		'description' => '',
		'price' => '',
		'color' => '',
		'before' => '$',
		'after' => '',
		'url' => '',
		'urltitle' => '',
		'urlcolor' => '',
		'coin' => '$'
		), $atts));
		$random_id = rand();
		
		
		$output = '<div class="ctsc-pricing-column ctsc-pricing-column-'.$random_id.' ctsc-pricing-column-'.$type.'">';
		
		$output .= '<style>';
		//Section Styling
		$output .= '.ctsc-pricing-column-'.$random_id.' .ctsc-pricing-item-highlight .ctsc-pricing-title {';
		if($color != '') $output .= "color:#fff; background:$color;";
		$output .= ' }';
		$output .= '</style>';
		
		$output .= '<div class="ctsc-pricing-item ctsc-pricing-item-'.$type.'">';
		if($title != ''){
			$output .= '<div class="ctsc-pricing-title">';
			$output .= $title;
			if($subtitle != '') $output .= '<div class="ctsc-pricing-subtitle">'.$subtitle.'</div>';
			$output .= '</div>';
		}
		if($price != ''){
			$output .= '<div class="ctsc-pricing-price">';
			if($before != '') $output .= '<span class="ctsc-pricing-before">'.$before.'</span>';
			$output .= '<span class="ctsc-pricing-price-value">'.$price.'</span>';
			if($after != '') $output .= '<span class="ctsc-pricing-after">'.$after.'</span>';
			if($description != '') $output .= '<span class="ctsc-pricing-description">'.$description.'</span>';
			$output .= '</div>';
		}
		$output .= '<div class="ctsc-pricing-content">';
		$output .= ctsc_do_shortcode($content);
		$output .= '</div>';
		if($url != ''){
			if($urlcolor == '') $urlcolor = 'default';
			$output .= '<div class="ctsc-pricing-url">';
			$output .= '<a class="ctsc-button ctsc-button-'.$urlcolor.'" href="'.$url.'">';
			if($urltitle == '') $output .= __('Read More', 'cpocore'); else $output .= $urltitle;
			$output .= '</a>';
			$output .= '</div>';
		}
		$output .= '</div>';
		$output .= '</div>';
		return $output;
	}
	add_shortcode('pricing_item', 'ctsc_shortcode_pricing_cell');
}


/* Client Grid Shortcode */
if(!function_exists('ctsc_shortcode_client_list')){
	function ctsc_shortcode_client_list($atts, $content = null){
		$attributes = extract(shortcode_atts(array(
			'columns' => 1, 
			'state' => ''),
			$atts));
		
		$content = ctsc_do_shortcode($content);
		
		$output = '<div class="ctsc-client-list ctsc-client-col'.$columns.'">';
		$output .= do_shortcode($content);
		$output .= '<div class="clear"></div>';
		$output .= '</div>';
		
		return $output;
	}
	add_shortcode('clients', 'ctsc_shortcode_client_list');
}

/* Client Shortcode */
if(!function_exists('ctsc_shortcode_client')){
	function ctsc_shortcode_client($atts, $content = null){
		$attributes = extract(shortcode_atts(array(
		'title' => '',
		'image' => '',
		'description' => '',
		'url' => ''), $atts));
				
		$output = '<div class="ctsc-client-column">';
		$output .= '<div class="ctsc-client-item">';
		if($image != ''){
			$output .= '<div class="ctsc-client-image">';
			if($url != '') $output .= '<a class="ctsc-client-link" href="'.$url.'" target="_blank">';
			$output .= '<img src="'.$image.'"/>';
			if($url != '') $output .= '</a>';
			$output .= '</div>';
		}
		if($title != '') $output .= '<div class="ctsc-client-title">'.$title.'</div>';
		if($description != '') $output .= '<div class="ctsc-client-description">'.$description.'</div>';
		$output .= '</div>';
		$output .= '</div>';
		return $output;
	}
	add_shortcode('client', 'ctsc_shortcode_client');
}


/* Definition Lists Shortcode */
if(!function_exists('ctsc_shortcode_map')){
	function ctsc_shortcode_map($atts, $content = null){
		wp_enqueue_script('ctsc-core');
		$attributes = extract(shortcode_atts(array(
			'color' => '', 
			'height' => '400', 
			'latitude' => '', 
			'longitude' => '', 
			),
			$atts));
		wp_enqueue_script('google-map', 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false', array(), false, true);
		$output = '<div class="ctsc-map" data-lat="'.$latitude.'" data-lng="'.$longitude.'" data-color="'.$color.'" style="height:'.$height.'px"></div>';		
		return $output;
	}
	add_shortcode('map', 'ctsc_shortcode_map');
}