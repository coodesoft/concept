<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

  require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'twentynineteen' ); ?></a>

		<nav id="main_menu" class="navbar navbar-expand-md fixed-top nav-light">

				<a class="navbar-brand" href="#"><img class="brand-img  d-sm-block d-md-none" src="<?php echo wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ) , 'full' )[0]; ?>" alt=""></a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse center-margin" id="navbarCollapse">
					<img class="brand-img d-none d-md-block" src="<?php echo wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ) , 'full' )[0]; ?>" alt="">
					<?php /* Primary navigation */
						wp_nav_menu( [
						  'menu'       => 'menu-1',
						  'depth'      => 2,
						  'container'  => false,
						  'menu_class' => 'navbar-nav',
						  'walker'     => new wp_bootstrap_navwalker()]
						);
						?>
				</div>
			</nav>

		<div id="content" class="site-content">
