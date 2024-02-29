<?php
// menu icons
$searchicon = redart_option('layout','menu-searchicon');
$carticon	= redart_option('layout','menu-carticon');
if( isset($searchicon) || isset($carticon) ) : ?>
	<div class="menu-icons-wrapper"><?php
		if( isset($searchicon) ): ?>
			<div class="search">
				<a href="javascript:void(0)" class="dt-search-icon"> <span class="fa fa-search"> </span> </a>
				<div class="top-menu-search-container">
					<?php get_search_form(); ?>
				</div>
			</div><?php
		endif;
		if( isset($carticon) && function_exists("is_woocommerce")) : ?>
			<div class="cart">
				<a class="cart-contents" href="<?php echo wc_get_cart_url(); ?>" title="<?php esc_html_e( 'View Shopping Cart', 'redart' ); ?>">
					<span class="fa fa-shopping-cart"> </span><?php
					$count = WC()->cart->cart_contents_count;														
					if( $count > 0 ) : ?>
						<sup><?php echo esc_html($count); ?></sup><?php
					endif;?>
				</a>
			</div><?php
		endif; ?>
	</div><?php
endif; ?>