<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

//get_header( 'shop' );

	//se comprueba si el usuario está logueado para redirigir a página de registro
	if (!is_user_logged_in()){
		wp_redirect( get_site_url().'/my-account' );
    exit;
	}

//do_action( 'woocommerce_before_main_content' );
	get_header();
	do_action( 'woocommerce_archive_description' );

	$args           = ['taxonomy' => 'product_cat', 'hierarchical' => 1, 'hide_empty' => 1 ];
	$all_categories = get_categories( $args );
	$html_cats      = '';

	foreach ($all_categories as $k => $v){

		if ($v->parent == 0){
		$html_cats .= '<div class="col-12 prod-cat-prview">
										<div class="prod-cat-link-cont">
											<a href="'.get_term_link( $v->term_id, 'product_cat' ).'" ><span>'.$v->name.'</span><span class="dsp-count">('.$v->count.')</span></a>
										</div>
						 </div>';
		}

	}
?>

<section class="page_section page-section-container" id="#category-products">
  <div id="category-products" class="wrapper_page container-fluid">
		<div class="row">
			<div class="col-12 title-cat">
				<div class="text-center" style="position: relative;">
					<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
						<h3><?php woocommerce_page_title(); ?></h3>
					<?php endif; ?>
					<div class="borde-inf">
				</div></div>
			</div>
		</div>

		<div class="row product-zone">
			<div class="col-12 col-sm-4 col-md-3 col-lg-2 col-xl-2 offset-sm-1">
				<div class="row">
					<div class="col-12 categories-pr-view">
						<div class="row">
							<div class="col-12 title-cat">
								<div class="text-center" style="position: relative;"><h3>Categorías</h3><div class="borde-inf"></div></div>
							</div>
						</div>

						<div class="row"><?php echo $html_cats; ?></div>
					</div>
				</div>
			</div>

			<div class="col-12 col-sm-7 col-md-8 col-lg-9 col-xl-8 offset-xl-1">
				<div class="row">
				<?php if ( woocommerce_product_loop() ) {
					woocommerce_product_loop_start();
					if ( wc_get_loop_prop( 'total' ) ) {
						while ( have_posts() ) {
							the_post();

							do_action( 'woocommerce_shop_loop' );

							wc_get_template_part( 'content', 'product' );
						}
					}
          woocommerce_product_loop_end();
					do_action( 'woocommerce_after_shop_loop' );
				} else {
					do_action( 'woocommerce_no_products_found' );
				}

				do_action( 'woocommerce_after_main_content' );
				?>
				</div>
			</div>
		</div>

		</div>
	</div>
</section>

<?php
	$to_single = 'true';
	set_query_var( 'to_single', $to_single );
	get_template_part( 'template-parts/header/main', 'menu' );
?>


<?php

//do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );
