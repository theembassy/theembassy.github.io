<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package showme
 */

if (!function_exists('showme_entry_content')) {
  function showme_entry_content() {
    $excerpt_type = get_theme_mod('blog_excerpt_type', 'excerpt');
    if ($excerpt_type == 'excerpt') {
      ?>

      <!-- excerpt -->
      <div class="entry-content clearfix">
        <?php the_excerpt(); ?>
      </div>
      <!-- end excerpt -->

      <?php
    } else {
      ?>

      <!-- excerpt (post content) -->
      <div class="entry-content clearfix">
        <?php
        the_content( sprintf(
          wp_kses(
            __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'showme' ),
            array(
              'span' => array(
                'class' => array(),
              ),
            )
          ),
          get_the_title()
        ) );
        ?>
      </div>
      <!-- end excerpt (post content) -->

      <?php
    }
  }
}

if (!function_exists('showme_page_header')) {
  function showme_page_header(){
    // author page
    if (is_author()) {
?>
      <header class="page-header">
        <h1 class="page-title"><?php the_archive_title();?></h1>
        <?php if (get_the_author_meta('description')) { ?>
        <div class="archive-description"><?php the_author_meta('description'); ?></div>
        <?php }?>
      </header><!-- .page-header -->
<?php
    // category/tag page
    } else if (is_category() || is_tag()) {
?>
      <header class="page-header">
        <h1 class="page-title"><?php the_archive_title();?></h1>
        <?php if (get_the_archive_description()) { ?>
        <div class="archive-description"><?php the_archive_description();?></div>
        <?php }?>
      </header><!-- .page-header -->
<?php
    // search results page
    } else if (is_search()) { 
?>
      <header class="page-header">
        <h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'showme' ), '<span>' . get_search_query() . '</span>' );?></h1>
      </header><!-- .page-header -->
<?php
    // archive page
    } else if (is_archive()) {
?>
      <header class="page-header">
        <h1 class="page-title"><?php the_archive_title();?></h1>
      </header><!-- .page-header -->
<?php
    }
  }
}

if (!function_exists('showme_excerpt_length')) {
  function showme_excerpt_length($length) {
    $excerpt_length = get_theme_mod('blog_excerpt_length', 40);
    if ($excerpt_length) {
      $excerpt_length = intval($excerpt_length);
    } else {
      $excerpt_length = 40;
    }
    return $excerpt_length;
  }
}
add_filter('excerpt_length', 'showme_excerpt_length');

if (!function_exists('showme_editor_style')) {
  function showme_editor_style() {

    // add stylesheets
    add_editor_style(array(
      'assets/css/editor-style.css',
      'assets/font-awesome/css/font-awesome.min.css'
    ));

  }
}
add_action('init', 'showme_editor_style');
