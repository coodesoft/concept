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
 * @subpackage Concept
 * @since Concept 1.0
 */

get_header();

 $theme_mod_background = get_theme_mod('background_'.strtolower(get_the_id()));
?>

<section class="page_section" id="#home">
  <div id="home" class="wrapper_page container">

    <div class="home_image">
			<div class="home_image_wrapper">
				<img src="<?php echo wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ) , 'full' )[0]; ?>" alt="home page main image" />
			</div>
		</div>

		<div class="home_content"></div>

    <div class="home_link">
      <a href="#productos">
        <div><img src="<?php echo get_site_url(); ?>/wp-content/themes/concept/img/flecha1.svg"/></div>
      </a>
    </div>
	</div>

</section>

<?php
  get_template_part( 'template-parts/header/main', 'menu' );

  $args = ['post_type' => 'page', 'orderby' => 'menu_order', 'order' => 'ASC'];
  $query = new WP_Query( $args );
  $c =0;
  while ( $query->have_posts() ) : $query->the_post();

    if ($query->post->post_type != 'page')
      echo 'Chan!';
    elseif ($query->post->menu_order != 0){
      $c++;
      $class_par = 'even'; if ($c % 2 == 0){ $class_par = 'odd'; }
      ?>
      <section class="page_section <?php echo $class_par; ?>" id="<?php echo $query->post->post_name; ?>" data-id="<?php echo $query->post->post_name; ?>">
        <div id="explore_page" class="wrapper_page">
      <?php the_content(); ?>
        </div>
      </section>
      <?php
    }

  endwhile;

?>

<?php
get_footer();
