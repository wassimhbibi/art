<?php
	// standard left sidebar
	register_sidebar(array(
		'name' 			=>	esc_html__('Standard | Left Sidebar', 'redart'),
		'id'			=>	'standard-sidebar-left',
		'description'	=>	esc_html__("Appears in the Left side of the site, one enabled.",'redart'),
		'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
		'after_widget' 	=> 	'</aside>',
		'before_title' 	=> 	'<h3 class="widgettitle">',
		'after_title' 	=> 	'</h3>'));

	// standard right sidebar
	register_sidebar(array(
		'name' 			=>	esc_html__('Standard | Right Sidebar', 'redart'),
		'id'			=>	'standard-sidebar-right',
		'description'	=>	esc_html__("Appears in the Right side of the site, one enabled.",'redart'),
		'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
		'after_widget' 	=> 	'</aside>',
		'before_title' 	=> 	'<h3 class="widgettitle">',
		'after_title' 	=> 	'</h3>'));

	// custom widget area
	$widget_area = redart_option('widgetarea','custom');
	$widget_area = is_array($widget_area) ? array_unique($widget_area) : array();
    $widget_area = array_filter($widget_area);
    foreach ($widget_area as $key => $value) {
    	$id = mb_convert_case($value, MB_CASE_LOWER, "UTF-8");
    	$id = str_replace(" ", "-", $id);

    	register_sidebar(array(
		'name' 			=>	$value,
		'id'			=>	$id,
		'description'   =>  esc_html__("Custom sidebar created in Theme Options.",'redart'),
		'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
		'after_widget' 	=> 	'</aside>',
		'before_title' 	=> 	'<h3 class="widgettitle">',
		'after_title' 	=> 	'</h3>'));
    }

	// post archives sidebar
	$layout = redart_option('pageoptions','post-archives-page-layout');
	$layout = !empty($layout) ? $layout : "content-full-width";
	switch($layout) :
		case 'with-left-sidebar':
			register_sidebar(array(
				'name' 			=>	esc_html__("Post Archives | Left Sidebar",'redart'),
				'id'			=>	'post-archives-sidebar-left',
				'description'   =>  esc_html__("Appears in the Left side of Post Archives Page.",'redart'),
				'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
				'after_widget' 	=> 	'</aside>',
				'before_title' 	=> 	'<h3 class="widgettitle">',
				'after_title' 	=> 	'</h3>'));
		break;

		case 'with-right-sidebar':
			register_sidebar(array(
				'name' 			=>	esc_html__("Post Archives | Right Sidebar",'redart'),
				'id'			=>	'post-archives-sidebar-right',
				'description'   =>  esc_html__("Appears in the Right side of Post Archives Page.",'redart'),
				'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
				'after_widget' 	=> 	'</aside>',
				'before_title' 	=> 	'<h3 class="widgettitle">',
				'after_title' 	=> 	'</h3>'));
		break;

		case 'with-both-sidebar':
			register_sidebar(array(
				'name' 			=>	esc_html__("Post Archives | Left Sidebar",'redart'),
				'id'			=>	'post-archives-sidebar-left',
				'description'   =>  esc_html__("Appears in the Left side of Post Archives Page.",'redart'),
				'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
				'after_widget' 	=> 	'</aside>',
				'before_title' 	=> 	'<h3 class="widgettitle">',
				'after_title' 	=> 	'</h3>'));

			register_sidebar(array(
				'name' 			=>	esc_html__("Post Archives | Right Sidebar",'redart'),
				'id'			=>	'post-archives-sidebar-right',
				'description'   =>  esc_html__("Appears in the Right side of Post Archives Page.",'redart'),
				'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
				'after_widget' 	=> 	'</aside>',
				'before_title' 	=> 	'<h3 class="widgettitle">',
				'after_title' 	=> 	'</h3>'));
		break;
	endswitch;

	// events everywhere sidebar
	if( class_exists('Tribe__Events__Main')	):
		// left sidebar
		register_sidebar(array(
			'name' 			=>	esc_html__('Events | Left Sidebar', 'redart'),
			'id'			=>	'events-everywhere-sidebar-left',
			'description'   =>  esc_html__("Main sidebar for The Events Calendar pages that appears on the left.",'redart'),
			'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
			'after_widget' 	=> 	'</aside>',
			'before_title' 	=> 	'<h3 class="widgettitle">',
			'after_title' 	=> 	'</h3>'));

		// right sidebar
		register_sidebar(array(
			'name' 			=>	esc_html__('Events | Right Sidebar', 'redart'),
			'id'			=>	'events-everywhere-sidebar-right',
			'description'   =>  esc_html__("Main sidebar for The Events Calendar pages that appears on the right.",'redart'),
			'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
			'after_widget' 	=> 	'</aside>',
			'before_title' 	=> 	'<h3 class="widgettitle">',
			'after_title' 	=> 	'</h3>'));
	endif;

	// portfolio archives sidebar
	if( class_exists('DTCorePlugin') ):
		$layout = redart_option('pageoptions','portfolio-archives-page-layout');
		$layout = !empty($layout) ? $layout : "content-full-width";
		switch($layout) :
			case 'with-left-sidebar':
				register_sidebar(array(
					'name' 			=>	esc_html__("Portfolio Archives | Left Sidebar",'redart'),
					'id'			=>	'custom-post-portfolio-archives-sidebar-left',
					'description'   =>  esc_html__("Appears in the Left side of Portfolio Archives Page.",'redart'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	'<h3 class="widgettitle">',
					'after_title' 	=> 	'</h3>'));
			break;

			case 'with-right-sidebar':
				register_sidebar(array(
					'name' 			=>	esc_html__("Portfolio Archives | Right Sidebar",'redart'),
					'id'			=>	'custom-post-portfolio-archives-sidebar-right',
					'description'   =>  esc_html__("Appears in the Right side of Portfolio Archives Page.",'redart'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	'<h3 class="widgettitle">',
					'after_title' 	=> 	'</h3>'));
			break;

			case 'with-both-sidebar':
				register_sidebar(array(
					'name' 			=>	esc_html__("Portfolio Archives | Left Sidebar",'redart'),
					'id'			=>	'custom-post-portfolio-archives-sidebar-left',
					'description'   =>  esc_html__("Appears in the Left side of Portfolio Archives Page.",'redart'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	'<h3 class="widgettitle">',
					'after_title' 	=> 	'</h3>'));

				register_sidebar(array(
					'name' 			=>	esc_html__("Portfolio Archives | Right Sidebar",'redart'),
					'id'			=>	'custom-post-portfolio-archives-sidebar-right',
					'description'   =>  esc_html__("Appears in the Right side of Portfolio Archives Page.",'redart'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	'<h3 class="widgettitle">',
					'after_title' 	=> 	'</h3>'));
			break;
		endswitch;
	endif;

	// shop everywhere sidebar
	if( class_exists('woocommerce')	):
		// left sidebar
		register_sidebar(array(
			'name' 			=>	esc_html__('Shop | Left Sidebar', 'redart'),
			'id'			=>	'shop-everywhere-sidebar-left',
			'description'   =>  esc_html__("Main sidebar for The Shop pages that appears on the left.",'redart'),
			'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
			'after_widget' 	=> 	'</aside>',
			'before_title' 	=> 	'<h3 class="widgettitle">',
			'after_title' 	=> 	'</h3>'));

		// right sidebar
		register_sidebar(array(
			'name' 			=>	esc_html__('Shop | Right Sidebar', 'redart'),
			'id'			=>	'shop-everywhere-sidebar-right',
			'description'   =>  esc_html__("Main sidebar for The Shop pages that appears on the right.",'redart'),
			'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
			'after_widget' 	=> 	'</aside>',
			'before_title' 	=> 	'<h3 class="widgettitle">',
			'after_title' 	=> 	'</h3>'));

		// custom left sidebars for product
		$layout = redart_option('woo','product-layout');
		$layout = !empty($layout) ? $layout : "content-full-width";
		switch($layout) :
			case 'with-left-sidebar':
				register_sidebar(array(
					'name' 			=>  esc_html__('Product Detail | Left Sidebar', 'redart'),
					'id'			=>	'product-detail-sidebar-left',
					'description'	=>  esc_html__('Appears in the Left side of Product details Page.','redart'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	'<h3 class="widgettitle">',
					'after_title' 	=> 	'</h3>'));
			break;

			case 'with-right-sidebar':
				register_sidebar(array(
					'name' 			=>	esc_html__('Product Detail | Right Sidebar', 'redart'),
					'id'			=>	'product-detail-sidebar-right',
					'description'	=>  esc_html__('Appears in the Right side of Product details Page.','redart'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	'<h3 class="widgettitle">',
					'after_title' 	=> 	'</h3>'));
			break;

			case 'with-both-sidebar':
				register_sidebar(array(
					'name' 			=>	esc_html__('Product Detail | Left Sidebar', 'redart'),
					'id'			=>	'product-detail-sidebar-left',
					'description'	=>  esc_html__('Appears in the Left side of Product details Page.','redart'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	'<h3 class="widgettitle">',
					'after_title' 	=> 	'</h3>'));

				register_sidebar(array(
					'name' 			=>	esc_html__('Product Detail | Right Sidebar', 'redart'),
					'id'			=>	'product-detail-sidebar-right',
					'description'	=>  esc_html__('Appears in the Right side of Product details Page.','redart'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	'<h3 class="widgettitle">',
					'after_title' 	=> 	'</h3>'));
			break;
		endswitch;

		// custom left sidebars for product category
		$layout = redart_option('woo','product-category-layout');
		$layout = !empty($layout) ? $layout : "content-full-width";
		switch($layout) :
			case 'with-left-sidebar':
				register_sidebar(array(
					'name' 			=>	esc_html__('Product Category | Left Sidebar', 'redart'),
					'id'			=>	'product-category-sidebar-left',
					'description'	=>  esc_html__('Appears on Left side of Product Category Page.','redart'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	'<h3 class="widgettitle">',
					'after_title' 	=> 	'</h3>'));
			break;

			case 'with-right-sidebar':
				register_sidebar(array(
					'name' 			=>	esc_html__('Product Category | Right Sidebar', 'redart'),
					'id'			=>	"product-category-sidebar-right",
					'description'	=>  esc_html__('Appears on Right side of Product Category Page.','redart'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	'<h3 class="widgettitle">',
					'after_title' 	=> 	'</h3>'));
			break;

			case 'with-both-sidebar':
				register_sidebar(array(
					'name' 			=>	esc_html__('Product Category | Left Sidebar', 'redart'),
					'id'			=>	'product-category-sidebar-left',
					'description'	=>  esc_html__('Appears on Left side of Product Category Page.','redart'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	'<h3 class="widgettitle">',
					'after_title' 	=> 	'</h3>'));

				register_sidebar(array(
					'name' 			=>	esc_html__('Product Category | Right Sidebar', 'redart'),
					'id'			=>	'product-category-sidebar-right',
					'description'	=>  esc_html__('Appears on Right side of Product Category Page.','redart'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	'<h3 class="widgettitle">',
					'after_title' 	=> 	'</h3>'));
			break;
		endswitch;

		// custom left sidebars for product tag
		$layout = redart_option('woo','product-tag-layout');
		$layout = !empty($layout) ? $layout : "content-full-width";
		switch($layout) :
			case 'with-left-sidebar':
				register_sidebar(array(
					'name' 			=>	esc_html__('Product Tag | Left Sidebar', 'redart'),
					'id'			=>	'product-tag-sidebar-left',
					'description'	=>  esc_html__('Appears on Left side of Product Tag Page.','redart'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	'<h3 class="widgettitle">',
					'after_title' 	=> 	'</h3>'));
			break;

			case 'with-right-sidebar':
				register_sidebar(array(
					'name' 			=>	esc_html__('Product Tag | Right Sidebar', 'redart'),
					'id'			=>	'product-tag-sidebar-right',
					'description'	=>  esc_html__('Appears on Right side of Product Tag Page.','redart'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	'<h3 class="widgettitle">',
					'after_title' 	=> 	'</h3>'));
			break;

			case 'with-both-sidebar':
				register_sidebar(array(
					'name' 			=>	esc_html__('Product Tag | Left Sidebar', 'redart'),
					'id'			=>	'product-tag-sidebar-left',
					'description'	=>  esc_html__('Appears on Left side of Product Tag Page.','redart'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	'<h3 class="widgettitle">',
					'after_title' 	=> 	'</h3>'));

				register_sidebar(array(
					'name' 			=>	esc_html__('Product Tag | Right Sidebar', 'redart'),
					'id'			=>	'product-tag-sidebar-right',
					'description'	=>  esc_html__('Appears on Right side of Product Tag Page.','redart'),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	'<h3 class="widgettitle">',
					'after_title' 	=> 	'</h3>'));
			break;
		endswitch;
	endif;

	// footer columnns		
	$footer_columns =  redart_option('layout','footer-columns');
	redart_footer_widgetarea($footer_columns); ?>