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

<section class="page_section odd page-section-container" data-id="<?php echo esc_html( get_the_title() ); ?>">
  <div id="explore_page" class="wrapper_page container">

		<?php the_content(); ?>

	</div>
</section>

<?php
  $to_single = 'true';
  set_query_var( 'to_single', $to_single );
  get_template_part( 'template-parts/header/main', 'menu' );
?>
