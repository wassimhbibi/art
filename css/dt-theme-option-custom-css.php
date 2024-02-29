<?php
/* ---------------------------------------------------------------------------
 * Custom CSS from THeme option panel
 * --------------------------------------------------------------------------- */

if ( ! defined( 'ABSPATH' ) ) exit;

if( ($custom_css = redart_option('layout','customcss-content')) &&  redart_option('layout','enable-customcss')){
	echo stripcslashes( $custom_css )."\n";
}?>