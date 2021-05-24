<?php
  /**
   * Displaying post permalink if the link post points to an external link
   *
   * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
   *
   * @package Log_Lolla
   */
?>

<?php

  if ( ! log_lolla_post_link_is_external() ) {
    get_template_part( 'template-parts/post/parts/post', 'permalink' );
  }

?>
