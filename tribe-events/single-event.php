<?php get_header();	

	$tpl_default_settings = get_post_meta(get_the_ID(),'_custom_settings',TRUE);
	$tpl_default_settings = is_array($tpl_default_settings) ? $tpl_default_settings  : array();

	if($GLOBALS['force_enable'] == true)
	  $page_layout = $GLOBALS['page_layout'];
	else
	  $page_layout  = array_key_exists( "layout", $tpl_default_settings ) ? $tpl_default_settings['layout'] : $GLOBALS['page_layout'];

	$post_style   = array_key_exists( "event-post-style", $tpl_default_settings ) ? $tpl_default_settings['event-post-style'] : "type1";
	$show_sidebar = $show_left_sidebar = $show_right_sidebar = false;
	$sidebar_class = "";

	switch ( $page_layout ) {
		case 'with-left-sidebar':
			$page_layout = "page-with-sidebar with-left-sidebar";
			$show_sidebar = $show_left_sidebar = true;
			$sidebar_class = "secondary-has-left-sidebar";
		break;

		case 'with-right-sidebar':
			$page_layout = "page-with-sidebar with-right-sidebar";
			$show_sidebar = $show_right_sidebar	= true;
			$sidebar_class = "secondary-has-right-sidebar";
		break;
		
		case 'with-both-sidebar':
			$page_layout = "page-with-sidebar with-both-sidebar";
			$show_sidebar = $show_left_sidebar = $show_right_sidebar	= true;
			$sidebar_class = "secondary-has-both-sidebar";
		break;

		case 'content-full-width':
		default:
			$page_layout = "content-full-width";
		break;
	}
	?>
    <section id="primary" class="<?php echo esc_attr( $page_layout ); ?>"><?php
		if( have_posts() ):
			while( have_posts() ):
				the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class($post_style); ?>>
                	<?php get_template_part('tribe-events/templates/event', $post_style); ?>
                </article><?php
			endwhile;
		endif; ?>
    </section><!-- **Primary - End** --><?php
	
	if ( $show_sidebar ):
		if ( $show_left_sidebar ): ?>
			<!-- Secondary Left -->
			<section id="secondary-left" class="secondary-sidebar <?php echo esc_attr( $sidebar_class ); ?>"><?php get_sidebar('left'); ?></section><?php
		endif;
	endif;
	
	if ( $show_sidebar ):
		if ( $show_right_sidebar ): ?>
			<!-- Secondary Right -->
			<section id="secondary-right" class="secondary-sidebar <?php echo esc_attr( $sidebar_class ); ?>"><?php get_sidebar('right'); ?></section><?php
		endif;
	endif;
get_footer(); ?>