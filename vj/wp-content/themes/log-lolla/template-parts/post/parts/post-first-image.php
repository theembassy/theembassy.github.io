<?php
  /**
   * Displaying the first image from the post content
   *
   * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
   *
   * @package Log_Lolla
   */
?>

<aside class="post-first-image">
  <h3 hidden>
    <?php esc_html_e( 'Post first image', 'log-lolla' ) ?>
  </h3>

  <figure class="figure">
		<a class="link" href="<?php echo esc_url( get_permalink() ) ?>" title="<?php the_title_attribute(); ?>">
      <img src="<?php echo esc_url( log_lolla_get_post_first_image_url() ); ?>" alt="<?php the_title_attribute(); ?>">
    </a>

    <?php
      the_title(
        '<figcaption class="figcaption"><a class="link" href="' . esc_url( get_permalink() ) . '" title="' . the_title_attribute( 'echo=0') . '">',
        '</a></figcaption>'
      );
    ?>
  </figure>
</aside>
