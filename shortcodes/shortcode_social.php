<?php

/* Like Button Shortcode */
if(!function_exists('ctsc_shortcode_fblike')){
	function ctsc_shortcode_fblike($atts, $content = null){
		$attributes = extract(shortcode_atts(array(
			'url' => '',
			'style' => 'standard',
			'font' => 'arial',
			'action' => 'like',
			'width' => 450,
			'height' => 30,
			'position' => 'none'), 
			$atts));
		if($url == ''){
			global $post;
			$url = get_permalink($post->ID);
		}
		$url = urlencode(htmlentities($url));
		switch($style){
			case 'standard': $button_style = 'standard'; break;
			case 'button_count': $button_style = 'button_count'; break;
			case 'box_count': $button_style = 'box_count'; break;
			default: $button_style = 'standard'; break;
		}
		switch($action){
			case 'like': $button_action = 'like'; break;
			case 'recommend': $button_action = 'recommend'; break;
			default: $button_action = 'like'; break;
		}
		switch($font){
			case 'arial': $button_font = 'arial'; break;
			case 'tahoma': $button_font = 'tahoma'; break;
			case 'verdana': $button_font = 'verdana'; break;
			case 'lucida grande': $button_font = 'lucida+grande'; break;
			case 'segoe ui': $button_font = 'segoe+ui'; break;
			case 'trebuchet ms': $button_font = 'trebuchet+ms'; break;
			default: $button_font = 'arial'; break;
		}
		switch($position){
			case 'inline': $button_position = 'none'; break;
			case 'left': $button_position = 'left'; break;
			case 'right': $button_position = 'right'; break;
			default: $button_position = 'none'; break;
		}
		
		$output = '<div class="social-like" style="float:'.$button_position.'; width:'.$width.'px; height:'.$height.'px;">';
		$output .= '<iframe src="//www.facebook.com/plugins/like.php?href='.$url;
		$output .= '&amp;send=false';
		$output .= '&amp;layout='.$button_style;
		$output .= '&amp;width='.$width;
		$output .= '&amp;show_faces=true';
		$output .= '&amp;action='.$button_action;
		$output .= '&amp;colorscheme=light';
		$output .= '&amp;font='.$button_font;
		$output .= '&amp;height='.$height;
		$output .= '" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:'.$width.'px; height:'.$height.'px;" allowTransparency="true"></iframe>';
		$output .= '</div>';
		
		return $output;
	}
	add_shortcode('fb_like', 'ctsc_shortcode_fblike');
}

/* Tweet Button Shortcode */
if(!function_exists('ctsc_shortcode_tweet')){
	function ctsc_shortcode_tweet($atts, $content = null){
		$attributes = extract(shortcode_atts(array(
			'url' => '',
			'style' => 'none',
			'width' => 450,
			'height' => 30,
			'position' => 'none'), 
			$atts));
		if($url == ''){
			global $post;
			$url = get_permalink($post->ID);
		}
		$url = urlencode(htmlentities($url));
		switch($style){
			case 'none': $button_style = 'none'; break;
			case 'horizontal': $button_style = 'horizontal'; break;
			case 'vertical': $button_style = 'vertical'; break;
			default: $button_style = 'none'; break;
		}
		switch($position){
			case 'inline': $button_position = 'none'; break;
			case 'left': $button_position = 'left'; break;
			case 'right': $button_position = 'right'; break;
			default: $button_position = 'none'; break;
		}
		
		$output = '<div class="social-tweet" style="float:'.$button_position.'; width:'.$width.'px; height:'.$height.'px;">';
		$output .= '<iframe src="http://platform.twitter.com/widgets/tweet_button.html?url='.$url;
		$output .= '&count='.$button_style;
		$output .= '&text=';
		$output .= '" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:'.$width.'px; height:'.$height.'px;" allowTransparency="true"></iframe>';
		$output .= '</div>';
		
		return $output;
	}
	add_shortcode('tweet', 'ctsc_shortcode_tweet');
}

/* Plus One Button Shortcode */
if(!function_exists('ctsc_shortcode_gplus')){
	function ctsc_shortcode_gplus($atts, $content = null){
		$attributes = extract(shortcode_atts(array(
			'counter' => '',
			'style' => '',
			'width' => 450,
			'height' => 30,
			'position' => 'none'), 
			$atts));
			
		switch($counter){
			case 'inline': $button_annotation = ' data-annotation="inline"'; break;
			case 'none': $button_annotation = ' data-annotation="none"'; break;
			default: $button_annotation = ''; break;
		}
		switch($style){
			case 'small': $button_size = ' data-size="small"'; break;
			case 'medium': $button_size = ' data-size="medium"'; break;
			case 'tall': $button_size = ' data-size="tall"'; break;
			default: $button_size = ''; break;
		}
		switch($position){
			case 'inline': $button_position = 'none'; break;
			case 'left': $button_position = 'left'; break;
			case 'right': $button_position = 'right'; break;
			default: $button_position = 'none'; break;
		}
		
		$output = '<div class="social-gplus" style="float:'.$button_position.'; width:'.$width.'px; height:'.$height.'px;">';
		$output .= '<div class="g-plusone"'.$button_size.$button_annotation.' data-width="'.$width.'"></div>';
		$output .= '</div>';
		$output .= '<script type="text/javascript"> (function(){
		var po = document.createElement(\'script\'); po.type = \'text/javascript\'; po.async = true;
		po.src = \'https://apis.google.com/js/plusone.js\';
		var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(po, s); })(); </script>';
		
		return $output;
	}
	add_shortcode('gplus', 'ctsc_shortcode_gplus');
}