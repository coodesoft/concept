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

<section class="page_section even" id="productos">
  <div id="explore_page" class="wrapper_page container">
    <div class="container" style="padding-top: 50px;">
      Nueva temporada
    </div>
	</div>

</section>

<section class="page_section odd" id="categorias">
  <div id="explore_page" class="wrapper_page container">
    <div class="container" style="padding-top: 50px;">
      Categorias
    </div>
	</div>

</section>

<section class="page_section even" id="nosotros">
  <div id="explore_page" class="wrapper_page container">
    <div class="container" style="padding-top: 50px;">
      <div class="row">
        <div class="col-12 col col-sm-10 offset-sm-1">
          <div class="row">
            <div class="col-12 col col-sm-7">
              <h3 class="text-center">¿Quienes somos?</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>

              <h3 class="text-center">¿Que hacemos y cómo?</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
            </div>
            <div class="col-12 col col-sm-4 offset-sm-1">
              <div style="position: absolute;bottom: 0px;">
                <h3 class="text-center">Nuestros valores</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                  incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                  exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                  Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
	</div>

</section>

<section class="page_section odd" id="contacto">
  <div id="explore_page" class="wrapper_page container">
    <div class="container" style="padding-top: 50px;">
      contacto
    </div>
	</div>

</section>

<?php
get_footer();
