<?php

if($section =="header"){

	header_misc_settings_callback();

}elseif($section =="login"){

	login_misc_settings_callback();

}elseif($section =="navbar"){

	navbar_misc_settings_callback();

}elseif($section =="pageTitle"){

	title_misc_settings_callback();

}elseif($section =="body"){

	body_misc_settings_callback();

}elseif($section =="posts"){

	posts_misc_settings_callback();	

}elseif($section =="footer"){

	footer_misc_settings_callback();

}

function title_misc_settings_callback(){
	settings_fields( 'kjd_pageTitle_misc_settings' );
	$options = get_option('kjd_pageTitle_misc_settings');
	$options = $options['kjd_pageTitle_misc'];
	$glowSettings = array('none','left-right','top-bottom', 'all-sides','top','bottom');	
?>
	<div class="optionsWrapper">

		<?php 
			echo confine_section_toggle($section);
		?>
	
		<?php
			echo float_section_toggle($section);
		?>

		<?php
			echo set_section_margin($section);
		?>

	</div>
<?php
}


function login_misc_settings_callback(){	
	settings_fields( 'kjd_login_misc_settings' );
	$logoOptions = get_option('kjd_login_misc_settings'); 
	$logo = $logoOptions['kjd_loginPage_logo'];

	$glowSettings = array('none','left-right','top-bottom', 'all-sides','top','bottom');
?>

	<h2>Login Logo</h2>
	<div class="option">
		<label>Upload logo</label>
		<input type="text" class="url" id="logo_url" name="kjd_login_misc_settings[kjd_loginPage_logo]" value="<?php echo $logo ? $logo : ''; ?>" />  
		<input type="button" class="button upload_option upload_logo_button" value="Upload image" /> 
		<div class="logo_preview" style="min-height: 100px; clear:both;">  
  			<img src="<?php echo esc_url( $logo ); ?>" />  
		</div> 
	</div>

<?php
}

function header_misc_settings_callback(){
		settings_fields( 'kjd_header_misc_settings' );
		$options = get_option('kjd_header_misc_settings'); 
		$options = $options['kjd_header_misc'];

		$glowSettings = array('none','left-right','top-bottom', 'all-sides','top','bottom');
?>
		<div class="optionsWrapper">
			<h2>Options</h2>
			<div class="option">
				<label>Header Contents</label>		
				<select name="kjd_header_misc_settings[kjd_header_misc][header_contents]">
					<option value="logo" <?php selected( $options['header_contents'], 'logo', true ) ?>>Logo</option>
					<option value="widgets" <?php selected( $options['header_contents'], 'widgets', true ) ?>>Widgets</option>
				</select>
			</div>

			<div class="option">

				<label>Logo Alignment</label>		
				<select name="kjd_header_misc_settings[kjd_header_misc][logo_align]">
					<option value="left" <?php selected( $options['logo_align'], 'left', true ) ?>>Left</option>
					<option value="center" <?php selected( $options['logo_align'], 'center', true ) ?>>Center</option>
					<option value="right" <?php selected( $options['logo_align'], 'right', true ) ?>>Right</option>
				</select>
			</div>


			<div class="option">
				<label>Force Header height</label>
				<select name="kjd_header_misc_settings[kjd_header_misc][force_height]">
					<option value="false" <?php selected( $options['force_height'], 'false', true ) ?>>No</option>
					<option value="true" <?php selected( $options['force_height'], 'true', true ) ?>>Yes</option>
				</select>
				<input type="text" name="kjd_header_misc_settings[kjd_header_misc][header_height]"
				value="<?php echo $options['header_height'] ? $options['header_height'] : '' ;?>" style="width:40px;">px
			</div>

		<?php 
			echo confine_section_toggle($section);
		?>
	
		<?php
			echo float_section_toggle($section);
		?>

		<?php
			echo set_section_margin($section);
		?>
				
			<div class="option">
				<label>Hide Header?</label>
				<select name="kjd_header_misc_settings[kjd_header_misc][hide_header]">
					<option value="false" <?php selected( $options['hide_header'], 'false', true ) ?>>No</option>
					<option value="true" <?php selected( $options['hide_header'], 'true', true ) ?>>Yes</option>
				</select>
			</div>			

		</div><!-- end options wrapper -->

<?php
}

function navbar_misc_settings_callback(){ 
	settings_fields( 'kjd_navbar_misc_settings' );
	$options = get_option('kjd_navbar_misc_settings');
	$options = $options['kjd_navbar_misc'];

	$navBarStyles = array('full_width','contained','page-top','sticky-top','sticky-bottom');	
	$navBarLinkStyles = array('none','highlighted','pills','tabs', 'tabs-below');	

	$glowSettings = array('none','left-right','top-bottom', 'all-sides','top','bottom');
?>
		<!-- link styles -->
		<div class="optionsWrapper">

			<h3>Navbar settings</h3>
			<div class="option">
				<label><?php echo ucwords(str_replace("_"," ",$section));?> navbar style</label>
				<select name="kjd_navbar_misc_settings[kjd_navbar_misc][navbar_style]">
					<?php foreach($navBarStyles as $style){ ?>
						<option value="<?php echo $style;?>" <?php selected( $options['navbar_style'], $style, true) ?>><?php echo ucwords(str_replace("_"," ",$style));?></option>
					<?php } ?>
				</select>
			</div>

			<div class="option">
				<label>Nav link style</label>
				<select name="kjd_navbar_misc_settings[kjd_navbar_misc][navbar_link_style]">
					<?php foreach($navBarLinkStyles as $style){ ?>
						<option value="<?php echo $style;?>" <?php selected( $options['navbar_link_style'], $style, true) ?>><?php echo ucwords(str_replace("_"," ",$style));?></option>
					<?php } ?>
				</select>
			</div>

			<div class="option">
				<label>Nav alignment</label>
				<select name="kjd_navbar_misc_settings[kjd_navbar_misc][navbar_alignment]">
					<option value="left" <?php selected( $options['navbar_alignment'], 'left', true) ?>>Left</option>
					<option value="center" <?php selected( $options['navbar_alignment'], 'center', true) ?>>Center</option>
					<option value="right" <?php selected( $options['navbar_alignment'], 'right', true) ?>>Right</option>
				</select>
			</div>

			<div class="option">
				<label>Disable Link Inner Shadows?</label>
				<select name="kjd_navbar_misc_settings[kjd_navbar_misc][link_shadows]">
					<option value="true" <?php selected( $options['link_shadows'], 'true', true) ?>>Yes</option>
					<option value="false" <?php selected( $options['link_shadows'], 'false', true ) ?>>No</option>
				</select>
			</div>

		<?php 
			echo confine_section_toggle($section);
		?>

		<?php
			echo float_section_toggle($section);
		?>

		<?php
			echo set_section_margin($section);
		?>
		
			<div class="option">
				<label>Move to header and align?</label>
				<select name="kjd_navbar_misc_settings[kjd_navbar_misc][kjd_navbar_pull_up]">
					<option value="false" <?php selected( $options['kjd_navbar_pull_up'], 'false', true ) ?>>No</option>
					<option value="true" <?php selected( $options['kjd_navbar_pull_up'], 'true', true) ?>>Yes</option>
				</select>
				<input name="kjd_navbar_misc_settings[kjd_navbar_misc][kjd_navbar_margin_top]" 
				value="<?php echo  $options['kjd_navbar_margin_top'] ?  $options['kjd_navbar_margin_top'] : ''; ?>"
				style="width:40px;"/>px.
			</div>	

			<div class="option">
				<label>Remove left padding on first link</label>
				<select name="kjd_navbar_misc_settings[kjd_navbar_misc][flush_first_link]">
						<option value="false" <?php selected( $options['flush_first_link'], 'false', true) ?>>No</option>
						<option value="true" <?php selected( $options['flush_first_link'], 'true', true) ?>>Yes</option>
				</select>
			</div>

			<div class="option">
				<label>Hide navbar?</label>
				<select name="kjd_navbar_misc_settings[kjd_navbar_misc][hideNav]">
						<option value="false" <?php selected( $options['hideNav'], 'false', true) ?>>No</option>
						<option value="true" <?php selected( $options['hideNav'], 'true', true) ?>>Yes</option>
				</select>
			</div>

			<div class="option">
				<label>Side Sliding Nav</label>
				<select name="kjd_navbar_misc_settings[kjd_navbar_misc][side_nav]">
						<option value="false" <?php selected( $options['side_nav'], 'false', true) ?>>No</option>
						<option value="true" <?php selected( $options['side_nav'], 'true', true) ?>>Yes</option>
				</select>
			</div>

			<div class="option">
				<label>Dropdown Background on Mobile?</label>
				<select name="kjd_navbar_misc_settings[kjd_navbar_misc][dropdown_bg]">
					<option value="true" <?php selected( $options['dropdown_bg'], 'true', true) ?>>Yes</option>
					<option value="false" <?php selected( $options['dropdown_bg'], 'false', true ) ?>>No</option>
				</select>
			</div>

		<h3>Open Menu Button Settings</h3>
		<div class="color_option option" style="position: relative;">
			<label>Background</label>

			<input class="minicolors" name="kjd_navbar_misc_settings[kjd_navbar_misc][menu_btn_bg]" 
				value="<?php echo  $options['menu_btn_bg'] ?  $options['menu_btn_bg'] : ''; ?>"/>
			<a class="clearColor">Clear</a>
		</div>
		<div class="color_option option" style="position: relative;">
			<label>Border</label>

			<input class="minicolors" name="kjd_navbar_misc_settings[kjd_navbar_misc][menu_btn_border]" 
				value="<?php echo $options['menu_btn_border'] ? $options['menu_btn_border'] : ''; ?>"/>
			<a class="clearColor">Clear</a>
		</div>

		<div class="color_option option" style="position: relative;">
			<label>Background - hovered/active</label>

			<input class="minicolors" name="kjd_navbar_misc_settings[kjd_navbar_misc][menu_btn_bg_hovered]" 
				value="<?php echo  $options['menu_btn_bg_hovered'] ?  $options['menu_btn_bg_hovered'] : ''; ?>"/>
			<a class="clearColor">Clear</a>
		</div>
		<div class="color_option option" style="position: relative;">
			<label>Border - hovered/active</label>

			<input class="minicolors" name="kjd_navbar_misc_settings[kjd_navbar_misc][menu_btn_border_hovered]" 
				value="<?php echo $navbarSettings['menu_btn_border_hovered'] ? $navbarSettings['menu_btn_border_hovered'] : ''; ?>"/>
			<a class="clearColor">Clear</a>
		</div>



		</div>

<?php
}

/* ------------------------- Body Misc Settings --------------------------- */
function body_misc_settings_callback(){
	settings_fields( 'kjd_body_misc_settings' );
	$options = get_option('kjd_body_misc_settings');
	$options = $options['kjd_body_misc'];

	$glowSettings = array('none','left-right','top-bottom', 'all-sides','top','bottom');	
?>
	<div class="optionsWrapper">

		<?php 
			echo confine_section_toggle($section);
		?>

		<?php
			echo float_section_toggle($section);
		?>

		<?php
			echo set_section_margin($section);
		?>


	</div>			
<?php
}

/* ---------------------------  Posts Misc settings ----------------------------- */
function posts_misc_settings_callback()
{
	settings_fields('kjd_posts_misc_settings');
	$options = get_option('kjd_posts_misc_settings');
	$options = $options['kjd_posts_misc'];

///////post
		//use well
			//well color and opacity

?>
	<div class="optionsWrapper">

		<h3>Post/Page Listing</h3>


		<div class="option"> 
			<label>Show Excerpt or Content</label>
			<select name="kjd_posts_misc_settings[kjd_posts_misc][post_listing_type]" class="post-listing-toggle">
				<option value="excerpt" <?php selected( $options['post_listing_type'], "excerpt", true) ?>>Excerpt</option>
				<option value="content" <?php selected( $options['post_listing_type'], "content", true) ?>>Content</option>
			<select>
		</div>

	</div>

<!-- Post Thumbnail settings -->
	<div class="optionsWrapper image-settings" <?php echo $options['post_listing_type'] == 'excerpt' ? 'style="display:block;"' : 'style="display:none;"';?>>
		<h3>Featured Image</h3>

		<div class="option"> 
			<label>Show Featured/Author Image</label>
			<select name="kjd_posts_misc_settings[kjd_posts_misc][show_featured_image]" class='featured-image-toggle'>
				<option value="false" <?php selected( $options['show_featured_image'], "false", true) ?>>No</option>
				<option value="true" <?php selected( $options['show_featured_image'], "true", true) ?>>Yes</option>
			<select>
		</div> 
	</div>

	<div class="option-wraper featured-image-settings">
		<div class="option"> 
			<label>Featured/Author Image Position</label>
			<select name="kjd_posts_misc_settings[kjd_posts_misc][featured_position]">
				<?php
					$positions = array('atop_post','left_of_post','right_of_post','after_post','before_post_info', 'before_content','before_post_meta');
					foreach($positions as $position){
						$selected = selected( $options['featured_position'], $position, true);
						echo '<option value="'.$position.'" '.$selected.' >'.ucwords(str_replace('_',' ',$position)).'</option>';
					}
				?>
			<select>
		</div> 

		<div class="option"> 
			<label>Show Featured or Author Image</label>
			<select name="kjd_posts_misc_settings[kjd_posts_misc][image_type]">
				<option value="featured" <?php selected( $options['image_type'], "featured", true) ?>>Featured</option>
				<option value="author" <?php selected( $options['image_type'], "author", true) ?>>Author</option>
			<select>
		</div> 

	</div>


	<div class="optionsWrapper">
		<h3>Post/Page Listing</h3>

		<div class="option"> 
			<label>Style Posts?</label>
			<select name="kjd_posts_misc_settings[kjd_posts_misc][style_posts]">
				<option value="true" <?php selected( $options['style_posts'], "true", true) ?>>Yes</option>
				<option value="false" <?php selected( $options['style_posts'], "false", true) ?>>No</option>
			<select>
		</div>
		
	</div>

<!-- Misc Colors -->
	<div class="options-wrapper">
		
		<h3>Misc Colors</h3>

		<div class="color_option option" style="position: relative;">
			<label>Post Titles Bottom Border</label>

			<input class="minicolors" name="kjd_posts_misc_settings[kjd_posts_misc][post_info_border]" 
				value="<?php echo $options['post_info_border'] ? $options['post_info_border'] : ''; ?>"/>
			<a class="clearColor">Clear</a>
		</div>

		<div class="color_option option" style="position: relative;">
			<label>Blockquote Color</label>

			<input class="minicolors" name="kjd_posts_misc_settings[kjd_posts_misc][blockquote]" 
				value="<?php echo $options['blockquote'] ? $options['blockquote'] : ''; ?>"/>
			<a class="clearColor">Clear</a>
		</div>
	</div>
<?php

}


/* ---------------------------  Footer Misc settings ----------------------------- */
function footer_misc_settings_callback(){
	settings_fields( 'kjd_footer_misc_settings' );
	$options = get_option('kjd_footer_misc_settings');
	$options = $options['kjd_footer_misc'];

	$glowSettings = array('none','left-right','top-bottom', 'all-sides','top','bottom');	
?>
	<div class="optionsWrapper">

		<?php 
			echo confine_section_toggle($section);
		?>

		<div class="option">
			<label>Footer Height</label>
			<input name="kjd_footer_misc_settings[kjd_footer_misc][height]" 
				value="<?php echo $options['height'] ? $options['height'] : ''; ?>"
				style="width:40px;"/>px.
		</div>

	</div>			
<?php
}

/* --------------------------------- repeated settings --------------------------------- */

function confine_section_toggle($section) {

	$option_markup ='';
	$option_markup .= '<div class="option">';
		$option_markup .= '<label>Confine Background?</label>';
		$option_markup .= '<select name="kjd_'.$section.'_misc_settings[kjd_'.$section.'_misc][kjd_'.$section.'_confine_background]">';
			$option_markup .= '<option value="true" '. selected( $options['kjd_'.$section.'_confine_background'], 'true', true) .'>Yes</option>';
			$option_markup .= '<option value="false" '. selected( $options['kjd_'.$section.'_confine_background'], 'false', true ) .'>No</option>';
		$option_markup .= '</select>';
	$option_markup .= '</div>';

	return $option_markup;
}

function float_section_toggle($section) {

	$option_markup ='';
	$option_markup .= '<div class="option float-toggle">';
		$option_markup .= '<label>Float Navbar Area</label>';
		$option_markup .= '<select name="kjd_'.$section.'_misc_settings[kjd_'.$section.'_misc][float][toggle]">';
				$option_markup .= '<option value="true" '.selected( $options['float']['toggle'], 'true', true) .'>Yes</option>';
				$option_markup .= '<option value="false" '.selected( $options['float']['toggle'], 'false', true) .'>No</option>';
		$option_markup .= '</select>';
	$option_markup .= '</div>';
	
	return $option_markup;
}

function set_section_margin($section) {
	$option_markup ='';
	
	$toggle_class = $options['float']['toggle']=='true' ? 'style="display:block;"' : 'style="display:none;"' ;
	$margin_top_toggle = $options['float']['margin_top'] ? $options['float']['margin_top'] : '0';
	$margin_bottom_toggle = $options['float']['margin_bottom'] ? $options['float']['margin_bottom'] : '0';

	$option_markup .= '<div class="option float-option" '. $toggle_class .'>';
		$option_markup .= '<label>Navbar Margin</label>';
		$option_markup .= '<div class="margin-label"><span>Top</span>';
			$option_markup .= '<input name="kjd_'.$section.'_misc_settings[kjd_'.$section.'_misc][float][margin_top]" ';
				$option_markup .= 'value="'. $margin_top_toggle .'"';
				$option_markup .= 'style="width:40px;"/>px.';
		$option_markup .= '</div>';
	$option_markup .= '<div class="margin-label"><span>Bottom</span>';
		$option_markup .= '<input name="kjd_'.$section.'_misc_settings[kjd_'.$section.'_misc][float][margin_bottom]" ';
			$option_markup .= 'value="'. $margin_bottom_toggle .'"';
			$option_markup .= 'style="width:40px;"/>px.';
		$option_markup .= '</div>';
	$option_markup .= '</div>';

	return $option_markup;
}

function section_glow_toggle($section) {
	
	$option_markup = '';
	$option_markup .= '<div class="option">';
	$option_markup .= '<label>Outer glow</label>';
	$option_markup .= '<select name="kjd_'.$section.'_misc_settings[kjd_'.$section.'_misc][kjd_'.$section.'_section_shadow]">';
	foreach($glowSettings as $glow){ 
			$option_markup .= '<option value="'.$glow.' '.selected( $options['kjd_'.$section.'_section_shadow'], $glow, true) . '>';
				$option_markup .= $glow;
			$option_markup .= '</option>';
	}
	$option_markup .= '</select>';

return $option_markup;
}