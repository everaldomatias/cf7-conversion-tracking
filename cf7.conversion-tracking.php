<?php
/**
 * Plugin Name: Contact Form 7 Conversion Tracking
 * Plugin URI: https://github.com/everaldomatias/cf7-conversion-tracking
 * Description: Adds tracking conversion by Google in Contact Form 7.
 * Author: Everaldo Matias
 * Author URI: https://everaldomatias.github.io/
 * Version: 0.1
 * License: GPLv2 or later
 * Text Domain: cf7-conversion-tracking
 * Domain Path: /languages/
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'CF7_Conversion_Tracking' ) ) :
	
	/**
	* Contact Form 7 Conversion Tracking plugin.
	*/
	class CF7_Conversion_Tracking {
		
		function __construct() {
			// Load plugin text domain.
			add_action( 'init', array( $this, 'load_plugin_textdomain' ) );
			# code...
		}
	}

endif;