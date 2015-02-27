jQuery(document).ready(function(){
    	
	//INLINE SLIDESHOWS
	jQuery('.ctsc-slideshow-slides').each(function(){
		var p = this.parentNode;
		jQuery(this).cycle({
			speed: jQuery('.ctsc-slideshow-slides', p).data('speed'),
			timeout: jQuery('.ctsc-slideshow-slides', p).data('timeout'),
			fx: jQuery('.ctsc-slideshow-slides', p).data('animation'),
			pause: true,
			pauseOnPagerHover: true,
			containerResize: false,
			slideResize: false,
			fit: 1,
			before: ctsc_resize_slideshow,
			after: ctsc_resize_slideshow,
			prev: jQuery('.ctsc-slideshow-prev', p),
			next: jQuery('.ctsc-slideshow-next', p),
			pager: jQuery('.ctsc-slideshow-pages', p)
		});    
	});
	
	//CONTENT SLIDERS
	jQuery('.ctsc-slider-slides').each(function(){
		var p = this.parentNode;
		jQuery(this).cycle({
			speed: jQuery('.ctsc-slider-slides', p).data('speed'),
			timeout: jQuery('.ctsc-slider-slides', p).data('timeout'),
			fx: jQuery('.ctsc-slider-slides', p).data('animation'),
			pause: true,
			pauseOnPagerHover: true,
			containerResize: false,
			slideResize: false,
			fit: 1,
			before: ctsc_resize_slideshow,
			after: ctsc_resize_slideshow,
			prev: jQuery('.ctsc-slider-prev', p),
			next: jQuery('.ctsc-slider-next', p),
			pager: jQuery('.ctsc-slider-pages', p)
		});    
	});
	
	jQuery('.ctsc-map').each(function() {
		var data = jQuery(this).data(), // Get the data from this element
		options = { // Create map options object
			center: new google.maps.LatLng(data.lat, data.lng),
			disableDefaultUI: data.controls || false,
			zoom: data.zoom || 15,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		var styles = [{
			stylers: [{ hue: data.color }, { saturation: -20 }]
		},{
			featureType: "road",
			elementType: "labels",
			stylers: [{ visibility: "off" }]
		}];

		// Create and display the map
		var map = new google.maps.Map(this, options);
		map.setOptions({styles: styles});
	});
	
	//FADE IN ELEMENTS WHEN SCROLLING
	ctsc_waypoint_fade();
	
	//FILL PROGRESS BARS
	ctsc_waypoint_progress();
	
	//SKIPPING BUTTONS
	//Adds smooth scrolling to an anchor link with the specified class
	jQuery('.ctsc-back-top').click(function(e){
		e.preventDefault();
		var target_id = jQuery(this).attr('href');
		jQuery('html, body').animate({
			scrollTop: jQuery(target_id).offset().top
		}, 1000);
	});
});

//Resizes slideshow height after each transition
function ctsc_resize_slideshow(curr, next, opts, fwd) {
	var ht = jQuery(this).height();
	jQuery(this).parent().animate({height: ht});
}

function ctsc_waypoint_fade(){
	if(jQuery.isFunction(jQuery.fn.waypoint)){
		jQuery('.ctsc-animation').waypoint(function(){ 
			var area_delay = 0;
			var element = jQuery(this);
			if(jQuery(this).attr('data-delay'))	area_delay = jQuery(this).attr('data-delay');
			setTimeout(function(){ element.addClass('ctsc-animation-active'); }, area_delay);
		},{ offset:'80%' });
	}
}

function ctsc_waypoint_progress(){
	if(jQuery.isFunction(jQuery.fn.waypoint)){
		jQuery('.ctsc-progress .bar-content').waypoint(function(){ 
			var element = jQuery(this);
			var progress_data = element.data();
			element.animate({ width: progress_data.value + '%' }, 1500);
		},{ 
			offset:'95%'
		});
	}
}