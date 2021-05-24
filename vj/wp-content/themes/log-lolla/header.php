<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until the content
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Log_Lolla
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php get_template_part( 'template-parts/site/site', 'title' ); ?>
	<?php get_template_part( 'template-parts/header/header' ); ?>
