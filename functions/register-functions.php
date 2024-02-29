<?php
/* ---------------------------------------------------------------------------
 * Theme support
 * --------------------------------------------------------------------------- */
if (!function_exists('redart_features')) {

	function redart_features() {

		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
		add_theme_support( 'post-formats', array('status', 'quote', 'gallery', 'image', 'video', 'audio', 'link', 'aside', 'chat'));

		# post thumbnails
		if ( function_exists( 'add_theme_support' ) ) {

			add_theme_support( 'post-thumbnails' );
			add_image_size( 'blog-thumb', 150, 120, true  ); 	// blog - list
			add_image_size( 'event-list', 420, 336, true  ); 	// event-calendar - list
			add_image_size( 'event-single-type1', 773, 520, true  ); // event-calendar - single
			add_image_size( 'event-single-type4', 570, 460, true  ); // event-calendar - single
			add_image_size( 'event-single-type5', 746, 770, true  ); // event-calendar - single
			add_image_size( 'event-list2', 420, 275, true  ); 	// event-calendar - shortcode list
		}
		
		# add custom background
		$args = array(
			'default-color' => 'ffffff',
			'default-image' => '',
			'wp-head-callback' => '_custom_background_cb',
			'admin-head-callback' => '',
			'admin-preview-callback' => ''
		);
		add_theme_support('custom-background', $args);

		# add custom header
		$args = array( 'default-image'=>'', 'random-default'=>false, 'width'=>0, 'height'=>0,
					   'flex-height'=> false, 'flex-width'=> false, 'default-text-color'=> '', 'header-text'=> false,
					   'uploads'=> true, 'wp-head-callback'=> '', 'admin-head-callback'=> '', 'admin-preview-callback' => ''
		);
		add_theme_support('custom-header', $args);

	}
	add_action('after_setup_theme', 'redart_features');
}

/* ---------------------------------------------------------------------------
 *	Under Construction
 * --------------------------------------------------------------------------- */
if( ! function_exists('redart_under_construction') ){
	function redart_under_construction(){
		if( ! is_user_logged_in() 
			&& ! is_admin() ) {
			get_template_part('tpl-comingsoon');
			exit();
		}
	}
}

if( redart_option('pageoptions','enable-comingsoon') ):
	add_action('template_redirect', 'redart_under_construction', 30);

	// getting shortcode css ----------------------
	add_action('wp_head', 'redart_rand_css');
	if( !function_exists('redart_rand_css') ) {
		function redart_rand_css() {
			$id = redart_option('pageoptions','comingsoon-pageid');
			if ( $id ) {
				$shortcodes_custom_css = get_post_meta( $id, '_wpb_shortcodes_custom_css', true );
				if ( ! empty( $shortcodes_custom_css ) ) {
					wp_register_style( 'dt-comingsoon', '' );
					wp_enqueue_style( 'dt-comingsoon' );
					wp_add_inline_style( 'dt-comingsoon', $shortcodes_custom_css );
				}
			}
		}
	}
endif;

/* ---------------------------------------------------------------------------
 *	Set Max Content Width
 * --------------------------------------------------------------------------- */
if ( ! isset( $content_width ) ) $content_width = 1200;

/* ---------------------------------------------------------------------------
 * Filter to modify default category widget view
 * --------------------------------------------------------------------------- */
if( !function_exists('redart_wp_list_categories') ){
	function redart_wp_list_categories( $output ){

		if (strpos($output, "</span>") <= 0) {
			$output = str_replace('</a> (', ' <span>', $output);
			$output = str_replace(')', '</span></a> ', $output);
		}
		
		return $output;
	}
	
	add_filter('wp_list_categories', 'redart_wp_list_categories');
}

/* ---------------------------------------------------------------------------
 * Filter to modify default list archive widget view
 * --------------------------------------------------------------------------- */
if( !function_exists('redart_wp_list_archive') ){
	function redart_wp_list_archive( $link_html ) {
		$link_html = str_replace( '</a>&nbsp;(', '<span class="count">', $link_html );
	   $link_html = str_replace( ')', '</span></a>', $link_html );
	   return $link_html;
	}
	add_filter( 'get_archives_link', 'redart_wp_list_archive' );
}

/* ---------------------------------------------------------------------------
 * Filter to execute shortcode inside contact form7
 * --------------------------------------------------------------------------- */
if( !function_exists('redart_wpcf7_form_elements') ){
	function redart_wpcf7_form_elements($form) {
		$form = do_shortcode( $form );
		return $form;
	}
	add_filter('wpcf7_form_elements', 'redart_wpcf7_form_elements');
}

/* ---------------------------------------------------------------------------
 * Get Current Page or Page ID
 * --------------------------------------------------------------------------- */
if( !function_exists('redart_ID') ) {
	function redart_ID(){
		$post = redart_global_variables('post');
		$postID = false;
	
		if( ! is_404() ){
	
			if( function_exists('is_woocommerce') && is_woocommerce() ){
	
				$postID = wc_get_page_id( 'shop' );
	
			} elseif( is_search() ){
	
				$postID = false;
	
			} else {
	
				$postID = get_the_ID();
	
			}
		}
	
		return $postID;
	}
}

/* ---------------------------------------------------------------------------
 * Get Layer or Revolution Slider
 * --------------------------------------------------------------------------- */
if( !function_exists('redart_slider') ) {
	function redart_slider( $id = false ){
	
		$slider = false;
	
		if( $id || is_home() || get_post_type() == 'page' ) {
	
			if( is_home() ) $id = get_option('page_for_posts');
			elseif( is_page() ) $id = redart_ID();
	
			$slider_key = get_post_meta( $id, '_tpl_default_settings', true );
			
			if( is_array( $slider_key) && array_key_exists('slider_type', $slider_key) ) {
				
				if( ( $slider_key['slider_type'] == 'revolutionslider' ) && ( array_key_exists( 'revolutionslider_id', $slider_key ) ) && ( array_key_exists( 'show_slider', $slider_key ) ) ) {
					
					// revolution slider
					$slider = '<div id="slider"><div class="dt-sc-main-slider" id="dt-sc-rev-slider">';
						$slider .= do_shortcode('[rev_slider '. $slider_key['revolutionslider_id'] .']');
					$slider .= '</div></div>';
				
				} elseif( ( $slider_key['slider_type'] == 'layerslider' ) && ( array_key_exists('layerslider_id', $slider_key) ) && ( array_key_exists( 'show_slider', $slider_key ) ) ) {
	
					// layer slider
					$slider = '<div id="slider"><div class="dt-sc-main-slider" id="dt-sc-layer-slider">';
						$slider .= do_shortcode('[layerslider id="'. $slider_key['layerslider_id'] .'"]');
					$slider .= '</div></div>';
	
				} elseif( ( $slider_key['slider_type'] == 'customslider' ) && ( array_key_exists('customslider_sc', $slider_key) ) && ( array_key_exists( 'show_slider', $slider_key ) ) ) {
		
					// Custom Slider
					$slider = '<div id="slider"><div class="dt-sc-main-slider" id="dt-sc-custom-slider">';
						$slider .= redart_wp_kses(do_shortcode( $slider_key['customslider_sc'] ));
					$slider .= '</div></div>';
				}
			}
		}
		return $slider;
	}
}

/* ---------------------------------------------------------------------------
 * Pagination for Blog and Portfolio
 * --------------------------------------------------------------------------- */
if( !function_exists('redart_pagination') ) {
	function redart_pagination( $query = false, $load_more = false ){
		$wp_query = redart_global_variables('wp_query');	
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : ( ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1 );
	
		// default $wp_query
		if( $query ) $wp_query = $query;
	
		$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;  
		
		if( empty( $paged ) ) $paged = 1;
		$prev = $paged - 1;
		$next = $paged + 1;
	
		$end_size = 1;
		$mid_size = 2;
		$show_all = redart_option('general','showall-pagination');
		$dots = false;
	
		if( ! $total = $wp_query->max_num_pages ) $total = 1;
		
		$output = '';
		if( $total > 1 )
		{
			if( $load_more ){
				// ajax load more -------------------------------------------------
				if( $paged < $total ){
					$output .= '<div class="column one pager_wrapper pager_lm">';
						$output .= '<a class="pager_load_more button button_js" href="'. get_pagenum_link( $next ) .'">';
							$output .= '<span class="button_icon"><i class="icon-layout"></i></span>';
							$output .= '<span class="button_label">'. esc_html__('Load more', 'redart') .'</span>';
						$output .= '</a>';
					$output .= '</div>';
				}
	
			} else {
				// default --------------------------------------------------------	
				$output .= '<div class="column one pager_wrapper">';
	
					$big = 999999999; // need an unlikely integer
					$args = array(
						'base'               => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'total'              => $wp_query->max_num_pages,
						'current'            => max( 1, get_query_var('paged') ),
						'show_all'           => $show_all,
						'end_size'           => $end_size,
						'mid_size'           => $mid_size,
						'prev_next'          => true,
						'prev_text'          => '<i class="fa fa-angle-double-left"></i>'.esc_html__('Prev', 'redart'),
						'next_text'          => esc_html__('Next', 'redart').'<i class="fa fa-angle-double-right"></i>',
						'type'               => 'list'
					);
					$output .= paginate_links( $args );
	
				$output .= '</div>'."\n";
			}
		}
		return $output;
	}
}

/* ---------------------------------------------------------------------------
 * Page Title
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'redart_page_title' ) ){
	function redart_page_title( $echo = false ){

		if( function_exists('tribe_is_month') && ( tribe_is_event_query() || tribe_is_month() || tribe_is_event() || tribe_is_day() || tribe_is_venue() ) ){
			$title = tribe_get_events_title();

		} elseif( is_home() || is_single() ){
			$title = get_the_title( redart_ID() );
			
		} elseif( is_tag() ){
			$title = single_tag_title('', false);
			
		} elseif( is_category() || get_post_taxonomies() ){
			$title = single_cat_title('', false);
			
		} elseif( is_author() ){
			$title = get_the_author();
		
		} elseif( is_day() ){
			$title = get_the_time('d');
		
		} elseif( is_month() ){
			$title = get_the_time('F');

		} elseif( is_year() ){
			$title = get_the_time('Y');
			
		} else {
			$title = get_the_title( redart_ID() );		
		}
		if( $echo ) echo redart_wp_kses($title);
		return $title;
	}
}

/* ---------------------------------------------------------------------------
 * Breadcrumbs
 * --------------------------------------------------------------------------- */
if( !function_exists('redart_breadcrumbs') ) {
	function redart_breadcrumbs(){
		global $post;
		
		$homeLink = esc_url( home_url('/') );
		$separator = '<span class="'.redart_option('layout','breadcrumb-delimiter').'"></span>';
		
		// plugin of bbPress
		if( function_exists('is_bbpress') && is_bbpress() ){
			bbp_breadcrumb( array(
				'before' 		=> '<div class="breadcrumb">',
				'after' 		=> '</div>',
				'sep' 			=> '<span class="'.redart_option('layout','breadcrumb-delimiter').'"></span>',
				'crumb_before' 	=> '',
				'crumb_after' 	=> '',
				'home_text' 	=> esc_html__('Home','redart'),
			) );
			return true;
		}
	
		$breadcrumbs = array();
	
		$breadcrumbs[] =  '<a href="'. $homeLink .'">'. esc_html__('Home','redart') .'</a>';
	
		// blog -----------------------------------------------
		if( get_post_type() == 'post' ){
			
			$blogID = false;
			if( get_option( 'page_for_posts' ) ){
				$blogID = get_option( 'page_for_posts' );	// setings > reading
			}
			if( $blogID ) $breadcrumbs[] = '<a href="'. get_permalink( $blogID ) .'">'. get_the_title( $blogID ) .'</a>';
		}
		
		if( function_exists('tribe_is_month') && ( tribe_is_event_query() || tribe_is_month() || tribe_is_event() || tribe_is_day() || tribe_is_venue() ) ) {
	
			if( function_exists('tribe_get_events_link') ){
				$breadcrumbs[] = '<a href="'. tribe_get_events_link() .'">'. tribe_get_events_title() .'</a>';
			}			
		} elseif( is_front_page() ){
	
			// do nothing
	
		} elseif( is_tag() ){
	
			$breadcrumbs[] = '<a href="'. get_tag_link( get_query_var('tag_id') ) .'">' . single_tag_title('', false) . '</a>';
	
		} elseif( is_category() ){
	
			$breadcrumbs[] = '<a href="'. get_category_link( get_query_var('cat') ) .'">' . single_cat_title('', false) . '</a>';
	
		} elseif( is_author() ){
	
			$breadcrumbs[] = '<a href="'. get_author_posts_url( get_the_author_meta( 'ID' ) ) .'">' . get_the_author() . '</a>';
	
		} elseif( is_day() || is_time() ){
	
			$breadcrumbs[] = '<a href="'. get_year_link( get_the_time('Y') ) . '">'. get_the_time('Y') .'</a>';
			$breadcrumbs[] = '<a href="'. get_month_link( get_the_time('Y'), get_the_time('m') ) .'">'. get_the_time('F') .'</a>';
			$breadcrumbs[] = '<a href="'. get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d') ) .'">'. get_the_time('d') .'</a>';
	
		} elseif( is_month() ){
	
			$breadcrumbs[] = '<a href="' . get_year_link( get_the_time('Y') ) . '">' . get_the_time('Y') . '</a>';
			$breadcrumbs[] = '<a href="'. get_month_link( get_the_time('Y'), get_the_time('m') ) .'">'. get_the_time('F') .'</a>';
	
		} elseif( is_year() ){
	
			$breadcrumbs[] = '<a href="'. get_year_link( get_the_time('Y') ) .'">'. get_the_time('Y') .'</a>';
	
		} elseif( is_single() && ! is_attachment() ){
	
			if( get_post_type() == 'dt_portfolios' ){
	
				$cat = get_the_term_list($post->ID, 'portfolio_entries', '', '$$$', '');
				$cats = array_filter(explode('$$$', $cat));
				if (!empty($cats))
					$breadcrumbs[] = $cats[0];
	
				$breadcrumbs[] = '<a href="' . get_the_permalink() . '">'. get_the_title().'</a>';

			} elseif( get_post_type() == 'product' ){

				$terms = get_the_terms( $post->ID, 'product_cat' );
				foreach ($terms as $term) {
					$term_link = get_term_link( $term );
					$breadcrumbs[] = '<a href="' . esc_url( $term_link ) . '">' . $term->name . '</a>';
				}
	
				$breadcrumbs[] = '<a href="' . get_the_permalink() . '">'. get_the_title().'</a>';

			} elseif( get_post_type() == 'post' ) {
	
				$cat = get_the_category();
				if( $cat ) {
					$cat = $cat[0];
					$breadcrumbs[] = get_category_parents( $cat, true, $separator );
				}
	
				$breadcrumbs[] = '<a href="' . get_the_permalink() . '">'. get_the_title() .'</a>';
	
			} else {
				$breadcrumbs[] = '<a href="' . get_the_permalink() . '">'. get_the_title() .'</a>';
			}
	
		} elseif( is_page() && $post->post_parent ){
	
			$parent_id  = $post->post_parent;
			$parents = array();
	
			while( $parent_id ) {
				$page = get_page( $parent_id );
				$parents[] = '<a href="' . get_permalink( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a>';
				$parent_id  = $page->post_parent;
			}
			$parents = array_reverse( $parents );
			$breadcrumbs = array_merge_recursive($breadcrumbs, $parents);
	
			$breadcrumbs[] = '<span class="current">'. get_the_title( redart_ID() ) .'</span>';
	
		} elseif( function_exists( 'is_woocommerce' ) && is_shop() ){
	
			$breadcrumbs[] = '<span class="current">'. get_the_title( redart_ID() ) .'</span>';
	
		} elseif( get_post_taxonomies() ){
	
			$breadcrumbs[] = '<a href="' . get_category_link( get_query_var('cat') ) . '">' . single_cat_title('', false) . '</a>';
	
		} else {
	
			$breadcrumbs[] = '<span class="current">'. get_the_title( redart_ID() ) .'</span>';
	
		}
	
		echo '<div class="breadcrumb">';
			$count = count( $breadcrumbs );
			$i = 1;
	
			foreach( $breadcrumbs as $bk => $bc ){
				if( !is_object( $bc ) ) {
					if( strpos( $bc , $separator ) ) {
						// category parents fix
						echo apply_filters( 'redart_breadcrumbs', $bc );
					} else {
						if( $i == $count ) $separator = '';
						echo apply_filters( 'redart_breadcrumbs', $bc . $separator );
					}
				}
				$i++;
			}
		echo '</div>';
	}
}

/* ---------------------------------------------------------------------------
 * Breadcrumb Section
 * --------------------------------------------------------------------------- */
if( !function_exists('redart_breadcrumb_section') ) {
	function redart_breadcrumb_section($id, $post_type ) {
	
		$bcrumb = redart_option('layout','show-breadcrumb');
		if( isset($bcrumb) && $bcrumb == 'true' ) :
	
			$title = get_the_title($id);
	
			if( $post_type === "post" )
				$settings = '_dt_post_settings';
			elseif( $post_type === "page")
				$settings = '_tpl_default_settings';
			elseif( $post_type === "dt_portfolios" )
				$settings = '_portfolio_settings';
			else
				$settings = '_custom_settings';
	
			$settings = get_post_meta( $id, $settings, TRUE );
			$settings = is_array($settings) ? $settings : array();
	
			$bg = $opacity = $position = $repeat = $color = '';
			$bg = array_key_exists('sub-title-bg', $settings) ? $settings['sub-title-bg'] : '';
			if(!empty($bg)) :
				$opacity = array_key_exists('sub-title-opacity', $settings) ? $settings['sub-title-opacity'] :'1';
				$position = array_key_exists('sub-title-bg-position', $settings) ? $settings['sub-title-bg-position'] :'center center';
				$repeat = array_key_exists('sub-title-bg-repeat', $settings) ? $settings['sub-title-bg-repeat'] :'repeat';
				$color = !empty($settings['sub-title-bg-color']) ? redart_hex2rgb($settings['sub-title-bg-color']) : '';
			else:
				$bg = redart_option('layout','sub-title-bg');
				$opacity = redart_option('layout','sub-title-opacity');
				$opacity = !empty($opacity) ? $opacity : '1';
				$position = redart_option('layout','sub-title-bg-position');
				$position = !empty($position) ? $position : 'center center';
				$repeat = redart_option('layout','sub-title-bg-repeat');
				$repeat = !empty($repeat) ? $repeat : 'repeat';
				$color = redart_option('layout','sub-title-bg-color');
				$color = !empty($color) ? redart_hex2rgb($color) : '';
			endif;
	
			$style = !empty($bg) ? "background:url($bg) $position $repeat;" : "";
			$style .= !empty($color) ? "background-color:rgba(  $color[0] ,  $color[1],  $color[2], {$opacity});" : "";
	
			$bstyle = redart_option('layout','breadcrumb-style');
	
			echo '<section class="main-title-section-wrapper '.esc_attr($bstyle).'" style="'.esc_attr($style).'">';
			echo '	<div class="container">';
			echo '		<div class="main-title-section">';
			echo 		'<h1>'.$title.'</h1>';
			echo '		</div>';
						redart_breadcrumbs();
			echo '	</div>';
			echo '</section>';
		else:
			$title = get_the_title($id);
			echo '<section class="main-title-section-wrapper no-breadcrumb">';
				echo '<div class="container">';
					echo '<div class="dt-sc-clear"></div>';
					echo '<h1 class="simple-title">'.$title.'</h1>';
				echo '</div>';
			echo '</section>';
		endif;
	}
}

if( !function_exists('redart_breadcrumb_section_with_class') ) {
	function redart_breadcrumb_section_with_class ( $title , $class ){
		$bcrumb = redart_option('layout','show-breadcrumb');
		if( isset($bcrumb) && $bcrumb == 'true' ) :
	
			$bg = redart_option('layout','sub-title-bg');
			$opacity = redart_option('layout','sub-title-opacity');
			$opacity = !empty($opacity) ? $opacity : '1';
			$position = redart_option('layout','sub-title-bg-position');
			$position = !empty($position) ? $position : 'center center';
			$repeat = redart_option('layout','sub-title-bg-repeat');
			$repeat = !empty($repeat) ? $repeat : 'repeat';
			$color = redart_option('layout','sub-title-bg-color');
			$color = !empty($color) ? redart_hex2rgb($color) : '';
			$style = !empty($bg) ? "background:url($bg) $position $repeat;" : "";
			$style .= !empty($color) ? "background-color:rgba(  $color[0] ,  $color[1],  $color[2], {$opacity});" : "";
	
			$bstyle = redart_option('layout','breadcrumb-style');
			$class .= " ".$bstyle;
	
			echo '<section class="main-title-section-wrapper '.esc_attr($class).'" style="'.esc_attr($style).'">';
			echo '	<div class="container">';
			echo '		<div class="main-title-section">';
			echo 		'<h1>'.esc_html($title).'</h1>';
			echo '		</div>';
						redart_breadcrumbs();
			echo '	</div>';
			echo '</section>';
		else:
			echo '<section class="main-title-section-wrapper no-breadcrumb">';
				echo '<div class="container">';
					echo '<div class="dt-sc-clear"></div>';
					echo '<h1 class="simple-title">'.$title.'</h1>';
				echo '</div>';
			echo '</section>';
		endif;
	}
}

if( !function_exists('redart_events_title') ) {
	function redart_events_title() {
		
		global $wp_query;
		
		$title = '';
		$date_format = apply_filters( 'tribe_events_pro_page_title_date_format', 'l, F jS Y' );
		
		if( tribe_is_month() && !is_tax() ) { 
			$title = sprintf( esc_html__( 'Events for %s', 'redart' ), date_i18n( 'F Y', strtotime( tribe_get_month_view_date() ) ) );
		} elseif( class_exists('Tribe__Events__Pro__Main') && tribe_is_week() )  {
			$title = sprintf( esc_html__('Events for week of %s', 'redart'), date_i18n( $date_format, strtotime( tribe_get_first_week_day($wp_query->get('start_date') ) ) ) );
		} elseif( class_exists('Tribe__Events__Pro__Main') && tribe_is_day() ) {
			$title = esc_html__( 'Events for', 'redart' ) . ' ' . date_i18n( $date_format, strtotime( $wp_query->get('start_date') ) );
		} elseif( class_exists('Tribe__Events__Pro__Main') && (tribe_is_map() || tribe_is_photo()) ) {
			if( tribe_is_past() ) {
				$title = esc_html__( 'Past Events', 'redart' );
			} else {
				$title = esc_html__( 'Upcoming Events', 'redart' );
			}
		
		} elseif( tribe_is_list_view() )  {
			$title = esc_html__('Upcoming Events', 'redart');
		} elseif (is_single())  {
			$title = $wp_query->post->post_title;
		} elseif( tribe_is_month() && is_tax() ) {
			$term_slug = $wp_query->query_vars['tribe_events_cat'];
			$term = get_term_by('slug', $term_slug, 'tribe_events_cat');
			$name = $term->name;
			$title = $name;
		} elseif( is_tag() )  {
			$title = esc_html__('Tag Archives','redart');
		}
		return $title;
	}
}

/* ---------------------------------------------------------------------------
 * Excerpt
 * --------------------------------------------------------------------------- */
if( !function_exists('redart_excerpt') ) {
	function redart_excerpt($limit = NULL) {
		$limit = !empty($limit) ? $limit : 10;
	
		$excerpt = explode(' ', get_the_excerpt(), $limit);
		$excerpt = array_filter($excerpt);
	
		if (!empty($excerpt)) {
			if (count($excerpt) >= $limit) {
				array_pop($excerpt);
				$excerpt = implode(" ", $excerpt).'...';
			} else {
				$excerpt = implode(" ", $excerpt);
			}
			$excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);
			return "<p>{$excerpt}</p>";
		}
	}
}

/* ---------------------------------------------------------------------------
 * WordPress wp_kses function for allowed html
 * --------------------------------------------------------------------------- */
if( !function_exists('redart_wp_kses') ) {
	function redart_wp_kses($content) {
		$dt_allowed_html_tags = array(
			'a' => array('class' => array(), 'data-product_id' => array(), 'href' => array(), 'title' => array(), 'target' => array(), 'id' => array(), 'data-post-id' => array(), 'data-gal' => array(), 'data-image' => array(), 'rel' => array()),
			'abbr' => array('title' => array()),
			'address' => array(),
			'area' => array('shape' => array(), 'coords' => array(), 'href' => array(), 'alt' => array()),
			'article' => array('id' => array(), 'class' => array()),
			'aside' => array('id' => array(), 'class' => array()),
			'audio' => array('autoplay' => array(), 'controls' => array(), 'loop' => array(), 'muted' => array(), 'preload' => array(), 'src' => array()),
			'b' => array(),
			'base' => array('href' => array(), 'target' => array()),
			'bdi' => array(),
			'bdo' => array('dir' => array()), 
			'blockquote' => array('cite' => array()), 
			'br' => array(),
			'button' => array('autofocus' => array(), 'disabled' => array(), 'form' => array(), 'formaction' => array(), 'formenctype' => array(), 'formmethod' => array(), 'formnovalidate' => array(), 'formtarget' => array(), 'name' => array(), 'type' => array(), 'value' => array()),
			'canvas' => array('height' => array(), 'width' => array()),
			'caption' => array('align' => array()),
			'cite' => array(),
			'code' => array(),
			'col' => array(),
			'colgroup' => array(),
			'datalist' => array('id' => array()),
			'dd' => array(),
			'del' => array('cite' => array(), 'datetime' => array()),
			'details' => array('open' => array()),
			'dfn' => array(),
			'dialog' => array('open' => array()),
			'div' => array('class' => array(), 'id' => array(), 'style' => array(), 'align' => array(), 'data-for' => array()),
			'dl' => array(),
			'dt' => array(),
			'em' => array(),
			'embed' => array('height' => array(), 'src' => array(), 'type' => array(), 'width' => array()),
			'fieldset' => array('disabled' => array(), 'form' => array(), 'name' => array()),
			'figcaption' => array(),
			'figure' => array(),
			'form' => array('accept' => array(), 'accept-charset' => array(), 'action' => array(), 'autocomplete' => array(), 'enctype' => array(), 'method' => array(), 'name' => array(), 'novalidate' => array(), 'target' => array(), 'id' => array(), 'class' => array()),
			'h1' => array('class' => array()), 'h2' => array('class' => array()), 'h3' => array('class' => array()), 'h4' => array('class' => array()), 'h5' => array('class' => array()), 'h6' => array('class' => array()),
			'hr' => array(), 
			'i' => array('class' => array(), 'id' => array()), 
			'iframe' => array('name' => array(), 'seamless' => array(), 'src' => array(), 'srcdoc' => array(), 'width' => array(), 'height' => array(), 'frameborder' => array(), 'allowfullscreen' => array(), 'mozallowfullscreen' => array(), 'webkitallowfullscreen' => array(), 'title' => array()),
			'img' => array('alt' => array(), 'crossorigin' => array(), 'height' => array(), 'ismap' => array(), 'src' => array(), 'usemap' => array(), 'width' => array(), 'title' => array(), 'data-default' => array()),
			'input' => array('align' => array(), 'alt' => array(), 'autocomplete' => array(), 'autofocus' => array(), 'checked' => array(), 'disabled' => array(), 'form' => array(), 'formaction' => array(), 'formenctype' => array(), 'formmethod' => array(), 'formnovalidate' => array(), 'formtarget' => array(), 'height' => array(), 'list' => array(), 'max' => array(), 'maxlength' => array(), 'min' => array(), 'multiple' => array(), 'name' => array(), 'pattern' => array(), 'placeholder' => array(), 'readonly' => array(), 'required' => array(), 'size' => array(), 'src' => array(), 'step' => array(), 'type' => array(), 'value' => array(), 'width' => array(), 'id' => array(), 'class' => array()),
			'ins' => array('cite' => array(), 'datetime' => array()),
			'label' => array('for' => array(), 'form' => array(), 'class' => array()),
			'legend' => array('align' => array()), 
			'li' => array('type' => array(), 'value' => array(), 'class' => array(), 'id' => array()),
			'link' => array('crossorigin' => array(), 'href' => array(), 'hreflang' => array(), 'media' => array(), 'rel' => array(), 'sizes' => array(), 'type' => array()),
			'main' => array(), 
			'map' => array('name' => array()), 
			'mark' => array(), 
			'menu' => array('label' => array(), 'type' => array()),
			'menuitem' => array('checked' => array(), 'command' => array(), 'default' => array(), 'disabled' => array(), 'icon' => array(), 'label' => array(), 'radiogroup' => array(), 'type' => array()),
			'meta' => array('charset' => array(), 'content' => array(), 'http-equiv' => array(), 'name' => array()),
			'object' => array('form' => array(), 'height' => array(), 'name' => array(), 'type' => array(), 'usemap' => array(), 'width' => array()),
			'ol' => array('class' => array(), 'reversed' => array(), 'start' => array(), 'type' => array()),
			'option' => array('value' => array(), 'selected' => array()),
			'p' => array('class' => array()), 
			'q' => array('cite' => array()), 
			'section' => array(), 
			'select' => array('autofocus' => array(), 'disabled' => array(), 'form' => array(), 'multiple' => array(), 'name' => array(), 'required' => array(), 'size' => array(), 'class' => array()),
			'small' => array(), 
			'source' => array('media' => array(), 'src' => array(), 'type' => array()),
			'span' => array('class' => array()), 
			'strong' => array(),
			'style' => array('media' => array(), 'scoped' => array(), 'type' => array()),
			'sub' => array(),
			'sup' => array(),
			'table' => array('sortable' => array()), 
			'tbody' => array(), 
			'td' => array('colspan' => array(), 'headers' => array()),
			'textarea' => array('autofocus' => array(), 'cols' => array(), 'disabled' => array(), 'form' => array(), 'maxlength' => array(), 'name' => array(), 'placeholder' => array(), 'readonly' => array(), 'required' => array(), 'rows' => array(), 'wrap' => array()),
			'tfoot' => array(),
			'th' => array('abbr' => array(), 'colspan' => array(), 'headers' => array(), 'rowspan' => array(), 'scope' => array(), 'sorted' => array()),
			'thead' => array(), 
			'time' => array('datetime' => array()), 
			'title' => array(), 
			'tr' => array(), 
			'track' => array('default' => array(), 'kind' => array(), 'label' => array(), 'src' => array(), 'srclang' => array()), 
			'u' => array(), 
			'ul' => array('class' => array(), 'id' => array()), 
			'var' => array(), 
			'video' => array('autoplay' => array(), 'controls' => array(), 'height' => array(), 'loop' => array(), 'muted' => array(), 'muted' => array(), 'poster' => array(), 'preload' => array(), 'src' => array(), 'width' => array()),
			'wbr' => array(),
		);
	
		$data = wp_kses($content, $dt_allowed_html_tags);
		return $data;
	}
}

/* ---------------------------------------------------------------------------
 * Hexadecimal to RGB color conversion
 * --------------------------------------------------------------------------- */
if(!function_exists('redart_hex2rgb')) {

	function redart_hex2rgb($hex) {
		$hex = str_replace ( "#", "", $hex );

		if (strlen ( $hex ) == 3) :
			$r = hexdec ( substr ( $hex, 0, 1 ) . substr ( $hex, 0, 1 ) );
			$g = hexdec ( substr ( $hex, 1, 1 ) . substr ( $hex, 1, 1 ) );
			$b = hexdec ( substr ( $hex, 2, 1 ) . substr ( $hex, 2, 1 ) );
		 else :
			$r = hexdec ( substr ( $hex, 0, 2 ) );
			$g = hexdec ( substr ( $hex, 2, 2 ) );
			$b = hexdec ( substr ( $hex, 4, 2 ) );
		endif;
		$rgb = array (
				$r,
				$g,
				$b 
		);
		return $rgb;
	}
}

/* ---------------------------------------------------------------------------
 * Getting individual Theme options
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'redart_opts_get' ) ) {

	function redart_opts_get( $opt_name, $default = null ){

		// getting option
		$opts = get_option ( REDART_SETTINGS );
		$opts = is_array( $opts ) ? $opts : array();

		$value = redart_array_search($opts, $opt_name);
		if( ! empty( $value ) ){
			return $value;
		} else {
			return $default;
		}
	}
}

/* ---------------------------------------------------------------------------
 * Showing individual Theme options
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'redart_opts_show' ) ) {

	function redart_opts_show( $opt_name, $default = null ){

		// getting option
		$opts = get_option ( REDART_SETTINGS );
		$opts = is_array( $opts ) ? $opts : array();

		$value = redart_array_search($opts, $opt_name);
		if( ! empty( $value ) ){
			echo redart_wp_kses($value);
		} else {
			echo redart_wp_kses($default);
		}
	}
}

/* ---------------------------------------------------------------------------
 * Theme Options search using key
 * --------------------------------------------------------------------------- */
if( !function_exists('redart_array_search') ) {
	function redart_array_search(array $array, $search) {
		$keys = false;
	
		foreach ($array as $key => $value) {
			if (is_array($array[$key])) {
				if (array_key_exists($search, $array[$key])) {
					return $array[$key][$search];
				} else {
					$keys = redart_array_search($array[$key], $search);
				}
			}
		}
		return $keys;
	}
}

/* ---------------------------------------------------------------------------
 * Theme Header Logo
 * --------------------------------------------------------------------------- */
if( !function_exists('redart_header_logo') ) {
	function redart_header_logo() {
		echo '<div id="logo">';
			if( redart_option('layout', 'logo') ):
				$url = redart_option('layout', 'logo-url');
				$url = !empty( $url ) ? $url : REDART_URI . "/images/logo.png";
	
				$retina_url = redart_option('layout','retina-logo-url');
				$retina_url = !empty($retina_url) ? $retina_url : REDART_URI ."/images/logo@2x.png";
	
				$width = redart_option('layout','retina-logo-width');
				$width = !empty($width) ? $width."px;" : "140px";
	
				$height = redart_option('layout','retina-logo-height');
				$height = !empty($height) ? $height."px;" : "88px";?>
				<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php bloginfo('title'); ?>">
					<img class="normal_logo" src="<?php echo esc_url($url); ?>" alt="<?php bloginfo('title'); ?>" title="<?php bloginfo('title'); ?>" />
					<img class="retina_logo" src="<?php echo esc_url($retina_url); ?>" alt="<?php bloginfo('title'); ?>" title="<?php bloginfo('title'); ?>" style="width:<?php echo esc_attr($width); ?>; height:<?php echo esc_attr($height); ?>;"/>
				</a><?php
			else: ?>
				<div class="logo-title">
					<h1 id="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" title="<?php bloginfo('title'); ?>"><?php bloginfo('title'); ?></a></h1>
					<h2 id="site-description"><?php bloginfo('description'); ?></h2>
				</div><?php
			endif;
		echo '</div>';
	}
}

/* ---------------------------------------------------------------------------
 * Theme Comment Style
 * --------------------------------------------------------------------------- */
if( !function_exists('redart_comment_style') ) {
	function redart_comment_style( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ($comment->comment_type ) :
		case 'pingback':
		case 'trackback':
			echo '<li class="post pingback">';
			echo "<p>";
			esc_html_e('Pingback:', 'redart');
			comment_author_link();
			edit_comment_link(esc_html__('Edit', 'redart'), ' ', '');
			echo "</p>";
			break;
	
		default:
		case '':
			echo "<li ";
			comment_class();
			echo ' id="li-comment-';
			comment_ID();
			echo '">';
			echo '<article class="comment" id="comment-';
			comment_ID();
			echo '">';
	
			echo '<header class="comment-author">'.get_avatar($comment, 450).'</header>';
	
			echo '<section class="comment-details">';
			echo '	<div class="author-name">';
			echo 		comment_reply_link(array_merge($args, array('reply_text' => ucfirst(get_comment_author_link()) , 'depth' => $depth, 'max_depth' => $args['max_depth'])));
			echo '		<span class="commentmetadata"> / '.get_comment_date('d M Y').'</span>';
			echo '	</div>';		
			echo '  <div class="comment-body">';
						comment_text();
						if ($comment->comment_approved == '0') :
							esc_html_e('Your comment is awaiting moderation.', 'redart');
						endif;
						edit_comment_link(esc_html__('Edit', 'redart'));
			echo '	</div>';
			echo '	<div class="reply">';
			echo 		comment_reply_link(array_merge($args, array('reply_text' => esc_html__('Reply', 'redart'), 'depth' => $depth, 'max_depth' => $args['max_depth'])));
			echo '	</div>';
			echo '</section>';
			echo '</article><!-- .comment-ID -->';
			break;
		endswitch;
	}
}

/* ---------------------------------------------------------------------------
 * Theme show sidebar
 * --------------------------------------------------------------------------- */
if( !function_exists('redart_show_sidebar') ) {
	function redart_show_sidebar( $type, $id, $position = 'right' ) {
	
		if( $type == 'page' ){
			$settings = get_post_meta($id,'_tpl_default_settings',TRUE);
		} elseif( $type == 'post' ){
			$settings = get_post_meta($id,'_dt_post_settings',TRUE);
		} elseif( $type == 'dt_portfolios' ){
			$settings = get_post_meta($id,'_portfolio_settings',TRUE);
		} else {
			$settings = get_post_meta($id,'_custom_settings',TRUE);
		}
	
		$settings = is_array($settings) ? $settings  : array();	
		
		$k = 'show-standard-sidebar-'.$position;
		if( isset($settings[$k]) ){
	
			$sidebar = 'standard-sidebar-'.$position;
			if( is_active_sidebar( $sidebar ) ){
				dynamic_sidebar($sidebar);
			}
		}
	
		$k = 'widget-area-'.$position;
		if( array_key_exists($k, $settings) ){
			foreach($settings[$k] as $widgetarea ){
				$id = mb_convert_case($widgetarea, MB_CASE_LOWER, "UTF-8");
	
				if( is_active_sidebar($id) ){
					dynamic_sidebar($id);
				}
			}
		}
	}
}

/* ---------------------------------------------------------------------------
 * Registering Footer Widget Areas
 * --------------------------------------------------------------------------- */
if (!function_exists('redart_footer_widgetarea')) {
	function redart_footer_widgetarea($count) {
		$name = esc_html__ ( "Footer Column", 'redart' );
		if ($count <= 4) :
			for($i = 1; $i <= $count; $i ++) :
				register_sidebar ( array (
						'name' => $name . "-{$i}",
						'id' => "footer-sidebar-{$i}",
						'description' => esc_html__('Appears in the footer section of the site.', 'redart'),
						'before_widget' => '<aside id="%1$s" class="widget %2$s">',
						'after_widget' => '</aside>',
						'before_title' => '<h3 class="widgettitle">',
						'after_title' => '</h3>'
				) );
			endfor;
		 elseif ($count == 5 || $count == 6) :
			$a = array (
					"1-4",
					"1-4",
					"1-2" 
			);
			$a = ($count == 5) ? $a : array_reverse ( $a );
			foreach ( $a as $k => $v ) :
				register_sidebar ( array (
						'name' => $name . "-{$v}",
						'id' => "footer-sidebar-{$k}-{$v}",
						'description' => esc_html__('Appears in the footer section of the site.', 'redart'),
						'before_widget' => '<aside id="%1$s" class="widget %2$s">',
						'after_widget' => '</aside>',
						'before_title' => '<h3 class="widgettitle">',
						'after_title' => '</h3>'
				) );
			endforeach;
		 elseif ($count == 7 || $count == 8) :
			$a = array (
					"1-4",
					"3-4" 
			);
			$a = ($count == 7) ? $a : array_reverse ( $a );
			foreach ( $a as $k => $v ) :
				register_sidebar ( array (
						'name' => $name . "-{$v}",
						'id' => "footer-sidebar-{$k}-{$v}",
						'description' => esc_html__('Appears in the footer section of the site.', 'redart'),
						'before_widget' => '<aside id="%1$s" class="widget %2$s">',
						'after_widget' => '</aside>',
						'before_title' => '<h3 class="widgettitle">',
						'after_title' => '</h3>'
				) );
			endforeach;
		 elseif ($count == 9 || $count == 10) :
			$a = array (
					"1-3",
					"2-3" 
			);
			$a = ($count == 9) ? $a : array_reverse ( $a );
			foreach ( $a as $k => $v ) :
				register_sidebar ( array (
						'name' => $name . "-{$v}",
						'id' => "footer-sidebar-{$k}-{$v}",
						'description' => esc_html__('Appears in the footer section of the site.', 'redart'),
						'before_widget' => '<aside id="%1$s" class="widget %2$s">',
						'after_widget' => '</aside>',
						'before_title' => '<h3 class="widgettitle">',
						'after_title' => '</h3>'
				) );
			endforeach;
		endif;
	}
}

/* ---------------------------------------------------------------------------
 * Check global variables
 * --------------------------------------------------------------------------- */
if( !function_exists('redart_global_variables') ) {
	function redart_global_variables($variable = '') {
	
		global $woocommerce, $product, $woocommerce_loop, $post, $wp_query, $pagenow, $post_like_love;
	
		switch($variable) {
			case 'woocommerce':
				return $woocommerce;
				break;
			case 'product':
				return $product;
				break;
			case 'woocommerce_loop':
				return $woocommerce_loop;
				break;
			case 'post':
				return $post;
				break;
			case 'wp_query':
				return $wp_query;
				break;
			case 'pagenow':
				return $pagenow;
				break;
			case 'post_like_love':
				return $post_like_love;
				break;
		}
		return false;
	}
}

/* ---------------------------------------------------------------------------
 * Load Gallery Items
 * --------------------------------------------------------------------------- */
add_action("wp_ajax_redart_ajax_load_gallery_posts", "redart_ajax_load_gallery_posts");
add_action("wp_ajax_nopriv_redart_ajax_load_gallery_posts", "redart_ajax_load_gallery_posts");
if( !function_exists('redart_ajax_load_gallery_posts') ) {
	function redart_ajax_load_gallery_posts() {
	
		$galleryloadmore_nonce  = sanitize_text_field($_POST['galleryloadmore_nonce']);
		if(isset($galleryloadmore_nonce) && wp_verify_nonce($galleryloadmore_nonce, 'galleryloadmore_nonce')):

			$out = '';
		
			$limit = (isset($_REQUEST['numPosts'])) ? $_REQUEST['numPosts'] : '5';
			$tax = (isset($_REQUEST['tax'])) ? explode(',', $_REQUEST['tax']) : '';
			$page = (isset($_REQUEST['pageNumber'])) ? $_REQUEST['pageNumber'] : '0';
			$offset = (isset($_REQUEST['offset'])) ? $_REQUEST['offset'] : '0';
			$post_class = $_REQUEST['itemClass'];
			$allow_gridspace = (isset($_REQUEST['allowSpace'])) ? $_REQUEST['allowSpace'] : 'no-space';
			$style = (isset($_REQUEST['style'])) ? $_REQUEST['style'] : 'type1';
			$allow_filter = $_REQUEST['allowFilter'];
			
			$args = array('post_type' => 'dt_portfolios', 'posts_per_page' => $limit, 'post_status' => 'publish', 'offset' => $offset + ($limit * $page), 'tax_query' => array( array( 'taxonomy' => 'portfolio_entries', 'field' => 'id', 'terms' => $tax )));
			
			$the_query = new WP_Query($args);
			if($the_query->have_posts()): 
			while($the_query->have_posts()): $the_query->the_post();
		
				$the_id = get_the_ID();
				$title = get_the_title($the_id);
				$permalink = get_permalink($the_id);
			
				$temp_class = $style.' '.$allow_gridspace;
				if($i == 1) $temp_class .= $post_class." first"; else $temp_class .= $post_class;
				if($i == $column) $i = 1; else $i = $i + 1;
			
				if( $allow_filter == "yes" ):
					$item_categories = get_the_terms( $the_id, 'portfolio_entries' );
					if(is_object($item_categories) || is_array($item_categories)):
						foreach ($item_categories as $category):
							$temp_class .=" ".$category->slug.'-sort ';
						endforeach;
					endif;
				endif;
			
				#setting up images					
				$portfolio_item_meta = get_post_meta($the_id,'_portfolio_settings',TRUE);
				$portfolio_item_meta = is_array($portfolio_item_meta) ? $portfolio_item_meta  : array();
				$items = false;
				
				if( array_key_exists('items_name', $portfolio_item_meta) ) {
					
					$items = true;
					$item =  $portfolio_item_meta['items_name'][0];
					$popup = $portfolio_item_meta['items'][0];
					
					if( "video" === $item ) {
						$x = array_diff( $portfolio_item_meta['items_name'] , array("video") );
						if( !empty($x) ) {
							$image = $portfolio_item_meta['items'][key($x)];
						} else {
							$image = 'http'.redart_ssl().'://place-hold.it/1170X902.jpg&text=Video';
						}
					} else {
						if( sizeof($portfolio_item_meta['items']) > 1 ){
							$popup = $portfolio_item_meta['items'][0];
						}
						
						$image = $portfolio_item_meta['items'][0];
					}
				}
			
				if( has_post_thumbnail( $the_id ) ){
					$image = wp_get_attachment_image_src(get_post_thumbnail_id( $the_id ), 'full', false);
					$image = $popup = $image[0];
					
					if( !$items ){
						$popup = $image;
					} 
				}elseif( $items ) {
					$image = $image;
					$popup = $popup;
				}else{
					$image = $popup = 'http'.redart_ssl().'://place-hold.it/1170X902.jpg&text='.$title;
				}				
				// setting up image end
				
				$out .= '<div id="dt_portfolios-'.esc_attr($the_id).'" class="'.esc_attr(trim($temp_class)).'">';
				$out .= '	<figure>';
				$out .= '		<img src="'.esc_url($image).'" alt="'.esc_attr($title).'" title="'.esc_attr($title).'"/>';
				$out .= '		<div class="image-overlay">';
									if($style == "type3" ):
										$out .= '<div class="links">';
										$out .= 	'<a title="'.esc_attr($title).'" href="'.esc_url($permalink).'">'.esc_html($title).'</a>';
										$out .= '</div>';
									elseif( $style == "type4" || $style == "type6" ):
										$out .= '<div class="links">';
										$out .= 	'<a title="'.esc_attr($title).'" href="'.esc_url($permalink).'"><span class="icon icon-linked"> </span></a>';
										$out .= 	'<a title="'.esc_attr($title).'" data-gal="prettyPhoto[gallery]" href="'.esc_url($popup).'">';
										$out .= 	'	<span class="icon icon-search"> </span> </a>';
										$out .= '</div>';
									elseif( $style == "type1" || $style == "type2" || $style == "type5"):
										$out .= '<div class="links">';
										$out .= 	'<a title="'.esc_attr($title).'" href="'.esc_url($permalink).'"><span class="icon icon-linked"> </span></a>';
										$out .= 	'<a title="'.esc_attr($title).'" data-gal="prettyPhoto[gallery]" href="'.esc_url($popup).'">';
										$out .= 	'	<span class="icon icon-search"> </span> </a>';
										$out .= '</div>';
										$out .= '<div class="image-overlay-details">';
										$out .= '	<h2><a title="'.esc_attr($title).'" href="'.esc_url($permalink).'">'.esc_html($title).'</a></h2>';										
													$out .= get_the_term_list( $id, 'portfolio_entries', "<p class='categories'>", ', ', '</p>' );
										$out .= '</div>';
									elseif( $style == "type7" ):
										$out .= '<div class="links">';
										$out .= 	'<a title="'.esc_attr($title).'" data-gal="prettyPhoto[gallery]" href="'.esc_url($popup).'">';
										$out .= 	'	<span class="pe-icon pe-plus"> </span></a>';
										$out .= '</div>';
									endif;
				$out .= '		</div>';
				$out .= '	</figure>';					
				$out .= '</div>';   
		
			endwhile;
			endif;
			
			echo "{$out}";

		endif;

		die();


	}
}

/* ---------------------------------------------------------------------------
 * Whitelist Associate
 * --------------------------------------------------------------------------- */
if ( ! function_exists( 'redart_array_whitelist_assoc' ) ) {
	function redart_array_whitelist_assoc( Array $array1, Array $array2 ) {
		if ( func_num_args() > 2 ) {
			$args = func_get_args();
			array_shift( $args );
			$array2 = call_user_func_array( 'array_merge', $args );
		}

		return array_intersect_key( $array1, array_flip( $array2 ) );
	}
}

/* ---------------------------------------------------------------------------
 * Post Type Support
 * --------------------------------------------------------------------------- */
add_filter( 'fw_ext_page_builder_supported_post_types', 'redart_limit_post_types_support', 1 );
if( ! function_exists( 'redart_limit_post_types_support' ) ){
	function redart_limit_post_types_support( $all_post_types ) {
	
		$white_listed_post_types = array( '' ); //allowed custom post type names
		$post_types              = redart_array_whitelist_assoc( $all_post_types, $white_listed_post_types );
	
		return $post_types;
	}
}