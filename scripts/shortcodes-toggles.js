jQuery(document).ready(function(){
   //Accordions
	if(jQuery('.ctsc-accordion').length){
		jQuery('.ctsc-accordion').each(function(){
			var accordion = jQuery(this);
			
			accordion.find('.ctsc-accordion-title').on("click touchstart", function(e){
				accordion.find('.ctsc-accordion-content').slideToggle(300);
				accordion.toggleClass('ctsc-accordion-open');
				e.preventDefault(); 
			});
		});
	}
	
	//Tabs
	jQuery('.ctsc-tablist').tabs();
});