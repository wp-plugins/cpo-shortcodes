<?php 

if(!class_exists('ctsc_shortcode_slideshow')){
	class ctsc_shortcode_slideshow{

		function __construct(){
			add_shortcode(ctsc_shortcode_prefix().'slideshow', array($this, 'shortcode_create'));
		}
		
		/* slideshow Wrapper Shortcode */
		function shortcode_create($atts, $content = null){
			wp_enqueue_script('ctsc-core');
			wp_enqueue_script('ctsc-toggles');
			wp_enqueue_script('ctsc-cycle');
			
			$attributes = extract(shortcode_atts(array(
			'effect' => 'fade', 
			'images' => '', 
			'speed' => '1500', 
			'timeout' => '6000', 
			'navigation' => '', 
			'pager' => '', 
			'state' => '',
			'id' => '',
			'class' => '',
			'animation' => ''),
			$atts));		
			
			$element_effect = ' data-animation = "'.esc_attr($effect).'"';
			$element_speed = ' data-speed = "'.esc_attr($speed).'"';
			$element_timeout = ' data-timeout = "'.esc_attr($timeout).'"';
			$element_class = ' '.$class;
			$element_id = $id != '' ? ' id="'.$id.'"' : '';
			
			//Entrace effects and delay
			if($animation != ''){
				wp_enqueue_script('ctsc-waypoints');
				wp_enqueue_script('ctsc-core');			
				$element_class .= ' ctsc-animation ctsc-animation-'.$animation;
			}
			
			$output = '<div class="ctsc-slideshow '.$element_class.'"'.$element_id.'>';
			$output .= '<div class="ctsc-slideshow-slides"'.$element_effect.$element_speed.$element_timeout.'>';
			$output .= ctsc_do_shortcode($content);
			$output .= '</div>';
			if($navigation != 'none'){
				$output .= '<div class="ctsc-slideshow-prev"></div>';
				$output .= '<div class="ctsc-slideshow-next"></div>';
			} 
			if($pager != 'none') $output .= '<div class="ctsc-slideshow-pages pages_'.$pager.'"></div>';
			$output .= '</div>';
			return $output;
		}
	}
}



if(!class_exists('ctsc_shortcode_slide')){
	class ctsc_shortcode_slide{

		function __construct(){
			add_shortcode(ctsc_shortcode_prefix().'slide', array($this, 'shortcode_create'));
		}
	
		
		/* Single Slide Shortcode -- For use within the content slideshow */
		function shortcode_create($atts, $content = null){
			wp_enqueue_script('ctsc-core');
			wp_enqueue_script('ctsc-toggles');
			wp_enqueue_script('ctsc-cycle');
			
			$attributes = extract(shortcode_atts(array(
			'id' => '',
			'class' => ''),
			$atts));		
			
			$element_class = ' '.$class;
			$element_id = $id != '' ? ' id="'.$id.'"' : '';
			
			$output = '<div class="ctsc-slideshow-slide '.$element_class.'"'.$element_id.'>';
			$output .= ctsc_do_shortcode($content);
			$output .= '</div>';
			return $output;
		}
	}
}

$ctsc_shortcode_slideshow = new ctsc_shortcode_slideshow;
$ctsc_shortcode_slide = new ctsc_shortcode_slide;