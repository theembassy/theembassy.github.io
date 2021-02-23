<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="site">

  <header id="masthead" class="site-header">
    <div class="container">

    <div class="site-branding clearfix">
      <div class="site-branding-logo">
        <?php the_custom_logo();?>
        <?php if ( !get_theme_mod( 'header_title' )):?>
          <div class="site-branding-title">
            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

            <?php $description = get_bloginfo( 'description', 'display' );
            if ( $description || is_customize_preview() ) : ?>
              <p class="site-description"><?php echo $description;?></p>
            <?php endif; ?>
          </div>
        <?php endif;?>
      </div>

      <nav id="site-navigation" class="main-navigation">
        <?php
          if (has_nav_menu('menu-1')) {
            wp_nav_menu( array(
              'theme_location' => 'menu-1',
              'container' => 'nav',
              'menu_class' => 'menu hidden-sm hidden-xs',
            ) );
          }
        ?>
      </nav><!-- #site-navigation -->

      <button class="menu-toggle navbar-toggle" data-toggle="collapse" data-target="#main-navigation-collapse"><i class="fa fa-bars"></i></button>
    </div><!-- .site-branding -->

    <div id="main-navigation-collapse" class="collapse navbar-collapse">
      <?php
        if (has_nav_menu('menu-1')) {
          wp_nav_menu( array(
            'theme_location' => 'menu-1',
            'container' => 'nav',
            'menu_class' => 'nav navbar-nav responsive-nav hidden-md hidden-lg',
          ) );
        }
      ?>
    </div>
  </div>
  </header><!-- #masthead -->
