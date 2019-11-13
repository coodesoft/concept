<?php
/**
 * Twenty Nineteen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

/**
 * Enqueue scripts and styles.
 */

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
