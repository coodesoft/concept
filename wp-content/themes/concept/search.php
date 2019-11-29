<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage Concept
 * @since 1.0.0
 */

get_header();
?>

<section class="page_section odd page-section-container" data-id="<?php echo esc_html( get_the_title() ); ?>">
	<div id="explore_page" class="wrapper_page container">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php _e( 'Search results for:', 'twentynineteen' ); ?>
				</h1>
				<div class="page-description"><?php echo get_search_query(); ?></div>
			</header><!-- .page-header -->

			<?php
			// Start the Loop.
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content/content', 'excerpt' );

				// End the loop.
			endwhile;

			// Previous/next page navigation.
			concept_the_posts_navigation();

			// If no content, include the "No posts found" template.
		else :
			get_template_part( 'template-parts/content/content', 'none' );

		endif;
		?>

	</div>
</section>

<?php
	$to_single = 'true';
	set_query_var( 'to_single', $to_single );
	get_template_part( 'template-parts/header/main', 'menu' );
	get_footer();
