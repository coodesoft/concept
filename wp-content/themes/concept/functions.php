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
    'height'      => 350,
    'width'       => 350,
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
      <div class="col col-12 col-sm-8 offset-sm-1">
        <div class="row">
          <div class="col col-12 col-sm-5" style="padding-top: 65px;">
            <div class="row cont-prodcat-l" >';

      $query = new WP_Query( array(
              'post_type' => 'product',
              'post_status' => 'publish',
              'posts_per_page' => -1 ,
              'tax_query' => array( array(
                  'taxonomy' => 'product_visibility',
                  'field'    => 'term_id',
                  'terms'    => 'featured',
                  'operator' => 'IN',
              ) )
          ) );

     if ( $query->have_posts() ): while ( $query->have_posts() ): $query->the_post();
         $product = wc_get_product( $query->post->ID );

         $html .= '<div class="col-12 prod-cont-1">
                      <div class="row">
                          <div class="col-2 p-cont-sqr p-0"><div class="square"></div> </div>
                          <div class="col-10">'.$product->get_title().'</div>
                      </div>
                  </div>';
     endwhile; wp_reset_query();endif;

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
        <div class="col-12 title-cat">
          <div class="text-center" style="position: relative;"><h3>Categorias</h3><div class="borde-inf"></div></div>
        </div>
      </div>
      <div class="row">
        <div class="col col-12 col-sm-10 offset-sm-1 col-md-9 offset-md-2">
          <div class="row">';

          $args           = ['taxonomy' => 'product_cat', 'hierarchical' => 1, 'hide_empty' => 1 ];
          $all_categories = get_categories( $args );

          //echo json_encode($all_categories);
          $c = 1;
          $style_par = '';
          foreach ($all_categories as $k => $v){

            if ($v->parent == 0){
              if ($c % 2 == 0){  $style_par = 'margin-top: 68px;';  } else { $style_par = ''; }
              $c++;

              $thumbnail_id = get_woocommerce_term_meta( $v->term_id, 'thumbnail_id', true );
              $image        = wp_get_attachment_url( $thumbnail_id );

              $html .= '
          <div class="col col-12 col-sm-12 col-md-6 col-lg-4">
            <div class="row">
              <div class="col col-12 col-sm-11">

                <div class="card category-card" style="width: 100%; '.$style_par.'">
                  <div class="img-cont-square"> <div class="v-center"> <img src="'.$image.'" class="card-img-top" alt="..."> </div> </div>
                  <div class="card-body p-0">
                    <p class="card-text text-center">'.$v->name.'</p>
                    <div class="col-12"> <a href="'.get_term_link( $v->term_id, 'product_cat' ).'" class="btn btn-primary col-12" style="color: #fdbd18; border-radius:11px; background-color: #fff; border-color: #fdbd18;">Ver productos</a> </div>
                  </div>
                </div>

              </div>
            </div>
          </div>';
            }

          }

    $html .= '</div>
        </div>
      </div>
    </div>';

  return $html;
}
add_shortcode('concept_woo_cat_1', 'concept_woo_cat_1');



function concept_contact($attr){
	$html = '<div class="container" style="padding-top: 50px;">

    </div>';

  return $html;
}
add_shortcode('concept_contact', 'concept_contact');

/**
 * Determines if post thumbnail can be displayed.
 */
function concept_can_show_post_thumbnail() {
	return apply_filters( 'twentynineteen_can_show_post_thumbnail', ! post_password_required() && ! is_attachment() && has_post_thumbnail() );
}

if ( ! function_exists( 'concept_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function concept_post_thumbnail() {
		if ( ! concept_can_show_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<figure class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</figure><!-- .post-thumbnail -->

			<?php
		else :
			?>

		<figure class="post-thumbnail">
			<a class="post-thumbnail-inner" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php the_post_thumbnail( 'post-thumbnail' ); ?>
			</a>
		</figure>

			<?php
		endif; // End is_singular().
	}
endif;

/**
 * Gets the SVG code for a given icon.
 */
require get_template_directory() . '/classes/class-concept-svg-icons.php';
function concept_get_icon_svg( $icon, $size = 24 ) {
	return Concept_SVG_Icons::get_svg( 'ui', $icon, $size );
}

if ( ! function_exists( 'concept_posted_by' ) ) :
	/**
	 * Prints HTML with meta information about theme author.
	 */
	function concept_posted_by() {
		printf(
			/* translators: 1: SVG icon. 2: post author, only visible to screen readers. 3: author link. */
			'<span class="byline">%1$s<span class="screen-reader-text">%2$s</span><span class="author vcard"><a class="url fn n" href="%3$s">%4$s</a></span></span>',
			concept_get_icon_svg( 'person', 16 ),
			__( 'Posted by', 'twentynineteen' ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		);
	}
endif;

if ( ! function_exists( 'concept_comment_count' ) ) :
	/**
	 * Prints HTML with the comment count for the current post.
	 */
	function concept_comment_count() {
		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			echo concept_get_icon_svg( 'comment', 16 );

			/* translators: %s: Name of current post. Only visible to screen readers. */
			comments_popup_link( sprintf( __( 'Leave a comment<span class="screen-reader-text"> on %s</span>', 'twentynineteen' ), get_the_title() ) );

			echo '</span>';
		}
	}
endif;

if ( ! function_exists( 'concept_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function concept_entry_footer() {

		// Hide author, post date, category and tag text for pages.
		if ( 'post' === get_post_type() ) {

			// Posted by
			concept_posted_by();

			// Posted on
			twentynineteen_posted_on();

			/* translators: used between list items, there is a space after the comma. */
			$categories_list = get_the_category_list( __( ', ', 'twentynineteen' ) );
			if ( $categories_list ) {
				printf(
					/* translators: 1: SVG icon. 2: posted in label, only visible to screen readers. 3: list of categories. */
					'<span class="cat-links">%1$s<span class="screen-reader-text">%2$s</span>%3$s</span>',
					concept_get_icon_svg( 'archive', 16 ),
					__( 'Posted in', 'twentynineteen' ),
					$categories_list
				); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma. */
			$tags_list = get_the_tag_list( '', __( ', ', 'twentynineteen' ) );
			if ( $tags_list ) {
				printf(
					/* translators: 1: SVG icon. 2: posted in label, only visible to screen readers. 3: list of tags. */
					'<span class="tags-links">%1$s<span class="screen-reader-text">%2$s </span>%3$s</span>',
					concept_get_icon_svg( 'tag', 16 ),
					__( 'Tags:', 'twentynineteen' ),
					$tags_list
				); // WPCS: XSS OK.
			}
		}

		// Comment count.
		if ( ! is_singular() ) {
			concept_comment_count();
		}

		// Edit post link.
		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers. */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'twentynineteen' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">' . concept_get_icon_svg( 'edit', 16 ),
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'concept_the_posts_navigation' ) ) :
	/**
	 * Documentation for function.
	 */
	function concept_the_posts_navigation() {
		the_posts_pagination(
			array(
				'mid_size'  => 2,
				'prev_text' => sprintf(
					'%s <span class="nav-prev-text">%s</span>',
					concept_get_icon_svg( 'chevron_left', 22 ),
					__( 'Newer posts', 'twentynineteen' )
				),
				'next_text' => sprintf(
					'<span class="nav-next-text">%s</span> %s',
					__( 'Older posts', 'twentynineteen' ),
					concept_get_icon_svg( 'chevron_right', 22 )
				),
			)
		);
	}
endif;
