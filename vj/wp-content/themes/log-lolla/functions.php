<?php
  /**
   * Log Lolla functions and definitions
   *
   * Based on Underscore starter theme
   *
   * @link https://developer.wordpress.org/themes/basics/theme-functions/
   *
   * @package Log_Lolla
   */

if ( ! function_exists( 'log_lolla_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function log_lolla_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Log Lolla, use a find and replace
		 * to change 'log-lolla' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'log-lolla', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'log-lolla' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'log_lolla_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		/*
     * Enable support for Post Formats.
     *
     * See: https://codex.wordpress.org/Post_Formats
     */
    add_theme_support( 'post-formats', array(
			'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
    ) );


    /*
  	 * This theme styles the visual editor to resemble the theme style,
  	 * specifically font, colors, and column width.
   	 */
  	add_editor_style();
	}
endif;
add_action( 'after_setup_theme', 'log_lolla_setup' );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function log_lolla_widgets_init() {
  register_sidebar( array(
    'name'          => esc_html__( 'Header Menu', 'log-lolla' ),
    'id'            => 'sidebar-2',
    'description'   => esc_html__( 'Add widgets here.', 'log-lolla' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ) );

  register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'log-lolla' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'log-lolla' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'log_lolla_widgets_init' );



/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function log_lolla_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'log_lolla_content_width', 640 );
}
add_action( 'after_setup_theme', 'log_lolla_content_width', 0 );


/**
 * Enqueue scripts and styles.
 */
function log_lolla_scripts() {
  $timestamp = filemtime( get_template_directory() . '/style.css' );
	wp_enqueue_style( 'log-lolla-style', get_stylesheet_uri(), array(), $timestamp );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

  $timestamp = filemtime( get_template_directory() . '/assets/js/log-lolla.js' );
	wp_enqueue_script( 'log-lolla', get_theme_file_uri( '/assets/js/log-lolla.js' ), array(), $timestamp );
}
add_action( 'wp_enqueue_scripts', 'log_lolla_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';


/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

?>
