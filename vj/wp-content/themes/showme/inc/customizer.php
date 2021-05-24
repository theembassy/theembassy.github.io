<?php
/**
 * showme Theme Customizer
 *
 * @package showme
 */

function showme_customize_register( $wp_customize ) {

  class showme_customize_number_control extends WP_Customize_Control {
    public $type = 'showme_number_field';
    public function render_content() {
      ?>
      <label>
        <span class="customize-control-title">
          <?php echo esc_html($this->label); ?>
        </span>
        <input type="number" min="1" max="10000" value="<?php echo esc_attr($this->value()); ?>" <?php $this->link(); ?> />
      </label>
      <?php
    }
  }
  
  $wp_customize->add_panel(
    'theme_options',
    array(
      'title' => esc_html__('Theme Options', 'showme'),
      'description' => '',
    )
  );

  //----------------------------------------------------------------------------------
  // Section: Colors
  //----------------------------------------------------------------------------------
  $wp_customize->add_section(
    'colors_general',
    array(
      'title' => esc_html__('Colors', 'showme'),
      'panel' => 'theme_options',
      'priority' => 1,
    )
  );
  $wp_customize->add_setting(
    'theme_color',
    array(
      'default' => '#8cc152',
      'sanitize_callback' => 'sanitize_hex_color_no_hash',
      'sanitize_js_callback' => 'maybe_hash_hex_color',
    )
  );
  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'theme_color',
      array(
        'label' => esc_html__('Theme Color', 'showme'),
        'section' => 'colors_general',
      )
    )
  );
  
  //----------------------------------------------------------------------------------
  // Section: General Settings
  //----------------------------------------------------------------------------------
  $wp_customize->add_section(
    'general_settings_section',
    array(
      'title' => esc_html__('General Settings', 'showme'),
      'panel' => 'theme_options',
      'priority' => 2,
    )
  );
  $wp_customize->add_setting(
    'blog_pagination',
    array(
      'default' => 'pagination',
      'sanitize_callback' => 'showme_sanitize_blog_pagination',
    )
  );
  $wp_customize->add_control(
    'blog_pagination',
    array(
      'label' => esc_html__('Blog Pagination or Navigation', 'showme'),
      'section' => 'general_settings_section',
      'settings' => 'blog_pagination',
      'type' => 'radio',
      'choices' => array(
        'pagination' => esc_html__('Pagination', 'showme'),
        'navigation' => esc_html__('Navigation', 'showme'),
      ),
    )
  );
  $wp_customize->add_setting(
    'header_title',
    array(
      'default' => false,
      'sanitize_callback' => 'showme_sanitize_checkbox',
    )
  );
  $wp_customize->add_control(
    'header_title',
    array(
      'label' => esc_html__('Hide Header Title Text', 'showme'),
      'section' => 'general_settings_section',
      'settings' => 'header_title',
      'type' => 'checkbox',
    )
  );
  $wp_customize->add_setting(
    'blog_layout',
    array(
      'default' => 'right_sidebar',
      'sanitize_callback' => 'showme_sanitize_blog_layout',
    )
  );
  $wp_customize->add_control(
    'blog_layout',
    array(
      'type' => 'select',
      'label' => esc_html__('Blog Layout', 'showme'),
      'section' => 'general_settings_section',
      'choices' => array(
        'right_sidebar' => esc_html__('Right sidebar', 'showme'),
        'left_sidebar' => esc_html__('Left sidebar', 'showme'),
        'one_column' => esc_html__('One column', 'showme'),
      ),
    )
  );
  $wp_customize->add_setting(
    'blog_excerpt_type',
    array(
      'default' => 'excerpt',
      'sanitize_callback' => 'showme_sanitize_blog_excerpt_type',
    )
  );
  $wp_customize->add_control(
    'blog_excerpt_type',
    array(
      'type' => 'select',
      'label' => esc_html__('Use Excerpt or "Read More tag"', 'showme'),
      'section' => 'general_settings_section',
      'choices' => array(
        'excerpt' => esc_html__('Excerpt', 'showme'),
        'more-tag' => esc_html__('Read More tag', 'showme'),
      ),
    )
  );
  $wp_customize->add_setting(
    'blog_excerpt_length',
    array(
      'default' => 40,
      'sanitize_callback' => 'showme_sanitize_number_intval',
    )
  );
  $wp_customize->add_control(
    new showme_customize_number_control(
      $wp_customize,
      'blog_excerpt_length',
      array(
        'label' => esc_html__('Excerpt Length (Number of Words)', 'showme'),
        'section' => 'general_settings_section',
        'settings' => 'blog_excerpt_length',
      )
    )
  );
  $wp_customize->add_setting(
    'general_show_totop_btn',
    array(
      'default' => 1,
      'sanitize_callback' => 'showme_sanitize_checkbox',
    )
  );
  $wp_customize->add_control(
    'general_show_totop_btn',
    array(
      'type' => 'checkbox',
      'label' => esc_html__('Show "Back to top" button', 'showme'),
      'section' => 'general_settings_section',
    )
  );
  $wp_customize->add_setting(
    'blog_images_hover_effects',
    array(
      'default' => 0,
      'sanitize_callback' => 'showme_sanitize_checkbox',
    )
  );
  $wp_customize->add_control(
    'blog_images_hover_effects',
    array(
      'type' => 'checkbox',
      'label' => esc_html__('Enable hover effects when you hover on featured images', 'showme'),
      'section' => 'general_settings_section',
    )
  );
  $wp_customize->add_setting(
    'blog_show_date',
    array(
      'default' => 1,
      'sanitize_callback' => 'showme_sanitize_checkbox',
    )
  );
  $wp_customize->add_control(
    'blog_show_date',
    array(
      'type' => 'checkbox',
      'label' => esc_html__('Show date', 'showme'),
      'section' => 'general_settings_section',
    )
  );
  $wp_customize->add_setting(
    'blog_show_author',
    array(
      'default' => 1,
      'sanitize_callback' => 'showme_sanitize_checkbox',
    )
  );
  $wp_customize->add_control(
    'blog_show_author',
    array(
      'type' => 'checkbox',
      'label' => esc_html__('Show author', 'showme'),
      'section' => 'general_settings_section',
    )
  );
  $wp_customize->add_setting(
    'blog_show_categories',
    array(
      'default' => 1,
      'sanitize_callback' => 'showme_sanitize_checkbox',
    )
  );
  $wp_customize->add_control(
    'blog_show_categories',
    array(
      'type' => 'checkbox',
      'label' => esc_html__('Show categories', 'showme'),
      'section' => 'general_settings_section',
    )
  );
  $wp_customize->add_setting(
    'blog_show_tags',
    array(
      'default' => 1,
      'sanitize_callback' => 'showme_sanitize_checkbox',
    )
  );
  $wp_customize->add_control(
    'blog_show_tags',
    array(
      'type' => 'checkbox',
      'label' => esc_html__('Show tags', 'showme'),
      'section' => 'general_settings_section',
    )
  );
  $wp_customize->add_setting(
    'single_show_post_nav',
    array(
      'default' => 1,
      'sanitize_callback' => 'showme_sanitize_checkbox',
    )
  );
  $wp_customize->add_control(
    'single_show_post_nav',
    array(
      'type' => 'checkbox',
      'label' => esc_html__('Show post navigation (single post page)', 'showme'),
      'section' => 'general_settings_section',
    )
  );
  $wp_customize->add_setting(
    'single_show_about_author',
    array(
      'default' => 0,
      'sanitize_callback' => 'showme_sanitize_checkbox',
    )
  );
  $wp_customize->add_control(
    'single_show_about_author',
    array(
      'type' => 'checkbox',
      'label' => esc_html__('Show "About the author" block (single post page)', 'showme'),
      'section' => 'general_settings_section',
    )
  );

  //----------------------------------------------------------------------------------
  // Section: Social Media Icons 
  //----------------------------------------------------------------------------------
  $wp_customize->add_section(
    'showme_social',
    array(
      'title' => esc_html__('Social Links & RSS', 'showme'),
      'panel' => 'theme_options',
      'priority' => 3,
    )
  );
  $wp_customize->add_setting(
    'social_twitter',
    array(
      'default' => '',
      'sanitize_callback' => 'showme_sanitize_url',
    )
  );
  $wp_customize->add_control(
    'social_twitter',
    array(
      'label' => esc_html__('Twitter URL', 'showme'),
      'section' => 'showme_social',
      'settings' => 'social_twitter',
      'type' => 'text',
    )
  );
  $wp_customize->add_setting(
    'social_facebook',
    array(
      'default' => '',
      'sanitize_callback' => 'showme_sanitize_url',
    )
  );
  $wp_customize->add_control(
    'social_facebook',
    array(
      'label' => esc_html__('Facebook URL', 'showme'),
      'section' => 'showme_social',
      'settings' => 'social_facebook',
      'type' => 'text',
    )
  );
  $wp_customize->add_setting(
    'social_google-plus',
    array(
      'default' => '',
      'sanitize_callback' => 'showme_sanitize_url',
    )
  );
  $wp_customize->add_control(
    'social_google-plus',
    array(
      'label' => esc_html__('Google+ URL', 'showme'),
      'section' => 'showme_social',
      'settings' => 'social_google-plus',
      'type' => 'text',
    )
  );
  $wp_customize->add_setting(
    'social_pinterest',
    array(
      'default' => '',
      'sanitize_callback' => 'showme_sanitize_url',
    )
  );
  $wp_customize->add_control(
    'social_pinterest',
    array(
      'label' => esc_html__('Pinterest URL', 'showme'),
      'section' => 'showme_social',
      'settings' => 'social_pinterest',
      'type' => 'text',
    )
  );
  $wp_customize->add_setting(
    'social_vk',
    array(
      'default' => '',
      'sanitize_callback' => 'showme_sanitize_url',
    )
  );
  $wp_customize->add_control(
    'social_vk',
    array(
      'label' => esc_html__('VK URL', 'showme'),
      'section' => 'showme_social',
      'settings' => 'social_vk',
      'type' => 'text',
    )
  );
  $wp_customize->add_setting(
    'social_flickr',
    array(
      'default' => '',
      'sanitize_callback' => 'showme_sanitize_url',
    )
  );
  $wp_customize->add_control(
    'social_flickr',
    array(
      'label' => esc_html__('Flickr URL', 'showme'),
      'section' => 'showme_social',
      'settings' => 'social_flickr',
      'type' => 'text',
    )
  );
  $wp_customize->add_setting(
    'social_instagram',
    array(
      'default' => '',
      'sanitize_callback' => 'showme_sanitize_url',
    )
  );
  $wp_customize->add_control(
    'social_instagram',
    array(
      'label' => esc_html__('Instagram URL', 'showme'),
      'section' => 'showme_social',
      'settings' => 'social_instagram',
      'type' => 'text',
    )
  );
  $wp_customize->add_setting(
    'social_500px',
    array(
      'default' => '',
      'sanitize_callback' => 'showme_sanitize_url',
    )
  );
  $wp_customize->add_control(
    'social_500px',
    array(
      'label' => esc_html__('500px URL', 'showme'),
      'section' => 'showme_social',
      'settings' => 'social_500px',
      'type' => 'text',
    )
  );
  $wp_customize->add_setting(
    'social_youtube',
    array(
      'default' => '',
      'sanitize_callback' => 'showme_sanitize_url',
    )
  );
  $wp_customize->add_control(
    'social_youtube',
    array(
      'label' => esc_html__('YouTube URL', 'showme'),
      'section' => 'showme_social',
      'settings' => 'social_youtube',
      'type' => 'text',
    )
  );
  $wp_customize->add_setting(
    'social_vimeo',
    array(
      'default' => '',
      'sanitize_callback' => 'showme_sanitize_url',
    )
  );
  $wp_customize->add_control(
    'social_vimeo',
    array(
      'label' => esc_html__('Vimeo URL', 'showme'),
      'section' => 'showme_social',
      'settings' => 'social_vimeo',
      'type' => 'text',
    )
  );
  $wp_customize->add_setting(
    'social_soundcloud',
    array(
      'default' => '',
      'sanitize_callback' => 'showme_sanitize_url',
    )
  );
  $wp_customize->add_control(
    'social_soundcloud',
    array(
      'label' => esc_html__('SoundCloud URL', 'showme'),
      'section' => 'showme_social',
      'settings' => 'social_soundcloud',
      'type' => 'text',
    )
  );
  $wp_customize->add_setting(
    'social_dribbble',
    array(
      'default' => '',
      'sanitize_callback' => 'showme_sanitize_url',
    )
  );
  $wp_customize->add_control(
    'social_dribbble',
    array(
      'label' => esc_html__('Dribbble URL', 'showme'),
      'section' => 'showme_social',
      'settings' => 'social_dribbble',
      'type' => 'text',
    )
  );
  $wp_customize->add_setting(
    'social_behance',
    array(
      'default' => '',
      'sanitize_callback' => 'showme_sanitize_url',
    )
  );
  $wp_customize->add_control(
    'social_behance',
    array(
      'label' => esc_html__('Behance URL', 'showme'),
      'section' => 'showme_social',
      'settings' => 'social_behance',
      'type' => 'text',
    )
  );
  $wp_customize->add_setting(
    'social_github',
    array(
      'default' => '',
      'sanitize_callback' => 'showme_sanitize_url',
    )
  );
  $wp_customize->add_control(
    'social_github',
    array(
      'label' => esc_html__('GitHub URL', 'showme'),
      'section' => 'showme_social',
      'settings' => 'social_github',
      'type' => 'text',
    )
  );
  $wp_customize->add_setting(
    'social_rss',
    array(
      'default' => '',
      'sanitize_callback' => 'showme_sanitize_url',
    )
  );
  $wp_customize->add_control(
    'social_rss',
    array(
      'label' => esc_html__('RSS URL', 'showme'),
      'section' => 'showme_social',
      'settings' => 'social_rss',
      'type' => 'text',
    )
  );

  //----------------------------------------------------------------------------------
  // Section: Footer
  //----------------------------------------------------------------------------------
  $wp_customize->add_section(
    'showme_footer',
    array(
      'title' => esc_html__('Footer', 'showme'),
      'panel' => 'theme_options',
      'priority' => 4,
    )
  );
  $wp_customize->add_setting(
    'footer_show_social',
    array(
      'default' => 0,
      'sanitize_callback' => 'showme_sanitize_checkbox',
    )
  );
  $wp_customize->add_control(
    'footer_show_social',
    array(
      'type' => 'checkbox',
      'label' => esc_html__('Show "Social Links & RSS" block', 'showme'),
      'section' => 'showme_footer',
    )
  );
  $wp_customize->add_setting(
    'footer_show_menu',
    array(
      'default' => 0,
      'sanitize_callback' => 'showme_sanitize_checkbox',
    )
  );
  $wp_customize->add_control(
    'footer_show_menu',
    array(
      'type' => 'checkbox',
      'label' => esc_html__('Show "Footer menu" block', 'showme'),
      'section' => 'showme_footer',
    )
  );
}
add_action('customize_register', 'showme_customize_register');
