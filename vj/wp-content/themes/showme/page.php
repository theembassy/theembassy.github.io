<?php
/**
 * The template for displaying all pages
 *
 * @package showme
 */

get_header(); ?>

<div id="content" class="site-content">
  <div class="container">

<?php
$blog_layout = get_theme_mod('blog_layout', 'right_sidebar');

if ($blog_layout == 'right_sidebar') {
?>
      <div class="row">
        <div class="col-md-8 sidebar-right">
<?php
}
if ($blog_layout == 'left_sidebar') {
?>
      <div class="row">
        <div class="col-md-8 col-md-push-4 sidebar-left">
<?php
}
?>

          <div id="primary" class="content-area">
            <main id="main" class="site-main">

              <?php
              while ( have_posts() ) : the_post();

              ?>
              <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
              <?php if (has_post_thumbnail()) {?> 
                <div class="post-media">
                  <?php the_post_thumbnail();?>
                </div>
              <?php }?>

                <div class="post-content clearfix">
                <header class="entry-header">
                  <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                </header><!-- .entry-header -->

                <div class="entry-content clearfix">
                  <?php
                    the_content();

                    wp_link_pages( array(
                      'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'showme' ),
                      'after'  => '</div>',
                    ) );
                  ?>
                </div><!-- .entry-content -->
                  </div>
              </article><!-- #post-<?php the_ID(); ?> -->
              <?php

                if (!get_theme_mod('page_comments')) :
                  // If comments are open or we have at least one comment, load up the comment template.
                  if ( comments_open() || get_comments_number() ) :
                    comments_template();
                  endif;
                endif;

              endwhile; // End of the loop.
              ?>

            </main><!-- #main -->
          </div><!-- #primary -->

<?php
if ($blog_layout == 'right_sidebar') {
?>
        </div>
        <div class="col-md-4 sidebar-right">
          <?php get_sidebar();?>
        </div>
      </div>
<?php
}
if ($blog_layout == 'left_sidebar') {
?>
        </div>
        <div class="col-md-4 col-md-pull-8 sidebar-left">
          <?php get_sidebar();?>
        </div>
      </div>
<?php
}
?>

  </div>
</div><!-- #content -->

<?php
get_footer();
