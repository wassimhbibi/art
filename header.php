<!DOCTYPE html>
<!--[if IE 7 ]>    <html lang="en-gb" class="isie ie7 oldie no-js"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en-gb" class="isie ie8 oldie no-js"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en-gb" class="isie ie9 no-js"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <?php redart_viewport(); ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open();
} ?>
<?php
// loading
$loader = redart_option('general','enable-loader');
$ltitle = redart_option('general','loader-title');
$lstitle = redart_option('general','loader-subtitle');
if( isset($loader) ) echo '<div class="loader-wrapper"><div id="large-header" class="large-header"><h1 class="loader-title"><span>'.esc_html($ltitle).'</span> '.esc_html($lstitle).'</h1></div></div>';
// top hook
do_action( 'redart_hook_top' ); ?>

<!-- **Wrapper** -->
<div class="wrapper">
	<div class="inner-wrapper">

		<!-- **Header Wrapper** -->
		<div id="header-wrapper">
            <!-- **Header** -->
            <header id="header"><?php
				//top bar
				$topbar 	= redart_option('layout','layout-topbar');
				$topcontent = redart_option('layout','top-content');
				if( isset($topbar) && isset($topcontent) && $topcontent != '' ):?>
                    <div class="top-bar">
                        <div class="container"><?php
							$content = redart_option('layout','top-content');
							$content = do_shortcode( stripslashes($content) );
							echo redart_wp_kses( $content ); ?>
                        </div>
                    </div><?php
				endif;

				// header types
				$htype = redart_option('layout','header-type');
				if( $htype != "left-header" && $htype != "left-header-boxed" && $htype != "creative-header" && $htype != "overlay-header" ):
					// header position
					$headerpos = redart_option('layout','header-position');
					if( isset($headerpos) && $headerpos == 'below slider' ):
						echo redart_slider();
					endif;
				endif;?>

            	<!-- **Main Header Wrapper** -->
            	<div id="main-header-wrapper" class="main-header-wrapper">

            		<div class="container">

            			<!-- **Main Header** -->
            			<div class="main-header"><?php

							redart_header_logo();
                            
							if( isset($htype) && ( $htype == 'rotate-header' ) ):?>
                            	<a class="menu-trigger" href="#"><span></span></a><?php
							endif; ?>

            				<div id="menu-wrapper" class="menu-wrapper <?php redart_opts_show('menu-active-type',''); ?>">
                            	<div class="dt-menu-toggle" id="dt-menu-toggle">
                                	<?php esc_html_e('Menu','redart'); ?>
                                    <span class="dt-menu-toggle-icon"></span>
                                </div><?php
								if( isset($htype) ):
									switch($htype):
										case 'split-header fullwidth-header':
										case 'split-header boxed-header':
												echo '<nav id="main-menu">';
												redart_wp_split_menu();
												echo '</nav>';
										break;
										
										case 'overlay-header':
												echo '<div class="overlay overlay-hugeinc">';
													echo '<div class="overlay-close"></div>';
													redart_wp_nav_menu(1);
												echo '</div>';
										break;

										case 'fullwidth-header':
										case 'boxed-header':
										case 'two-color-header':
										default:
											redart_wp_nav_menu();
											require_once( REDART_DIR .'/headers/default.php' );
										break;
									endswitch;
								endif; ?>
            				</div><?php
							// left header
                            if( isset($htype) && ( $htype == 'left-header' || $htype == 'left-header-boxed' || $htype == 'creative-header') ): ?>
                                <div class="left-header-footer"><?php
									$content = redart_option('layout','menu-left-header-content');
									$content = do_shortcode( stripcslashes( $content ) );
									echo redart_wp_kses($content); ?>
                                </div><?php
							endif; ?>
            			</div>
            		</div><?php
					if( isset($htype) && ( $htype == 'rotate-header') ):
						redart_wp_nav_menu();
					endif;?>
            	</div><!-- **Main Header** --><?php			
				if( $htype != "left-header" && $htype != "left-header-boxed" && $htype != "creative-header" && $htype != "overlay-header" ):
					// header position
					if( isset($headerpos) && $headerpos != 'below slider' ):
						echo redart_slider();
					endif;
				endif;?>

			</header><!-- **Header - End** -->
		</div><!-- **Header Wrapper - End** -->

		<?php if( $htype == "creative-header" ) echo '<div id="toggle-sidebar"></div>'; ?>

		<?php if( $htype == "overlay-header" ) echo '<div id="trigger-overlay"></div>'; ?>

        <!-- **Main** -->
        <div id="main"><?php

			if( $htype == "left-header" || $htype == "left-header-boxed" || $htype == "creative-header" || $htype == "overlay-header" ):
				echo redart_slider();
			endif;
			
			if(is_front_page()) {
				echo '<div class="dt-sc-margin50"></div>';	
			}

			// subtitle & breadcrumb section
			require_once( REDART_DIR .'/headers/breadcrumb.php' );
			
			$class = "container";
			
			if( is_page_template('tpl-portfolio.php') ) {
				$tpl_default_settings = get_post_meta($post->ID,'_tpl_default_settings',TRUE);
				$tpl_default_settings = is_array( $tpl_default_settings ) ? $tpl_default_settings  : array();
				$class =  isset( $tpl_default_settings['portfolio-fullwidth'] ) ? "portfolio-fullwidth-container" : "container"; 
            }

			if( is_singular('tribe_events') ) {
				$tpl_default_settings = get_post_meta($post->ID,'_custom_settings',TRUE);
				$tpl_default_settings = is_array( $tpl_default_settings ) ? $tpl_default_settings  : array();
				$post_style = array_key_exists( "event-post-style", $tpl_default_settings ) ? $tpl_default_settings['event-post-style'] : "type1";
				switch( $post_style ):
					case 'type2':
						$class = "event-type2-fullwidth";
						break;
					case 'type5':
						$class = "event-type5-fullwidth";
						break;
					default:
						$class = "container";
				endswitch;
			}

			if( is_singular() ) {
				$tpl_default_settings = get_post_meta($post->ID,'_custom_settings',TRUE);
				$tpl_default_settings = is_array( $tpl_default_settings ) ? $tpl_default_settings  : array();
				$class =  ( isset( $tpl_default_settings['layout'] ) ) && ( $tpl_default_settings['layout'] == 'fullwidth-container') ? "show-in-fullwidth" : $class;
			} ?>
            <!-- ** Container ** -->
            <div class="<?php echo esc_attr($class); ?>"><?php
			do_action( 'redart_hook_content_before' ); ?>