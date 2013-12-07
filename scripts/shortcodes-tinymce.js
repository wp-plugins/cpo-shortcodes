(function(){
	tinymce.create('tinymce.plugins.ctsc_shortcodes', {
		init: function(ed, url){},
		createControl: function(button, e){
			if(button == "ctsc_shortcodes_button"){
				var current_object = this;	
				var button = e.createSplitButton('ctsc_button', {
	                title: "Add Shortcode",
					image: ctsc_shortcodes_vars.toolbar_icon,
					icons: false
	            });
	            button.onRenderMenu.add(function(c, b){
					//Design Elements
					c = b.addMenu({title:"Basic Elements"});
					current_object.render(c, "Button", "button");
					current_object.render(c, "Notice", "notice");
					current_object.render(c, "Message Box", "message");
					current_object.render(c, "Progress Bar", "progress");
					current_object.render(c, "Mini Feature", "feature");
					current_object.render(c, "Team Member", "team");
					current_object.render(c, "Testimonial", "testimonial");
					current_object.render(c, "Counter", "counter");
					
					//Advanced
					c = b.addMenu({title:"Interactive"});
					current_object.render(c, "Accordion", "accordion");
					current_object.render(c, "Tab Group", "tabs");
					current_object.render(c, "Slideshow", "slideshow");
					current_object.render(c, "Google Map", "map");
					current_object.render(c, "Pricing Table", "pricing");
					
					//Content
					c = b.addMenu({title:"Content"});
					current_object.render(c, "Dropcap", "dropcap");
					current_object.render(c, "Lead Paragraph", "leading");
					current_object.render(c, "Custom List", "list");
					//current_object.render(c, "Recent Items", "recent_items");
					
					//Social
					c = b.addMenu({title:"Social"});
					current_object.render(c, "Facebook Like Button", "like_button");
					current_object.render(c, "Tweet Button", "tweet_button");
					current_object.render(c, "Google +1 Button", "plusone_button");
					
					//Columns
					c = b.addMenu({title:"Layout"});
					current_object.render(c, "2 Columns", "column2");
					current_object.render(c, "3 Columns", "column3");
					current_object.render(c, "4 Columns", "column4");
					current_object.render(c, "5 Columns", "column5");
					//current_object.render(c, "4/3 + 1/3 Columns", "column4x3_3");
					current_object.render(c, "Section", "section");
					current_object.render(c, "Separator", "separator");
					
				});
				return button;
			}
			return null;               
		},
		render: function(ed, title, value){
			ed.add({
				title: title,
				onclick: function (){
					
					//Retrieve selected content
					var selected_content = tinyMCE.activeEditor.selection.getContent();
					if(!selected_content)
						var selected_content = 'Content';
					
					
					//Design Elements
					if(value == "button")
						tinyMCE.activeEditor.selection.setContent('[button color="red" url="http://www.url.com" size="medium"]' + selected_content + '[/button]');
					
					if(value == "notice")
						tinyMCE.activeEditor.selection.setContent('[notice]' + selected_content + '[/notice]');
					
					if(value == "message")
						tinyMCE.activeEditor.selection.setContent('[message type="info"]' + selected_content + '[/message]');
					
					if(value == "progress")
						tinyMCE.activeEditor.selection.setContent('[progress color="red" icon="" size="" value="" title="Progress Bar"]');
					
					if(value == "feature")
						tinyMCE.activeEditor.selection.setContent('[feature icon="flag" style="horizontal" title="Title"]' + selected_content + '[/feature]');
					
					if(value == "team")
						tinyMCE.activeEditor.selection.setContent('[team image="" name="Member Name" title="Job Title" web="" facebook="" twitter="" gplus=""]' + selected_content + '[/team]');
					
					if(value == "testimonial")
						tinyMCE.activeEditor.selection.setContent('[testimonial image="" name="Testimonial Name" title="Job Title"]' + selected_content + '[/testimonial]');
					
					if(value == "counter")
						tinyMCE.activeEditor.selection.setContent('[counter icon="ok" Title="Counter Title" number="999"]' + selected_content + '[/counter]');
					
					
					//Interactive
					if(value == "accordion")
						tinyMCE.activeEditor.selection.setContent('[accordion title="Title" state="open"]' + selected_content + '[/accordion]');
					
					if(value == "tabs")
						tinyMCE.activeEditor.selection.setContent('[tabs][tab title="Title"]' + selected_content + '[/tab][/tabs]');
					
					if(value == "slideshow")
						tinyMCE.activeEditor.selection.setContent('[slideshow][slide]' + selected_content + '[/slide][/slideshow]');
					
					if(value == "map")
						tinyMCE.activeEditor.selection.setContent('[map latitude="" longitude="" color="" height="400"]');
					
					if(value == "pricing")
						tinyMCE.activeEditor.selection.setContent('[pricing_table][pricing_item title="Title" price="100" coin="$" url="" urltitle="Read More"]' + selected_content + '[/pricing_item][/pricing_table]');
					
					
					//Content Lists
					if(value == "dropcap")
						tinyMCE.activeEditor.selection.setContent('[dropcap style="square"]' + selected_content + '[/dropcap]');
					
					if(value == "leading")
						tinyMCE.activeEditor.selection.setContent('[leading]' + selected_content + '[/leading]');
					
					if(value == "list")
						tinyMCE.activeEditor.selection.setContent('[list icon="ok" style="round"]' + selected_content + '[/list]');
					
					if(value == "recent_items")
						tinyMCE.activeEditor.selection.setContent('[recent_posts number="5"]');
					
					
					//Social
					if(value == "like_button")
						tinyMCE.activeEditor.selection.setContent('[fb_like url="" style="standard" font="arial" action="like" width="450" height="30" position="none"]');
					
					if(value == "tweet_button")
						tinyMCE.activeEditor.selection.setContent('[tweet url="" style="none" font="arial" action="like" width="450" height="30" position="none"]');
					
					if(value == "plusone_button")
						tinyMCE.activeEditor.selection.setContent('[gplus counter="" style="" width="450" height="30" position="none"]');
					
					
					//Columns
					if(value == "column2")
						tinyMCE.activeEditor.selection.setContent('[column_half]<br><br>Column<br><br>[/column_half][column_half_last]<br><br>Column<br><br>[/column_half_last]');
					
					if(value == "column3")
						tinyMCE.activeEditor.selection.setContent('[column_third]<br><br>Column<br><br>[/column_third][column_third]<br><br>Column<br><br>[/column_third][column_third_last]<br><br>Column<br><br>[/column_third_last]');
					
					if(value == "column4")
						tinyMCE.activeEditor.selection.setContent('[column_fourth]<br><br>Column<br><br>[/column_fourth][column_fourth]<br><br>Column<br><br>[/column_fourth][column_fourth]<br><br>Column<br><br>[/column_fourth][column_fourth_last]<br><br>Column<br><br>[/column_fourth_last]');
					
					if(value == "column5")
						tinyMCE.activeEditor.selection.setContent('[column_fifth]<br><br>Column<br><br>[/column_fifth][column_fifth]<br><br>Column<br><br>[/column_fifth][column_fifth]<br><br>Column<br><br>[/column_fifth][column_fifth]<br><br>Column<br><br>[/column_fifth][column_fifth_last]<br><br>Column<br><br>[/column_fifth_last]');
					
					if(value == "separator")
						tinyMCE.activeEditor.selection.setContent('[separator type="top"]' + selected_content + '[/separator]');
					
					if(value == "section")
						tinyMCE.activeEditor.selection.setContent('[section background="#666666" color="dark"]' + selected_content + '[/section]');
					
					return false;
				}
			})
		}
	
	});
	tinymce.PluginManager.add("ctsc_shortcodes", tinymce.plugins.ctsc_shortcodes);
})();  