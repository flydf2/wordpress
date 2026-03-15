<?php //phpcs:ignore
/**
 * Theme functions and definitions.
 *
 * @package Blogmate
 * @author  Peregrine Themes
 * @since   1.0.0
 */

/**
 * Main Blogmate class.
 *
 * @since 1.0.0
 */
final class Blogmate {

	/**
	 * Singleton instance of the class.
	 *
	 * @since 1.0.0
	 * @var object
	 */
	private static $instance;

	public static function instance() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Blogmate ) ) {
			self::$instance = new Blogmate();
			self::$instance->includes();
			// Hook now that all of the Blogmate stuff is loaded.
			do_action( 'blogmate_loaded' );
		}
		return self::$instance;
	}

	/**
	 * Primary class constructor.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'blogmate_styles' ) );
		add_action( 'after_setup_theme', array( $this, 'blogmate_markdown_support' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'blogmate_enqueue_markdown_scripts' ) );
		add_action( 'bloglo_after_article', array( $this, 'blogmate_after_article_markdown' ) );
	}

	/**
	 * Include files.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function includes() {
		require get_stylesheet_directory() . '/inc/customizer/default.php';
		require get_stylesheet_directory() . '/inc/customizer/customizer.php';
	}

	/**
	 * Recommended way to include parent theme styles.
	 * (Please see http://codex.wordpress.org/Child_Themes#How_to_Create_a_Child_Theme)
	 */
	function blogmate_styles() {
		wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
		wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'parent-style' ) );
	}

	/**
	 * Markdown support detection and setup.
	 *
	 * @since 1.0.0
	 */
	function blogmate_markdown_support() {
		// Check if Jetpack Markdown module is active
		if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'markdown' ) ) {
			// Jetpack Markdown is active
			add_filter( 'the_content', 'wpautop' );
		}

		// Add support for Gutenberg Markdown block
		add_theme_support( 'wp-block-styles' );

		// Add support for responsive embedded content
		add_theme_support( 'responsive-embeds' );
	}

	/**
	 * Enqueue Markdown scripts.
	 *
	 * @since 1.0.0
	 */
	function blogmate_enqueue_markdown_scripts() {
		// Enqueue markdown-it library
		wp_enqueue_script( 'markdown-it', get_stylesheet_directory_uri() . '/js/markdown-it.min.js', array(), '14.1.0', true );

		// Enqueue mermaid library
		wp_enqueue_script( 'mermaid', 'https://cdn.jsdelivr.net/npm/mermaid@11.10.0/dist/mermaid.min.js', array(), '11.10.0', true );
	}

	/**
	 * Handle Markdown processing after article.
	 *
	 * @since 1.0.0
	 */
	function blogmate_after_article_markdown() {
		// Enqueue custom markdown script
		wp_enqueue_script( 'blogmate-markdown', get_stylesheet_directory_uri() . '/js/blogmate-markdown.js', array( 'jquery', 'markdown-it' ), '1.0.0', true );

		// Enqueue custom mermaid script
		wp_enqueue_script( 'blogmate-mermaid', get_stylesheet_directory_uri() . '/js/blogmate-mermaid.js', array( 'jquery', 'mermaid' ), '1.0.0', true );
	}
}

/**
 * The function which returns the one Blogmate instance.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * Example: <?php $blogmate = blogmate(); ?>
 *
 * @since 1.0.0
 * @return object
 */
function blogmate() {
	return Blogmate::instance();
}

blogmate();
