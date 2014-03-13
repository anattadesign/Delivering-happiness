<?php
/**
 * Delivering Happiness functions and definitions
 *
 * @package Delivering Happiness
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'delivering_happiness_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function delivering_happiness_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Delivering Happiness, use a find and replace
	 * to change 'delivering-happiness' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'delivering-happiness', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'delivering-happiness' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form', ) );
}
endif; // delivering_happiness_setup
add_action( 'after_setup_theme', 'delivering_happiness_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function delivering_happiness_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'delivering-happiness' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'delivering_happiness_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function delivering_happiness_scripts() {

	wp_enqueue_style( 'delivering-happiness-style', get_template_directory_uri() . '/assets/css/app.css', array(), filemtime( get_template_directory() . '/assets/css/app.css' ) );
	wp_enqueue_script( 'delivering-happiness-navigation', get_template_directory_uri() . '/js/main.js', array(jquery), '20120206', true );
	wp_enqueue_script( 'cycle-plugin', get_template_directory_uri() . '/js/libraries/jquery.cycle2.js', array(jquery), '20120206', true );
	


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'delivering_happiness_scripts' );

/**
 * Storify Class
 */
require get_template_directory() . '/inc/storify.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
