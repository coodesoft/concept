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
      <div class="row">
        <div class="col-12">
          <div class="text-center" style="position: relative;"><h3>Nueva temporada</h3><div class="borde-inf" style="left: 36%;"></div></div>
        </div>
      </div>
      <div class="row">
        <div class="col col-12 col-sm-8 offset-2">
          <div class="row">
            <div class="col col-12 col-sm-5" style="padding-top: 65px;">
              <div class="row cont-prodcat-l" >
                <?php
                $args = [
                  'taxonomy'     => 'product_cat',
                  'hierarchical' => 1,
                  'hide_empty'   => 1
                ];
                $all_categories = get_categories( $args );
                $salida         = '';
//echo json_encode($all_categories);
                foreach ($all_categories as $k => $v){
                  if ($v->parent == 0)
                    $salida .= '<div class="col-12"><div class="prod-cont-1"><div class="square"></div><span>'.$v->name.'</span></div></div>';
                }
                ?>
                <?php echo $salida; ?>
              </div>
            </div>
            <div class="col col-sm-7">
            </div>
          </div>
        </div>
      </div>
    </div>
	</div>

</section>

<section class="page_section odd" id="categorias">
  <div id="explore_page" class="wrapper_page container">
    <div class="container" style="padding-top: 50px;">
      <div class="row">
        <div class="col-12">
          <div class="text-center" style="position: relative;"><h3>Categorias</h3><div class="borde-inf" style="left: 46%;"></div></div>
        </div>
      </div>
      <div class="row">
        <div class="col col-sm-8 offset-2">
          <div class="row">
            <div class="col col-12 col-sm-4">
              <div class="row">
                <div class="col col-12 col-sm-11">

                  <div class="card" style="width: 100%;">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR4Ze72kB16LAiTeTKjKveAYCtA7Y2Xb_uTcorcF-7blXwtZcFMEg&s" class="card-img-top" alt="...">
                    <div class="card-body">
                      <p class="card-text">Categoría 1</p>
                      <a href="#" class="btn btn-primary" style="color: #fdbd18; background-color: #fff; border-color: #fdbd18;">Ver productos</a>
                    </div>
                  </div>

                </div>
              </div>
            </div>
            <div class="col col-12 col-sm-4">
              <div class="col col-12 col-sm-11">

                <div class="card" style="width: 100%; margin-top:92px;">
                  <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR4Ze72kB16LAiTeTKjKveAYCtA7Y2Xb_uTcorcF-7blXwtZcFMEg&s" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text">Categoría 2</p>
                    <a href="#" class="btn btn-primary" style="color: #fdbd18; background-color: #fff; border-color: #fdbd18;">Ver productos</a>
                  </div>
                </div>

              </div>
            </div>
            <div class="col col-12 col-sm-4">
              <div class="col col-12 col-sm-11">

                <div class="card" style="width: 100%;">
                  <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR4Ze72kB16LAiTeTKjKveAYCtA7Y2Xb_uTcorcF-7blXwtZcFMEg&s" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text">Categoría 3</p>
                    <a href="#" class="btn btn-primary" style="color: #fdbd18; background-color: #fff; border-color: #fdbd18;">Ver productos</a>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
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
              <div class="text-center" style="position: relative;"><h3>¿Quienes somos?</h3><div class="borde-inf" style="left: 36%;"></div></div>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>

              <div class="text-center" style="position: relative;"><h3>¿Que hacemos y cómo?</h3><div class="borde-inf" style="left: 25%;"></div></div>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
            </div>
            <div class="col-12 col col-sm-4 offset-sm-1">
              <div style="position: absolute;bottom: 0px;">
                <div class="text-center" style="position: relative;"><h3>Nuestros valores </h3><div class="borde-inf" style="left: 40%;"></div></div>
                <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
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
      <div class="row">

      </div>
    </div>
	</div>

</section>

<?php
get_footer();
