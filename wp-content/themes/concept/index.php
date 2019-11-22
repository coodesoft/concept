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
  <div class="page_background" style=""></div>
  <div class="page_cover"></div>

	<div id="home" class="wrapper_page container">

    <div class="home_image">
			<div class="home_image_wrapper col-sm-3 col-8">
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

<nav id="main_menu" class="navbar navbar-expand-md nav-light">

    <a class="navbar-brand" href="#"><img class="brand-img  d-sm-block d-md-none" src="<?php echo wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ) , 'full' )[0]; ?>" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse center-margin" id="navbarCollapse">
      <img class="brand-img d-none d-md-block" src="<?php echo wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ) , 'full' )[0]; ?>" alt="">
      <?php
        $args = ['post_type' => 'page', 'orderby' => 'menu_order', 'order' => 'ASC'];
        $query = new WP_Query( $args );

        $locations = get_nav_menu_locations();
        $menu      = wp_get_nav_menu_object( $locations[ 'menu-1' ] );
        $menu_opc  = wp_get_nav_menu_items(wp_get_nav_menu_object( $menu->term_id));
      ?>
      <ul id="menu-principal" class="navbar-nav">

        <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-20" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-20 nav-item"><a title="Home" href="#home" class="nav-link">Home</a></li>

        <?php
          $html = '';
          while ( $query->have_posts() ) : $query->the_post();

            if ($query->post->post_type != 'page')
              echo 'Chan!';
            elseif ($query->post->menu_order != 0){
              if (strpos(strtolower($query->post->post_title), 'oculto') === false){
                $html .= '<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-22" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-22 nav-item"><a title="Nosotros" href="#'.$query->post->post_name.'" class="nav-link">'.$query->post->post_title.'</a></li>';
              }
            }

          endwhile;

          for ($c=0; $c < count($menu_opc); $c++){
            $html .= '<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-22" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-22 nav-item"><a title="Nosotros" href="'.$menu_opc[$c]->url.'" class="nav-link">'.$menu_opc[$c]->title.'</a></li>';
          }

          echo $html;
        ?>
      </ul>

    </div>
  </nav>



<?php
  $c =0;
  while ( $query->have_posts() ) : $query->the_post();

    if ($query->post->post_type != 'page')
      echo 'Chan!';
    elseif ($query->post->menu_order != 0){
      $c++;
      $class_par = 'even'; if ($c % 2 == 0){ $class_par = 'odd'; }
      ?>
      <section class="page_section <?php echo $class_par; ?>" id="<?php echo $query->post->post_name; ?>">
        <div id="explore_page" class="wrapper_page container">
      <?php the_content(); ?>
        </div>
      </section>
      <?php
    }

  endwhile;

?>

<?php
get_footer();
