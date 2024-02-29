<?php
/* ---------------------------------------------------------------------------
 * Load default theme options
 * - To return default options to store in database.
 * --------------------------------------------------------------------------- */
if( !function_exists('redart_default_option') ) {
	function redart_default_option() {

		$general = array(
			'enable-nicescroll' => 'false',
			'show-pagecomments' => 'true',
			'loader-title' => 'Red',
			'loader-subtitle' => 'Art',
			'enable-responsive' => 'true',
			'show-mobileslider' => 'true',
			'enable-stylepicker' => 'true',
			'enable-loader' => 'true'
		);
	
		$layout = array(
			'logo' => 'true',
			'logo-url' => REDART_URI.'/images/logo.png',
			'retina-logo-url' => REDART_URI.'/images/logo@2x.png',
			'retina-logo-width' => '219',
			'retina-logo-height' => '60',
			'favicon-url' => REDART_URI.'/images/favicon.png',
			'apple-favicon' => REDART_URI.'/images/apple-touch-icon.png',
			'apple-retina-favicon' => REDART_URI.'/images/apple-touch-icon-114x114.png',
			'apple-ipad-favicon' => REDART_URI.'/images/apple-touch-icon-72x72.png',
			'apple-ipad-retina-favicon' => REDART_URI.'/images/apple-touch-icon-114x114.png',
			'show-breadcrumb' => 'true',
			'breadcrumb-delimiter' => 'fa fa-caret-right',
			'show-boxed-layout-pattern-color' => 'true',
			'show-boxed-layout-bg-color' => 'true',
			'site-layout' => 'wide',
			'header-type' => 'fullwidth-header',
			'layout-stickynav' => 'true',
			'header-position' => 'on slider',
			'top-content' => '[dt_sc_sociable]',
			'menu-left-header-content' => '<h5> Connect with us </h5>[dt_sc_sociable /]',
			'show-sociables' => 'on',
			'enable-footer' => 'true',
			'footer-columns' => '4',
			'enable-copyright' => 'true',
			'copyright-content' => 'Copyright © 2016 <a href="#" title="RedArt"> Red Art </a>. All Rights Reserved'
		);

		$widgetarea = array(
			'wtitle-style' => 'default'
		);
		
		$social = array(
			'social-1' => array(
				'icon' => 'fa-facebook',
				'link' => '#'
			),
			'social-2' => array(
				'icon' => 'fa-twitter',
				'link' => '#'
			),
			'social-3' => array(
				'icon' => 'fa-google-plus',
				'link' => '#'
			)
		);
	
		$pageoptions = array(
			'single-post-authorbox' => 'true',
			'single-post-related' => 'true',
			'single-post-comments' => 'true',
			'post-format-meta' => 'true',
			'post-author-meta' => 'false',
			'post-date-meta' => 'true',
			'post-comment-meta' => 'false',
			'post-category-meta' => 'false',
			'post-tag-meta' => 'true',
			'post-archives-post-layout' => 'one-column',
			'post-archives-enable-excerpt' => 'true',
			'post-archives-excerpt' => 40,
			'post-archives-enable-readmore' => 'false',
			'post-archives-readmore' => '[dt_sc_button size="small" style="filled" target="_blank" class="dt-sc-expand dt-sc-expand-vertical" title="Read More"][/dt_sc_button]',
			'single-portfolio-related' => 'true',
			'enable-404message' => 'true',
			'notfound-bg' => REDART_URI.'/images/old-man.jpg',
			'post-style' => 'entry-date-left',
			'show-notfound-bg-color' => 'true',
			'show-launchdate' => 'true',
			'comingsoon-launchdate' => '08/30/2016 12:00:00',
			'comingsoon-timezone' => '+5',
			'comingsoon-bg' => REDART_URI.'/images/photographer.jpg',
			'show-comingsoon-bg-color' => 'true'
		);
	
		$woo = array(
			'shop-product-per-page' => '12',
			'shop-page-product-layout' => 'one-fourth-column'
		);
	
		$colors = array(
			'theme-skin' => 'red',
			'body-bgcolor' => '#000000',
			'custom-default' => '#b48b3c',
			'custom-light' => '#ffffff',
			'custom-dark' => '#cccccc',

			'content-text-color' => '#ffffff',
            'content-link-color' => '#a81c51',
			'content-link-hcolor' => '#ffffff',
			
			'heading-h1-color' => '#ffffff',
			'heading-h2-color' => '#ffffff',
			'heading-h3-color' => '#ffffff',
			'heading-h4-color' => '#ffffff',
			'heading-h5-color' => '#ffffff',
			'heading-h6-color' => '#ffffff'
		);
	
		$fonts = array(
			'content-font' => 'Droid Sans',
			'menu-font' => 'PT Sans Narrow',
			'pagetitle-font' => 'Josefin Sans',
			'h1-font' => 'Josefin Sans',
			'h2-font' => 'Josefin Sans',
			'h3-font' => 'Josefin Sans',
			'h4-font' => 'Josefin Sans',
			'h5-font' => 'Josefin Sans',
			'h6-font' => 'Josefin Sans',
			'font-style' => array( '100', '100italic', '200', '200italic','300', '300italic','400', '400italic','500', '500italic','600', '600italic','700', '700italic','800', '800italic','900', '900italic'),
			'content-font-size' => '14',
			'menu-font-size' => '14',
			'h1-font-size' => '30',
			'h2-font-size' => '24',
			'h3-font-size' => '18',
			'h4-font-size' => '16',
			'h5-font-size' => '14',
			'h6-font-size' => '13',
			'menu-letter-spacing' => '0.5px',
			'h1-letter-spacing' => '0.5px',
			'h2-letter-spacing' => '0.5px',
			'h3-letter-spacing' => '0.5px',
			'h4-letter-spacing' => '0.5px',
			'h5-letter-spacing' => '0.5px',
			'h6-letter-spacing' => '0.5px',
			'body-line-height' => '24'
		);
		
		$data = array(
			'general' => $general,
			'layout'  => $layout,
			'widgetarea'  => $widgetarea,
			'social'  => $social,
			'pageoptions' => $pageoptions,
			'woo'	  => $woo,
			'colors'  => $colors,
			'fonts'   => $fonts
		);
		return $data;
	}
}

/* ---------------------------------------------------------------------------
 * Load default theme options
 * - To return default options to store in database.
 * --------------------------------------------------------------------------- */
if( !function_exists('redart_show_footer_widgetarea') ) {
	function redart_show_footer_widgetarea( $count ) {
		$classes = array (
			"1" => "dt-sc-full-width",
			"dt-sc-one-half",
			"dt-sc-one-third",
			"dt-sc-one-fourth",
			"1-2" => "dt-sc-one-half",
			"1-3" => "dt-sc-one-third",
			"1-4" => "dt-sc-one-fourth",
			"3-4" => "dt-sc-three-fourth",
			"2-3" => "dt-sc-two-third" );
	
		if ($count <= 4) :
			for($i = 1; $i <= $count; $i ++) :
	
				$class = $classes [$count];
				$class = esc_attr( $class );
	
				$first = ($i == 1) ? "first" : "";
				$first = esc_attr( $first );
	
				echo "<div class='column {$class} {$first}'>";
					if (function_exists ( 'dynamic_sidebar' ) && dynamic_sidebar ( "footer-sidebar-{$i}" )) : endif;
				echo "</div>";
			endfor;
		elseif ($count == 5 || $count == 6) :
	
			$a = array (
				"1-4",
				"1-4",
				"1-2" );
	
			$a = ($count == 5) ? $a : array_reverse ( $a );
			foreach ( $a as $k => $v ) :
				$class = $classes [$v];
				$class = esc_attr( $class );
	
				$first = ($k == 0 ) ? "first" : "";
				$first = esc_attr( $first );
	
				echo "<div class='column {$class} {$first}'>";
					if (function_exists ( 'dynamic_sidebar' ) && dynamic_sidebar ( "footer-sidebar-{$k}-{$v}" )) : endif;
				echo "</div>";
			endforeach;
		elseif ($count == 7 || $count == 8) :
			$a = array (
				"1-4",
				"3-4");
	
			$a = ($count == 7) ? $a : array_reverse ( $a );
			foreach ( $a as $k => $v ) :
				$class = $classes [$v];
				$class = esc_attr( $class );
	
				$first = ($k == 0 ) ? "first" : "";
				$first = esc_attr( $first );
	
	
				echo "<div class='column {$class} {$first}'>";
					if (function_exists ( 'dynamic_sidebar' ) && dynamic_sidebar ( "footer-sidebar-{$k}-{$v}" )) :endif;
				echo "</div>";
			endforeach;
		elseif ($count == 9 || $count == 10) :
			$a = array ( 
				"1-3",
				"2-3" );
			$a = ($count == 9) ? $a : array_reverse ( $a );
	
			foreach ( $a as $k => $v ) :
				$class = $classes [$v];
				$class = esc_attr( $class );
	
				$first = ($k == 0 ) ? "first" : "";
				$first = esc_attr( $first );
	
				echo "<div class='column {$class} {$first}'>";
					if (function_exists ( 'dynamic_sidebar' ) && dynamic_sidebar ( "footer-sidebar-{$k}-{$v}" )) :endif;
				echo "</div>";
			endforeach;
		endif;
	}
}