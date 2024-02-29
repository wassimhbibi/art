<?php
/**
 * Gutenberg Editor CSS
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package     Redart
 * @author      Redart
 * @copyright   Copyright (c) 2019, Redart
 * @link        http://themes-demo.com/redart/
 * @since       Redart 1.0
 */

if ( ! class_exists( 'Gutenberg_Editor_CSS' ) ) :
	/**
	 * Admin Helper
	 */
	class Gutenberg_Editor_CSS {

		function __construct() {

			add_action('after_setup_theme', array( $this,  'redart_after_setup_theme' ) );

			add_action( 'current_screen', array( $this,  'redart_current_screen_hook' ), 10, 1 );
			add_action( 'enqueue_block_editor_assets', array( $this, 'redart_backend_editor_styles' ), 10 );
			if ( class_exists( 'Classic_Editor' ) ) {
				add_filter( 'tiny_mce_before_init', array( $this, 'redart_theme_editor_dynamic_styles' ) );
			}

			add_action( 'wp_enqueue_scripts', array( $this, 'redart_editor_enqueue_styles'), 110 );

		}

		public function redart_after_setup_theme() {

			# Gutenberg Compatible
			add_theme_support( 'align-wide' );
			add_theme_support( 'wp-block-styles' );
			add_theme_support( 'editor-styles' );
				
			# Add support for responsive embedded content.
			add_theme_support( 'responsive-embeds' );

			$primary_color = $secondary_color = $tertiary_color = '';
			$skin = redart_option('colors','theme-skin');
			$skin = ($skin != '') ? $skin : 'red';

			if( $skin == 'custom' ) {
				$default_options = redart_default_option();
				$custom_default = $default_options['colors']['custom-default'];
				$custom_light = $default_options['colors']['custom-light'];
				$custom_dark = $default_options['colors']['custom-default'];

				$primary_color   = redart_opts_get('custom-default', $custom_default);
				$secondary_color = redart_opts_get('custom-light', $custom_light);
				$tertiary_color  = redart_opts_get('custom-dark', $custom_dark);
			} else {
				$colors          = $this->redart_skins( $skin );
				$primary_color   = $colors['primary-color'];
				$secondary_color = $colors['secondary-color'];
				$tertiary_color  = $colors['tertiary-color'];
			}

			add_theme_support( 'editor-color-palette', array(
				array(
					'name'  => esc_html__( 'Primary Color', 'redart' ),
					'slug'  => 'primary',
					'color' => $primary_color,
				),
				array(
					'name'  => esc_html__( 'Secondary Color', 'redart' ),
					'slug'  => 'secondary',
					'color' => $secondary_color,
				),
				array(
					'name'  => esc_html__( 'Tertiary Color', 'redart' ),
					'slug'  => 'tertiary',
					'color' => $tertiary_color,
				)
			));

		}

		public function redart_skins( $skin ) {

			$skins['blue']         = array( 'primary-color' => '#0060d6', 'secondary-color' => '#0b4892', 'tertiary-color' => '#7fb1ef' );
			$skins['brown']        = array( 'primary-color' => '#795548', 'secondary-color' => '#573a30', 'tertiary-color' => '#8d6a5e' );
			$skins['cadetblue']    = array( 'primary-color' => '#3c939d', 'secondary-color' => '#34818a', 'tertiary-color' => '#b3dee2' );
			$skins['chillipepper'] = array( 'primary-color' => '#c10841', 'secondary-color' => '#9d0836', 'tertiary-color' => '#e31655' );
			$skins['cyan']         = array( 'primary-color' => '#00bcd4', 'secondary-color' => '#00a0b4', 'tertiary-color' => '#00cee8' );
			$skins['darkgolden']   = array( 'primary-color' => '#b48b3c', 'secondary-color' => '#a17b35', 'tertiary-color' => '#cca55b' );
			$skins['deeporange']   = array( 'primary-color' => '#ff5722', 'secondary-color' => '#db4211', 'tertiary-color' => '#ff774b' );
			$skins['deeppurple']   = array( 'primary-color' => '#673ab7', 'secondary-color' => '#532b99', 'tertiary-color' => '#8152d4' );
			$skins['green']        = array( 'primary-color' => '#60ae0d', 'secondary-color' => '#54990b', 'tertiary-color' => '#76ca1c' );
			$skins['lime']         = array( 'primary-color' => '#cddc39', 'secondary-color' => '#b1bf27', 'tertiary-color' => '#dfef45' );
			$skins['magenta']      = array( 'primary-color' => '#cb506d', 'secondary-color' => '#ae3753', 'tertiary-color' => '#eb738f' );
			$skins['orange']       = array( 'primary-color' => '#ff9800', 'secondary-color' => '#da8200', 'tertiary-color' => '#ffb343' );
			$skins['pink']         = array( 'primary-color' => '#fd6ca3', 'secondary-color' => '#e86496', 'tertiary-color' => '#ff90ba' );
			$skins['purple']       = array( 'primary-color' => '#9c27b0', 'secondary-color' => '#771e86', 'tertiary-color' => '#c145d6' );
			$skins['red']          = array( 'primary-color' => '#a81c51', 'secondary-color' => '#660e2f', 'tertiary-color' => '#c7346c' );
			$skins['skyblue']      = array( 'primary-color' => '#0eb2e7', 'secondary-color' => '#0da2d4', 'tertiary-color' => '#24caff' );
			$skins['teal']         = array( 'primary-color' => '#009688', 'secondary-color' => '#007f73', 'tertiary-color' => '#00b4a3' );
			$skins['turquoise']    = array( 'primary-color' => '#32ccbd', 'secondary-color' => '#24b6a8', 'tertiary-color' => '#40e3d3' );
			$skins['wisteria']     = array( 'primary-color' => '#9b59b6', 'secondary-color' => '#7c4094', 'tertiary-color' => '#bc77d8' );
			$skins['yellow']       = array( 'primary-color' => '#ffe401', 'secondary-color' => '#ebd302', 'tertiary-color' => '#fff074' );

			return $skins[ $skin ];
	
		}

		public function redart_current_screen_hook( $current_screen ) {
			
			if ( 'post' == $current_screen->base ) {

				$google_fonts = redart_fonts();
				$google_fonts = $google_fonts['all'];

				$subset = redart_option('fonts', 'font-subset');
				if( $subset ) $subset = str_replace(' ', '', $subset);

				if( $weight = redart_option('fonts', 'font-style') )
					$weight = ':'. implode( ',', $weight );

				$fonts = redart_fonts_selected();
				$fonts = array_unique($fonts);
				$fonts_url = ''; $font_families = array ('Londrina Outline');
				foreach( $fonts as $font ){
					if( in_array( $font, $google_fonts ) ){
						$font_families[] .= $font . $weight;
					}
				}
				$query_args = array( 'family' => urlencode( implode( '|', $font_families ) ), 'subset' => urlencode( $subset ) );
				$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

				add_editor_style( $fonts_url );
				add_editor_style( 'css/editor-style.css' );

			}

		}

		public function redart_generate_editor_styles( $editor_type = 'block' ) {
			
			
				$wrapper_class = '.editor-styles-wrapper';
				$header_wrapper_class = $wrapper_class.' .wp-block';
				$header1_add_class = '.editor-post-title__block .editor-post-title__input, ';
			

			$styles = '';

			$styles .= $wrapper_class.' pre { font-family:monospace; }';


			$styles .= $wrapper_class.' > * { ';

				$content_font = redart_option('fonts', 'content-font');
				if( $content_font != '' ) {
					$styles .= 'font-family: '.$content_font.';';
				}

				$content_font_size = redart_option('fonts', 'content-font-size');
				if( $content_font_size != '' ) {
					$styles .= 'font-size: '.$content_font_size.'px;';
				}

				$body_line_height = redart_option('fonts', 'body-line-height');
				if( $body_line_height != '' ) {
					$styles .= 'line-height: '.$body_line_height.'px;';
				}

			$styles .= ' }';


			$body_bg_color = redart_option('colors', 'body-bgcolor');
			if( $body_bg_color != '' ) {
				$styles .= $wrapper_class.' { background-color: '.$body_bg_color.'; } ';
			}

			$content_text_color = redart_option('colors', 'content-text-color');
			if( $content_text_color != '' ) {
				$styles .= $wrapper_class.' > *, '.$wrapper_class.' pre { color: '.$content_text_color.'; } ';
			}

			$content_link_color = redart_option('colors', 'content-link-color');
			if( $content_link_color != '' ) {
				$styles .= $wrapper_class.' a { color: '.$content_link_color.'; } ';
			}

			$content_link_hcolor = redart_option('colors', 'content-link-hcolor');
			if( $content_link_hcolor != '' ) {
				$styles .= $wrapper_class.' a:focus, '.$wrapper_class.' a:hover { color: '.$content_link_hcolor.'; } ';
			}


			for( $i = 1; $i <= 6; $i++ ) {

				if($i == 1) {
					$header_wrapper_final_class = $header1_add_class.$header_wrapper_class;
				} else {
					$header_wrapper_final_class = $header_wrapper_class;
				}

				$styles .= $header_wrapper_final_class.' h'.$i.' { ';

					$heading_color = redart_option('colors', 'heading-h'.$i.'-color');
					if( $heading_color != '' ) {
						$styles .= 'color: '.$heading_color.';';
					}

					$heading_font = redart_option('fonts', 'h'.$i.'-font');
					if( $heading_font != '' ) {
						$styles .= 'font-family: '.$heading_font.';';
					}

					$heading_font_size = redart_option('fonts', 'h'.$i.'-font-size');
					if( $heading_font_size != '' ) {
						$styles .= 'font-size: '.$heading_font_size.'px;';
					}

					$heading_font_weight = redart_option('fonts', 'h'.$i.'-weight');
					if( $heading_font_weight != '' ) {
						$styles .= 'font-weight: '.$heading_font_weight.';';
					}

					$heading_letter_spacing = redart_option('fonts', 'h'.$i.'-letter-spacing');
					if( $heading_letter_spacing != '' ) {
						$styles .= 'letter-spacing: '.$heading_letter_spacing.';';
					}

				$styles .= ' }';

			}
			
			return $styles;

		}

		public function redart_backend_editor_styles() {
			
			wp_enqueue_style( 'redart-gutenberg', get_theme_file_uri('/css/admin-gutenberg.css'), false, REDART_VERSION, 'all' );
			wp_add_inline_style( 'redart-gutenberg', redart_styles_custom_font() );
						
			$styles = $this->redart_generate_editor_styles('block');
			
			wp_add_inline_style( 'redart-gutenberg', $styles );

		}
			
		public function redart_theme_editor_dynamic_styles( $mceInit ) {

			$styles = redart_styles_custom_font();

			$styles .= $this->redart_generate_editor_styles('tinymce');

			if ( isset( $mceInit['content_style'] ) ) {
				$mceInit['content_style'] .= ' ' . $styles . ' ';
			} else {
				$mceInit['content_style'] = $styles . ' ';
			}
			
			return $mceInit;
		}

		public function redart_editor_enqueue_styles( ) {

			$styles = '';

			$primary_color = $secondary_color = $tertiary_color = '';
			$skin = redart_option('colors','theme-skin');
			$skin = ($skin != '') ? $skin : 'red';
	
			if( $skin == 'custom' ) {
				$default_options = redart_default_option();
				$custom_default = $default_options['colors']['custom-default'];
				$custom_light = $default_options['colors']['custom-light'];
				$custom_dark = $default_options['colors']['custom-default'];
	
				$primary_color   = redart_opts_get('custom-default', $custom_default);
				$secondary_color = redart_opts_get('custom-light', $custom_light);
				$tertiary_color  = redart_opts_get('custom-dark', $custom_dark);
			} else {
				$colors          = $this->redart_skins( $skin );
				$primary_color   = $colors['primary-color'];
				$secondary_color = $colors['secondary-color'];
				$tertiary_color  = $colors['tertiary-color'];
			}

			# Primary Color
			$styles .= '.has-primary-background-color { background-color:'.$primary_color.'; }';
			$styles .= '.has-primary-color { color:'.$primary_color.'; }';
	
			# Secondary Color
			$styles .= '.has-secondary-background-color { background-color:'.$secondary_color.'; }';
			$styles .= '.has-secondary-color { color:'.$secondary_color.'; }';
	
			# Tertiary Color
			$styles .= '.has-tertiary-background-color { background-color:'.$tertiary_color.'; }';
			$styles .= '.has-tertiary-color { color:'.$tertiary_color.'; }';

			wp_add_inline_style('redart-gutenberg', $styles );

		}

	}

	new Gutenberg_Editor_CSS();

endif;