<?php

// Adding options page
function bc_menu() {
	add_menu_page('Custom Background','Custom Background','manage_options','bc_options','bc_options');
	}
add_action('admin_menu', 'bc_menu');

function bc_options(){
	//print_r($_REQUEST);
	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
	?>
	<!-- admin options for inserting Font Size and Font Family -->
	<?php ?>
	<form action="options.php" method="post">
	  <div class="wrap">
		<?php wp_nonce_field('update-options') ?>
		  <h2>Custom Background <?php _e('Settings', 'custom_bg') ?></h2>
		  <table border="0" cellspacing="6" cellpadding="6">
		  <tr>
		  <td><?php _e('Preview', 'custom_bg') ?>Preview</td>
		  <td>
		  		<div style="background-color: <?php echo get_option('bc');?>;" id="custom-background-image"><img src="<?php echo get_option('bg');?>" /></div>
		  </td>
		  </tr>
			<tr>
			  <td>
			  <?php _e('Background url', 'custom_bg') ?>
			  </td>
			  <td>
			  <input type="text" name="bg" id="bg" value="<?php echo get_option('bg') ?>" size="30" style="width:97%" />
			  <input type="button" name="upload_image_button" id="upload_image_button" value="Browse" />
			 </td>
			</tr>
			<tr>
			  <td><?php _e('Background', 'custom_bg') ?></td>
			  <td>
			  <input type="text" id="bc" name="bc" value="<?php echo get_option('bc'); ?>" /> Pick link color</label>
    			<div id="ilctabscolorpicker"></div>
			  </td>
			</tr>
			<tr>
			  <td><?php _e('Background Repeat', 'repeat') ?></td>
			  <td>
			  <select id="repeat" name="repeat" >
			  <option value="no-repeat" <?php if(get_option('repeat')=='no-repeat'){ echo 'selected';}?>>No-Repeat</option>
			  <option value="repeat" <?php if(get_option('repeat')=='repeat'){ echo 'selected';}?>>Repeat</option>
			  <option value="repeat-x" <?php if(get_option('repeat')=='repeat-x'){ echo 'selected';}?> >Repeat-x</option>
			  <option value="repeat-y" <?php if(get_option('repeat')=='repeat-y'){ echo 'selected';} ?>>repeat-y</option>
			  </select></td>
			</tr>
			<tr>
			  <td><span class="submit">
			  <input type="hidden" name="action" value="update" />
			  <!-- Sending saved Data to wp_nonce fields -->
                <input type="hidden" name="page_options" value="bg,bc,repeat,position,position2" />
				<input type="submit" class="button-primary" value="<?php _e('Save Changes', 'custom_bg') ?>" />
			  </span></td>
			  <td>&nbsp;</td>
			</tr>
			<tr><td cell-padding=3>
			<div style="background:url(<?php echo get_option('bg');?>); background-repeat:<?php echo get_option('repeat')?>; background-color:<?php echo get_option('bc');?>; background-position:<?php echo get_option('position'); echo get_option('position2');?>; width:500px; height:500px; text-align:Center; text-color:#7E96C6; "><h1>Preview</h1></div>
			
			</td></tr>
		  </table>
		</div>
	</form>
	<script type="text/javascript">
 
  jQuery(document).ready(function() {
    jQuery('#ilctabscolorpicker').hide();
    jQuery('#ilctabscolorpicker').farbtastic("#bc");
    jQuery("#bc").click(function(){jQuery('#ilctabscolorpicker').slideToggle()});
  });
 
</script>
	<script>
	jQuery(document).ready(function() {
 
jQuery('#upload_image_button').click(function() {
		window.send_to_editor = function(html) {
 imgurl = jQuery('img',html).attr('src');
 jQuery('#bg').val(imgurl);
 tb_remove();
 
 
}
 
 
 tb_show('', 'media-upload.php?post_id=1&amp;type=image&amp;TB_iframe=true');
 return false;
});
 
 
});
    </script>
	<?php
}
add_action('init', 'bc_script');
function bc_script() {
  wp_enqueue_style( 'farbtastic' );
  wp_enqueue_script( 'farbtastic' );
}

add_action( 'admin_enqueue_scripts', 'bc_color_picker' );
function bc_color_picker( $hook_suffix ) {
    // first check that $hook_suffix is appropriate for your admin page
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'my-script-handle', plugins_url('my-script.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
}

function bc_scripts() {
wp_enqueue_script('media-upload');
wp_enqueue_script('thickbox');
wp_register_script('my-upload', get_bloginfo('template_url') . '/js/upload.js', array('jquery','media-upload','thickbox'));
wp_enqueue_script('my-upload');
}
function bc_styles() {
wp_enqueue_style('thickbox');
}
add_action('admin_print_scripts', 'bc_scripts');
add_action('admin_print_styles', 'bc_styles');

 function bc_admin_scripts() {
wp_enqueue_script('media-upload');
wp_enqueue_script('thickbox');
wp_register_script('my-upload', get_bloginfo('template_url') . '/js/upload.js', array('jquery','media-upload','thickbox'));
wp_enqueue_script('my-upload');
}
function bc_admin_styles() {
wp_enqueue_style('thickbox');
}
add_action('admin_print_scripts', 'bc_admin_scripts');
add_action('admin_print_styles', 'bc_admin_styles');
?>