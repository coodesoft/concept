<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */


$theme_mod_background = get_theme_mod('background_'.strtolower(get_the_id()));
?>

<section class="page_section" id="<?php echo strtolower(get_the_title()) ?>">
  <div class="page_background" style="background: url(<?php echo $theme_mod_background ?>) no-repeat fixed center"></div>
  <div class="page_cover"></div>
	<div class="wrapper_page container">

		<div class="home_content">
			<?php the_content(); ?>
		</div>

	</div>

</section>
