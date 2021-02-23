<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Log_Lolla
 */

get_header(); ?>

	<section class="content content-none">
		<h3 class="none-title">
			<?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'log-lolla' ); ?>
		</h3>

		<div class="text">
			<?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'log-lolla' ); ?>
		</div>

		<aside class="search">
			<h3 hidden>
				<?php esc_html_e( 'Search form', 'log-lolla' ); ?>
			</h3>

			<?php get_search_form(); ?>
		</aside>
	</section>

	<?php get_template_part( 'template-parts/sidebar/sidebar' ); ?>

<?php
get_footer();
