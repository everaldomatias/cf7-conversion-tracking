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

		/**
		 * Plugin version.
		 *
		 * @var string
		 */
		const VERSION = '0.1';
		
		function __construct() {
			// Load plugin text domain.
			add_action( 'init', array( $this, 'load_plugin_textdomain' ) );
			
			// Verify CF7 dependencies.
			if ( defined( 'WPCF7_VERSION' ) &&  version_compare( WPCF7_VERSION, '4.5', '>=' ) ) {
				if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
					$this->admin_includes();
				}
				$this->includes();
			} else {
				add_action( 'admin_notices', array( $this, 'cf7_is_missing_notice' ) );
			}
		}

		/**
		 * Instance of this class.
		 *
		 * @var object
		 */
		protected static $instance = null;

		/**
		 * Return an instance of this class.
		 *
		 * @return object A single instance of this class.
		 */
		public static function get_instance() {
			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Includes.
		 */
		protected function includes() {
			include_once( 'includes/class-cf7-conversion-tracking-print-tags.php' );
		}
		/**
		 * Admin includes.
		 */
		protected function admin_includes() {
			include_once( 'includes/class-cf7-conversion-tracking-admin.php' );
		}

		/**
		 * Fired for each blog when the plugin is activated.
		 */
		public static function activate() {
			add_option( 'cf7_conversion_tracking', array() );
			add_option( 'cf7_conversion_tracking_version', self::VERSION );
		}

		/**
		 * Load the plugin text domain for translation.
		 */
		public function load_plugin_textdomain() {
			load_plugin_textdomain( 'cf7-conversion-tracking', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		}

		/**
		 * Contact Form 7 missing notice.
		 *
		 * @return string Admin notice.
		 */
		public function cf7_is_missing_notice() {
			echo '<div class="error"><p><strong>' . __( 'Contact Form 7 Conversion Tracking', 'cf7-conversion-tracking' ) . '</strong> ' . sprintf( __( 'works only with %s, in version 4.5 or later, please install or upgrade your installation!', 'cf7-conversion-tracking' ), '<a href="https://wordpress.org/plugins/contact-form-7/">' . __( 'Contact Form 7', 'cf7-conversion-tracking' ) . '</a>' ) . '</p></div>';
		}
	}

/**
 * Install plugin default options.
 */
register_activation_hook( __FILE__, array( 'CF7_Conversion_Tracking', 'activate' ) );

/**
 * Initialize the plugin actions.
 */
add_action( 'plugins_loaded', array( 'CF7_Conversion_Tracking', 'get_instance' ) );

endif;