<?php
  /**
   * Displaying a post title
   *
   * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
   *
   * @package Log_Lolla
   */
?>

<?php
  the_title(
    '<h3 class="post-title"><a class="link" href="' . esc_url( get_permalink() ) . '" title="' . the_title_attribute( 'echo=0') . '">',
    '</a></h3>'
  );
?>
