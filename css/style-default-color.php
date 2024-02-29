<?php
/* ---------------------------------------------------------------------------
 * Default Color Styles
 * --------------------------------------------------------------------------- */

if ( ! defined( 'ABSPATH' ) ) exit; ?>

<?php
$mtype = redart_option('layout','menu-active-type');
$skin = redart_option('colors','theme-skin');
if($skin == 'custom'):
	
	# Will do after working custom skin...

else:
    if( isset($mtype) && (($mtype == 'menu-active-highlight') || ($mtype == 'menu-active-with-icon menu-active-highlight')) ): ?>
        #main-menu > ul.menu > li.current_page_item > a, #main-menu > ul.menu > li.current_page_ancestor > a, #main-menu > ul.menu > li.current-menu-item > a, #main-menu > ul.menu > li.current-menu-ancestor > a,  .menu-active-highlight-grey #main-menu > ul.menu > li.current_page_item, .menu-active-highlight-grey #main-menu > ul.menu > li.current_page_ancestor, .menu-active-highlight-grey #main-menu > ul.menu > li.current-menu-item, .menu-active-highlight-grey #main-menu > ul.menu > li.current-menu-ancestor {
            background-color:<?php redart_opts_show('menu-activebgcolor', ''); ?>;
        }<?php
    endif;
    if( isset($mtype) && ($mtype == 'menu-active-highlight') ): ?>
        .menu-active-highlight-with-arrow #main-menu > ul.menu > li.current_page_item > a:before, .menu-active-highlight-with-arrow #main-menu > ul.menu > li.current_page_ancestor > a:before, .menu-active-highlight-with-arrow #main-menu > ul.menu > li.current-menu-item > a:before, .menu-active-highlight-with-arrow #main-menu > ul.menu > li.current-menu-ancestor > a:before {    	
            border-top-color:<?php redart_opts_show('menu-activebgcolor', ''); ?>;
        }<?php
    endif;
    if( isset($mtype) && ($mtype == 'menu-active-with-icon menu-active-highlight') ): ?>
        .menu-active-highlight-grey #main-menu > ul.menu > li.current_page_item > a:before, .menu-active-highlight-grey #main-menu > ul.menu > li.current_page_ancestor > a:before, .menu-active-highlight-grey #main-menu > ul.menu > li.current-menu-item > a:before, .menu-active-highlight-grey #main-menu > ul.menu > li.current-menu-ancestor > a:before {
            background-color:<?php redart_opts_show('menu-activecolor', ''); ?>;
        }<?php
    endif;
	if( isset($mtype) && ($mtype == 'menu-active-border-with-arrow')): ?>
		.menu-active-border-with-arrow #main-menu > ul.menu > li.current_page_item > a:before, .menu-active-border-with-arrow #main-menu > ul.menu > li.current_page_ancestor > a:before, .menu-active-border-with-arrow #main-menu > ul.menu > li.current-menu-item > a:before, .menu-active-border-with-arrow #main-menu > ul.menu > li.current-menu-ancestor > a:before {
			border-bottom-color:<?php redart_opts_show('menu-activecolor', ''); ?>;
		}
		.menu-active-border-with-arrow #main-menu > ul.menu > li.current_page_item > a:after, .menu-active-border-with-arrow #main-menu > ul.menu > li.current_page_ancestor > a:after, .menu-active-border-with-arrow #main-menu > ul.menu > li.current-menu-item > a:after, .menu-active-border-with-arrow #main-menu > ul.menu > li.current-menu-ancestor > a:after {
			background-color:<?php redart_opts_show('menu-activecolor', ''); ?>;
		}<?php
	endif;

	$mhovercolor = redart_opts_get('menu-hovercolor', '');
	$mactivecolor = redart_opts_get('menu-activecolor', '');

	if( !empty($mhovercolor) ){ ?>
      	#main-menu ul.menu > li > a:hover, #main-menu ul.menu li.menu-item-megamenu-parent:hover > a, #main-menu ul.menu > li.menu-item-simple-parent:hover > a { color:<?php echo esc_attr($mhovercolor); ?>; }<?php
	}

	if( !empty($mactivecolor) ){ ?>
      	#main-menu > ul.menu > li.current_page_item > a, #main-menu > ul.menu > li.current_page_ancestor > a, #main-menu > ul.menu > li.current-menu-item > a, #main-menu ul.menu > li.current-menu-ancestor > a, #main-menu ul.menu li.menu-item-simple-parent ul > li.current_page_item > a, #main-menu ul.menu li.menu-item-simple-parent ul > li.current_page_ancestor > a, #main-menu ul.menu li.menu-item-simple-parent ul > li.current-menu-item > a, #main-menu ul.menu li.menu-item-simple-parent ul > li.current-menu-ancestor > a, .left-header #main-menu > ul.menu > li.current_page_item > a,.left-header #main-menu > ul.menu > li.current_page_ancestor > a,.left-header #main-menu > ul.menu > li.current-menu-item > a, .left-header #main-menu > ul.menu > li.current-menu-ancestor > a { color:<?php echo esc_attr($mactivecolor); ?>;}<?php
	}
endif; ?>

/*-----------------------*****------------------------- Topbar  -----------------------*****-------------------------*/

.top-bar a, .top-bar a { color:<?php redart_opts_show('topbar-linkcolor', ''); ?>; }
.top-bar { color:<?php redart_opts_show('topbar-textcolor', '#000000'); ?>; background-color:<?php redart_opts_show('topbar-bgcolor','#252525'); ?>}
.top-bar a:hover, .top-bar a:hover { color:<?php redart_opts_show('topbar-linkhovercolor', '#000000'); ?>; }
#logo .logo-title > h1 a, .logo-title h2 { color:<?php redart_opts_show('site-title-color', '#FFFFFF'); ?>; }

/*-----------------------*****------------------------- Header -----------------------*****-------------------------*/<?php

$htype = redart_option('layout','header-type');
$hcolor = redart_option('colors','header-bgcolor');
if( isset($htype) && ($htype == 'boxed-header') && isset($hcolor) && ($hcolor != '')): ?>
	.main-header, .boxed-header.semi-transparent-header .main-header, .boxed-header .main-header { background: rgba(<?php $rgbcolor = redart_hex2rgb($hcolor); $rgbcolor = implode(',', $rgbcolor); echo esc_attr($rgbcolor); ?>, <?php redart_opts_show('header-bgcolor-opacity', '1'); ?>); }<?php
elseif( isset($hcolor) && ($hcolor != '') ):?>
	.main-header-wrapper, .fullwidth-header.semi-transparent-header .main-header-wrapper { background: rgba(<?php $rgbcolor = redart_hex2rgb(redart_opts_get('header-bgcolor', '')); $rgbcolor = implode(',', $rgbcolor); echo esc_attr($rgbcolor); ?>, <?php redart_opts_show('header-bgcolor-opacity', '1'); ?>); }<?php
endif;

$headbg = redart_option('layout','header-bg');
$bgrepeat = redart_opts_get('header-bg-repeat', 'no-repeat');
$bgposition = redart_opts_get('header-bg-position', 'center center');
if( !empty( $headbg) ) {?>
	#main-header-wrapper { background-image: url('<?php echo esc_attr($headbg); ?>'); background-repeat: <?php echo esc_attr($bgrepeat); ?>; background-position: <?php echo esc_attr($bgposition); ?>; }<?php
}?>

/*-----------------------*****------------------------- Menu  -----------------------*****-------------------------*/<?php

$mbg = redart_option('colors','menu-bgcolor');
if( isset($mbg) ): ?>
	.menu-wrapper, .rotate-header #main-menu .menu {  background: rgba(<?php $rgbcolor = redart_hex2rgb(redart_opts_get('menu-bgcolor', '')); $rgbcolor = implode(',', $rgbcolor); echo esc_attr($rgbcolor); ?>, <?php redart_opts_show('menu-bgcolor-opacity', '1'); ?>); }<?php
endif;

$mlinkcolor = redart_opts_get('menu-linkcolor','');
if( isset($mlinkcolor) ): ?>
	#main-menu ul.menu > li > a { color:<?php echo esc_attr($mlinkcolor); ?>; }<?php
endif;

$mlinkhovercolor = redart_opts_get('menu-hovercolor','');
if( isset($mlinkhovercolor) ): ?>
	#main-menu ul.menu > li:hover > a, .rotate-header #main-menu.nav-is-visible .menu li:hover a, .rotate-header #main-menu .menu li:hover a::before, .rotate-header #main-menu .menu li:hover a::after, 
    .rotate-header #main-menu .menu li .sub-menu li:hover > a { color:<?php echo esc_attr($mlinkhovercolor); ?>; }<?php
endif;

$mlinkactivelinkcolor = redart_opts_get('menu-activecolor','');
if( isset($mlinkactivelinkcolor) ): ?>
	.rotate-header #main-menu .menu ul.sub-menu li.current_page_item a, .rotate-header #main-menu .menu ul.sub-menu li.current-menu-item a, .rotate-header #main-menu .menu ul.sub-menu li.current_page_item a:before, 
    .rotate-header #main-menu .menu ul.sub-menu li.current-menu-item a:before, .rotate-header #main-menu .menu ul.sub-menu li.current_page_item a:after, .rotate-header #main-menu .menu ul.sub-menu li.current-menu-item a:after { color:<?php echo esc_attr($mlinkactivelinkcolor); ?>; }<?php
endif;

$mlinkactivebgcolor = redart_opts_get('menu-activebgcolor','#FFFFFF');
if( isset($mlinkactivebgcolor) ): ?>
	.rotate-header #main-menu.nav-is-visible .menu .current_page_item > a, .rotate-header #main-menu.nav-is-visible .menu .current-menu-item > a { background-color:<?php echo esc_attr($mlinkactivebgcolor); ?>; }<?php
endif;

if( isset($mtype) && ($mtype == 'menu-active-with-icon menu-active-highlight') ): ?>
	.menu-active-highlight.menu-active-with-icon #main-menu > ul.menu > li.current_page_item > a:before, .menu-active-highlight.menu-active-with-icon #main-menu > ul.menu > li.current_page_ancestor > a:before, .menu-active-highlight.menu-active-with-icon #main-menu > ul.menu > li.current-menu-item > a:before, .menu-active-highlight.menu-active-with-icon #main-menu > ul.menu > li.current-menu-ancestor > a:before,  .menu-active-highlight.menu-active-with-icon #main-menu > ul.menu > li.current_page_item > a:after, .menu-active-highlight.menu-active-with-icon #main-menu > ul.menu > li.current_page_ancestor > a:after, .menu-active-highlight.menu-active-with-icon #main-menu > ul.menu > li.current-menu-item > a:after, .menu-active-highlight.menu-active-with-icon #main-menu > ul.menu > li.current-menu-ancestor > a:after {
		background-color:<?php redart_opts_show('menu-activecolor', '#ffffff'); ?>;
	}<?php
endif;
if( isset($mtype) && ($mtype == 'menu-active-with-two-border') ): ?>
	.menu-active-with-two-border #main-menu > ul.menu > li.current_page_item > a:before, .menu-active-with-two-border #main-menu > ul.menu > li.current_page_ancestor > a:before, .menu-active-with-two-border #main-menu > ul.menu > li.current-menu-item > a:before, .menu-active-with-two-border #main-menu > ul.menu > li.current-menu-ancestor > a:before, .menu-active-with-two-border #main-menu > ul.menu > li.current_page_item > a:after, .menu-active-with-two-border #main-menu > ul.menu > li.current_page_ancestor > a:after, .menu-active-with-two-border #main-menu > ul.menu > li.current-menu-item > a:after, .menu-active-with-two-border #main-menu > ul.menu > li.current-menu-ancestor > a:after {
		background-color:<?php redart_opts_show('menu-activecolor', ''); ?>;
	}<?php
endif; ?>

.menu-active-highlight #main-menu > ul.menu > li.current_page_item > a, .menu-active-highlight #main-menu > ul.menu > li.current_page_ancestor > a, .menu-active-highlight #main-menu > ul.menu > li.current-menu-item > a, .menu-active-highlight #main-menu > ul.menu > li.current-menu-ancestor > a, .rotate-header #main-menu.nav-is-visible .menu .current_page_item > a, .rotate-header #main-menu.nav-is-visible .menu .current-menu-item > a { color:<?php redart_opts_show('menu-activecolor', '#ffffff'); ?>; }

/*-----------------------*****------------------------- Content -----------------------*****-------------------------*/<?php

$ccolor = redart_option('colors','content-text-color');
if( isset($ccolor) ): ?>
	body, p { color:<?php redart_opts_show('content-text-color', ''); ?>; }<?php
endif;
$ccolor = redart_option('colors','content-link-color');
if( isset($ccolor) ): ?>
	a { color:<?php redart_opts_show('content-link-color', ''); ?>; }<?php
endif;
$ccolor = redart_option('colors','content-link-hcolor');
if( isset($ccolor) ): ?>
	a:hover { color:<?php redart_opts_show('content-link-hcolor', ''); ?>; }<?php
endif;?>

/*-----------------------*****------------------------- Heading -----------------------*****-------------------------*/<?php

for($i = 1; $i <= 6; $i++):
	$hcolor = redart_option("colors","heading-h{$i}-color");
	if( isset($hcolor) ):
		echo "h{$i} { color: ";
			redart_opts_show("heading-h{$i}-color", "");
		echo "; }\n";	
	endif;
endfor;?>

/*-----------------------*****------------------------- Footer -----------------------*****-------------------------*/<?php

$fcolor = redart_option('colors','footer-bgcolor');
if( isset($fcolor) && ($fcolor != '')): ?>
    .footer-widgets {
        background: rgba(<?php
        $rgbcolor = redart_hex2rgb($fcolor);
        $rgbcolor = implode(',', $rgbcolor);
        echo esc_attr($rgbcolor); ?>, <?php redart_opts_show('footer-bgcolor-opacity', '1'); ?>) url( <?php redart_opts_show('footer-bg', ''); ?> ) <?php redart_opts_show('footer-bg-position', 'center center'); ?> <?php redart_opts_show('footer-bg-repeat', 'no-repeat'); ?>;
    }<?php
endif;

$footerbg = redart_option('layout','footer-bg');
if( !empty( $footerbg) ) {?>
    .footer-widgets {
        background-image: url('<?php echo esc_attr($footerbg); ?>'); background-repeat: <?php redart_opts_show('footer-bg-repeat', 'no-repeat'); ?>; background-position: <?php redart_opts_show('footer-bg-position', 'center center'); ?>;
    }<?php
}?>

.footer-widgets, #footer, .footer-copyright, #footer p { color:<?php redart_opts_show('footer-text-color', ''); ?>; }
.footer-widgets a, #footer a, .widget ul li a, .footer-widgets .widget ul li > a, #footer .widget ul li > a { color:<?php redart_opts_show('footer-link-color', ''); ?>; }
#footer h3 { color:<?php redart_opts_show('footer-heading-color', ''); ?>; }

/*-----------------------*****------------------ Copyright Section ---------------*****-------------------------*/<?php

$fccolor = redart_option('colors','copyright-bgcolor');
if( isset($fccolor) && ($fccolor != '')): ?>
    .footer-copyright {
        background: rgba(<?php
        $rgbcolor = redart_hex2rgb($fccolor);
        $rgbcolor = implode(',', $rgbcolor);
        echo esc_attr($rgbcolor); ?>, <?php redart_opts_show('copyright-bgcolor-opacity', '1'); ?>);
    }<?php
endif; ?>

/*----*****---- Megamenu ----*****----*/
<?php
# Border,Border radius
$applymenuborder = redart_option('layout','menu-border');
if( isset( $applymenuborder ) ):
	$borderstyle = redart_option('layout','menu-border-style');
	$bordercolor = redart_option('layout','menu-border-color');
	
	$bwtop = redart_option('layout','menu-border-width-top');
	$bwright = redart_option('layout','menu-border-width-right');
	$bwbottom = redart_option('layout','menu-border-width-bottom');
	$bwleft = redart_option('layout','menu-border-width-left');
	
	$brtop = redart_option('layout','menu-border-radius-top');
	$brright = redart_option('layout','menu-border-radius-right');
	$brbottom = redart_option('layout','menu-border-radius-bottom');
	$brleft = redart_option('layout','menu-border-radius-left'); ?>
    
    #main-menu ul li.menu-item-simple-parent ul, #main-menu .megamenu-child-container {
    	border-style:<?php echo "{$borderstyle}";?>;
        border-color:<?php echo "{$bordercolor}";?>;        
		<?php if( isset( $bwtop ) ); ?>
        	border-top-width:<?php echo "{$bwtop}";?>px;        
		<?php if( isset( $bwright ) ); ?>
    		border-right-width:<?php echo "{$bwright}";?>px;        
        <?php if( isset( $bwbottom ) ); ?>
    		border-bottom-width:<?php echo "{$bwbottom}";?>px;
        <?php if( isset( $bwleft ) ); ?>
        	border-left-width:<?php echo "{$bwleft}";?>px;
        <?php if( isset( $brtop ) ); ?>
        	border-top-left-radius:<?php echo "{$brtop}";?>px;    
        <?php if( isset( $brright ) ); ?>
    		border-top-right-radius:<?php echo "{$brright}";?>px;        
    	<?php if( isset( $brbottom ) ); ?>
    		border-bottom-right-radius:<?php echo "{$brbottom}";?>px;        
    	<?php if( isset( $brleft ) ); ?>
    		border-bottom-left-radius:<?php echo "{$brleft}";?>px;
	}
<?php
endif;
# Mega Menu Container BG Color
$menubgcolor = redart_option('layout','menu-bg-color');
if( isset( $menubgcolor ) ):?>
	#main-menu ul li.menu-item-simple-parent ul, #main-menu .megamenu-child-container { background-color:<?php echo "{$menubgcolor}";?>;}<?php
endif;

# Mega Menu Container gradient
$menugrc1 =  redart_option('layout','menu-gradient-color1');
$menugrc2 =  redart_option('layout','menu-gradient-color2');

if( isset($menugrc1) && isset($menugrc2) ) {
	
	$p1 = (redart_option('layout','menu-gradient-percent1') != NULL) ? redart_option('layout','menu-gradient-percent1') : "0%";
	$p2 = (redart_option('layout','menu-gradient-percent2') != NULL) ? redart_option('layout','menu-gradient-percent2') : "100%";?>
    #main-menu ul li.menu-item-simple-parent ul, #main-menu .megamenu-child-container {
		background: <?php echo "{$menugrc1}"; ?>; /* Old browsers */
		background: -moz-linear-gradient(top, <?php echo "{$menugrc1}".' '.$p1.', '.$menugrc2.' '.$p2; ?>); /* FF3.6-15 */
		background: -webkit-linear-gradient(top, <?php echo "{$menugrc1}".' '.$p1.', '.$menugrc2.' '.$p2; ?>); /* Chrome10-25,Safari5.1-6 */
		background: linear-gradient(to bottom, <?php echo "{$menugrc1}".' '.$p1.', '.$menugrc2.' '.$p2 ?>); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo "{$menugrc1}"; ?>', endColorstr='<?php echo "{$menugrc2}"; ?>',GradientType=0 ); /* IE6-9 */
	}
    <?php  
}

# Default Menu Title text and hover color
$titletextdcolor = redart_option('layout','menu-title-text-dcolor');
$titletextdhcolor = redart_option('layout','menu-title-text-dhcolor');

if( isset( $titletextdcolor) ); ?>
	#main-menu .megamenu-child-container > ul.sub-menu > li > a, #main-menu .megamenu-child-container > ul.sub-menu > li > .nolink-menu { color:<?php echo "{$titletextdcolor}";?>; }<?php
if( isset( $titletextdhcolor) ); ?>
	#main-menu .megamenu-child-container > ul.sub-menu > li > a:hover { color:<?php echo "{$titletextdhcolor}";?>; }
	#main-menu .megamenu-child-container > ul.sub-menu > li.current_page_item > a, #main-menu .megamenu-child-container > ul.sub-menu > li.current_page_ancestor > a, #main-menu .megamenu-child-container > ul.sub-menu > li.current-menu-item > a, #main-menu .megamenu-child-container > ul.sub-menu > li.current-menu-ancestor > a { color:<?php echo "{$titletextdhcolor}";?>; }<?php


# Menu Title Background
if( "true" == redart_option('layout','menu-title-bg') ) :
	$menutitlebgcolor = redart_option('layout','menu-title-bg-color');
	$bghovercolor = redart_option('layout','menu-title-hoverbg-color');
	$menutitletxtcolor = redart_option('layout','menu-title-text-color');
	$hovertxtcolor = redart_option('layout','menu-title-hovertext-color');
	$menutitlebr = redart_option('layout','menu-title-border-radius'); ?>
    #main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li > a, #main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li > .nolink-menu {
    	<?php if( isset( $menutitlebgcolor ) ); ?>
        	background:<?php echo "{$menutitlebgcolor}";?>;
        <?php if( isset( $menutitlebr ) ); ?>
        	border-radius:<?php echo "{$menutitlebr}";?>px;        
    }
    
    <?php if( isset($bghovercolor) ) {?>
    	#main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li > a:hover { background:<?php echo "{$bghovercolor}";?>;}
		#main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li.current_page_item > a, #main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li.current_page_ancestor > a, #main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li.current-menu-item > a, #main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li.current-menu-ancestor > a { background:<?php echo "{$bghovercolor}";?>; }<?php
	}
	
	if( isset( $menutitletxtcolor ) ) {?>
    	#main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li > a, #main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li > .nolink-menu, #main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li > a .menu-item-description { color:<?php echo "{$menutitletxtcolor}";?>;}<?php
	}
	
	if( isset( $hovertxtcolor ) ) {?>
    	#main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li > a:hover, #main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li > a:hover .menu-item-description { color:<?php echo "{$hovertxtcolor}";?>;}
		#main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li.current_page_item > a, #main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li.current_page_ancestor > a, #main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li.current-menu-item > a, #main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li.current-menu-ancestor > a, #main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li.current_page_item > a .menu-item-description
#main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li.current_page_ancestor > a .menu-item-description, #main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li.current-menu-item > a .menu-item-description, #main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li.current-menu-ancestor > a .menu-item-description { color:<?php echo "{$hovertxtcolor}";?>; }<?php
	}
endif;

#Menu Title With Border
$mtbwtop = redart_option('layout','menu-title-border-width-top');
$mtbwright = redart_option('layout','menu-title-border-width-right');
$mtbwbottom = redart_option('layout','menu-title-border-width-bottom');
$mtbwleft = redart_option('layout','menu-title-border-width-left');

if( isset($mtbwtop) || isset($mtbwright) || isset($mtbwbottom) || isset($mtbwleft) ) :

	$menutitlebrc = redart_option('layout','menu-title-border-color');
	$menutitlebrs = redart_option('layout','menu-title-border-style'); ?>
    #main-menu .menu-item-megamenu-parent .megamenu-child-container > ul.sub-menu > li > a, #main-menu .menu-item-megamenu-parent .megamenu-child-container > ul.sub-menu > li > .nolink-menu {
    	<?php if( isset( $mtbwtop ) ) : ?>
        		 border-top-width:<?php echo "{$mtbwtop}"; ?>px;
                 padding-top:10px;

    	<?php endif;
			  if( isset( $mtbwright ) ): ?>
        		 border-right-width:<?php echo "{$mtbwright}"; ?>px;
                 padding-right:10px;

    	<?php endif;
			  if( isset( $mtbwbottom ) ): ?>
        		 border-bottom-width:<?php echo "{$mtbwbottom}"; ?>px;
                 padding-bottom:10px;

    	<?php endif;
			  if( isset( $mtbwleft ) ): ?>
        		 border-left-width:<?php echo "{$mtbwleft}"; ?>px;
                 padding-left:10px;       
    	
        <?php endif;
		     if( isset( $menutitlebrs ) ); ?>
        	 	border-style:<?php echo "{$menutitlebrs}";?>;
        <?php if( isset( $menutitlebrc ) ); ?>
        		 border-color:<?php echo "{$menutitlebrc}";?>;
   }<?php	
endif;

# Default text and hover color
$textdcolor = redart_option('layout','menu-link-text-dcolor');
$textdhcolor = redart_option('layout','menu-link-text-dhcolor');

if( isset( $textdcolor) ); ?>
	#main-menu .megamenu-child-container ul.sub-menu > li > ul > li > a, #main-menu ul li.menu-item-simple-parent ul > li > a { color:<?php echo "{$textdcolor}";?>; }<?php
if( isset( $textdhcolor) ) :?>
	#main-menu .megamenu-child-container ul.sub-menu > li > ul > li > a:hover, #main-menu ul li.menu-item-simple-parent ul > li > a:hover { color:<?php echo "{$textdhcolor}";?>; }
	#main-menu .megamenu-child-container ul.sub-menu > li > ul > li.current_page_item > a, #main-menu .megamenu-child-container ul.sub-menu > li > ul > li.current_page_ancestor > a, #main-menu .megamenu-child-container ul.sub-menu > li > ul > li.current-menu-item > a, #main-menu .megamenu-child-container ul.sub-menu > li > ul > li.current-menu-ancestor > a, #main-menu ul li.menu-item-simple-parent ul > li.current_page_item > a, #main-menu ul li.menu-item-simple-parent ul > li.current_page_ancestor > a, #main-menu ul li.menu-item-simple-parent ul > li.current-menu-item > a, #main-menu ul li.menu-item-simple-parent ul > li.current-menu-ancestor > a { color:<?php echo "{$textdhcolor}";?>; }<?php
endif;

# Menu Links Background
if( "true" == redart_option('layout','menu-links-bg') ) :
	$menulinkbgcolor = redart_option('layout','menu-link-bg-color');
	$menulinkbghovercolor = redart_option('layout','menu-link-hoverbg-color');
	$menulinktxtcolor = redart_option('layout','menu-link-text-color');
	$menulinkhovertxtcolor = redart_option('layout','menu-link-hovertext-color');
	$menulinkbr = redart_option('layout','menu-link-border-radius');
	echo "\n";?>    
    /* Menu Link */   
    #main-menu .menu-item-megamenu-parent.menu-links-with-bg .megamenu-child-container ul.sub-menu > li > ul > li > a, #main-menu ul li.menu-item-simple-parent.menu-links-with-bg ul > li > a {
    	<?php if( !is_null( $menulinkbgcolor ) || !empty( $menulinkbgcolor ) ):?>
        		background:<?php echo "{$menulinkbgcolor}";?>;
        <?php endif;
			if( isset( $menulinkbr ) ); ?>
        	border-radius:<?php echo "{$menulinkbr}";?>px;
        <?php if(!is_null($menulinktxtcolor) || !empty( $menulinktxtcolor ) ): ?>
        	color:<?php echo "{$menulinktxtcolor}";?>;
        <?php endif; ?>
    }
    /* Menu Link Hover */
    #main-menu .menu-item-megamenu-parent.menu-links-with-bg .megamenu-child-container ul.sub-menu > li > ul > li > a:hover, #main-menu ul li.menu-item-simple-parent.menu-links-with-bg ul > li > a:hover {
    	<?php if( !is_null( $menulinkbghovercolor ) || !empty( $menulinkbghovercolor ) ):?>
        		background:<?php echo "{$menulinkbghovercolor}";?>;
        <?php endif;
			if( !is_null( $menulinkhovertxtcolor ) || !empty( $menulinkhovertxtcolor ) ):?>
        	color:<?php echo "{$menulinkhovertxtcolor}";?>;
       <?php endif;?>
    }
	#main-menu .menu-item-megamenu-parent.menu-links-with-bg .megamenu-child-container ul.sub-menu > li > ul > li.current_page_item > a, #main-menu .menu-item-megamenu-parent.menu-links-with-bg .megamenu-child-container ul.sub-menu > li > ul > li.current_page_ancestor > a, #main-menu .menu-item-megamenu-parent.menu-links-with-bg .megamenu-child-container ul.sub-menu > li > ul > li.current-menu-item > a, #main-menu .menu-item-megamenu-parent.menu-links-with-bg .megamenu-child-container ul.sub-menu > li > ul > li.current-menu-ancestor > a, #main-menu ul li.menu-item-simple-parent.menu-links-with-bg ul > li.current_page_item > a, #main-menu ul li.menu-item-simple-parent.menu-links-with-bg ul > li.current_page_ancestor > a, #main-menu ul li.menu-item-simple-parent.menu-links-with-bg ul > li.current-menu-item > a, #main-menu ul li.menu-item-simple-parent.menu-links-with-bg ul > li.current-menu-ancestor > a {
    	<?php if( !is_null( $menulinkbghovercolor ) || !empty( $menulinkbghovercolor ) ):?>
        	background:<?php echo "{$menulinkbghovercolor}";?>;
        <?php endif;
			if( !is_null( $menulinkhovertxtcolor ) || !empty( $menulinkhovertxtcolor ) ):?>
        	color:<?php echo "{$menulinkhovertxtcolor}";?>;
        <?php endif;?>
    }<?php
endif;

#Menu link hover boder 
if( "true" == redart_option('layout','menu-hover-border') ) {
	$mlhcolor = redart_option('layout','menu-link-hborder-color');
	
	if( isset( $mlhcolor ) ) {?>   
      #main-menu .menu-item-megamenu-parent .megamenu-child-container ul.sub-menu > li > ul > li, #main-menu ul li.menu-item-simple-parent ul > li { width:100%; box-sizing:border-box; } 
      #main-menu .menu-item-megamenu-parent.menu-links-with-arrow .megamenu-child-container ul.sub-menu > li > ul > li > a, #main-menu ul li.menu-item-simple-parent.menu-links-with-arrow ul > li > a { padding-left:27px; }
	  #main-menu .menu-item-megamenu-parent.menu-links-with-arrow .megamenu-child-container ul.sub-menu > li > ul > li > a:before, #main-menu ul li.menu-item-simple-parent.menu-links-with-arrow ul > li > a:before { left:12px; }
      #main-menu .menu-item-megamenu-parent .megamenu-child-container ul.sub-menu > li > ul > li > a, #main-menu ul li.menu-item-simple-parent ul > li > a, #main-menu ul li.menu-item-simple-parent ul > li:last-child > a { padding:7px 10px; width:100%; box-sizing:border-box; border:1px solid transparent; }
      #main-menu .menu-item-megamenu-parent .megamenu-child-container ul.sub-menu > li > ul > li > a:hover, #main-menu ul li.menu-item-simple-parent ul > li > a:hover {
        border:1px solid <?php echo "{$mlhcolor}";?>;        
      }<?php		
	}
}

#Menu Links With Border
if( "true" == redart_option('layout','menu-links-border') ) :

	$menulinkbrw = redart_option('layout','menu-link-border-width');
	$menulinkbrc = redart_option('layout','menu-link-border-color');
	$menulinkbrs = redart_option('layout','menu-link-border-style'); ?>
    #main-menu .menu-item-megamenu-parent.menu-links-with-border .megamenu-child-container ul.sub-menu > li > ul > li > a, #main-menu ul li.menu-item-simple-parent.menu-links-with-border ul > li > a {
    	<?php if( isset( $menulinkbrw ) ); ?>
        	 border-bottom-width:<?php echo "{$menulinkbrw}";?>px;
        <?php if( isset( $menulinkbrc ) ); ?>
        	 border-bottom-style:<?php echo "{$menulinkbrs}";?>;
        <?php if( isset( $menulinkbrs ) ); ?>
        	 border-bottom-color:<?php echo "{$menulinkbrc}";?>;
   }<?php	
endif; ?>