<?php get_header();

  $theme_mod_home_logo = get_theme_mod('home_image_setting');
?>

  <main id="main_coode">

    <section class="page_section" id="<?php echo strtolower(get_the_title()) ?>">
      <div class="page_background"></div>
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

    

  <?php
	  $args = ['post_type' => 'page', 'orderby' => 'menu_order', 'order' => 'ASC'];
	  $query = new WP_Query( $args );
	  while ( $query->have_posts() ) : $query->the_post();

			if ($query->post->post_type != 'page')
				echo 'lalita';
			elseif ($query->post->menu_order == 0){
				get_template_part( 'template-parts/content', 'home' );
				Html::navbar();
			} else
				get_template_part( 'template-parts/content', 'page' );


	  endwhile;

 ?>
</main>

 <?php get_footer(); ?>
