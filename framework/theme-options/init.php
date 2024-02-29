<?php
/* ---------------------------------------------------------------------------
 * Create menu for theme options panel
 * --------------------------------------------------------------------------- */
if( !function_exists('redart_create_admin_menu') ) {
	function redart_create_admin_menu() {
		/**
		 * Creates main options page.
		*/
		add_theme_page( REDART_NAME . esc_html__(' Theme Options', 'redart'), REDART_NAME . esc_html__(' Options', 'redart'), 'manage_options', 'redart-opts', 'redart_options_page'	);
	}
}
add_action('admin_menu', 'redart_create_admin_menu');
require_once(REDART_DIR . '/framework/theme-options/settings.php');

/* ---------------------------------------------------------------------------
 * Create function to init dttheme options
 * --------------------------------------------------------------------------- */
add_action('admin_init', 'redart_admin_options_init', 1);
if( !function_exists('redart_admin_options_init') ) {
	function redart_admin_options_init() {
		register_setting(REDART_SETTINGS, REDART_SETTINGS);
		add_option(REDART_SETTINGS, redart_default_option());
	
		if (isset($_POST['dttheme-option-save'])) :
			redart_ajax_option_save();
		endif;
	
		if (isset($_POST['dttheme']['reset'])) :
			delete_option(REDART_SETTINGS);
			update_option(REDART_SETTINGS, redart_default_option()); # To set Default options
			wp_redirect(admin_url('admin.php?page=parent&reset=true'));
			exit;
		endif;
	}
}

if( !function_exists('redart_ajax_option_save') ) {
	function redart_ajax_option_save() {

		$ajax_ref_check = check_ajax_referer('dttheme_wpnonce', 'dttheme_admin_wpnonce');
			
		if($ajax_ref_check === false) {
			return false;
		} else {

			$data = $_POST;
		
			unset($data['_wp_http_referer'], $data['_wpnonce'], $data['action']);
			unset($data['dttheme_admin_wpnonce'], $data['dttheme-option-save'], $data['option_page']);
		
			$msg = array(
				'success' => false, 
				'message' => esc_html__('Error: Options not saved, please try again.', 'redart')
			);
		
			$data = array_filter($data['dttheme']);
		

			if (update_option(REDART_SETTINGS, $data)) {
					$msg = array(
						'success' => 'options_saved',
						'message' => esc_html__('Options Saved.', 'redart')
					);
			} else {
				$msg = array(
					'success' => true,
					'message' => esc_html__('Options Saved.', 'redart')
				);
			}
		
			$echo = json_encode($msg);
			@header('Content-Type: application/json; charset='.get_option('blog_charset'));
			echo redart_wp_kses($echo);
			exit;

		}

	}
}

/* ---------------------------------------------------------------------------
 * Backup And Restore theme options
 * --------------------------------------------------------------------------- */
add_action('wp_ajax_redart_backup_and_restore_action', 'redart_backup_and_restore_action');
if( !function_exists('redart_backup_and_restore_action') ) {
	function redart_backup_and_restore_action() {

		$save_type = $_REQUEST['type'];
		
		if ($save_type == 'backup_options') :
		
			$data = array(
				'general' => redart_option('general'),
				'layout' => redart_option('layout'),
				'social' => redart_option('social'),
				'pageoptions' => redart_option('pageoptions'),
				'woo' => redart_option('woo'),
				'colors' => redart_option('colors'),
				'fonts' => redart_option('fonts'),
				'backup' => date('r')
			);
			
			update_option("dt_theme_backup", $data);
			die('1');
		elseif ($save_type == 'restore_options') :
			$data = get_option("dt_theme_backup");
			update_option(REDART_SETTINGS, $data);
			die('1');
		elseif ($save_type == "import_options") :
			$data = $_REQUEST['data'];
			$data =  unserialize( stripcslashes($data) );
			update_option(REDART_SETTINGS, $data);
			die('1');
		elseif( $save_type == "reset_options") :
			delete_option(REDART_SETTINGS);
			update_option(REDART_SETTINGS, redart_default_option()); #To set Default options
			die('1');
		endif;
	}
}

/* ---------------------------------------------------------------------------
 * Create function to get theme options
 * --------------------------------------------------------------------------- */
if( !function_exists('redart_option') ) {
	function redart_option($key1, $key2 = '') {
		$options = get_option ( REDART_SETTINGS );
		$output = NULL;
	
		if (is_array ( $options )) {
	
			if (array_key_exists ( $key1, $options )) {
				$output = $options [$key1];
				if (is_array ( $output ) && ! empty ( $key2 )) {
					$output = (array_key_exists ( $key2, $output ) && (! empty ( $output [$key2] ))) ? $output [$key2] : NULL;
				}
			} else {
				$output = $output;
			}
		}
		return $output;
	}
}

/* ---------------------------------------------------------------------------
 * Create admin panel image preview
 * --------------------------------------------------------------------------- */
if( !function_exists('redart_adminpanel_image_preview') ) {
	function redart_adminpanel_image_preview($src, $backend = true, $default = "no-image.jpg") {
		$default = ($backend) ? REDART_URI . "/framework/theme-options/images/" . $default : REDART_URI . "/images/" . $default;
		$src = ! empty ( $src ) ? $src : $default;
		echo  "<div class='bpanel-option-help'>\n";
		echo  "<a href='' title='' class='a_image_preivew'> <img src='" . REDART_URI . "/framework/theme-options/images/image-preview.png' alt='img' /> </a>\n";
		echo  "\r<div class='bpanel-option-help-tooltip imagepreview'>\n";
		echo  "\r<img src='{$src}' data-default='{$default}'/>";
		echo  "\r</div>\n";
		echo  "</div>\n";
	}
}

/* ---------------------------------------------------------------------------
 * List all images from specific directory
 * --------------------------------------------------------------------------- */
if( !function_exists('redart_listImage') ) {
	function redart_listImage($dir) {
		$sociables = array ();
		$icon_types = array (
				'jpg',
				'jpeg',
				'gif',
				'png' 
		);
	
		if (is_dir ( $dir )) {
			$handle = opendir ( $dir );
			while ( false !== ($dirname = readdir ( $handle )) ) {
				if ($dirname != "." && $dirname != "..") {
					$parts = explode ( '.', $dirname );
					$ext = strtolower ( $parts [count ( $parts ) - 1] );
	
					if (in_array ( $ext, $icon_types )) {
						$option = $parts [count ( $parts ) - 2];
						$sociables [$dirname] = str_replace ( ' ', '', $option );
					}
				}
			}
			closedir ( $handle );
		}
		return $sociables;
	}
}

/* ---------------------------------------------------------------------------
 * Types of Background option available
 * --------------------------------------------------------------------------- */
if( !function_exists('redart_bgtypes') ) {
	function redart_bgtypes($name, $parent, $child) {
		$args = array (
			"bg-patterns" => esc_html__ ( "Pattern", 'redart' ),
			"bg-custom" => esc_html__ ( "Custom Background", 'redart' ),
			"bg-none" => esc_html__ ( "None", 'redart' ) 
		);
		echo '<div class="bpanel-option-set">';
		echo "<label>" . esc_html__ ( "Background Type", 'redart' ) . "</label>";
		echo "<div class='clear'></div>";
		echo "<select class='bg-type dt-chosen-select' name='{$name}'>";
		foreach ( $args as $k => $v ) :
			$rs = selected ( $k, redart_option ( $parent, $child ), false );
			echo "<option value='{$k}' {$rs}>{$v}</option>";
		endforeach;
		echo "</select>";
		echo '</div>';
	}
}

/* ---------------------------------------------------------------------------
 * Getting color picker for color option
 * --------------------------------------------------------------------------- */
if( !function_exists('redart_admin_color_picker') ) {
	function redart_admin_color_picker($label, $name, $value, $tooltip = NULL) {
		echo "<div class='bpanel-option-set'>\n";
		if (! empty ( $label )) :
			echo "<label>{$label}</label>";
			echo "<div class='hr_invisible'></div><div class='clear'></div>";
		endif;
		
		echo "<input type='text' class='dt-color-field medium' name='{$name}' value='{$value}' />";
	
		if ($tooltip != NULL)
			dt_theme_adminpanel_tooltip ( $tooltip );
	
		echo "</div>\n";
	}
}

/* ---------------------------------------------------------------------------
 * Getting color picker for color option
 * --------------------------------------------------------------------------- */
if( !function_exists('redart_admin_color_picker_two') ) {
	function redart_admin_color_picker_two($name, $value) {
		echo "<input type='text' class='dt-color-field small' name='{$name}' value='{$value}' />";
	}
}


/* ---------------------------------------------------------------------------
 * Getting privacy button action selection box
 * --------------------------------------------------------------------------- */
if ( ! function_exists( 'redart_privacy_btnaction_selection' ) ) {
	function redart_privacy_btnaction_selection($name = '', $selected = "") {
		$actions = array( '' => esc_html__('Dismiss the notification', 'redart'), 'link' => esc_html__('Link to another page', 'redart'), 'info_modal' => esc_html__('Open info modal on privacy and cookies', 'redart') );
	
		$name = ! empty ( $name ) ? "name='dttheme[privacy-bar][{$name}][action]'" : '';
		$out = "<select class='button-select' {$name}>"; // name attribute will be added to this by jQuery menuAdd()
		foreach ( $actions as $key => $value ) :
			$s = selected ( $key, $selected, false );
			$v = $value;
			$out .= "<option value='{$key}' {$s} >{$v}</option>";
		endforeach;
		$out .= "</select>";
	
		return $out;
	}
}

/* ---------------------------------------------------------------------------
 * Getting jquery ui slider
 * --------------------------------------------------------------------------- */
if( !function_exists('redart_admin_jqueryuislider') ) {
	function redart_admin_jqueryuislider($label, $id = '', $value = '', $px = "px") {
		$div_value = (! empty ( $value ) && ($px == "px")) ? $value . "px" : $value;
		echo "<label>{$label}</label>";
		echo "<div class='clear'></div>";
		echo "<div id='{$id}' class='dttheme-slider' data-for='{$px}'></div>";
		echo "<input type='hidden' class='' name='{$id}' value='{$value}'/>";
		echo "<div class='dttheme-slider-txt'>{$div_value}</div>";
	}
}

/* ---------------------------------------------------------------------------
 * Getting theme switch button
 * --------------------------------------------------------------------------- */
if( !function_exists('redart_switch') ) {
	function redart_switch($label, $parent, $name) {
		$checked = ("true" == redart_option ( $parent, $name )) ? ' checked="checked"' : '';
		$switchclass = ("true" == redart_option ( $parent, $name )) ? 'checkbox-switch-on' : 'checkbox-switch-off';
		echo "<div data-for='dttheme-{$parent}-{$name}' class='checkbox-switch {$switchclass}'></div>";
		echo "<input id='dttheme-{$parent}-{$name}' class='hidden' name='dttheme[{$parent}][{$name}]' type='checkbox' value='true' {$checked} />";
	}
}

/* ---------------------------------------------------------------------------
 * Return List of social icons
 * --------------------------------------------------------------------------- */
if( !function_exists('redart_listSocial') ) {
	function redart_listSocial() {
		$sociables = array('fa-dribbble' => 'Dribble', 'fa-flickr' => 'Flickr', 'fa-github' => 'GitHub', 'fa-pinterest' => 'Pinterest', 'fa-stack-overflow' => 'Stack Overflow', 'fa-twitter' => 'Twitter', 'fa-youtube' => 'YouTube', 'fa-android' => 'Android', 'fa-dropbox' => 'Dropbox', 'fa-instagram' => 'Instagram', 'fa-windows' => 'Windows', 'fa-apple' => 'Apple', 'fa-facebook' => 'Facebook', 'fa-google-plus' => 'Google Plus', 'fa-linkedin' => 'LinkedIn', 'fa-skype' => 'Skype', 'fa-tumblr' => 'Tumblr', 'fa-vimeo-square' => 'Vimeo');
		
		return $sociables;
	}
}

/* ---------------------------------------------------------------------------
 * Getting theme sociable selection box
 * --------------------------------------------------------------------------- */
if( !function_exists('redart_sociables_selection') ) {
	function redart_sociables_selection($name = '', $selected = "") {
		$sociables = redart_listSocial();
	
		$name = ! empty ( $name ) ? "name='dttheme[social][{$name}][icon]'" : '';
		$out = "<select class='social-select' {$name}>"; // name attribute will be added to this by jQuery menuAdd()
		foreach ( $sociables as $key => $value ) :
			$s = selected ( $key, $selected, false );
			$v = ucwords ( $value );
			$out .= "<option value='{$key}' {$s} >{$v}</option>";
		endforeach;
		$out .= "</select>";
	
		return $out;
	}
}

/* ---------------------------------------------------------------------------
 * Getting sub directories from parent directory
 * --------------------------------------------------------------------------- */
if( !function_exists('redart_getfolders') ) {
	function redart_getfolders($directory, $starting_with = "", $sorting_order = 0) {
		if (! is_dir ( $directory ))
			return false;
		$dirs = array ();
		$handle = opendir ( $directory );
		while ( false !== ($dirname = readdir ( $handle )) ) {
			if ($dirname != "." && $dirname != ".." && is_dir ( $directory . "/" . $dirname )) {
				if ($starting_with == "")
					$dirs [] = $dirname;
				else {
					$filter = strstr ( $dirname, $starting_with );
					if ($filter !== false)
						$dirs [] = $dirname;
				}
			}
		}
		
		closedir ( $handle );
		
		if ($sorting_order == 1) {
			rsort ( $dirs );
		} else {
			sort ( $dirs );
		}
		return $dirs;
	}
}

/* ---------------------------------------------------------------------------
 * Add new mimes to use custom font upload
 * --------------------------------------------------------------------------- */
add_filter('upload_mimes', 'redart_upload_mimes');
if( !function_exists('redart_upload_mimes') ) {
	function redart_upload_mimes( $existing_mimes = array() ){
		$existing_mimes['woff'] = 'font/woff';
		$existing_mimes['ttf'] 	= 'font/ttf';
		$existing_mimes['svg'] 	= 'font/svg';
		$existing_mimes['eot'] 	= 'font/eot';
		return $existing_mimes;
	}
}