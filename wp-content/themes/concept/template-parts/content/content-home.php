<?php
 $theme_mod_background = get_theme_mod('background_'.strtolower(get_the_id()));
?>

<section class="page_section" id="<?php echo strtolower(get_the_title()) ?>">
  <div class="page_background" style=""></div>
  <div class="page_cover"></div>

	<div id="home" class="wrapper_page container">

    <div class="home_image">
			<div class="home_image_wrapper col-sm-3 col-8">
				<img src="<?php echo wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ) , 'full' )[0]; ?>" alt="home page main image" />
			</div>
		</div>

		<div class="home_content">
			<?php the_content(); ?>
		</div>

    <div class="home_link">
      <a href="#productos">
        <div><i class="fal fa-angle-double-down fa-2x"></i></div>
      </a>
    </div>
	</div>

</section>
