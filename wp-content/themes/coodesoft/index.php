<?php get_header(); ?>

  <main id="main_coode">
	
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
