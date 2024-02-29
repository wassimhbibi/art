<?php
/**
 * Theme Functions
 *
 * @package DTtheme
 * @author DesignThemes
 * @link http://wedesignthemes.com
 */
define( 'REDART_DIR', get_template_directory() );
define( 'REDART_URI', get_template_directory_uri() );
define( 'REDART_CORE_PLUGIN', WP_PLUGIN_DIR.'/designthemes-core-features' );
define( 'REDART_SETTINGS', 'redart-opts' );

if (function_exists ('wp_get_theme')) :
	$themeData = wp_get_theme();
	define( 'REDART_NAME', $themeData->get('Name'));
	define( 'REDART_VERSION', $themeData->get('Version'));
endif;

define( 'LANG_DIR', REDART_DIR. '/languages' );

/* ---------------------------------------------------------------------------
 * Loads Theme Textdomain
 * --------------------------------------------------------------------------- */
load_theme_textdomain( 'redart', LANG_DIR );

/* ---------------------------------------------------------------------------
 * Loads the Admin Panel Scripts
 * --------------------------------------------------------------------------- */
if( !function_exists('redart_admin_scripts') ) {
	function redart_admin_scripts() {
	
		wp_enqueue_style('redart-admin', REDART_URI .'/framework/theme-options/style.css');
		wp_enqueue_style('chosen', REDART_URI .'/framework/theme-options/css/chosen.css');
		wp_enqueue_style('wp-color-picker');
	
		wp_enqueue_script('jquery-ui-tabs');
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('jquery-ui-slider');
		wp_enqueue_script('wp-color-picker');
	
		wp_enqueue_script('redart-browser', REDART_URI . '/framework/theme-options/js/jquery.browser.min.js');
		wp_enqueue_script('tools', REDART_URI . '/framework/theme-options/js/jquery.tools.min.js');
		wp_enqueue_script('chosen', REDART_URI . '/framework/theme-options/js/chosen.jquery.min.js');
		wp_enqueue_script('redart-custom', REDART_URI . '/framework/theme-options/js/dttheme.admin.js', array( 'wp-blocks' ));
		wp_enqueue_media();
	
		wp_localize_script('redart-custom', 'objectL10n', array(
			'saveall' => esc_html__('Save All', 'redart'),
			'saving' => esc_html__('Saving ...', 'redart'),
			'noResult' => esc_html__('No Results Found!', 'redart'),
			'resetConfirm' => esc_html__('This will restore all of your options to default. Are you sure?', 'redart'),
			'importConfirm' => esc_html__('You are going to import the dummy data provided with the theme, kindly confirm?', 'redart'),
			'backupMsg' => esc_html__('Click OK to backup your current saved options.', 'redart'),
			'backupSuccess' => esc_html__('Your options are backuped successfully', 'redart'),
			'backupFailure' => esc_html__('Backup Process not working', 'redart'),
			'disableImportMsg' => esc_html__('Importing is disabled.. :), Please select atleast import type','redart'),
			'restoreMsg' => esc_html__('Warning: All of your current options will be replaced with the data from your last backup! Proceed?', 'redart'),
			'restoreSuccess' => esc_html__('Your options are restored from previous backup successfully', 'redart'),
			'restoreFailure' => esc_html__('Restore Process not working', 'redart'),
			'importMsg' => esc_html__('Click ok import options from the above textarea', 'redart'),
			'importSuccess' => esc_html__('Your options are imported successfully', 'redart'),
			'importFailure' => esc_html__('Import Process not working', 'redart')));
	}
}
add_action( 'admin_enqueue_scripts', 'redart_admin_scripts' );

/* ---------------------------------------------------------------------------
 * Loads the Options Panel
 * --------------------------------------------------------------------------- */
require_once( REDART_DIR .'/framework/utils.php' );
require_once( REDART_DIR .'/framework/fonts.php' );
require_once( REDART_DIR .'/framework/theme-options/init.php' );

/* ---------------------------------------------------------------------------
 * Loads Theme Functions
 * --------------------------------------------------------------------------- */

// Functions --------------------------------------------------------------------
require_once( REDART_DIR .'/functions/register-functions.php' );

// Header -----------------------------------------------------------------------
require_once( REDART_DIR .'/functions/register-head.php' );

// Menu -------------------------------------------------------------------------
require_once( REDART_DIR .'/functions/register-menu.php' );
require_once( REDART_DIR .'/functions/register-mega-menu.php' );

// Hooks ------------------------------------------------------------------------
require_once( REDART_DIR .'/functions/register-hooks.php' );

// Widgets ----------------------------------------------------------------------
add_action( 'widgets_init', 'redart_widgets_init' );
if( !function_exists('redart_widgets_init') ) {
	function redart_widgets_init() {
		require_once( REDART_DIR .'/functions/register-widgets.php' );
	}
}

// Plugins ---------------------------------------------------------------------- 
require_once( REDART_DIR .'/functions/register-plugins.php' );

// WooCommerce ------------------------------------------------------------------
if( function_exists( 'is_woocommerce' ) ){
	require_once( REDART_DIR .'/functions/register-woocommerce.php' ); }

// Global Layout ---------------------------------------------------------------
$page_layout = redart_option('pageoptions', 'global-layout');
$GLOBALS['page_layout'] = !empty($page_layout) ? $page_layout : 'content-full-width';
$GLOBALS['force_enable'] = redart_option('pageoptions', 'force-enable-global-layout'); 

// Register Gutenberg -----------------------------------------------------------
require_once( REDART_DIR .'/functions/register-gutenberg-editor.php' );  ?>