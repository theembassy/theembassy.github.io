 <?php
 /**
  * Simplelin functions and definitions.
  *
  * @link https://developer.wordpress.org/themes/basics/theme-functions/
  *
  * @package Simplelin
  */

if ( ! function_exists( 'simplelin_setup' ) ) :
 /**
  * Sets up theme defaults and registers support for various WordPress features.
  * Note that this function is hooked into the after_setup_theme hook, which
  * runs before the init hook. The init hook is too late for some features, such
  * as indicating support for post thumbnails.
  */
function simplelin_setup() {
  /*
   * Make theme available for translation.
   * Translation can be filed in the /languages/directory.
   */
  load_theme_textdomain( 'simplelin', get_template_directory() . '/languages' );

  // Add default posts and comments RSS feed links to head.
  add_theme_support( 'automatic-feed-links' );

  /*
   * Let WordPress manage the document title.
   * By adding theme support, we declare that this theme does not use a
   * hard-coded <title> tag in the document head, and expect WordPress to
   * provide it for us.
   */
  add_theme_support( 'title-tag' );

  // Add theme support for Custom Logo.
  add_theme_support( 'custom-logo', array(
    'width'       => 240,
    'height'      => 240,
    'flex-height' => true,
  ) );

  /*
   * Enable support for Post Thumbnails on posts and pages.
   *
   * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
   */
  add_theme_support( 'post-thumbnails' );

  add_image_size( 'simplelin-featured', 750, 420, true );
  add_image_size( 'simplelin-featured-fullwidth', 1140, 624, true);
  add_image_size( 'simplelin-tab-small', 100, 100, true ); // Small Thumbnail

  // This theme uses wp_nav_menu() in two locations.
  register_nav_menus( array(
    'primary' => __( 'Primary Menu', 'simplelin' ),
  ) );

  /*
   * Switch default core markup for search form, comment form, and comments
   * to output valid HTML5
   */
  add_theme_support( 'html5', array(
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
  ) );

  add_theme_support( 'custom-background', apply_filters( 'simplelin_custom_background_args', array(
    'default-color' => 'f4f5f6',
    'default-image' => '',
  ) ) );

  // Add theme support for selective refresh for widgets.
  add_theme_support( 'customize-selective-refresh-widgets' );

  /*
   * Enable support for Post Formats.
   *
   * See: https://codex.wordpress.org/Post_Formats
   */
  add_theme_support( 'post-formats', array(
    'aside',
    'image',
    'video',
    'quote',
    'link',
    'gallery',
    'audio',
  ) );
}
endif;
add_action( 'after_setup_theme', 'simplelin_setup' );



/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function simplelin_content_width() {
  $GLOBALS['content_width'] = apply_filters( 'simplelin_content_width', 720);
}
add_action( 'after_setup_theme', 'simplelin_content_width' );




if ( ! function_exists( 'simplelin_widgets_init') ) :
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.or/themes/functionality/sidebars/#registering-a-sidebar
 */
function simplelin_widgets_init() {
  register_sidebar( array(
    'name'          => esc_html__( 'Sidebar', 'simplelin'),
    'id'            => 'sidebar-1',
    'description'   => esc_html__( 'Add widgets here.', 'simplelin' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ) );

  // Header Ad Sidebar
  register_sidebar( array(
    'name'          => __( 'Header Advertisement Area', 'simplelin' ),
    'id'            => 'sidebar-header',
    'description'   => esc_html__( 'You can add advertisement widget to this widget area.', 'simplelin' ),
    'before_widget' => '<aside id="%1$s" class="widget-header %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h4 class="widget-title">',
    'after_title'   => '</h4>',
  ) );
}
endif;
add_action( 'widgets_init', 'simplelin_widgets_init' );



/**
 * Enqueue scripts and styles.
 */
function simplelin_scripts() {

  // Theme stylesheet.
  wp_enqueue_style( 'simplelin-style', get_stylesheet_uri() );

  // Load Font Awesome v4.7.0.
  wp_enqueue_style( 'fontawesome-style', get_template_directory_uri() . '/font-awesome/css/font-awesome.min.css' );

  // Load navigation.js.
  wp_enqueue_script( 'simplelin-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20120206', true );

  // Load skip-link-focus-fix.js
  wp_enqueue_script( 'aeroblog-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array( 'jquery' ), '20120206', true );

  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
 }
}
add_action( 'wp_enqueue_scripts', 'simplelin_scripts' );



/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

 /**
  * Custom template tags for this theme.
  */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Include Theme Customizer Options.
 */
require get_template_directory() . '/inc/customizer.php';