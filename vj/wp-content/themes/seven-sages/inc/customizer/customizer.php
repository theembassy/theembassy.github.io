<?php
/**
 * Seven Sages Theme Customizer
 *
 * @package Seven_Sages
 */
/**
 * Set default options
 */
if (! function_exists('seven_sages_get_defaults') ) :

    /**
     * Set default options
     */
    function seven_sages_get_defaults() 
    {

        $seven_sages_defaults = array(

         /**
         * Container
         */
         'container-width-site'    => 1180,

         /**
         * Headers
         */
         'header-layouts' => 'header-layout-1',

         /**
         * Custom Header Image Width
         */
         'custom-header-width'    => 'full-width',

         /**
         * Blogs
         */
         'blog-post-content'     => 'excerpt',

         /**
         * Sidebar
         */
         'sidebar-page'    => 'layout-content-sidebar',
         'sidebar-single'  => 'layout-no-sidebar',
         'sidebar-archive' => 'layout-content-sidebar',

        );

        return apply_filters('seven_sages_theme_defaults', $seven_sages_defaults);
    }

endif;

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function seven_sages_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
  $wp_customize->get_control('header_textcolor')->label     = __('Site Title & Tagline Color', 'seven-sages');
  $wp_customize->get_control('background_color')->label     = __('Body Background Color', 'seven-sages');



	/**
     * Get default's
     */
    $defaults = seven_sages_get_defaults();


    /**
     * Load customizer helper files
     */
    include_once SEVEN_SAGES_DIR . '/inc/customizer/customizer-sanitize.php';
    include_once SEVEN_SAGES_DIR . '/inc/customizer/customizer-controls.php';
    
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'seven_sages_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'seven_sages_customize_partial_blogdescription',
		) );
	}


    /**
      * Added custom customizer controls
      */
      if (method_exists($wp_customize, 'register_control_type') ) {
          $wp_customize->register_control_type('Seven_Sages_Customize_Width_Slider_Control');
          $wp_customize->register_control_type('Seven_Sages_Customize_Radio_Image');
      }

        /**
         * Register Panel & Sections
         */
        if (class_exists('WP_Customize_Panel') ) :
            if (! $wp_customize->get_panel('seven_sages_panel_layout') ) {
                $wp_customize->add_panel(
                    'seven_sages_panel_layout', array(
                    'capability' => 'edit_theme_options',
                    'title'      => _x('Layout', 'Website Layout', 'seven-sages'),
                    'priority'   => 40,
                    )
                );
            }
        endif;

        // Container Section.
        $wp_customize->add_section(
            'seven_sages_section_container', array(
            'title'      => _x('Container', 'Website Container', 'seven-sages'),
            'capability' => 'edit_theme_options',
            'panel'      => 'seven_sages_panel_layout',
            )
        );

        // Header Section.
         $wp_customize->add_section(
            'seven_sages_headers', array(
            'title'      => __('Headers', 'seven-sages'),
            'capability' => 'edit_theme_options',
            'panel'      => 'seven_sages_panel_layout',
           )
        );
         // Blog Section.
         $wp_customize->add_section(
            'seven_sages_blogs', array(
            'title'      => __('Blogs', 'seven-sages'),
            'capability' => 'edit_theme_options',
            'panel'      => 'seven_sages_panel_layout',
            )
        );
         // SideBar Section.
        $wp_customize->add_section(
            'seven_sages_sidebars', array(
            'title'      => __('Sidebars', 'seven-sages'),
            'capability' => 'edit_theme_options',
            'panel'      => 'seven_sages_panel_layout',
            )
        );

        /**
         * Register options
         */

        /**
         * Container Width - Site
         */
        $wp_customize->add_setting(
            'seven-sages[container-width-site]', array(
            'default'           => $defaults['container-width-site'],
            'type'              => 'option',
            'sanitize_callback' => array( 'Seven_Sages_Customize_Sanitize', '_sanitize_integer' ),
            'transport'         => 'postMessage',
            )
        );
        $wp_customize->add_control(
            new Seven_Sages_Customize_Width_Slider_Control(
                $wp_customize, 'seven-sages[container-width-site]', array(
                'label'           => __('Site', 'seven-sages'),
                'tooltip'         => __('Container width is applied for the entire site.', 'seven-sages'),
                'section'         => 'seven_sages_section_container',
                'priority'        => 0,
                'type'            => 'seven-sages-range-slider',
                'default'         => $defaults['container-width-site'],
                'unit'            => 'px',
                'min'             => 700,
                'max'             => 2000,
                'step'            => 5,
                'settings'        => 'seven-sages[container-width-site]',
                )
            )
        );

        /**
         * Cheader Image Width
         */
        $wp_customize->add_setting(
            'seven-sages[custom-header-width]', array(
            'default'           => $defaults['custom-header-width'],
            'type'              => 'option',
            'sanitize_callback' => array( 'Seven_Sages_Customize_Sanitize', '_sanitize_choices' ),
            )
        );
        $wp_customize->add_control(
            'seven-sages[custom-header-width]', array(
            'type'            => 'select',
            'label'           => __('Header Image Width', 'seven-sages'),
            'section'         => 'header_image',
            'priority'        => 0,
            'choices'         => array(
              'full-width'              => __( 'Full Width', 'seven-sages'),
              'default-width'         => __( 'Container Width', 'seven-sages'),
              ),
            )
        );


        /**
         * Blog Post Content
         */
        $wp_customize->add_setting(
          'seven-sages[blog-post-content]', array(
            'default'           => $defaults['blog-post-content'],
            'type'              => 'option',
            'sanitize_callback' => array( 'Seven_Sages_Customize_Sanitize', '_sanitize_choices' ),
          )
        );
        $wp_customize->add_control(
          'seven-sages[blog-post-content]', array(
            'section'  => 'seven_sages_blogs',
            'label'    => __( 'Blog Post Content', 'seven-sages' ),
            'type'     => 'select',
            'priority' => 5,
            'choices'  => array(
              'full-content' => __( 'Full Content', 'seven-sages' ),
              'excerpt'      => __( 'Excerpt', 'seven-sages' ),
            ),
          )
        );


        /**
         * Sidebar - Archive
         */
        $wp_customize->add_setting(
            'seven-sages[sidebar-archive]', array(
            'default'           => $defaults['sidebar-archive'],
            'type'              => 'option',
            'sanitize_callback' => array( 'Seven_Sages_Customize_Sanitize', '_sanitize_choices' ),
            )
        );
        $wp_customize->add_control(
            'seven-sages[sidebar-archive]', array(
            'type'            => 'select',
            'label'           => __('Archive', 'seven-sages'),
            'description'     => __('Add sidebar layout for blog, archive, category tag pages.', 'seven-sages'),
            'section'         => 'seven_sages_sidebars',
            'choices'         => array(
            'layout-no-sidebar'              => __('Full Width ( No Sidebar )', 'seven-sages'),
            'layout-sidebar-content'         => __('Left Sidebar / Content', 'seven-sages'),
            'layout-content-sidebar'         => __('Content / Right Sidebar', 'seven-sages'),
            'layout-content-sidebar-sidebar' => __('Content / Left Sidebar / Right Sidebar', 'seven-sages'),
            'layout-sidebar-content-sidebar' => __('Left Sidebar / Content / Right Sidebar', 'seven-sages'),
            'layout-sidebar-sidebar-content' => __('Left Sidebar / Right Sidebar / Content', 'seven-sages'),
            ),
            )
        );

        /**
         * Sidebar - Single Post
         */
        $wp_customize->add_setting(
            'seven-sages[sidebar-single]', array(
            'default'           => $defaults['sidebar-single'],
            'type'              => 'option',
            'sanitize_callback' => array( 'Seven_Sages_Customize_Sanitize', '_sanitize_choices' ),
            )
        );
        $wp_customize->add_control(
            'seven-sages[sidebar-single]', array(
            'type'            => 'select',
            'label'           => __('Single Post', 'seven-sages'),
            'description'     => __('Add sidebar layout for single post only.', 'seven-sages'),
            'section'         => 'seven_sages_sidebars',
            'choices'         => array(
            'layout-no-sidebar'              => __('Full Width ( No Sidebar )', 'seven-sages'),
            'layout-sidebar-content'         => __('Left Sidebar / Content', 'seven-sages'),
            'layout-content-sidebar'         => __('Content / Right Sidebar', 'seven-sages'),
            'layout-content-sidebar-sidebar' => __('Content / Left Sidebar / Right Sidebar', 'seven-sages'),
            'layout-sidebar-content-sidebar' => __('Left Sidebar / Content / Right Sidebar', 'seven-sages'),
            'layout-sidebar-sidebar-content' => __('Left Sidebar / Right Sidebar / Content', 'seven-sages'),
            ),
            )
        );

        /**
         * Sidebar - Page
         */
        $wp_customize->add_setting(
            'seven-sages[sidebar-page]', array(
            'default'           => $defaults['sidebar-page'],
            'type'              => 'option',
            'sanitize_callback' => array( 'Seven_Sages_Customize_Sanitize', '_sanitize_choices' ),
            )
        );
        $wp_customize->add_control(
            'seven-sages[sidebar-page]', array(
            'type'            => 'select',
            'label'           => __('Page', 'seven-sages'),
            'description'     => __('Add sidebar layout for pages only.', 'seven-sages'),
            'section'         => 'seven_sages_sidebars',
            'choices'         => array(
            'layout-no-sidebar'              => __('Full Width ( No Sidebar )', 'seven-sages'),
            'layout-sidebar-content'         => __('Left Sidebar / Content', 'seven-sages'),
            'layout-content-sidebar'         => __('Content / Right Sidebar', 'seven-sages'),
            'layout-content-sidebar-sidebar' => __('Content / Left Sidebar / Right Sidebar', 'seven-sages'),
            'layout-sidebar-content-sidebar' => __('Left Sidebar / Content / Right Sidebar', 'seven-sages'),
            'layout-sidebar-sidebar-content' => __('Left Sidebar / Right Sidebar / Content', 'seven-sages'),
            ),
            )
        );

        /**
         * Headers
         */
        $wp_customize->add_setting(
            'seven-sages[header-layouts]', array(
            'default'           => $defaults['header-layouts'],
            'type'              => 'option',
            'sanitize_callback' => array( 'Seven_Sages_Customize_Sanitize', '_sanitize_choices' ),
            )
        );

        $wp_customize->add_control(
          new Seven_Sages_Customize_Radio_Image(
            $wp_customize, 'seven-sages[header-layouts]', array(
              'type'    => 'seven-sages-radio-image',
              'label'   => __( 'Headers', 'seven-sages' ),
              'section' => 'seven_sages_headers',
              'choices' => array(
                'header-layout-1' => array(
                  'label' => __( 'Layout 1', 'seven-sages' ),
                  'path'  => SEVEN_SAGES_URI . '/inc/assets/img/layout-design-1.png',
                ),
                'header-layout-2' => array(
                  'label' => __( 'Layout 2', 'seven-sages' ),
                  'path'  => SEVEN_SAGES_URI . '/inc/assets/img/layout-design-2.png',
                ),
              ),
            )
          )
        );
}
add_action( 'customize_register', 'seven_sages_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function seven_sages_customize_preview_js() {
	wp_enqueue_script( 'seven-sages-customizer', SEVEN_SAGES_URI . '/inc/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'seven_sages_customize_preview_js' );



/**
 * Add CSS for our controls
 */
if (! function_exists('seven_sages_customizer_controls_css') ) :

    /**
     * Add CSS for our controls
     *
     * @since 1.0.0
     */
    function seven_sages_customizer_controls_css() 
    {
        wp_enqueue_style('seven_sages-customizer-controls-css', SEVEN_SAGES_URI . '/inc/assets/css/customizer-control-slider.css' );
    }
    add_action('customize_controls_enqueue_scripts', 'seven_sages_customizer_controls_css');

endif;



/**
 * Generate Dynamic CSS
 */
if (! function_exists('seven_sages_dynamic_css') ) :

    /**
     * Generate Dynamic CSS from customizer option's
     */
    function seven_sages_dynamic_css() 
    {

        $space = ' ';

        // Generate CSS.
        $parse_css = array(

         '.site-content,
         .ss-custom-headers.default-width,
         .site-header .ss-header-container,
         .site-footer .ss-container' => array(
        'max-width' => seven_sages_get_option('container-width-site') . 'px',
         ),

        );

        // Output the above CSS.
        $output = '';

        foreach ( $parse_css as $selector => $properties ) {

            if (! count($properties) ) {
                continue;
            }

                  $temporary_output = $selector . ' {';
                  $elements_added   = 0;

            foreach ( $properties as $property => $css_value ) {
                if (empty($css_value) ) {
                    continue;
                }

                  $elements_added++;
                  $temporary_output .= $property . ': ' . $css_value . '; ';
            }

                  $temporary_output .= '}';

            if (0 < $elements_added ) {
                  $output .= $temporary_output;
            }
        }

        $output = str_replace(array( "\r", "\n", "\t" ), '', $output);

        wp_add_inline_style('seven-sages-style', esc_html($output));
    }
    add_action('wp_enqueue_scripts', 'seven_sages_dynamic_css');

endif;
