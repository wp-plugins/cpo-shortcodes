(function(){
	tinymce.PluginManager.add('ctsc_shortcodes', function( editor, url ){
		editor.addButton('ctsc_shortcodes_button', {
			title: 'WPShards Shortcodes',
			type: 'menubutton',
			icon: 'icon ctsc-shortcodes-icon',
			menu: [
				{
					text: 'Design Elements',
					menu: [
						{ text: 'Button', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.shortcode_prefix + 'button background="gray" gradient="black" color="white" url="http://google.com" size="normal" position="none"]' + editor.selection.getContent() + '[/' + ctsc_vars.shortcode_prefix + 'button]'); } },
						/*{
							text: 'Button',
							onclick: function(){ 
								editor.windowManager.open({
									title: 'Create Button',
									body: ctsc_generator_button,
									onsubmit: function(e){
										editor.selection.setContent('[button url="' + e.data.buttonUrl + '" color="' + e.data.buttonColor + '" size="' + e.data.buttonSize + '" border_radius="' + e.data.buttonBorderRadius + '" target="' + e.data.buttonLinkTarget + '" rel="' + e.data.buttonRel + '" icon_left="' + e.data.buttonLeftIcon + '" icon_right="' + e.data.buttonRightIcon + '"]' + e.data.buttonText + '[/button]');
									}
								});
							}
						},*/
						
						{ text: 'Image Banner', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.shortcode_prefix + 'banner image="123" color="light" style="round" position="top" align="left"]' + editor.selection.getContent() + '[/' + ctsc_vars.shortcode_prefix + 'banner]'); } },
						{ text: 'Focus Box', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.shortcode_prefix + 'focus color="light" background="lightgrey" gradient="darkgray" style="normal"]' + editor.selection.getContent() + '[/' + ctsc_vars.shortcode_prefix + 'focus]'); } },
						{ text: 'Message', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.shortcode_prefix + 'message type="info"]' + editor.selection.getContent() + '[/' + ctsc_vars.shortcode_prefix + 'message]'); } },
						{ text: 'Progress', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.shortcode_prefix + 'progress color="red" icon="ok" size="normal" value="50" title="Progress Bar"]'); } },
						{ text: 'Inline Feature', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.shortcode_prefix + 'feature icon="flag" style="horizontal" title="Title"]' + editor.selection.getContent() + '[/' + ctsc_vars.shortcode_prefix + 'feature]'); } },
						{ text: 'Team Member', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.shortcode_prefix + 'team image="" name="Member Name" title="Job Title" web="" facebook="" twitter="" gplus=""]' + editor.selection.getContent() + '[/' + ctsc_vars.shortcode_prefix + 'team]'); } },
						{ text: 'Testimonial', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.shortcode_prefix + 'testimonial image="" name="Testimonial Name" title="Job Title"]' + editor.selection.getContent() + '[/' + ctsc_vars.shortcode_prefix + 'testimonial]'); } },
						{ text: 'Counter', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.shortcode_prefix + 'counter icon="ok" title="Counter Title" number="999"]' + editor.selection.getContent() + '[/' + ctsc_vars.shortcode_prefix + 'counter]'); } },
						{ text: 'Definition', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.shortcode_prefix + 'definition title="Definition Title"]' + editor.selection.getContent() + '[/' + ctsc_vars.shortcode_prefix + 'definition]'); } },
					]
				},
				{
					text: 'Interactive',
					menu: [		
						{ text: 'Accordion', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.shortcode_prefix + 'accordion title="Title" state="open"]' + editor.selection.getContent() + '[/' + ctsc_vars.shortcode_prefix + 'accordion]'); } },
						{ text: 'Tabbed Content', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.shortcode_prefix + 'tabs][' + ctsc_vars.shortcode_prefix + 'tab title="Title"]' + editor.selection.getContent() + '[/' + ctsc_vars.shortcode_prefix + 'tab][/' + ctsc_vars.shortcode_prefix + 'tabs]'); } },
						{ text: 'Slideshow', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.shortcode_prefix + 'slideshow][' + ctsc_vars.shortcode_prefix + 'slide]' + editor.selection.getContent() + '[/' + ctsc_vars.shortcode_prefix + 'slide][/' + ctsc_vars.shortcode_prefix + 'slideshow]'); } },
						{ text: 'Map', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.shortcode_prefix + 'map latitude="" longitude="" color="" height="400"]'); } },
						{ text: 'Pricing Table', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.shortcode_prefix + 'pricing_table][' + ctsc_vars.shortcode_prefix + 'pricing_item title="Title" price="100" coin="$" url="" urltitle="Read More"]' + editor.selection.getContent() + '[/' + ctsc_vars.shortcode_prefix + 'pricing_item][/' + ctsc_vars.shortcode_prefix + 'pricing_table]'); } },
					]
				},
				{
					text: 'Content',
					menu: [			
						{ text: 'Dropcap', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.shortcode_prefix + 'dropcap style="square"]' + editor.selection.getContent() + '[/' + ctsc_vars.shortcode_prefix + 'dropcap]'); } },
						{ text: 'Leading', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.shortcode_prefix + 'leading]' + editor.selection.getContent() + '[/' + ctsc_vars.shortcode_prefix + 'leading]'); } },
						{ text: 'List', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.shortcode_prefix + 'list icon="ok" style="round"]' + editor.selection.getContent() + '[/' + ctsc_vars.shortcode_prefix + 'list]'); } },
						{ text: 'Post List', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.shortcode_prefix + 'posts type="post" number="5" columns="1"]'); } },
					]
				},
				/*{
					text: 'Social',
					menu: [			
						{ text: 'Like Button', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.shortcode_prefix + 'fb_like url="" style="standard" font="arial" action="like" width="450" height="30" position="none"]'); } },
						{ text: 'Tweet Button', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.shortcode_prefix + 'tweet url="" style="none" font="arial" action="like" width="450" height="30" position="none"]'); } },
						{ text: '+1 Button', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.shortcode_prefix + 'gplus counter="" style="" width="450" height="30" position="none"]'); } },
					]
				},*/
				{
					text: 'Layout',
					menu: [			
						{ text: 'Two Columns', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.shortcode_prefix + 'column_half]<br><br>Column<br><br>[/' + ctsc_vars.shortcode_prefix + 'column_half][' + ctsc_vars.shortcode_prefix + 'column_half_last]<br><br>Column<br><br>[/' + ctsc_vars.shortcode_prefix + 'column_half_last]'); } },
						{ text: 'Three Columns', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.shortcode_prefix + 'column_third]<br><br>Column<br><br>[/' + ctsc_vars.shortcode_prefix + 'column_third][' + ctsc_vars.shortcode_prefix + 'column_third]<br><br>Column<br><br>[/' + ctsc_vars.shortcode_prefix + 'column_third][' + ctsc_vars.shortcode_prefix + 'column_third_last]<br><br>Column<br><br>[/' + ctsc_vars.shortcode_prefix + 'column_third_last]'); } },
						{ text: 'Four Columns', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.shortcode_prefix + 'column_fourth]<br><br>Column<br><br>[/' + ctsc_vars.shortcode_prefix + 'column_fourth][' + ctsc_vars.shortcode_prefix + 'column_fourth]<br><br>Column<br><br>[/' + ctsc_vars.shortcode_prefix + 'column_fourth][' + ctsc_vars.shortcode_prefix + 'column_fourth]<br><br>Column<br><br>[/' + ctsc_vars.shortcode_prefix + 'column_fourth][' + ctsc_vars.shortcode_prefix + 'column_fourth_last]<br><br>Column<br><br>[/' + ctsc_vars.shortcode_prefix + 'column_fourth_last]'); } },
						{ text: 'Five Columns', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.shortcode_prefix + 'column_fifth]<br><br>Column<br><br>[/' + ctsc_vars.shortcode_prefix + 'column_fifth][' + ctsc_vars.shortcode_prefix + 'column_fifth]<br><br>Column<br><br>[/' + ctsc_vars.shortcode_prefix + 'column_fifth][' + ctsc_vars.shortcode_prefix + 'column_fifth]<br><br>Column<br><br>[/' + ctsc_vars.shortcode_prefix + 'column_fifth][' + ctsc_vars.shortcode_prefix + 'column_fifth]<br><br>Column<br><br>[/' + ctsc_vars.shortcode_prefix + 'column_fifth][' + ctsc_vars.shortcode_prefix + 'column_fifth_last]<br><br>Column<br><br>[/' + ctsc_vars.shortcode_prefix + 'column_fifth_last]'); } },
						{ text: 'Separator', onclick: function(){ editor.selection.setContent('[' + ctsc_vars.shortcode_prefix + 'separator type="top"]' + editor.selection.getContent() + '[/' + ctsc_vars.shortcode_prefix + 'separator]'); } },
					]
				}

			]
		});
	});
})();

var ctsc_generator_button = [
	
	//Text
	{ 
		type: 'textbox', 
		name: 'buttonText', 
		label: 'Button: Text', 
		value: 'Download' 
	},

	//URL
	{
		type: 'textbox',
		name: 'buttonUrl',
		label: 'Button: URL',
		value: 'http://www.wpexplorer.com/symple-shortcodes/'
	},

	//Border Radius
	{
		type: 'textbox',
		name: 'buttonBorderRadius',
		label: 'Button: Border Radius',
		value: '3px'
	},

	//Color
	{
		type: 'listbox', 
		name: 'buttonColor', 
		label: 'Button: Color',
		'values': [
			{text: 'Black', value: 'black'},
			{text: 'Blue', value: 'blue'},
			{text: 'Brown', value: 'brown'},
			{text: 'Grey', value: 'grey'},
			{text: 'Green', value: 'green'},
			{text: 'Gold', value: 'gold'},
			{text: 'Orange', value: 'orange'},
			{text: 'Pink', value: 'pink'},
			{text: 'Red', value: 'red'},
			{text: 'Rosy', value: 'rosy'},
			{text: 'Teal', value: 'teal'}
		]
	},
	{
		type: 'listbox',
		name: 'buttonSize',
		label: 'Button: Size',
		'values': [
			{text: 'Default', value: 'default'},
			{text: 'Small', value: 'small'},
			{text: 'Medium', value: 'medium'},
			{text: 'Large', value: 'large'}
		]
	},
	{
		type: 'listbox',
		name: 'buttonLinkTarget',
		label: 'Button: Link Target',
		'values': [
			{text: 'Self', value: 'self'},
			{text: 'Blank', value: 'blank'}
		]
	},

	//Rel
	{
		type: 'listbox',
		name: 'buttonRel',
		label: 'Button: Rel',
		'values': [
			{text: 'None', value: ''},
			{text: 'Nofollow', value: 'nofollow'}
		]
	},

	//Left Icon
	{
		type: 'textbox',
		name: 'buttonLeftIcon',
		label: 'Button: Left Icon (FontAwesome Class Name)',
		value: ''
	},

	//Right Icon
	{
		type: 'textbox',
		name: 'buttonRightIcon',
		label: 'Button: Right Icon (FontAwesome Class Name)',
		value: ''
	} 
];