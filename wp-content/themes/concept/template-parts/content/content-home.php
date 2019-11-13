<?php
 $theme_mod_background = get_theme_mod('background_'.strtolower(get_the_id()));
 $theme_mod_home_logo = get_theme_mod('home_image_setting');
?>

<section class="page_section" id="<?php echo strtolower(get_the_title()) ?>">
  <div class="page_background" style=""></div>
  <div class="page_cover"></div>

	<div id="home_page" class="wrapper_page container">

    <div class="home_image">
			<div class="home_image_wrapper col-sm-5 col-8">
				<img src="<?php echo $theme_mod_home_logo ?>" alt="home page main image" />
			</div>
		</div>

		<div class="home_content">
			<?php the_content(); ?>
		</div>

		<div class="home_link">
			<a href="#explore">
				<i class="fal fa-angle-double-down fa-2x"></i>
			</a>
		</div>
	</div>

</section>
