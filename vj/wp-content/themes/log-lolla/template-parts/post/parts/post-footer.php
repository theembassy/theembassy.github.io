<?php
  /**
   * Displaying post date, author, categories and tags
   *
   * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
   *
   * @package Log_Lolla
   */
?>

<aside class="post-footer">
  <h3 hidden>
    <?php esc_html_e( 'Post footer', 'log-lolla' ) ?>
  </h3>

  <div class="date-and-author">
    <?php get_template_part( 'template-parts/post/parts/post', 'date' ); ?>
    <?php get_template_part( 'template-parts/post/parts/post', 'author' ); ?>
  </div>

  <?php if ( has_category() && has_tag() ) { ?>
    <div class="categories-and-tags">
      <?php get_template_part( 'template-parts/post/parts/post', 'categories' ); ?>
      <?php get_template_part( 'template-parts/post/parts/post', 'tags' ); ?>
    </div>
  <?php } ?>

  <?php get_template_part( 'template-parts/post/parts/post', 'edit-link' ); ?>
</aside>
