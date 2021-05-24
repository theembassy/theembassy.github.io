<?php
/**
 * The template for displaying the footer
 *
 * @package showme
 */
?>

  <footer id="colophon" class="site-footer">
    <div class="container">
      <div class="site-info">
       

        <div class="site-info-copyright <?php if (($show_social && !$social_url_empty) || ($show_menu && has_nav_menu('menu-2'))){?>have-site-info-nav<?php }?>">
          <?php printf( esc_html__( '© INTERNATIONAL LTD 2018' ));
          ?>
        </div>
      </div><!-- .site-info -->
    </div>
  </footer><!-- #colophon -->
  
<?php
$show_back_to_top = get_theme_mod('general_show_totop_btn', 1);
if ($show_back_to_top) { 
?> 
  <div id="back_top"><i class="fa fa-angle-up"></i></div>
<?php
}
?>
  
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>