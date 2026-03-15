<?php
/**
 * Blogmate Admin class. Blogmate related pages in WP Dashboard.
 *
 * @package Blogmate
 * @author  Peregrine Themes <peregrinethemes@gmail.com>
 * @since   1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Blogmate Admin Class.
 *
 * @since 1.0.0
 * @package Blogmate
 */
final class Blogmate_Customizer {

	/**
	 * Singleton instance of the class.
	 *
	 * @since 1.0.0
	 * @var object
	 */
	private static $instance;

	/**
	 * Main Blogmate Admin Instance.
	 *
	 * @since 1.0.0
	 * @return Blogmate_Customizer
	 */
	public static function instance() {

		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Blogmate_Customizer ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Constructor.
	 *
	 * @since  1.0.0
	 */
	public function __construct() {

		// Init Blogmate admin.
		add_action( 'init', array( $this, 'includes' ) );

		// Blogmate Admin loaded.
		do_action( 'Blogmate_Customizer_loaded' );
	}

	/**
	 * Include files.
	 *
	 * @since 1.0.0
	 */
	public function includes() {

		require_once get_stylesheet_directory() . '/inc/customizer/settings/index.php';
		require_once get_stylesheet_directory() . '/inc/customizer/default.php';
	}

}

/**
 * The function which returns the one Blogmate_Customizer instance.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * Example: <?php $Blogmate_Customizer = Blogmate_Customizer(); ?>
 *
 * @since 1.0.0
 * @return object
 */
function Blogmate_Customizer() {
	return Blogmate_Customizer::instance();
}

Blogmate_Customizer();
