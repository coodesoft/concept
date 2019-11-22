<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Concept
 * @since 1.0.0
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="social-content">
			<div class="title">Encontranos en nuestras redes</div>
			<div class="social-icons">
				<a href="<?php echo get_theme_mod( 'enlace_face' ); ?>" target="_blank"><img src="<?php echo get_site_url(); ?>/wp-content/themes/concept/img/instagram.svg"/></a>
				<a href="<?php echo get_theme_mod( 'enlace_ig' ); ?>" target="_blank"><img src="<?php echo get_site_url(); ?>/wp-content/themes/concept/img/facebook.svg"/></a>
			</div>
		</div>
	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
