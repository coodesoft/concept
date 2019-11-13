<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

get_header();
?>
<main id="main" class="site-main">

	<?php
		$args = ['post_type' => 'page', 'orderby' => 'menu_order', 'order' => 'ASC'];
		$query = new WP_Query( $args );
		while ( $query->have_posts() ) : $query->the_post();

			if ($query->post->post_type != 'page')
				echo 'lalita';
			elseif ($query->post->menu_order == 0){
				get_template_part( 'template-parts/content', 'home' );
				
			} else
				get_template_part( 'template-parts/content', 'page' );


		endwhile;

 ?>

</main><!-- .site-main -->

<?php
get_footer();
