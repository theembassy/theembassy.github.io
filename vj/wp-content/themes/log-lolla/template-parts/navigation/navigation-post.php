<?php
  /**
   * Template part for displaying navigation inside a post
   *
   * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
   *
   * @package Log_Lolla
   */
?>

<nav class="navigation post-navigation">
  <h3 hidden>
    <?php esc_html_e( 'Post navigation', 'log-lolla' ); ?>
  </h3>

  <ul class="ul">
    <li class="li">
      <?php
        $arrow_left = log_lolla_get_arrow_html( 'left' );
        previous_post_link("$arrow_left%link");
      ?>
    </li>
    <li class="li">
      <?php
        $arrow_right = log_lolla_get_arrow_html( 'right' );
        next_post_link("$arrow_right%link");
      ?>
    </li>
  </ul>
</nav>
