<?php 

/* Accordion Shortcode */
if(!function_exists('ctsc_shortcode_accordion')){
	function ctsc_shortcode_accordion($atts, $content = null){
		//Enqueue necessary scripts
		wp_enqueue_script('jquery-ui-accordion');
		wp_enqueue_script('ctsc-core');
		wp_enqueue_script('ctsc-toggles');
		wp_enqueue_style('ctsc-fontawesome');
		
		$attributes = extract(shortcode_atts(array(
		'title' => '(No Title)', 
		'icon' => '', 
		'style' => '', 
		'state' => ''),
		$atts));
		
		$content = trim($content);
		$title = trim(htmlentities(strip_tags($title), ENT_QUOTES, "UTF-8"));
		if($icon != '') $icon = '<span class="ctsc-accordion-icon primary_color icon-'.htmlentities($icon).'"></span> ';
		if($style != '') $style = ' ctsc-accordion-'.$style;
		
		$output = '<div class="ctsc-accordion'.$style;
		if($state == 'open') 
			$output .= ' ctsc-accordion-open';
		$output .= '">';
		$output .= '<h4 class="ctsc-accordion-title">';
		$output .= $icon;
		$output .= $title.'</h4>';
		$output .= '<div class="ctsc-accordion-content"';
		if($state != 'open')
			$output .= ' style="display:none;"';
		$output .= '>'.ctsc_do_shortcode($content).'</div>';
		$output .= '</div>';
		
		return $output;
	}
	add_shortcode('accordion', 'ctsc_shortcode_accordion');
}


/* Tablist Shortcode */
if(!function_exists('ctsc_shortcode_tablist')){
	function ctsc_shortcode_tablist($atts, $content = null){
		//Enqueue necessary scripts
		wp_enqueue_script('jquery-ui-tabs');
		wp_enqueue_script('ctsc-core');
		wp_enqueue_script('ctsc-toggles');
		
		$attributes = extract(shortcode_atts(array('style' => 'horizontal'), $atts));
		$content = trim($content);
		
		$output = '<div class="ctsc-tablist ctsc-tablist-'.$style.'">';
		
		//Parse individual tab contents into tabs
		preg_match_all('/tab title="([^\"]+)"/i', $content, $results, PREG_OFFSET_CAPTURE);
		$tab_titles = array();
		if(isset($results[1]))
			$tab_titles = $results[1];
		$output .= '<ul class="ctsc-tablist-nav">';
		foreach($tab_titles as $tab)
			$output .= '<li><a href="#ctsc-tab-content-'.sanitize_title($tab[0]).'">'.$tab[0].'</a></li>';
		$output .= '</ul>';
		
		if(count($tab_titles))
		    $output .= ctsc_do_shortcode($content);
		else
			$output .= do_shortcode($content);
		
		$output .= '</div>';
		return $output;
	}
	add_shortcode('tabs', 'ctsc_shortcode_tablist');
}


/* Tab Shortcode */
if(!function_exists('ctsc_shortcode_tab')){
	function ctsc_shortcode_tab($atts, $content = null){
		$attributes = extract(shortcode_atts(array(
		'title' => '(No Title)', 
		'icon' => '', 
		'state' => ''),
		$atts));
			
		$content = trim($content);
		if($icon != '') $icon = '<span class="icon icon-'.htmlentities($icon).'"></span> ';
		
		return '<div id="ctsc-tab-content-'.sanitize_title($title).'" class="ctsc-tab-content">'.ctsc_do_shortcode($content).'</div>';
	}
	add_shortcode('tab', 'ctsc_shortcode_tab');
}


/* Slideshow Wrapper Shortcode */
if(!function_exists('ctsc_shortcode_slideshow')){
	function ctsc_shortcode_slideshow($atts, $content = null){
		wp_enqueue_script('ctsc-core');
		wp_enqueue_script('ctsc-toggles');
		wp_enqueue_script('ctsc-cycle');
		
		$attributes = extract(shortcode_atts(array(
		'animation' => '', 
		'navigation' => '', 
		'pager' => '', 
		'state' => ''),
		$atts));		
		$content = trim($content);
		
		
		$output = '<div class="ctsc-slideshow">';
		$output .= '<div class="ctsc-slideshow-slides">';
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
	add_shortcode('slideshow', 'ctsc_shortcode_slideshow');
}


/* Slides Shortcode */
if(!function_exists('ctsc_shortcode_slide')){
	function ctsc_shortcode_slide($atts, $content = null){
		$attributes = extract(shortcode_atts(array(
		'caption' => '', 
		'state' => ''),
		$atts));
		$content = trim($content);
		
		$output = '<div class="ctsc-slideshow-slide">';
		if($caption != '') $output .= '<div class="ctsc-slideshow-caption">'.$caption.'</div>';
		$output .= ctsc_do_shortcode($content);
		$output .= '</div>';
		return $output;
	}
	add_shortcode('slide', 'ctsc_shortcode_slide');
}