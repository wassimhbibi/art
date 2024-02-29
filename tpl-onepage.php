<?php
/*
Template Name: One Page Template
*/
get_header(); ?>
	<!-- ** Primary Section ** -->
	<div id="primary" class="content-full-width">
		<?php if( have_posts() ):
				while( have_posts() ):
					the_post();
					get_template_part('functions/loops/content', 'page');
				endwhile;
		endif;?>
	</div><!-- ** Primary Section Ends ** -->
<?php
get_footer(); ?>