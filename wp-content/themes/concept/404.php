<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage Concept
 * @since 1.0.0
 */

get_header();
?>

<section class="page_section odd page-section-container" data-id="<?php echo esc_html( get_the_title() ); ?>">
	<div id="explore_page" class="wrapper_page container">

		<div class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'twentynineteen' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">
				<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'twentynineteen' ); ?></p>
				<?php get_search_form(); ?>
			</div><!-- .page-content -->
		</div><!-- .error-404 -->

	</div>
</section>

<?php

$to_single = 'true';
set_query_var( 'to_single', $to_single );
get_template_part( 'template-parts/header/main', 'menu' );

get_footer();
