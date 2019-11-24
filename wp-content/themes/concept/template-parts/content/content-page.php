<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Concept
 * @since Concept 1.0
 */
 get_header();
?>

<section class="page_section odd" id="page-section-container">
  <div id="explore_page" class="wrapper_page container">

		<?php the_content(); ?>

	</div>
</section>

<?php get_template_part( 'template-parts/header/main', 'menu' ); ?>
