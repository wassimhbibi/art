<?php
/* ---------------------------------------------------------------------------
 * Loading Theme Scripts
 * --------------------------------------------------------------------------- */
add_action('wp_enqueue_scripts', 'redart_enqueue_scripts');
if( !function_exists('redart_enqueue_scripts') ) {
	function redart_enqueue_scripts() {
	
		$library_uri = REDART_URI.'/functions';
	
		// comment reply script ------------------------------------------------------
		if (is_singular() AND comments_open()):
			 wp_enqueue_script( 'comment-reply' );
		endif;
	
		// scipts variable -----------------------------------------------------------
		$stickynav = ( redart_option("layout","layout-stickynav") ) ? "enable" : "disable";
		$loadingbar = ( redart_option("general","enable-loader") ) ? "enable" : "disable";
		$nicescroll = ( redart_option("general","enable-nicescroll") ) ? "enable" : "disable";
		if(is_rtl()) $rtl = true; else $rtl = false;
	
		$htype = redart_option('layout','header-type');
		$stickyele = "";
		switch( $htype ){
			case 'fullwidth-header':
			case 'boxed-header':
			case 'split-header fullwidth-header':
			case 'split-header boxed-header':
			case 'two-color-header':
			case 'rotate-header':
				$stickyele = ".main-header-wrapper";
			break;
	
			case 'left-header':
			case 'left-header-boxed':
			case 'creative-header':
			case 'overlay-header':
				$stickyele = ".menu-wrapper";
				$stickynav = "disable";
			break;
		}
	
		wp_enqueue_script('jquery-ui-totop', $library_uri.'/js/jquery.ui.totop.min.js', array(), false, true);

		$cookiebar = redart_option('privacy', 'enable-cookie-msgbar');
		if( isset($cookiebar) ) {
			wp_enqueue_script('jq-cookie-js', $library_uri.'/js/cookieconsent.js', array(), false, true);
		}

		wp_enqueue_script('jquery-popup-js', $library_uri.'/js/magnific/jquery.magnific-popup.min.js', array(), false, true);
		wp_enqueue_script('isotope', $library_uri.'/js/isotope.pkgd.min.js', array(), false, true);
		wp_enqueue_script('jquery-caroufredsel', $library_uri.'/js/jquery.caroufredsel.js', array(), false, true);
		wp_enqueue_script('jquery-debouncedresize', $library_uri.'/js/jquery.debouncedresize.js', array(), false, true);
		wp_enqueue_script('jquery-prettyphoto', $library_uri.'/js/jquery.prettyphoto.js', array(), false, true);
		wp_enqueue_script('jquery-touchswipe', $library_uri.'/js/jquery.touchswipe.js', array(), false, true);
		wp_enqueue_script('jquery-waypoints', $library_uri.'/js/waypoint.js', array(), false, true);
		wp_enqueue_script('retina', $library_uri.'/js/retina.js', array(), false, true);
		wp_enqueue_script('easypiechart', $library_uri.'/js/easypiechart.js', array(), false, true);
		wp_enqueue_script('stellar', $library_uri.'/js/Stellar.js', array(), false, true);
		wp_enqueue_script('jquery-simple-sidebar', $library_uri.'/js/jquery.simple-sidebar.js', array(), false, true);
		wp_enqueue_script('jquery-uitotop', $library_uri.'/js/jquery.ui.totop.js', array(), false, true);
		wp_enqueue_script('jquery-parallax', $library_uri.'/js/jquery.parallax.js', array(), false, true);
		wp_enqueue_script('jquery-downcount', $library_uri.'/js/jquery.downcount.js', array(), false, true);
		wp_enqueue_script('jquery-nicescroll', $library_uri.'/js/jquery.nicescroll.min.js', array(), false, true);
		wp_enqueue_script('jquery-bxslider', $library_uri.'/js/jquery.bxslider.js', array(), false, true);
		wp_enqueue_script('jquery-fitvids', $library_uri.'/js/jquery.fitvids.js', array(), false, true);
		wp_enqueue_script('jquery-sticky', $library_uri.'/js/jquery.sticky.js', array(), false, true);
		wp_enqueue_script('jquery-classie', $library_uri.'/js/jquery.classie.js', array(), false, true);
		wp_enqueue_script('jquery-placeholder', $library_uri.'/js/jquery.placeholder.js', array(), false, true);
		wp_enqueue_script('jquery-visualnav', $library_uri.'/js/jquery.visualNav.min.js', array(), false, true);

		wp_localize_script('jquery-nicescroll', 'dttheme_urls', array(
			'theme_base_url' => esc_js(REDART_URI),
			'framework_base_url' => esc_js(REDART_URI).'/framework/',
			'ajaxurl' => esc_url( admin_url('admin-ajax.php') ),
			'url' => esc_url( get_site_url() ),
			'stickynav' => esc_js($stickynav),
			'stickyele' => esc_js($stickyele),
			'isRTL' => esc_js($rtl),
			'loadingbar' => esc_js($loadingbar),
			'nicescroll' => esc_js($nicescroll)
		));
	
		$picker = redart_option('general', 'enable-stylepicker');
		if( isset($picker) ) {
			wp_enqueue_script('cookie', $library_uri.'/js/jquery.cookie.min.js',array(),false,true);
			wp_enqueue_script('jq-cpanel', $library_uri.'/js/controlpanel.js',array(),false,true);
		}
		
		if( $loadingbar == 'enable' ) {
			wp_enqueue_script('pace', $library_uri.'/js/pace.min.js',array(),false,true);
			wp_localize_script('pace', 'paceOptions', array(
				'restartOnRequestAfter' => 'false',
				'restartOnPushState' => 'false'
			));
		}
	
		wp_enqueue_script('jq-custom', $library_uri.'/js/custom.js', array(), false, true);
		wp_localize_script ( 'jq-custom', 'ajax_load_more_option', array (
            'NoMorePostsFound'          => esc_html__('No More Posts Found', 'redart')
		));
	}
}

/* ---------------------------------------------------------------------------
 * Meta tag for viewport scale
* --------------------------------------------------------------------------- */
if( !function_exists('redart_viewport') ) {
	function redart_viewport() {
		if(redart_option('general', 'enable-responsive')){
			echo "<meta name='viewport' content='width=device-width, initial-scale=1'>\r";
		}
	}
}

/* ---------------------------------------------------------------------------
 * Scripts of Custom JS from Theme Back-End
* --------------------------------------------------------------------------- */
if( !function_exists('redart_scripts_custom') ) {
	function redart_scripts_custom() {
		if( ($custom_js = redart_option('layout', 'customjs-content')) && redart_option('layout','enable-customjs') ){
			
			$data = redart_wp_kses(stripslashes($custom_js));
			wp_add_inline_script ( 'jq-custom', $data );
		}
	}
}
add_action('wp_enqueue_scripts', 'redart_scripts_custom', 100);

/* ---------------------------------------------------------------------------
 * Loading Theme Styles
 * --------------------------------------------------------------------------- */
add_action( 'wp_enqueue_scripts', 'redart_enqueue_styles', 100 );
if( !function_exists('redart_enqueue_styles') ) {
	function redart_enqueue_styles() {
	
		$layout_opts = redart_option('layout');
		$general_opts = redart_option('general');
		$colors_opts = redart_option('colors');
		$pageopt_opts = redart_option('pageoptions');
	
		// site icons ---------------------------------------------------------------
		if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ):
			$url = ! empty ( $layout_opts ['favicon-url'] ) ? $layout_opts ['favicon-url'] : REDART_URI . "/images/favicon.ico";
			echo "<link href='$url' rel='shortcut icon' type='image/x-icon' />\n";
		
			$phone_url = ! empty ( $layout_opts ['apple-favicon'] ) ? $layout_opts ['apple-favicon'] : REDART_URI . "/images/apple-touch-icon.png";
			echo "<link href='$phone_url' rel='apple-touch-icon-precomposed'/>\n";
		
			$phone_retina_url = ! empty ( $layout_opts ['apple-retina-favicon'] ) ? $layout_opts ['apple-retina-favicon'] : REDART_URI. "/images/apple-touch-icon-114x114.png";
			echo "<link href='$phone_retina_url' sizes='114x114' rel='apple-touch-icon-precomposed'/>\n";
		
			$ipad_url = ! empty ( $layout_opts ['apple-ipad-favicon'] ) ? $layout_opts ['apple-ipad-favicon'] : REDART_URI . "/images/apple-touch-icon-72x72.png";
			echo "<link href='$ipad_url' sizes='72x72' rel='apple-touch-icon-precomposed'/>\n";
		
			$ipad_retina_url = ! empty ( $layout_opts ['apple-ipad-retina-favicon'] ) ? $layout_opts ['apple-ipad-retina-favicon'] : REDART_URI . "/images/apple-touch-icon-144x144.png";
			echo "<link href='$ipad_retina_url' sizes='144x144' rel='apple-touch-icon-precomposed'/>\n";
		endif;
	
		// wp_enqueue_style ---------------------------------------------------------------
		wp_enqueue_style( 'redart',				get_stylesheet_uri(), false, REDART_VERSION, 'all' );
		wp_enqueue_style( 'theme-prettyphoto',	REDART_URI .'/css/prettyPhoto.css', false, REDART_VERSION, 'all' );
		
		// icon fonts ---------------------------------------------------------------------
		wp_enqueue_style ( 'font-awesome',	REDART_URI . '/css/font-awesome.min.css', array (), '4.3.0' );
		wp_enqueue_style ( 'pe-icon-7-stroke',		REDART_URI . '/css/pe-icon-7-stroke.css', array () );
		wp_enqueue_style ( 'stroke-gap-icons-style',REDART_URI . '/css/stroke-gap-icons-style.css', array () );
	
		// comingsoon css
		if(isset($pageopt_opts['enable-comingsoon']))
			wp_enqueue_style("comingsoon",  	REDART_URI . "/css/comingsoon.css", false, REDART_VERSION, 'all' );
	
		// notfound css
		if ( is_404() )
			wp_enqueue_style("notfound",	  	REDART_URI . "/css/notfound.css", false, REDART_VERSION, 'all' );
	
		// loader css
		if(isset($general_opts['enable-loader']))
			wp_enqueue_style("loader",	  		REDART_URI . "/css/loaders.css", false, REDART_VERSION, 'all' );
	
		// show mobile slider
		if(empty($general_opts['show-mobileslider'])):
			$out =	'@media only screen and (max-width:320px), (max-width: 479px), (min-width: 480px) and (max-width: 767px), (min-width: 768px) and (max-width: 959px),
			 (max-width:1200px) { #slider { display:none !important; } }';
			wp_add_inline_style('redart', $out);
		endif;
	
		// woocommerce css
		if( function_exists( 'is_woocommerce' ) )
			wp_enqueue_style( 'woo-style', 		REDART_URI .'/css/woocommerce.css', 'woocommerce-general-css', REDART_VERSION, 'all' );
	
		// tribe-events -------------------------------------------------------------------
		wp_enqueue_style( 'custom-event', 		REDART_URI .'/tribe-events/custom.css', false, REDART_VERSION, 'all' );
	
		// light dark skin css
		if(isset($colors_opts['enable-lightskin'])) :
			wp_enqueue_style( 'light-dark', 		REDART_URI .'/css/light-skin.css', false, REDART_VERSION, 'all' );
		else :
			wp_enqueue_style( 'light-dark', 		REDART_URI .'/css/dark-skin.css', false, REDART_VERSION, 'all' );
		endif;
	
		// static css
		if(isset($general_opts['enable-staticcss'])) :
			wp_enqueue_style("static",  		REDART_URI . "/style-static.css", false, REDART_VERSION, 'all' );
	
		// skin css
		else :
			$skin	  = $colors_opts['theme-skin'];
			if($skin != 'custom')	wp_enqueue_style("redart-skin", 	REDART_URI ."/css/skins/$skin/style.css");
		endif;
	
		// responsive ---------------------------------------------------------------------
		if(redart_option('general', 'enable-responsive'))
			wp_enqueue_style("responsive",  	REDART_URI . "/css/responsive.css", false, REDART_VERSION, 'all' );	

		if( ! isset( $_COOKIE['dtPrivacyGoogleWebfontsDisabled'] ) ):

			// google fonts -----------------------------------------------------------------
			$google_fonts = redart_fonts();
			$google_fonts = $google_fonts['all'];
		
			$subset 	  = redart_option('fonts','font-subset');
			if( $subset ) $subset = str_replace(' ', '', $subset);
		
			// style & weight  --------------------------------------------------------------
			if( $weight = redart_option('fonts', 'font-style') )
				$weight = ':'. implode( ',', $weight );
		
			$fonts = redart_fonts_selected();
			$fonts = array_unique($fonts);
			$fonts_url = ''; $font_families = array();
			foreach( $fonts as $font ){
				if( in_array( $font, $google_fonts ) ){
					// if google fonts
					$font_families[] .= $font . $weight;
				}
			}

			# For loaders
			array_push( $font_families, "Londrina Outline" );

			$font_families = array_unique($font_families);


			$query_args = array( 'family' => urlencode( implode( '|', $font_families ) ), 'subset' => urlencode( $subset ) );
			$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

			wp_enqueue_style( 'redart-fonts', 		esc_url_raw($fonts_url), false, REDART_VERSION );
		endif;
	
		// custom css ---------------------------------------------------------------------
		wp_enqueue_style( 'dt-custom', 			REDART_URI .'/css/custom.css', false, REDART_VERSION, 'all' );
	
		// jquery scripts --------------------------------------------
		wp_enqueue_script('modernizr-custom', 	REDART_URI . '/functions/js/modernizr.custom.js', array('jquery'));

		$cookie_bar = redart_option('privacy', 'enable-cookie-msgbar');
		if( isset($cookie_bar) ) {
			wp_enqueue_style( 'redart-cookie-css', REDART_URI .'/css/cookieconsent.css', false, REDART_VERSION, 'all' );
		}

		wp_enqueue_style( 'redart-popup-css', 		REDART_URI .'/functions/js/magnific/magnific-popup.css', false, REDART_VERSION, 'all' );
			
		// rtl ----------------------------------------------------------------------------
		if(is_rtl()) wp_enqueue_style('rtl', 	REDART_URI . '/css/rtl.css', false, REDART_VERSION, 'all' );

		// gutenberg css ---------------------------------------------------------------------
		wp_enqueue_style( 'redart-gutenberg', REDART_URI . '/css/gutenberg.css', false, REDART_VERSION, 'all' );
	}
}

/* ---------------------------------------------------------------------------
 * Styles Minify
 * --------------------------------------------------------------------------- */
if( !function_exists('redart_styles_minify') ) {
	function redart_styles_minify( $css ){
	
		// remove comments
		$css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );	
	
		// remove whitespace
		$css = str_replace( array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $css );
	
		return $css;
	}
}

/* ---------------------------------------------------------------------------
 * Styles Dynamic
 * --------------------------------------------------------------------------- */
if( !function_exists('redart_styles_dynamic') ) {
	function redart_styles_dynamic() {
		ob_start();

		if( ! redart_opts_get( 'enable-staticcss' ) ){

			// custom colors.php
			$colors_opts = redart_option('colors');
			$skin	  = $colors_opts['theme-skin'];
			if($skin == 'custom'):
				include_once REDART_DIR . '/css/style-custom-color.php';
			endif;
			
			// default colors.php
			include_once REDART_DIR . '/css/style-default-color.php';
	
			// fonts.php
			include_once REDART_DIR . '/css/style-fonts.php';
		}
		
		// custom optons css.php
		if( ($custom_css = redart_option('layout','customcss-content')) &&  redart_option('layout','enable-customcss')):
			include_once REDART_DIR . '/css/dt-theme-option-custom-css.php';
		endif;
	
		$css = ob_get_contents();
	
		ob_get_clean();
	
		wp_register_style( 'redart-combined', '' );
		wp_enqueue_style( 'redart-combined' );
		wp_add_inline_style( 'redart-combined', redart_styles_minify($css) );
	}
}
add_action( 'wp_head', 'redart_styles_dynamic' );

/* ---------------------------------------------------------------------------
 * Styles of Custom Font
 * --------------------------------------------------------------------------- */
if( !function_exists('redart_styles_custom_font') ) {
	function redart_styles_custom_font() {
		$fonts 		  = redart_fonts_selected();
		$font_custom  = redart_option('fonts','customfont-name');
		$font_custom2 = redart_option('fonts','customfont2-name');
		$data = '';
	
		if( $font_custom && in_array( $font_custom, $fonts ) ){
			$data .= '@font-face {';
				$data .= 'font-family: "'. $font_custom .'";';
				$data .= 'src: url("'. redart_option('fonts','customfont-eot') .'");';
				$data .= 'src: url("'. redart_option('fonts','customfont-eot') .'#iefix") format("embedded-opentype"),';
					$data .= 'url("'. redart_option('fonts','customfont-woff') .'") format("woff"),';
					$data .= 'url("'. redart_option('fonts','customfont-ttf') .'") format("truetype"),';
					$data .= 'url("'. redart_option('fonts','customfont-svg') . $font_custom .'") format("svg");';
				$data .= 'font-weight: normal;';
				$data .= 'font-style: normal;';
			$data .= '}'."\n";
		}
		
		if( $font_custom2 && in_array( $font_custom2, $fonts ) ){
			$data .= '@font-face {';
				$data .= 'font-family: "'. $font_custom2 .'";';
				$data .= 'src: url("'. redart_option('fonts','customfont2-eot') .'");';
				$data .= 'src: url("'. redart_option('fonts','customfont2-eot') .'#iefix") format("embedded-opentype"),';
					$data .= 'url("'. redart_option('fonts','customfont2-woff') .'") format("woff"),';
					$data .= 'url("'. redart_option('fonts','customfont2-ttf') .'") format("truetype"),';
					$data .= 'url("'. redart_option('fonts','customfont2-svg') . $font_custom2 .'") format("svg");';
				$data .= 'font-weight: normal;';
				$data .= 'font-style: normal;';
			$data .= '}'."\n";
		}
		wp_register_style( 'redart-customfont', '' );
		wp_enqueue_style( 'redart-customfont' );
		wp_add_inline_style( 'redart-customfont', $data );
	}
}
add_action('wp_head', 'redart_styles_custom_font');

/* ---------------------------------------------------------------------------
 * Fonts Selected in Theme Options Panel
 * --------------------------------------------------------------------------- */
if( !function_exists('redart_fonts_selected') ) {
	function redart_fonts_selected(){
		$fonts = array();
		
		$font_opts = redart_option('fonts');
		
		$fonts['content'] 		= !empty ( $font_opts['content-font'] ) 	? 	$font_opts['content-font'] 		: 'Oswald';
		$fonts['menu'] 			= !empty ( $font_opts['menu-font'] ) 		? 	$font_opts['menu-font'] 		: 'Oswald';
		$fonts['title'] 		= !empty ( $font_opts['pagetitle-font'] ) 	? 	$font_opts['pagetitle-font'] 	: 'Oswald';
		$fonts['h1'] 		= !empty ( $font_opts['h1-font'] ) 	? 	$font_opts['h1-font'] 		: 'Oswald';
		$fonts['h2'] 		= !empty ( $font_opts['h2-font'] ) 	? 	$font_opts['h2-font'] 		: 'Oswald';
		$fonts['h3'] 		= !empty ( $font_opts['h3-font'] ) 	? 	$font_opts['h3-font'] 		: 'Oswald';
		$fonts['h4'] 		= !empty ( $font_opts['h4-font'] ) 	? 	$font_opts['h4-font'] 		: 'Oswald';
		$fonts['h5'] 		= !empty ( $font_opts['h5-font'] ) 	? 	$font_opts['h5-font'] 		: 'Oswald';
		$fonts['h6'] 		= !empty ( $font_opts['h6-font'] ) 	? 	$font_opts['h6-font'] 		: 'Oswald';
	
		return $fonts;
	}
}

/* ---------------------------------------------------------------------------
 * SSL | Attachments
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'redart_ssl_attachments' ) ) {
	function redart_ssl_attachments( $url ){
		if( is_ssl() ){
			return str_replace('http://', 'https://', $url);
		}
		return $url;
	}
}
add_filter( 'wp_get_attachment_url', 'redart_ssl_attachments' );

/* ---------------------------------------------------------------------------
 * Site SSL Compatibility
 * --------------------------------------------------------------------------- */
if(!function_exists('redart_ssl')) {
	function redart_ssl( $echo = false ){
		$ssl = '';
		if( is_ssl() ) $ssl = 's';
		if( $echo ){
			echo esc_html($ssl);
		}
		return $ssl;
	}
}

/* ---------------------------------------------------------------------------
 * Layout Selected in Theme Options Panel
 * --------------------------------------------------------------------------- */
add_action('wp_head', 'redart_appearance_css', 9);
if( !function_exists('redart_appearance_css') ) {
	function redart_appearance_css() {
		$output = NULL;
	
		if (redart_option('layout', 'site-layout') == 'boxed') :
	
			if (redart_option('layout', 'bg-type') == 'bg-patterns') :
				$pattern 			= 	redart_option('layout', 'boxed-layout-pattern');
				$pattern_repeat 	= 	redart_option('layout', 'boxed-layout-pattern-repeat');
				$pattern_opacity 	= 	redart_option('layout', 'boxed-layout-pattern-opacity');
				$enable_color 		= 	redart_option('layout', 'show-boxed-layout-pattern-color');
				$pattern_color 		= 	redart_option('layout', 'boxed-layout-pattern-color');
	
				$output .= "body { ";
	
				if (!empty($pattern)) {
					$output .= "background-image:url('" . REDART_URI . "/framework/theme-options/images/patterns/{$pattern}');";
				}
	
				$output .= "background-repeat:$pattern_repeat;";
				if ($enable_color) {
					if (!empty($pattern_opacity)) {
						$color = redart_hex2rgb($pattern_color);
						$output .= "background-color:rgba($color[0],$color[1],$color[2],$pattern_opacity); ";
					} else {
						$output .= "background-color:$pattern_color;";
					}
				}
				$output .= "}\r\t";
	
			elseif (redart_option('layout', 'bg-type') == 'bg-custom') :
				$bg 			= 	redart_option('layout', 'boxed-layout-bg');
				$bg_repeat 		= 	redart_option('layout', 'boxed-layout-bg-repeat');
				$bg_opacity 	= 	redart_option('layout', 'boxed-layout-bg-opacity');
				$bg_color 		= 	redart_option('layout', 'boxed-layout-bg-color');
				$enable_color 	= 	redart_option('layout', 'show-boxed-layout-bg-color');
				$bg_position 	= 	redart_option('layout', 'boxed-layout-bg-position');
	
				$output .= "body { ";
	
				if (!empty($bg)) {
					$output .= "background-image:url($bg);";
					$output .= "background-repeat:$bg_repeat;";
					$output .= "background-position:$bg_position;";
				}
	
				if ($enable_color) {
					if (!empty($bg_opacity)) {
						$color = redart_hex2rgb($bg_color);
						$output .= "background-color:rgba($color[0],$color[1],$color[2],$bg_opacity);";
					} else {
						$output .= "background-color:$bg_color;";
					}
				}
				$output .= "}\r\t";
			endif;
	
		endif;
	
		if (!empty($output)) :
			wp_register_style( 'redart-appearance', '' );
			wp_enqueue_style( 'redart-appearance' );
			wp_add_inline_style( 'redart-appearance', $output );
		endif;
	}
}

/* ---------------------------------------------------------------------------
 * Body Class Filter for layout changes
 * --------------------------------------------------------------------------- */
if( !function_exists('redart_body_classes') ) {
	function redart_body_classes( $classes ) {
	
		// layout
		$classes[] 		= 	'layout-'. redart_option('layout','site-layout');
	
		// header
		$header_type 	= 	redart_option('layout','header-type');
		if( isset($header_type) && ($header_type == 'left-header-boxed') ):
			$classes[]	=	'left-header left-header-boxed';
		elseif( isset($header_type) && ($header_type == 'creative-header') ):
			$classes[]	=	'left-header left-header-creative';
		else:
			$classes[]	=	$header_type;
		endif;
	
		$htrans 		= 	redart_option('layout', 'header-transparant');
		if(isset($htrans)):
			$classes[]	=	redart_option('layout', 'header-transparant');
		endif;
		
		$stickyhead		=	redart_option('layout','layout-stickynav');
		if(isset($stickyhead)):
			$classes[]	=	'sticky-header';
		endif;
	
		if( !is_front_page() ):
			$standard		=	redart_option('layout','header-position');
			if( isset($standard) && ($standard == 'above slider') ):
				$classes[]	=	'standard-header';
			elseif( isset($standard) && ($standard == 'below slider') ):
				$classes[]	=	'standard-header header-below-slider';
			elseif ( isset($standard) && ($standard == 'on slider') ):
				$classes[]	=	'header-on-slider';
			endif;
		endif;
	
		$topbar			=	redart_option('layout','layout-topbar');
		if(isset($topbar)):
			$classes[]	=	'header-with-topbar';
		endif;
	
		$wootype		=	redart_option('woo','product-style');
		$wootype		= 	!empty($wootype) ? 'woo-'.$wootype : 'woo-type15';
		$classes[]		=	$wootype;
	
		if( is_page() ) {
			$pageid = redart_ID();
			if(($slider_key = get_post_meta( $pageid, '_tpl_default_settings', true )) && (array_key_exists( 'show_slider', $slider_key )) ) {
				$classes[] = "page-with-slider";
			}
		} elseif( is_home() ) {
			$pageid = get_option('page_for_posts');
			if(($slider_key = get_post_meta( $pageid, '_tpl_default_settings', true )) && (array_key_exists( 'show_slider', $slider_key )) ) {
				$classes[] = "page-with-slider";
			}
		}
	
		$comingsoon		=	redart_option('pageoptions','enable-comingsoon');
		if(isset($comingsoon)):
			$classes[] = "under-construction";
		endif;

		# Gutenberg Class
		if ( is_singular() && function_exists('has_blocks') && has_blocks()) {
			$classes[] = 'has-gutenberg-blocks';
		}

		return $classes;
	}
}
add_filter( 'body_class', 'redart_body_classes' );