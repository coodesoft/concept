<?php
/**
 * Twenty Nineteen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Concept
 * @since 1.0.0
 */


add_theme_support( 'automatic-feed-links' );

register_nav_menus(	['menu-1' => __( 'Primary', 'concept' )] );

add_theme_support(
  'html5',
  array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
  )
);

/**
 * Add support for core custom logo.
 *
 * @link https://codex.wordpress.org/Theme_Logo
 */
add_theme_support(
  'custom-logo',
  array(
    'height'      => 190,
    'width'       => 190,
    'flex-width'  => false,
    'flex-height' => false,
  )
);

wp_register_script('jquery_coode',    get_stylesheet_directory_uri().'/js/jquery-3.2.1.min.js', [],               false, true );
wp_register_script('popper',          get_stylesheet_directory_uri().'/js/popper.min.js',       ['jquery_coode'], false, true );
wp_register_script('bootstrap',       get_stylesheet_directory_uri().'/js/bootstrap.min.js',    ['jquery_coode'], false, true );
wp_register_script('fontawesome-all', get_stylesheet_directory_uri().'/js/fontawesome-all.js',  [],               false, false );
wp_register_script('concept-theme',   get_stylesheet_directory_uri().'/js/concept-theme.js',    ['jquery_coode'], false, false );

wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css',false,'1.1','all');

function add_scripts_front(){
    wp_enqueue_script( 'popper' );
    wp_enqueue_script( 'bootstrap' );
    wp_enqueue_script( 'fontawesome-all' );
    wp_enqueue_script( 'concept-theme' );
}
add_action( 'wp_footer', 'add_scripts_front' );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function twentynineteen_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'twentynineteen_skip_link_focus_fix' );

/**
 * Enqueue supplemental block editor styles.
 */
function twentynineteen_editor_customizer_styles() {

	wp_enqueue_style( 'twentynineteen-editor-customizer-styles', get_theme_file_uri( '/style-editor-customizer.css' ), false, '1.1', 'all' );

	if ( 'custom' === get_theme_mod( 'primary_color' ) ) {
		// Include color patterns.
		require_once get_parent_theme_file_path( '/inc/color-patterns.php' );
		wp_add_inline_style( 'twentynineteen-editor-customizer-styles', twentynineteen_custom_colors_css() );
	}
}
add_action( 'enqueue_block_editor_assets', 'twentynineteen_editor_customizer_styles' );


/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/** EN LA INCIALIZACION DEL TEMPLATE **/
function concept_after_setup_theme(){

}
add_action( 'after_setup_theme', 'concept_after_setup_theme' );

/*--------------------SHORTCODES-----------------------*/
function concept_woo_cat_0($attr){
	$html = '<div class="container" style="padding-top: 50px;">
    <div class="row">
      <div class="col-12">
        <div class="text-center" style="position: relative;"><h3>Nueva temporada</h3><div class="borde-inf" style="left: 36%;"></div></div>
      </div>
    </div>
    <div class="row">
      <div class="col col-12 col-sm-8 offset-2">
        <div class="row">
          <div class="col col-12 col-sm-5" style="padding-top: 65px;">
            <div class="row cont-prodcat-l" >';

    $args           = ['taxonomy' => 'product_cat', 'hierarchical' => 1, 'hide_empty' => 1 ];
    $all_categories = get_categories( $args );

    //echo json_encode($all_categories);
    foreach ($all_categories as $k => $v){
      if ($v->parent == 0)
          $html .= '<div class="col-12"><div class="prod-cont-1"><div class="square"></div><span>'.$v->name.'</span></div></div>';
    }

    $html .= '</div>
          </div>
          <div class="col col-sm-7">
          </div>
        </div>
      </div>
    </div>
  </div>';

  return $html;
}
add_shortcode('concept_woo_cat_0', 'concept_woo_cat_0');

function concept_woo_cat_1($attr){
	$html = '<div class="container" style="padding-top: 50px;">
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
    </div>';

  return $html;
}
add_shortcode('concept_woo_cat_1', 'concept_woo_cat_1');



function concept_contact($attr){
	$html = '<div class="container" style="padding-top: 50px;">
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
    </div>';

  return $html;
}
add_shortcode('concept_contact', 'concept_contact');
