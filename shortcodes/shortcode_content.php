<?php 

/* Dropcap Shortcode */
if(!function_exists('ctsc_shortcode_dropcap')){
	function ctsc_shortcode_dropcap($atts, $content = null){
		wp_enqueue_script('ctsc-cycle');
		wp_enqueue_script('ctsc-waypoints');
		wp_enqueue_script('ctsc-toggles');
		wp_enqueue_script('ctsc-core');
		wp_enqueue_style('ctsc-shortcodes');
		wp_enqueue_style('ctsc-fontawesome');
		
		$attributes = extract(shortcode_atts(array(
		'title' => '',
		'style' => '',
		'color' => '',
		'icon' => ''), $atts));
		
		$title = trim(strip_tags($title));
		$color = trim(strip_tags($color));
		$style = trim(strip_tags($style));
		$content = trim(strip_tags($content));
		
		
		$random_id = rand();

		$output = '';
		
		if($style != '') $color_property = 'background-'; else $color_property = '';
		if($color != '') 
			$output .= '<style>.ctsc-dropcap-'.$random_id.' { '.$color_property.'color:'.$color.'; }</style>';
		
		$output .= '<span class="ctsc-dropcap ctsc-dropcap-'.$random_id.' ctsc-dropcap-'.$style.'">'.$content.'</span>';
		
		return $output;
	}
	add_shortcode('dropcap', 'ctsc_shortcode_dropcap');
}


/* Leading Paragraph Shortcode */
if(!function_exists('ctsc_shortcode_leading')){
	function ctsc_shortcode_leading($atts, $content = null){
		wp_enqueue_script('ctsc-cycle');
		wp_enqueue_script('ctsc-waypoints');
		wp_enqueue_script('ctsc-toggles');
		wp_enqueue_script('ctsc-core');
		wp_enqueue_style('ctsc-shortcodes');
		wp_enqueue_style('ctsc-fontawesome');
		
		$attributes = extract(shortcode_atts(array(
		'icon' => ''), $atts));
		
		$content = trim($content);
		$output = '<span class="ctsc-leading">'.$content.'</span>';
		
		return $output;
	}
	add_shortcode('leading', 'ctsc_shortcode_leading');
}


/* List Shortcode */
if(!function_exists('ctsc_shortcode_list')){
	function ctsc_shortcode_list($atts, $content = null){
		wp_enqueue_script('ctsc-cycle');
		wp_enqueue_script('ctsc-waypoints');
		wp_enqueue_script('ctsc-toggles');
		wp_enqueue_script('ctsc-core');
		wp_enqueue_style('ctsc-shortcodes');
		wp_enqueue_style('ctsc-fontawesome');
		
		$attributes = extract(shortcode_atts(array(
			'icon' => '',
			'size' => '',
			'style' => '',
			'color' => ''
			), 
			$atts));
		
		$icon = trim(strip_tags($icon));
		$style = trim(strip_tags($style));
		$size = trim(strip_tags($size));
		$color = trim(strip_tags($color));
		
		
		$random_id = rand();
		
		$output = '';
		$output .= '<style>';
		//Section Styling
		$output .= '.ctsc-list-'.$random_id.' .ctsc-list-icon { ';
		$classes = '';
		if($color != ''){
			if(in_array($style, array('round', 'square'))) 
				$output .= ' background-color:'.$color.'; color:#fff;';
			else
				$output .= ' color:'.$color.';';
		}else{
			if(in_array($style, array('round', 'square'))) 
				$classes = ' primary-color-bg';
			else
				$classes = ' primary-color';
		}
		$output .= ' }';
		$output .= '</style>';
		
		if($icon != '') $content = str_replace('<li>', '<li><span class="ctsc-list-icon icon-'.$icon.$classes.'"></span> ', $content);
		$output .= '<div class="ctsc-list ctsc-list-'.$random_id.' ctsc-list-'.$style.'">';
		$output .= ctsc_do_shortcode($content);
		$output .= '</div>';
				
		return $output;
	}
	add_shortcode('list', 'ctsc_shortcode_list');
}


/* Definition Lists Shortcode */
if(!function_exists('ctsc_shortcode_definition')){
	function ctsc_shortcode_definition($atts, $content = null){
		wp_enqueue_script('ctsc-cycle');
		wp_enqueue_script('ctsc-waypoints');
		wp_enqueue_script('ctsc-toggles');
		wp_enqueue_script('ctsc-core');
		wp_enqueue_style('ctsc-shortcodes');
		wp_enqueue_style('ctsc-fontawesome');
		
		$attributes = extract(shortcode_atts(array(
			'title' => '', 
			),
			$atts));
		
		$content = ctsc_do_shortcode($content);
		
		$output = '<dl class="ctsc-definition">';
		if($title != '') $output .= '<dt class="ctsc-definition-term">'.$title.'</dt>';
		if($content != '') $output .= '<dd class="ctsc-definition-description">'.$content.'</dd>';
		$output .= '</dl>';
		
		return $output;
	}
	add_shortcode('definition', 'ctsc_shortcode_definition');
}


/* Recent Posts Shortcode */
if(!function_exists('ctsc_shortcode_posts')){
	function ctsc_shortcode_posts($atts, $content = null){
		wp_enqueue_script('ctsc-cycle');
		wp_enqueue_script('ctsc-waypoints');
		wp_enqueue_script('ctsc-toggles');
		wp_enqueue_script('ctsc-core');
		wp_enqueue_style('ctsc-shortcodes');
		wp_enqueue_style('ctsc-fontawesome');
		
		$attributes = extract(shortcode_atts(array(
		'type' => 'post',
		'order' => 'DESC',
		'orderby' => 'date',
		'style' => '',
		'thumbnail' => 'thumbnail',
		'excerpt' => '',
		'date' => '',
		'author' => '',
		'comments' => '',
		'readmore' => '',
		'category' => '',
		'columns' => 3,
		'number' => 6,
		), $atts));
		
		$template_element = 'element';
		$template_part = 'blog';
		$random_id = rand();
		$output = '';
		
		//Layout columns
		if(!is_numeric($columns)) $columns = 3; 
		elseif($columns < 1) $columns = 1; 
		elseif($columns > 5) $columns = 5;
		
		//Post number
		if(!is_numeric($number)) $number = 5; 
		elseif($number < 1) $number = 1; 
		elseif($number > 500) $number = 500;
		
		//Create the query
		$args = array(
		'post_type' => $type, 
		'order' => $order, 
		'orderby' => $orderby, 
		'posts_per_page' => $number, 
		'nopaging' => 0, 
		'post_status' => 'publish', 
		'ignore_sticky_posts' => 1);
		$query = new WP_Query($args);
		
		if($query->have_posts()): 
		$item_count = 0;
		$output = '<section id="ctsc-postlist-'.$random_id.'" class="ctsc-postlist ctsc-postlist-'.$style.'">';
			while($query->have_posts()): $query->the_post();
			if($item_count % $columns == 0 && $item_count != 0) 
				$output .= '<div class="col-divide"></div>';
			$item_count++;
			if($item_count % $columns == 0 && $item_count != 0) 
				$col_last = ' col-last'; 
			else 
				$col_last = '';
			$output .= '<div class="ctsc-column ctsc-col'.$columns.$col_last.'">';
			
			//Post Item Output
			$output .= '<div class="ctsc-post">';
			if(has_post_thumbnail() && $thumbnail != 'none')
				$output .= '<div class="ctsc-post-thumbnail"><a href="'.get_permalink(get_the_ID()).'">'.get_the_post_thumbnail(get_the_ID(), $thumbnail).'</a></div>';
			$output .= '<div class="ctsc-post-body">';
			$output .= '<h3 class="ctsc-post-title"><a href="'.get_permalink(get_the_ID()).'">'.get_the_title().'</a></h3>';
			$output .= '<div class="ctsc-post-byline">';
			if($date != 'none')
				$output .= '<div class="ctsc-post-date">'.get_the_time(get_option('date_format')).'</div>';
			if($author != 'none')
				$output .= '<div class="ctsc-post-author"><a href="'.get_author_posts_url(get_the_author_meta('ID')).'">'.__('By', 'cpocore').' '.get_the_author().'</a></div>';
			$output .= '</div>';
			if($style != 'list' || $excerpt != 'none')
				$output .= '<div class="ctsc-post-content">'.get_the_excerpt().'</div>';
			if($readmore != '')
				$output .= '<a class="ctsc-post-readmore" href="'.get_permalink(get_the_ID()).'">'.$readmore.'</a>';
			$output .= '</div>';
			$output .= '</div>';
			
			$output .= '</div>';
			endwhile;
		$output .= '<div class="clear"></div>';
		$output .= '</section>';
		
		//Finish up and return output
		wp_reset_query();
		wp_reset_postdata();
		endif;
		
		return $output;
	}
	add_shortcode('posts', 'ctsc_shortcode_posts');
}


/* Recent Posts Shortcode */
if(!function_exists('ctsc_shortcode_portfolio')){
	function ctsc_shortcode_portfolio($atts, $content = null){
		wp_enqueue_script('ctsc-cycle');
		wp_enqueue_script('ctsc-waypoints');
		wp_enqueue_script('ctsc-toggles');
		wp_enqueue_script('ctsc-core');
		wp_enqueue_style('ctsc-shortcodes');
		wp_enqueue_style('ctsc-fontawesome');
		
		$attributes = extract(shortcode_atts(array(
		'nav' => '',
		'category' => '',
		'style' => '',
		'order' => 'ASC',
		'orderby' => 'menu_order',
		'columns' => 3,
		'number' => 5,
		), $atts));
		
		$template_element = 'element';
		$template_part = 'portfolio';
		$random_id = rand();
		$output = '';
		
		//Layout columns
		if(!is_numeric($columns)) $columns = 1; 
		elseif($columns < 1) $columns = 1; 
		elseif($columns > 5) $columns = 5;
		
		//Post number
		if(!is_numeric($number)) $number = 5; 
		elseif($number < 1) $number = 1; 
		elseif($number > 500) $number = 500;
		
		//Create the query
		$tax_query = array();
		if(is_numeric($category))
			$tax_query[] = array('taxonomy' => 'cpo_portfolio_category', 'terms' => $category, 'field' => 'id');
		$args = array(
		'post_type' => 'cpo_portfolio', 
		'order' => $order, 
		'orderby' => $orderby, 
		'posts_per_page' => $number);
		if(!empty($tax_query)) $args['tax_query'] = $tax_query;
		
		//Execute the query
		$query = new WP_Query($args);
		
		if($query->have_posts()): 
		$item_count = 0;
		ob_start();
		
		if($nav != '') 
			get_template_part($template_element, $template_part.'-nav');
		
		echo '<section id="portfolio-'.$random_id.'" class="portfolio">';
			while($query->have_posts()): $query->the_post();
			if($item_count % $columns == 0 && $item_count != 0) 
				echo '<div class="col-divide"></div>';
			$item_count++;
			if($item_count % $columns == 0 && $item_count != 0) 
				$col_last = ' col-last'; 
			else 
				$col_last = '';
				
			if($columns > 1) echo '<div class="ctsc-column ctsc-col'.$columns.$col_last.'">';
			get_template_part($template_element, $template_part);
			if($columns > 1) echo '</div>';
			endwhile;
		echo '<div class="clear"></div>';
		echo '</section>';
		
		//Finish up and return output
		$output = ob_get_clean();
		wp_reset_query();
		wp_reset_postdata();
		endif;
		
		return $output;
	}
	add_shortcode('portfolio', 'ctsc_shortcode_portfolio');
}