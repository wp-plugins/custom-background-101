<?php
/* Plugin Name: Custom Background 
 * Author: Annant Srivastava
 * Author URI: http://www.avincos.com
 * Plugin URI: http://www.avincos.com
 * Version: 1.1
 * Description: A Plugin to insert custom Background Changer
 */
define('bc_directory', WP_PLUGIN_DIR.'/custom_background');
define('bc_url', WP_PLUGIN_URL.'/custom_background');

/* including fonts */
include_once 'css.php';
// Activating plugin
register_activation_hook(__FILE__, 'back_activate');
function back_activate(){
	add_option('bg','1234');
	add_option('position','top');
	add_option('position','center');	
	add_option('repeat','repeat-x');
	add_option('bc','#B4F4F4');
	
}
// Loading css files to site header file
//if(!is_admin()){
	/*add_action('wp_print_style', 'bc_load_css');
	function bc_load_css(){
		wp_enqueue_style('background', bc_url.'/css/background.php');
	}*/

	add_action('wp_head', 'bc_head');
	function bc_head(){
		$out = "<style type='text/css' media='screen'>
		body{
		background:url(".get_option('bg').")!important;
		background-color:".get_option('bc')."!important;
		background-repeat:".get_option('repeat')."!important;
		}
			</style>";
		echo $out;
	}
//}
/**
   * Adds "Settings" link to the plugin overview page
   */

 function add_settings_link($links) {
	$settings_link = '<a href="admin.php?page=bc_options">Settings</a>';
  	array_push( $links, $settings_link );
  	return $links;
}
$plugin = plugin_basename(__FILE__);
add_filter( "plugin_action_links_$plugin", 'add_settings_link' );

function autobc($text) {
	$return = str_replace('<a', '<a class="link_text" target="_blank"', $text);
	return $return;
}
add_filter('the_content', 'autobc');

?>