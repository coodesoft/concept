<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
	'woocommerce-product-gallery',
	'woocommerce-product-gallery--' . ( $product->get_image_id() ? 'with-images' : 'without-images' ),
	'woocommerce-product-gallery--columns-' . absint( $columns ),
	'images',
) );

$description = apply_filters( 'description', $post->post_excerpt );

//die(var_dump($product));
?>

<div class="col-12 col-sm-10 col-md-10 col-lg-8 offset-sm-1 offset-md-1 offset-lg-2">
	<?php do_action( 'woocommerce_before_single_product' ); ?>
</div>
<div class="col-12 col-sm-10 col-md-10 col-lg-8 offset-sm-1 offset-md-1 offset-lg-2" id="product-<?php the_ID(); ?>" <?php wc_product_class('' , $product ); ?> >
			<div class="row">
				<div class="col-12 title-cat">
					<div class="text-center" style="position: relative;">
							<?php the_title( '<h3>', '</h3>' ); ?>
						<div class="borde-inf">
					</div></div>
				</div>
			</div>

			<div class="row single-product-cont">
				<div class="col-12 col-sm-10 offset-sm-1 col-md-6 offset-md-0 col-lg-4">
					<div class="row">
						<div class="col-12">
							<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
								<figure class="woocommerce-product-gallery__wrapper">
									<?php
									if ( $product->get_image_id() ) {
										$html = wc_get_gallery_image_html( $post_thumbnail_id, true );
									} else {
										$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
										$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
										$html .= '</div>';
									}

									echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id ); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped

									do_action( 'woocommerce_product_thumbnails' );
									?>
								</figure>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-12 description-cont">
							<?php echo $description; ?>
						</div>
					</div>
				</div>

				<div class="col-12 col-sm-10 offset-sm-1 col-md-6 offset-md-0 col-lg-8">

					<div class="row">
						<div class="col-12">
							<p class="price-cont <?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) );?>">
								<?php echo $product->get_price_html(); ?>
							</p>
						</div>
					</div>

					<div class="row">
						<div class="col-12 add-to-cart-cont">
							<?php wc_get_template( 'single-product/add-to-cart/simple.php' ); ?>
						</div>
					</div>

				</div>

			</div>

			<?php do_action( 'woocommerce_after_single_product' ); ?>
</div>
