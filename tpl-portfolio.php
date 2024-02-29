<?php
/*
Template Name: Portfolio Template
*/
get_header();
	$tpl_default_settings = get_post_meta($post->ID,'_tpl_default_settings',TRUE);
	$tpl_default_settings = is_array( $tpl_default_settings ) ? $tpl_default_settings  : array();

	if($GLOBALS['force_enable'] == true)
	  $page_layout = $GLOBALS['page_layout'];
	else
	  $page_layout  = array_key_exists( "layout", $tpl_default_settings ) ? $tpl_default_settings['layout'] : $GLOBALS['page_layout'];

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

	$full_class = array_key_exists( "portfolio-fullwidth", $tpl_default_settings ) ? 'portfolio-fullwidth' : '';

	?>
    <section id="primary" class="<?php echo esc_attr( $page_layout ); ?>"><?php
		if( have_posts() ):
			while( have_posts() ):
				the_post();
				get_template_part( 'functions/loops/content', 'page' );
			endwhile;
		endif;?>
        
        <div class="dt-sc-clear"></div>
        
        <!-- Portfolio Template -->
        <?php $post_layout = isset( $tpl_default_settings['portfolio-post-layout'] ) ? $tpl_default_settings['portfolio-post-layout'] : "one-half-column";
			$post_style = isset( $tpl_default_settings['portfolio-post-style'] ) ? $tpl_default_settings['portfolio-post-style'] : "type1";
			$allow_space =  isset( $tpl_default_settings['portfolio-grid-space'] ) ? "with-space" : "no-space";
			$post_per_page = $tpl_default_settings['portfolio-post-per-page'];
			
			#Post Class
			switch( $post_layout ):
				case 'one-fourth-column':
					$post_class = $show_sidebar ? " portfolio column dt-sc-one-fourth with-sidebar" : " portfolio column dt-sc-one-fourth";
					$columns = 4;
				break;

				case 'one-third-column':
					$post_class = $show_sidebar ? " portfolio column dt-sc-one-third with-sidebar" : " portfolio column dt-sc-one-third";
					$columns = 3;
				break;
				
				default:
				case 'one-half-column':
					$post_class = $show_sidebar ? " portfolio column dt-sc-one-half with-sidebar" : " portfolio column dt-sc-one-half";
					$columns = 2;
				break;
			endswitch;
			
			#Pagination
			$paged = 1;
			if ( get_query_var('paged') ) { 
				$paged = get_query_var('paged');
			} elseif ( get_query_var('page') ) {
				$paged = get_query_var('page');
			}
			
			$categories = isset($tpl_default_settings['portfolio-categories']) ? array_filter($tpl_default_settings['portfolio-categories']) : array();
			$cats = $categories;
			
			#Query arg
			$args = array();
			if( empty($categories) ):
				$args = array( 'paged' => $paged ,'posts_per_page' => $post_per_page,'post_type' => 'dt_portfolios');
			else:
				$args = array(
					'paged' => $paged,
					'posts_per_page' => $post_per_page,
					'post_type' => 'dt_portfolios',
					'orderby' => 'ID',
					'order' => 'ASC',
					'tax_query' => array( 
						array(
							'taxonomy' => 'portfolio_entries',
							'field' => 'id',
							'operator' => 'IN',
							'terms' => $categories
						)
					)
				);
			endif;
			#Query arg
			
			/* Filter Option */
			if(empty($categories)):
				$categories = get_categories('taxonomy=portfolio_entries&hide_empty=1');
			else:
				$c = array('taxonomy'=>'portfolio_entries','hide_empty'=>1,'include'=>$categories);
				$categories = get_categories($c);
			endif;
			
			if( (sizeof($categories) > 1) && (array_key_exists("filter",$tpl_default_settings)) ) :
				$post_class .= " all-sort";?>
                <div class="dt-sc-portfolio-sorting <?php echo esc_attr($post_style); ?>">
                	<a href="#" class="active-sort" data-filter=".all-sort"><?php esc_html_e('All','redart'); ?></a>
                    	<?php foreach( $categories as $category ):?>
                        		<a href='#' data-filter=".<?php echo esc_attr($category->category_nicename); ?>-sort">
                                	<?php echo esc_html($category->cat_name); ?>
                                </a>
                        <?php endforeach;?>
                 </div><?php
			endif; 
			/* Filter Option */
			
			$the_query = new WP_Query($args);
			if($the_query->have_posts()):
				$colors = array('cadetblue', 'cyan', 'deeporange', 'green', 'magenta', 'pink', 'red', 'teal', 'yellow');
				$i = 1;?>
            	<div class="dt-sc-portfolio-container <?php echo esc_attr($allow_space.' '.$full_class); ?>"><?php 
					while( $the_query->have_posts() ):
						$the_query->the_post();
						$the_id = get_the_ID();

						$temp_class = $post_style.' '.$allow_space;
						if($i == 1) $temp_class .= $post_class." first"; else $temp_class .= $post_class;
						if($i == $columns) $i = 1; else $i = $i + 1;
						
						if( array_key_exists("filter",$tpl_default_settings) ):
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
	                        		$image = 'http'.redart_ssl().'://placehold.it/1170X902.jpg&text=Video';
	                        	}								
							} else {
								if( sizeof($portfolio_item_meta['items']) > 1 ){
									$popup = $portfolio_item_meta['items'][1];
								}
								
								$image = $portfolio_item_meta['items'][0];
							}
						}
						
						if( has_post_thumbnail() ) {
							
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
						#setting up images end ?>
                        
                        <div id="dt_portfolios-<?php echo esc_attr($the_id); ?>" class="<?php echo esc_attr( trim($temp_class)); ?>">
                        	<figure>
                            	<img src="<?php echo esc_url($image); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" /><?php
									if($post_style == "type5"):
										$rndkey = array_rand($colors, 1);
										echo "<div class='image-overlay {$colors[$rndkey]}'>";
									else:
										echo '<div class="image-overlay">';
									endif;
									#conditions...
									if($post_style == "type3" ):?>
                                    		<div class="links">
                                            	<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </div>
                                    <?php elseif( $post_style == "type4" || $post_style == "type6" ):?>
                                    		<div class="links">
                                            	<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"> <span class="icon icon-linked"> </span> </a>
                                                <a title="<?php the_title(); ?>" data-gal="prettyPhoto[gallery]" href="<?php echo esc_url($popup); ?>">
                                                	<span class="icon icon-search"> </span> </a>
                                            </div>
                                    <?php elseif( $post_style == "type1" || $post_style == "type2" || $post_style == "type5"):?>
                                    		<div class="links">
                                            	<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"> <span class="icon icon-linked"> </span> </a>
                                                <a title="<?php the_title(); ?>" data-gal="prettyPhoto[gallery]" href="<?php echo esc_url($popup); ?>">
                                                	<span class="icon icon-search"> </span> </a>
                                            </div>
                                            <div class="image-overlay-details">
												<h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s','redart'), the_title_attribute('echo=0')); ?>"><?php 
													the_title(); ?></a></h2><?php
													the_terms( $post->ID, 'portfolio_entries', "<p class='categories'>",', ','</p>'); ?>
                                            </div>
                                    <?php elseif( $post_style == "type7" ):?>
                                    		<div class="links">
                                                <a title="<?php the_title(); ?>" data-gal="prettyPhoto[gallery]" href="<?php echo esc_url($popup); ?>">
                                                	<span class="pe-icon pe-plus"> </span> </a>
                                            </div>
                                    <?php endif;?>
                                </div>
                            </figure> 
                        </div><?php
					endwhile;?>
                </div><?php
				if(empty($cats)) {
					$cats = get_categories('taxonomy=portfolio_entries&hide_empty=1');
					$cats = get_terms( array('portfolio_entries'), array('fields' => 'ids'));		
				}
				#Ajax load more...
				$ajax_more =  isset( $tpl_default_settings['ajax-loadmore'] ) ? $tpl_default_settings['ajax-loadmore'] : '';
                if($ajax_more): ?>
                   <div class="aligncenter load-more">
                   	   <div class="aligncenter">
                       		<a id="ajax_load_gallery" href="javascript:void(0)" class="loadmore dt-sc-button medium with-icon icon-left filled dt-sc-expand dt-sc-expand-horizontal" data-per-page="<?php echo esc_attr($post_per_page); ?>" data-taxonomy="<?php echo implode(',', $cats); ?>" data-item-class="<?php echo esc_attr($post_class); ?>" data-allow-space="<?php echo esc_attr($allow_space); ?>" data-style="<?php echo esc_attr($post_style); ?>" data-galleryloadmore-nonce="<?php echo wp_create_nonce('galleryloadmore_nonce'); ?>"><span class="fa fa-picture-o"></span><?php esc_html_e('Load More', 'redart'); ?><i class="load-icon"></i></a>
                       </div>
                  </div><?php
				else: ?>
                    <!-- **Pagination** -->
                    <div class="pagination blog-pagination">
                        <?php echo redart_pagination($the_query); ?>
                    </div><!-- **Pagination** --><?php
				endif;
				wp_reset_postdata();
			endif;?>
            <!-- Portfolio Template -->
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