<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Concept
 * @since 1.0.0
 */
get_header();
?>

<section class="page_section odd page-section-container" data-id="post-<?php the_ID(); ?>">
  <div id="explore_page" class="wrapper_page container">
		<?php if ( ! concept_can_show_post_thumbnail() ) : ?>
		<header class="entry-header">
			<?php get_template_part( 'template-parts/header/entry', 'header' ); ?>
		</header>
		<?php endif; ?>

		<div class="entry-content">
			<?php
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentynineteen' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'twentynineteen' ),
					'after'  => '</div>',
				)
			);
			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php /*twentynineteen_entry_footer();*/ ?>
		</footer><!-- .entry-footer -->

		<?php if ( ! is_singular( 'attachment' ) ) : ?>
			<?php get_template_part( 'template-parts/post/author', 'bio' ); ?>
		<?php endif; ?>

	</div>
</section>

<?php
  $to_single = 'true';
  set_query_var( 'to_single', $to_single );
  get_template_part( 'template-parts/header/main', 'menu' );
?>
