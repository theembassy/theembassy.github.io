<?php
/**
 * Custom functions that act independently of the theme templates.
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Seven_Sages
 */

/**
 * Add sidebars
 */
if (! function_exists('seven_sages_get_sidebar_layout') ) :

    /**
     * Get Sidebar Layout
     *
     * @param string $layout Sidebar layout.
     */
    function seven_sages_get_sidebar_layout( $layout ) 
    {

        switch ( $layout ) {

        case 'layout-sidebar-content' :
            get_sidebar('left');
            break;

        case 'layout-content-sidebar' :
            get_sidebar(); // Default is right sidebar.
            break;

        case 'layout-content-sidebar-sidebar' :
        case 'layout-sidebar-content-sidebar' :
        case 'layout-sidebar-sidebar-content' :
            get_sidebar('left');
            get_sidebar(); // Default is right sidebar.
            break;
        }
    }

endif;

/**
 * Get individual option
 */
if (! function_exists('seven_sages_get_option') ) :

    /**
     * Get Theme Option
     *
     * @param  string $key      Customizer setting ID.
     * @param  string $defaults Default value for customizer setting.
     * @return mixed           Return the customizer setting stored value.
     */
    function seven_sages_get_option( $key = '', $defaults = '' ) 
    {
        $options = apply_filters(
            'seven_sages_theme_defaults_after_parse_args', wp_parse_args(
                get_option('seven-sages', true),
                seven_sages_get_defaults()
            )
        );

        if (isset($options[ $key ]) ) {
               return $options[ $key ];
        } else {
              return $defaults;
        }
    }

endif;

/**
 * Add body classes
 */
if (! function_exists('seven_sages_body_class') ) :

    /**
     * Add body classes
     *
     * @param  array $classes List of classes.
     * @return array          List of classes.
     */
    function seven_sages_body_class( $classes ) 
    {

        if (is_home() || is_archive() || is_search() ) {
            $layout = seven_sages_get_option('sidebar-archive');
        } elseif (is_page() || is_404() ) {
            $layout = seven_sages_get_option('sidebar-page');
        } elseif (is_single() ) {
            $layout = seven_sages_get_option('sidebar-single');
        }

        switch ( $layout ) {

        case 'layout-sidebar-content' :         $classes[] = 'layout-sidebar-content';
            break;
        case 'layout-content-sidebar' :         $classes[] = 'layout-content-sidebar';
            break;
        case 'layout-content-sidebar-sidebar' :    $classes[] = 'layout-content-sidebar-sidebar';
            break;
        case 'layout-sidebar-content-sidebar' :    $classes[] = 'layout-sidebar-content-sidebar';
            break;
        case 'layout-sidebar-sidebar-content' : $classes[] = 'layout-sidebar-sidebar-content';
            break;
        case 'layout-no-sidebar' :
        default:
            $classes[] = 'layout-no-sidebar';
            break;
        }

        return $classes;
    }
    add_filter('body_class', 'seven_sages_body_class');

endif;

/**
 * Adds custom classes to the array of body classes.
 */
if (! function_exists('seven_sages_body_classes') ) :

    /**
     * Adds custom classes to the array of body classes.
     *
     * @param  array $classes Classes for the body element.
     * @return array
     */
    function seven_sages_body_classes( $classes ) 
    {

        // Adds a class of group-blog to blogs with more than 1 published author.
        if (is_multi_author() ) {
            $classes[] = 'group-blog';
        }

        // Adds a class of hfeed to non-singular pages.
        if (! is_singular() ) {
            $classes[] = 'hfeed';
        }

        return $classes;
    }
    add_filter('body_class', 'seven_sages_body_classes');

endif;

/**
 * Adds custom classes to the array of Header classes.
 */
if (! function_exists('seven_sages_header_class') ) :

    /**
     * Adds custom classes to the array of Header classes.
     *
     * @param  array $classes Classes for the Header element.
     * @return array
     */
    function seven_sages_header_class( ) 
    {

        $classes                 = array( 'site-header' );
        $header_layouts      = seven_sages_get_option( 'header-layouts' );
        
        $classes[] = 'ss-' . $header_layouts;

        $classes = array_unique( apply_filters( 'seven_sages_header_class', $classes ) );

        $classes = array_map( 'sanitize_html_class', $classes );

        echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"';
    }

endif;



/**
 * Adds custom classes to the array of Custom Header classes.
 */
if (! function_exists('seven_sages_custom_header_class') ) :

    /**
     * Adds custom classes to the array of Custom Header classes.
     *
     * @param  array $classes Classes for the Custom Header element.
     * @return array
     */
    function seven_sages_custom_header_class( ) 
    {

        $classes                 = array( 'ss-custom-headers' );
        $custom_header_width      = seven_sages_get_option( 'custom-header-width' );
        $classes[]                 =  $custom_header_width;

        $classes = array_unique( apply_filters( 'seven_sages_custom_header_class', $classes ) );

        $classes = array_map( 'sanitize_html_class', $classes );

        echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"';
    }

endif;



/**
 * Display Blog Post Excerpt
 */
if ( ! function_exists( 'seven_sages_the_excerpt' ) ) :

    /**
     * Display Blog Post Excerpt
     *
     * @since 1.0.0
     */
    function seven_sages_the_excerpt() {

        $excerpt_type = seven_sages_get_option( 'blog-post-content' );

        if ( 'full-content' == $excerpt_type ) {
            the_content( sprintf(
             wp_kses(
                 /* translators: %s: Name of current post. Only visible to screen readers */
                 __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'seven-sages' ),
                 array(
                     'span' => array(
                         'class' => array(),
                     ),
                 )
             ),
             get_the_title()
            ) );
        } else {
            the_excerpt();
        }
    }
endif;

/**
 * Display Blog Post Excerpt Read More link
 */
if ( ! function_exists( 'seven_sages_the_excerpt_read_more' ) ) :

    /**
     * Prints the read more HTML to post excerpts.
     *
     * @since 0.2
     *
     * @param string $more The string shown within the more link.
     * @return string The HTML for the more link.
     */
    function seven_sages_the_excerpt_read_more( $more ) {
        return apply_filters( 'seven_sages_excerpt_more_output', sprintf( ' ... <a title="%1$s" class="read-more" href="%2$s">%3$s%4$s</a>',
            the_title_attribute( 'echo=0' ),
            esc_url( get_permalink( get_the_ID() ) ),
            __( 'Read more', 'seven-sages' ),
            '<span class="screen-reader-text">' . get_the_title() . '</span>'
        ) );
    }
endif;

add_filter( 'excerpt_more', 'seven_sages_the_excerpt_read_more' );


