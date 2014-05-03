<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {


	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}


	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();

	$options[] = array(
		'name' => __('General Settings', 'options_framework_theme'),
		'type' => 'heading');
		
	$options[] = array(
		'name' => __('FB APP ID', 'options_framework_theme'),
		'desc' => __('Input your FB APP ID', 'options_framework_theme'),
		'id' => 'fbappid',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Google Plus ID', 'options_framework_theme'),
		'desc' => __('Input Your Google Plus ID (Rich Snippets).', 'options_framework_theme'),
		'id' => 'gplusid',
		'std' => 'https://plus.google.com/',
		'type' => 'text');

	$options[] = array(
		'name' => __('Footer Credits', 'options_framework_theme'),
		'desc' => __('Insert your footer credits.', 'options_framework_theme'),
		'id' => 'footer',
		'std' => 'Copyright &copy;  2013 '.get_bloginfo('name').' All Rights Reserved. Theme by <a href="http://yantikmedia.com/">Wordpress Themes</a>',
		'type' => 'textarea');		

	$options[] = array(
		'name' => __('Layout Settings', 'options_framework_theme'),
		'type' => 'heading');

$options[] = array( 
		"name" => "Header",
		"desc" => "upload your header size 300 x 90 px.",
		"id" => "logo_uploader",
		"type" => "upload");
						
		
	$options[] = array(
		'name' => __('Favicon', 'options_framework_theme'),
		'desc' => __('Upload & preview favicon.', 'options_framework_theme'),
		'id' => 'favicon',
		'std' => ''.get_bloginfo('template_directory') . '/img/fav.png',
		'type' => 'upload');	
	
	$options[] = array(
		'name' => __('Font Footer Color', 'options_framework_theme'),
		'desc' => __('Select Font Footer Color.', 'options_framework_theme'),
		'id' => 'font',
		'std' => '#fff',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Theme Color', 'options_framework_theme'),
		'desc' => __('Select theme color.', 'options_framework_theme'),
		'id' => 'ctheme',
		'std' => '#0e0000',
		'type' => 'color' );
		
	$options[] = array(
		'name' => __('Link Color', 'options_framework_theme'),
		'desc' => __('Select link color.', 'options_framework_theme'),
		'id' => 'ltheme',
		'std' => '#245dc1',
		'type' => 'color' );	

	$options[] = array(
		'name' => __('AGC Setting', 'options_framework_theme'),
		'desc' => __('Show AGC at Single & search page.', 'options_framework_theme'),
		'id' => 'agc',
		'std' => '1',
		'type' => 'checkbox');		
	
	$options[] = array(
		'name' => __('Featured Post', 'options_framework_theme'),
		'desc' => __('Show Featured Post at Home/archive/search.', 'options_framework_theme'),
		'id' => 'featured',
		'std' => '1',
		'type' => 'checkbox');	

	return $options;
}

/*
 * This is an example of how to add custom scripts to the options panel.
 * This example shows/hides an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function($) {

	$('#example_showhidden').click(function() {
  		$('#section-example_text_hidden').fadeToggle(400);
	});

	if ($('#example_showhidden:checked').val() !== undefined) {
		$('#section-example_text_hidden').show();
	}

});
</script>

<?php
}