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
$type = redart_opts_get('comingsoon-style', 'type1');

$bg = redart_option('pageoptions','comingsoon-bg');
$opacity = redart_opts_get('comingsoon-bg-opacity', '1');
$position = redart_opts_get('comingsoon-bg-position', 'center center');
$repeat = redart_opts_get('comingsoon-bg-repeat', 'no-repeat');
$color = redart_option('pageoptions','comingsoon-bg-color');
$showcolor = redart_option('pageoptions','show-comingsoon-bg-color');

$estyle = redart_option('pageoptions','comingsoon-bg-style');

$color = !empty($color) ? redart_hex2rgb($color) : array('f', 'f', 'f');
$style = !empty($bg) ? "background:url($bg) $position $repeat;" : '';
$style .= (!empty($color) && isset($showcolor) ) ? "background-color:rgba(  $color[0] ,  $color[1],  $color[2], {$opacity});" : '';
$style .= !empty($estyle) ? $estyle : ''; ?>

<body <?php body_class($type); ?> style="<?php echo esc_attr($style); ?>">

<div class="wrapper"><?php
	$pageid = redart_option('pageoptions','comingsoon-pageid');
	if( !empty($pageid) ):
		$page = get_post( $pageid, ARRAY_A );
		echo DTCoreShortcodesDefination::dtShortcodeHelper ( stripslashes($page['post_content']) );
	endif; ?>
</div>
<?php wp_footer(); ?>
</body>
</html>