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
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
require_once(__DIR__.'/../db/UserClientRelation.php');

add_shortcode( 'gbs_cart_template', 'gbs_cart');
function gbs_cart($atts){

    if ( !is_admin() ){

        ?>

        <div id="gbsCheckout">
            <form class="woocommerce-cart-form gbs-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

                <p class="woocommerce-store-notice demo_store"> Su pedido es un compromiso de compra. La informaci&oacuten que contiene esta p&aacutegina web es de car&aacutecter informativo; la misma puede sufrir modificaciones en su contenido sin previo aviso, dependiendo de los listados de precios al d&iacutea de su facturaci&oacuten. </p>

                <div class="datos_user_cart">

                <?php if( is_user_logged_in()  ) {
                    //obtengo el usuario
                    $user = wp_get_current_user(); ?>
                    <div class="order-owner trescol"> Pedido de: <?php echo $user->user_firstname ." ". $user->user_lastname ?></div>
                        <?php
                            $clientes = UserClientRelation::getClientByUserId($user->ID);
                            $countClientes = count($clientes);
                            $checkoutController = new CheckoutController();

                            if ($countClientes > 1){
                                $products = $checkoutController->_calculate();
                            } elseif ($countClientes == 1){

                                $cliente = $clientes[0];
                                $sucursales = Sucursal::getByClientId($cliente['id']);
                                $countSucursales = count($sucursales);

                                if ($countSucursales > 1){
                                    $products = $checkoutController->_calculate();;
                                } elseif ($countSucursales == 1){
                                    $sucursal = $sucursales[0];
                                    $listas = ListaPrecios::getBySucursal($sucursal['id']);
                                    $products = $checkoutController->_calculate($listas);
                                } else{
                                    $listas = ListaPrecios::getByCliente($cliente['id']);
                                    $products = $checkoutController->_calculate($listas);
                                }
                            } else{
																$products = $checkoutController->_calculate();
														}
                        ?>
											<div class="gsSelectorContent">
												<div class="clienteTarget"> <?php ClienteDOM::selector($clientes); ?> </div>
                        <div class="sucursalTarget"><?php isset($sucursales) ? SucursalDOM::selector($sucursales) : '';?></div>

                    </div>
		        	</div>
                    <div class="gsCartContent">
                        <?php echo CartResumeDOM::cart($products); ?>
                    </div>


                <div class="user-actions">
                    <div class="save-order">
                        <input type="radio" name="pedido" value="G" checked=""> Agrega pendientes
                    </div>
                    <div class="null-order">
                        <input type="radio" name="pedido" value="A"> Anular pendientes
                    </div>
                </div>
		    <?php do_action( 'woocommerce_after_cart_table' ); ?>
            </form>
        </div>
        <?php }
    }
}

?>
