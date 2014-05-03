<?php 
if ( function_exists('register_sidebar') )
register_sidebar(array('name'=>'sidebar',
'before_widget' => '<div class="widget"><div class="inner">', // Removes <li>
'after_widget' => '</div></div>', // Removes </li>
'before_title' => '<h3 class="title"><span>', // Replaces <h2>
'after_title' => '</span></h3>', // Replaces </h2>
));
register_sidebar(array('name'=>'left sidebar',
'before_widget' => '<div class="widget"><div class="inner">', // Removes <li>
'after_widget' => '</div></div>', // Removes </li>
'before_title' => '<h3 class="title"><span>', // Replaces <h2>
'after_title' => '</span></h3>', // Replaces </h2>
));
?>
<?php
if( !function_exists('theme_setup') ) {
	function theme_setup() {
        register_nav_menus( array( 'main-menu 1' => __( 'Main Navigation 1' ), 'main-menu 2' => __( 'Main Navigation 2' ) ) );
	}
}
add_action( 'after_setup_theme', 'theme_setup' );
?>
<?php
define( 'BASE_DIR', TEMPLATEPATH . '/' ); 
include( BASE_DIR . 'inc/breadcrumbs.php' );
?>
<?php
//-------- theme options ---------- //
$themename = "Adsense";
$shortname = str_replace(' ', '_', strtolower($themename));
function get_theme_option($option)
{
	global $shortname;
	return stripslashes(get_option($shortname . '_' . $option));
}

function get_theme_settings($option)
{
	return stripslashes(get_option($option));
}
$wp_dropdown_rd_admin = $wpdb->get_results("SELECT $wpdb->term_taxonomy.term_id,name,description,count FROM $wpdb->term_taxonomy LEFT JOIN $wpdb->terms ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id WHERE parent  > -1 AND taxonomy = 'category' AND count != '0' GROUP BY $wpdb->terms.name ORDER by $wpdb->terms.name ASC");
$wp_getcat = array();
foreach ($wp_dropdown_rd_admin as $category_list) {
$wp_getcat[$category_list->term_id] = $category_list->name;
}
$category_bulk_list = array_unshift($wp_getcat, "Choose categorie:");
$number_entries = array("Number of Post :","4","8");
$options = array (

array(	"name" => "Display ads size 160 x 600 (Left Sidebar)", "type" => "heading", ),
array(	"name" => "Show ads size 160 x 600 ? ", "id" => $shortname."_agc_thumb_act1", "type" => "select", "std" => "No", "options" => array("No", "Yes")),
array(	"name" => "Input ads size 160 x 600", "id" => $shortname."_iklan_tengah", "type" => "textarea", "std" => "", ), 
array(	"name" => "</div></div>", "type" => "close", ),   		

array(	"name" => "Display ads Size 300 x 250 (Right Sidebar)", "type" => "heading", ),
array(	"name" => "Show ads Size 300 x 250 ? ", "id" => $shortname."_agc_satu_act1", "type" => "select", "std" => "No", "options" => array("No", "Yes")),
array(	"name" => "Input Ads size 300 x 250", "id" => $shortname."_iklan_kanan", "type" => "textarea", "std" => "", ), 
array(	"name" => "</div></div>", "type" => "close", ),

array(	"name" => "Display ads size 336 x 280 (Before Post Content)", "type" => "heading", ),
array(	"name" => "Show ads size 336 x 280 ? ", "id" => $shortname."_agc_dua_act1", "type" => "select", "std" => "Yes", "options" => array("No", "Yes")),
array(	"name" => "Input ads size 336 x 280", "id" => $shortname."_iklan_atas", "type" => "textarea", "std" => "", ), 
array(	"name" => "</div></div>", "type" => "close", ),   		

array(	"name" => "Display ads size 336 x 280 (After Post Content)", "type" => "heading", ),
array(	"name" => "Show ads size 336 x 280 ? ", "id" => $shortname."_agc_tiga_act1", "type" => "select", "std" => "No", "options" => array("No", "Yes")),
array(	"name" => "Input Ads size 336 x 280", "id" => $shortname."_iklan_bawah", "type" => "textarea", "std" => "", ), 
array(	"name" => "</div></div>", "type" => "close", ),   		
   		

);
function mytheme_add_admin() {

    global $themename, $shortname, $options;

    if ( $_GET['page'] == basename(__FILE__) ) {
    
        if ( 'save' == $_REQUEST['action'] ) {

                foreach ($options as $value) {
                    update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }

                foreach ($options as $value) {
                    if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }

                header("Location: themes.php?page=functions.php&saved=true");
                die;

        } else if( 'reset' == $_REQUEST['action'] ) {

            foreach ($options as $value) {
                delete_option( $value['id'] ); }

            header("Location: themes.php?page=functions.php&reset=true");
            die;

        }
    }

    add_theme_page($themename." Options", "".$themename." Options", 'edit_themes', basename(__FILE__), 'mytheme_admin');

}
function mytheme_add_init() {
$file_dir=get_bloginfo('template_directory');
wp_enqueue_style("functions", $file_dir."/function.css", false, "1.0", "all");
}

function mytheme_admin() {

    global $themename, $shortname, $options;

    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>Pengaturan Si '.$themename.' Berhasil di Simpan.</strong></p></div>';
    if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' Pengaturan Si '.$themename.' Berhasil di Reset Ulang.</strong></p></div>';
    
?>
<?php echo "<div id=\"function\"> ";?>
<h4>Area Pengaturan Adsense</h4>
<form action="" method="post">

<?php foreach ($options as $value) { ?>

<?php switch ( $value['type'] ) { case 'heading': ?>

<div class="get-option">

<h2><?php echo $value['name']; ?></h2>

<div class="option-save">

<?php
break;
case 'text':
?>

<div class="description"><?php echo $value['name']; ?></div>
<p><input name="<?php echo $value['id']; ?>" class="myfield" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if (

get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?>" /></p>

<?php
break;
case 'select':
?>

<div class="description"><?php echo $value['name']; ?></div>
<p><select name="<?php echo $value['id']; ?>" class="myselect" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>
<option<?php if ( get_settings( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
<?php } ?>
</select>
</p>

<?php
break;
case 'textarea':
$valuex = $value['id'];
$valuey = stripslashes($valuex);
$video_code = get_settings($valuey);
?>

<div class="description"><?php echo $value['name']; ?></div>
<p><textarea name="<?php echo $valuey; ?>" class="mytext" cols="40%" rows="8" /><?php if ( get_settings($valuey) != "") { echo stripslashes($video_code); }

else { echo $value['std']; } ?></textarea></p>

<?php
break;
case 'close':
?>

<div class="clearfix"></div>
</div><!-- OPTION SAVE END -->

<div class="clearfix"></div>
</div><!-- GET OPTION END -->

<?php
break;
default;
?>


<?php
break; } ?>

<?php } ?>

<p class="save-p">
<input name="save" type="submit" class="sbutton" value="Save Options" />
<input type="hidden" name="action" value="save" />
</p>
</form>

<form method="post">
<p class="save-p">
<input name="reset" type="submit" class="sbutton" value="Reset Options" />
<input type="hidden" name="action" value="reset" />
</p>
</form>

</div>
<?php } 

?>
<?php
add_action('admin_init', 'mytheme_add_init');
add_action('admin_menu', 'mytheme_add_admin');
?>
<?php 
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	//default thumbnail size
	add_image_size( 'gambar80', 100, 80, true );
	add_image_size( 'gambar585', 585, 320, true );
	add_image_size( 'gambar470', 470, 180, true );
	
};
?>
<?php 
if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
	require_once dirname( __FILE__ ) . '/inc/options-framework.php';
}
add_action('wp_print_scripts', 'jquery_script',8);
function jquery_script(){
	if ( function_exists('esc_attr') ) wp_enqueue_script('jquery'); 
	else { 
		wp_deregister_script('jquery');
		wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js', false, '1.3.2'); 
	}
}

function my_scripts_method() { 
wp_enqueue_script('myscript2', get_template_directory_uri() . '/js/js-mainmenu.js', array('jquery'), false, true);
}
add_action('wp_enqueue_scripts', 'my_scripts_method');
?>
