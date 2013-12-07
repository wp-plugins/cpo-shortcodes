<?php 

/* Section Shortcode */
if(!function_exists('ctsc_shortcode_section')){
	function ctsc_shortcode_section($atts, $content = null){
		wp_enqueue_script('ctsc-core');
		
		$attributes = extract(shortcode_atts(array(
		'title' => '', 
		'subtitle' => '', 
		'icon' => '', 
		'background' => '', 
		'video' => '', 
		'preview' => '', 
		'image' => '', 
		'color' => '', 
		'position' => '', 
		'parallax' => '', 
		'padding' => ''), $atts));		
		$random_id = rand();
		
		
		//Content color
		$color_data = '';
		if($color == 'dark'){
			$color_data = ' ctsc-dark';
		}
		
		//Parallax scrolling
		$parallax_data = '';
		if($position == 'parallax'){
			//wp_enqueue_script('ctsc_skrollr');
			$parallax_data = ' data-bottom-top="background-position:center 100%;" data-top-bottom="background-position:center 0;"';
		}
		$position = ' ctsc-section-'.$position;

		$output = '';
		//Output section wrapper-- styling must not go first for first-child selectors
		$output .= '<div class="ctsc-section ctsc-section-'.$random_id.$position.$color_data.'"'.$parallax_data.'>';
		$output .= '<style>';
		//Section Content Styles
		$output .= '.ctsc-section-'.$random_id.' .ctsc-section-content {';
		if($padding != '') $output .= ' padding-top:'.$padding.'px; padding-bottom:'.$padding.'px;';
		if($color != '' || $color != 'dark' || $color != 'light') $output .= ' color:'.$color.';';
		$output .= ' }';
		// Background Styles
		$output .= '.ctsc-section-'.$random_id.' .ctsc-section-background {';
		if($background != '') $output .= ' background-color:'.$background.';';
		if($image != '') $output .= ' background-image:url('.$image.'); background-position:center;';
		$output .= ' }';
		$output .= '</style>';
		//Section output
		if($video != ''){
			$output .= '<div class="ctsc-section-video">';
			$output .= '<video width="640" height="360" muted="muted" loop="loop" autoplay="autoplay">';
			$output .= '<source type="video/mp4" src="'.$video.'"></source>';
			$output .= '</video>';
			$output .= '</div>';
		} 
		$output .= '<div class="ctsc-section-background"></div>';
		$output .= '<div class="ctsc-section-content">';
		if($title != ''){
			$output .= '<div class="ctsc-section-heading">';
			$output .= '<h2 class="ctsc-section-title">'.$title.'</h2>';
			if($title != '') 
				$output .= '<div class="ctsc-section-subtitle">'.$subtitle.'</div>';
			$output .= '</div>';
		}
		$output .= ctsc_do_shortcode($content);
		$output .= '</div>';
		$output .= '</div>';
		
		return $output;
	}
	add_shortcode('section', 'ctsc_shortcode_section');
}

/* Spacer Shortcode */
if(!function_exists('ctsc_shortcode_spacer')){
	function ctsc_shortcode_spacer($atts, $content = null){
		$attributes = extract(shortcode_atts(array('height' => ''), $atts));
		if($height != '') $height = ' style="height:'.$height.'px;"';
		return '<div class="ctsc-spacer"'.$height.'></div>';
	}
	add_shortcode('spacer', 'ctsc_shortcode_spacer');
}


/* Area/Region Shortcode */
if(!function_exists('ctsc_shortcode_area')){
	function ctsc_shortcode_area($atts, $content = null){
		wp_enqueue_script('ctsc-waypoints');
		wp_enqueue_script('ctsc-core');
		
		$attributes = extract(shortcode_atts(array(
		'delay' => '', 
		'animation' => ''), $atts));		
		
		wp_enqueue_script('ctsc_waypoints');
		
		if($animation != '') $animation = ' ctsc-area-animation-'.$animation;
		if($delay != '') $delay = ' data-delay="'.$delay.'"';
		
		$output = '';
		$output .= '<div class="ctsc-area ctsc-area-animation'.$animation.'"'.$delay.'>';
		$output .= ctsc_do_shortcode($content);
		$output .= '</div>';
		return $output;		
	}
	add_shortcode('area', 'ctsc_shortcode_area');
}


/* ctsc-column Wrapper Shortcode - Alternate Markup */
if(!function_exists('ctsc_shortcode_columns')){
	function ctsc_shortcode_columns($atts, $content = null){
		$attributes = extract(shortcode_atts(array('number' => '2'), $atts));
		return '<div class="ctsc-columns ctsc-col'.$number.'">'.ctsc_do_shortcode($content).'<div class="ctsc-col-divide"></div></div>';
	}
	add_shortcode('columns', 'ctsc_shortcode_columns');
}


/* Single ctsc-column Shortcode - Alternate Markup */
if(!function_exists('ctsc_shortcode_column_single')){
	function ctsc_shortcode_column_single($atts, $content = null){
		$content = $content;		
		return '<div class="ctsc-column">'.ctsc_do_shortcode($content).'</div>';
	}
	add_shortcode('column', 'ctsc_shortcode_column_single');
}


/* Half ctsc-column Shortcode */
if(!function_exists('ctsc_shortcode_column2')){
	function ctsc_shortcode_column2($atts, $content = null){
		$content = $content;	
		return '<div class="ctsc-column ctsc-col2">'.ctsc_do_shortcode($content).'</div>';
	}
	add_shortcode('column_half', 'ctsc_shortcode_column2');
}

/* Half Last ctsc-column Shortcode */
if(!function_exists('ctsc_shortcode_column2_last')){
	function ctsc_shortcode_column2_last($atts, $content = null){
		$content = $content;	
		return '<div class="ctsc-column ctsc-col2 ctsc-col-last">'.ctsc_do_shortcode($content).'</div><div class="col-divide"></div>';
	}
	add_shortcode('column_half_last', 'ctsc_shortcode_column2_last');
}



/* Third ctsc-column Shortcode */
if(!function_exists('ctsc_shortcode_column3')){
	function ctsc_shortcode_column3($atts, $content = null){
		$content = $content;	
		return '<div class="ctsc-column ctsc-col3">'.ctsc_do_shortcode($content).'</div>';
	}
	add_shortcode('column_third', 'ctsc_shortcode_column3');
}

/* Two-Thirds ctsc-column Shortcode */
if(!function_exists('ctsc_shortcode_column3x2')){
	function ctsc_shortcode_column3x2($atts, $content = null){
		$content = $content;	
		return '<div class="ctsc-column ctsc-col3x2">'.ctsc_do_shortcode($content).'</div>';
	}
	add_shortcode('column_two_thirds', 'ctsc_shortcode_column3x2');
}

/* Third Last ctsc-column Shortcode */
if(!function_exists('ctsc_shortcode_column3_last')){
	function ctsc_shortcode_column3_last($atts, $content = null){
		$content = $content;	
		return '<div class="ctsc-column ctsc-col3 ctsc-col-last">'.ctsc_do_shortcode($content).'</div><div class="col-divide"></div>';
	}
	add_shortcode('column_third_last', 'ctsc_shortcode_column3_last');
}

/* Two-Thirds Last ctsc-column Shortcode */
if(!function_exists('ctsc_shortcode_column3x2_last')){
	function ctsc_shortcode_column3x2_last($atts, $content = null){
		$content = $content;	
		return '<div class="ctsc-column ctsc-col3x2 ctsc-col-last">'.ctsc_do_shortcode($content).'</div><div class="col-divide"></div>';
	}
	add_shortcode('column_two_thirds_last', 'ctsc_shortcode_column3x2_last');
}



/* Quarter ctsc-column Shortcode */
if(!function_exists('ctsc_shortcode_column4')){
	function ctsc_shortcode_column4($atts, $content = null){
		$content = $content;	
		return '<div class="ctsc-column ctsc-col4">'.ctsc_do_shortcode($content).'</div>';
	}
	add_shortcode('column_fourth', 'ctsc_shortcode_column4');
}

/* Three-Quarters ctsc-column Shortcode */
if(!function_exists('ctsc_shortcode_column4x3')){
	function ctsc_shortcode_column4x3($atts, $content = null){
		$content = $content;	
		return '<div class="ctsc-column ctsc-col4x3">'.ctsc_do_shortcode($content).'</div>';
	}
	add_shortcode('column_three_fourths', 'ctsc_shortcode_column4x3');
}

/* Quarter Last ctsc-column Shortcode */
if(!function_exists('ctsc_shortcode_column4_last')){
	function ctsc_shortcode_column4_last($atts, $content = null){
		$content = $content;	
		return '<div class="ctsc-column ctsc-col4 ctsc-col-last">'.ctsc_do_shortcode($content).'</div><div class="col-divide"></div>';
	}
	add_shortcode('column_fourth_last', 'ctsc_shortcode_column4_last');
}

/* Three-Quarters Last ctsc-column Shortcode */
if(!function_exists('ctsc_shortcode_column4x3_last')){
	function ctsc_shortcode_column4x3_last($atts, $content = null){
		$content = $content;	
		return '<div class="ctsc-column ctsc-col4x3 ctsc-col-last">'.ctsc_do_shortcode($content).'</div><div class="col-divide"></div>';
	}
	add_shortcode('column_three_fourths_last', 'ctsc_shortcode_column4x3_last');
}



/* Fifth ctsc-column Shortcode */
if(!function_exists('ctsc_shortcode_column5')){
	function ctsc_shortcode_column5($atts, $content = null){
		$content = $content;	
		return '<div class="ctsc-column ctsc-col5">'.ctsc_do_shortcode($content).'</div>';
	}
	add_shortcode('column_fifth', 'ctsc_shortcode_column5');
}

/* Two-Fifths ctsc-column Shortcode */
if(!function_exists('ctsc_shortcode_column5x2')){
	function ctsc_shortcode_column5x2($atts, $content = null){
		$content = $content;	
		return '<div class="ctsc-column ctsc-col5x2">'.ctsc_do_shortcode($content).'</div>';
	}
	add_shortcode('column_two_fifths', 'ctsc_shortcode_column5x2');
}

/* Three-Fifths ctsc-column Shortcode */
if(!function_exists('ctsc_shortcode_column5x3')){
	function ctsc_shortcode_column5x3($atts, $content = null){
		$content = $content;	
		return '<div class="ctsc-column ctsc-col5x3">'.ctsc_do_shortcode($content).'</div>';
	}
	add_shortcode('column_three_fifths', 'ctsc_shortcode_column5x3');
}

/* Four-Fifths ctsc-column Shortcode */
if(!function_exists('ctsc_shortcode_column5x4')){
	function ctsc_shortcode_column5x4($atts, $content = null){
		$content = $content;	
		return '<div class="ctsc-column ctsc-col5x4">'.ctsc_do_shortcode($content).'</div>';
	}
	add_shortcode('column_four_fifths', 'ctsc_shortcode_column5x4');
}

/* Fifth Last ctsc-column Shortcode */
if(!function_exists('ctsc_shortcode_column5_last')){
	function ctsc_shortcode_column5_last($atts, $content = null){
		$content = $content;	
		return '<div class="ctsc-column ctsc-col5 ctsc-col-last">'.ctsc_do_shortcode($content).'</div><div class="col-divide"></div>';
	}
	add_shortcode('column_fifth_last', 'ctsc_shortcode_column5_last');
}

/* Two-Fifths Last ctsc-column Shortcode */
if(!function_exists('ctsc_shortcode_column5x2_last')){
	function ctsc_shortcode_column5x2_last($atts, $content = null){
		$content = $content;	
		return '<div class="ctsc-column ctsc-col5x2 ctsc-col-last">'.ctsc_do_shortcode($content).'</div>';
	}
	add_shortcode('column_two_fifths_last', 'ctsc_shortcode_column5x2_last');
}

/* Three-Fifths Last ctsc-column Shortcode */
if(!function_exists('ctsc_shortcode_column5x3_last')){
	function ctsc_shortcode_column5x3_last($atts, $content = null){
		$content = $content;	
		return '<div class="ctsc-column ctsc-col5x3 ctsc-col-last">'.ctsc_do_shortcode($content).'</div>';
	}
	add_shortcode('column_three_fifths_last', 'ctsc_shortcode_column5x3_last');
}

/* Four-Fifths Last ctsc-column Shortcode */
if(!function_exists('ctsc_shortcode_column5x4_last')){
	function ctsc_shortcode_column5x4_last($atts, $content = null){
		$content = $content;	
		return '<div class="ctsc-column ctsc-col5x4 ctsc-col-last">'.ctsc_do_shortcode($content).'</div>';
	}
	add_shortcode('column_four_fifths_last', 'ctsc_shortcode_column5x4_last');
}


/* Divider Shortcode */
if(!function_exists('ctsc_shortcode_divide')){
	function ctsc_shortcode_divide($atts, $content = null){
		return '<hr/>';
	}
	add_shortcode('divide', 'ctsc_shortcode_divide');
}


/* Separator Shortcode */
if(!function_exists('ctsc_shortcode_separator')){
	function ctsc_shortcode_separator($atts, $content = null){
		wp_enqueue_style('ctsc-fontawesome');
		$attributes = extract(shortcode_atts(array(
		'style' => '',
		'title' => '',
		'color' => '',
		'top' => '',
		'icon' => ''), $atts));
		
		$title = trim(strip_tags($title));
		$color = trim(strip_tags($color));
		$style = trim(strip_tags($style));
		$top = trim(strip_tags($top));
		
		
		$random_id = rand();

		$output = '';
		if($color != '') 
		$output .= '<style>.ctsc-separator-'.$random_id.' { color:'.$color.'; }</style>';
		
		$output .= '<div class="ctsc-separator ctsc-separator-'.$random_id.' separator-'.$style;
		if($icon != '') $output .= ' ctsc-separator-has-icon';
		$output .= '">';
		$output .= '<div class="ctsc-separator-line"></div>';
		if($icon != '') $output .= '<div class="ctsc-separator-icon icon-'.$icon.'"></div>';
		if($top != '') $output .= '<a class="ctsc-separator-top skip-to" href="#top" rel="top">'.$top.'</a>';
		if($title != '') $output .= '<div class="ctsc-separator-title">'.$title.'</div>';
		$output .= '<div class="clear"></div>';
		$output .= '</div>';
		return $output;
	}
	add_shortcode('separator', 'ctsc_shortcode_separator');
}

/* Clearing Shortcode */
if(!function_exists('ctsc_shortcode_clear')){
	function ctsc_shortcode_clear($atts, $content = null){
		return '<div style="clear:both;width:100%;"></div>';
	}
	add_shortcode('clear', 'ctsc_shortcode_clear');
}