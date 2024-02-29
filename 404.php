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
<?php
$type = redart_opts_get('notfound-style', 'type1');

$bg = redart_option('pageoptions','notfound-bg');
$opacity = redart_opts_get('notfound-bg-opacity', '1');
$position = redart_opts_get('notfound-bg-position', 'center center');
$repeat = redart_opts_get('notfound-bg-repeat', 'no-repeat');
$color = redart_option('pageoptions','notfound-bg-color');

$estyle = redart_option('pageoptions','notfound-bg-style');
$color = !empty($color) ? redart_hex2rgb($color) : array();
$style = !empty($bg) ? "background:url($bg) $position $repeat;" : '';
$style .= !empty($color) ? "background-color:rgba(  $color[0] ,  $color[1],  $color[2], {$opacity});" : '';
$style .= !empty($estyle) ? $estyle : ''; ?>

<body <?php body_class($type); ?> style="<?php echo esc_attr($style); ?>">

<div class="wrapper">
	<div class="center-content-wrapper">
		<div class="center-content"><?php
			$pageid = redart_option('pageoptions','notfound-pageid');
			if( redart_option('pageoptions','enable-404message') && !empty($pageid) ):
				$page = get_post( $pageid, ARRAY_A );
				echo DTCoreShortcodesDefination::dtShortcodeHelper ( stripslashes($page['post_content']) );
			elseif( redart_option('pageoptions','enable-404message') ):
				echo '<h2>'.esc_html__('404 - Page Not Found', 'redart').'</h2><h5>'.esc_html__('The Page you are looking for is not found or does not exist.', 'redart').'</h5>';
				echo '<a class="dt-sc-button medium filled dt-sc-expand dt-sc-expand-vertical" target="_self" href="'.esc_url(home_url('/')).'">'.esc_html__('Back to Home','redart').'</a>';
			endif; ?>
        </div>
    </div>
</div>
<?php wp_footer(); ?>
</body>
</html>