<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' );

//se comprueba si el usuario está logueado para redirigir a página de registro
if (!is_user_logged_in()){
	wp_redirect( get_site_url().'/my-account' );
	exit;
}
?>

<?php

	$html = '';
	$cart_total = WC()->cart->total;

	foreach (WC()->cart->get_cart()  as $cart_item_key => $cart_item ) {
		$_product   = apply_filters( 'woocommerce_cart_item_product',    $cart_item['data'],       $cart_item, $cart_item_key );
		$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

		if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
			$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );

			$product_remove = apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						'woocommerce_cart_item_remove_link',
						sprintf(
							'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
							esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
							esc_html__( 'Remove this item', 'woocommerce' ),
							esc_attr( $product_id ),
							esc_attr( $_product->get_sku() )
						),
						$cart_item_key
					);

			$thumbnail         = get_the_post_thumbnail_url($_product->get_id());
			$product_sub_total = apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
			$product_name      = $_product->get_name();
			$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
			$input_quantity    = '';
			$product_meta      =  wc_get_formatted_cart_item_data( $cart_item );
			$back_order        = '';

			// Backorder notification.
		  if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
		    $back_order = wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
		  }

			//Input de Cantidad
			if ( $_product->is_sold_individually() ) {
		    $input_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
		  } else {
		    $input_quantity = woocommerce_quantity_input(
		      [
		        'input_name'   => "cart[{$cart_item_key}][qty]",
		        'input_value'  => $cart_item['quantity'],
		        'max_value'    => $_product->get_max_purchase_quantity(),
		        'min_value'    => '0',
		        'product_name' => $_product->get_name(),
		      ],
		      $_product,
		      false
		    );
		  }

			$html .= '
				<div class="row">
					<div class="col-1">
						<td class="product-remove">'.$product_remove.'</td>
					</div>

					<div class="col-11">
						<div class="row">
							<div class="col-12 col-sm-4">
								<a href="'.esc_url( $product_permalink ).'"><div class="img-cont"> <img src="'.$thumbnail.'" class="card-img-top" alt="product name"> </div> </a>
							</div>

							<div class="col-12 col-sm-4">
								<div class="row">
									<div class="col-12">'.$product_name.'</div>
									<div class="col-12" data-title="'.esc_attr_e( 'Price', 'woocommerce' ).'">'.$product_price.'</div>

									<div class="col-12">
										<div class="row" data-title="'.esc_attr_e( 'Quantity', 'woocommerce' ).'">
											<div class="col">Cantidad</div>
											<div class="col">+</div><div class="col">'.$input_quantity.'</div>-<div class="col"></div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-12 col-sm-4">
								<div class="row" data-title="'.esc_attr_e( 'Subtotal', 'woocommerce' ).'">
									<div class="col-12">Total</div>
									<div class="col-12">'.$product_sub_total.'</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-12">'.$back_order.'</div>
				</div>
			';
		}
	}
?>


<form class="woocommerce-cart-form row" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

		<div class="col-12 col-sm-9">
				<?php do_action( 'woocommerce_before_cart_table' );    ?>
				<?php do_action( 'woocommerce_before_cart_contents' ); ?>
				<?php echo $html; ?>
				<?php //do_action( 'woocommerce_cart_contents' ); ?>
				<div class="col-12">
					<button type="submit" class="button btn-update-cart" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>
				</div>
		</div>

		<div class="col-12 col-sm-3">
			<div class="row">
				<div class="col-12">Total de carrito de compras</div>
				<div class="col-12">
					<div class="row">
						<div class="col-12">
							<div class="row">
								<div class="col">Subtotal</div>
								<div class="col"></div></div>
						</div>

						<div class="col-12">
							<div class="row">
								<div class="col">Envío</div>
								<div class="col"></div></div>
						</div>

						<?php if ( wc_coupons_enabled() ) { ?>
						<div class="col-12">
							<div class="row">
								<div class="col">Cupón de descuento</div>
								<div class="col"><input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /></div></div>
						</div>

						<div class="col-12">
							<button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>">	<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?></button>
							<?php do_action( 'woocommerce_cart_coupon' ); ?>
						</div>
						<?php } ?>


						<div class="col-12">
							<div class="row">
								<div class="col">Total</div>
								<div class="col"><?php echo $cart_total	?></div></div>
						</div>

					</div>
				</div>

				<div class="col-12">


							<?php do_action( 'woocommerce_cart_actions' ); ?>
							<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>


					<?php do_action( 'woocommerce_after_cart_contents' ); ?>
					<?php do_action( 'woocommerce_after_cart_table' ); ?>
				</div>
			</div>
		</div>

</form>

<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

<div class="cart-collaterals">
	<?php
		/**
		 * Cart collaterals hook.
		 *
		 * @hooked woocommerce_cross_sell_display
		 * @hooked woocommerce_cart_totals - 10
		 */
		//do_action( 'woocommerce_cart_collaterals' );
	?>
</div>

<?php //do_action( 'woocommerce_after_cart' ); ?>
