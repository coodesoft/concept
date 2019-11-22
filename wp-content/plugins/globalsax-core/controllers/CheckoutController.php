<?php



class CheckoutController {
    
    
    public function __construct(){
        add_action('wp_ajax_gs_calculate_prices_by_sucursal', array($this, 'calculate') );
    }
    
    
    public function calculate(){
        $lista_id = $_POST['lista_id'];
        
        if (isset($lista_id)){
            $prices = PreciosProductos::getByListId($lista_id);
            $criteria = new PrecioProductoCriteria();
            $product_list = [];
            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ){
                $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                $product_cat = get_the_terms($product_id, 'product_cat');
                $product_cat = $product_cat[0]->name;
                
                $variation = $cart_item['variation_id'] ? (new WC_Product_Variation($cart_item['variation_id'])) : null;
                
                $inCart = [
                    'product_id' => $product_id,
                    'variation_sku' => $variation ? $variation->get_sku() : $variation,
                ];
                $criteria->prepare($inCart);
                $price = Filter::filterArrayElement($prices, $criteria);
                $arr[] = [$product_id, $variation->get_sku(), $price, $cart_item['quantity']];
                
                if (array_key_exists($product_cat, $product_list) ){
//                    if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ){
                    $product_list[$product_cat]['cant'] += $cart_item['quantity'];
                    $product_list[$product_cat]['price'] += $price['price'] * $cart_item['quantity'];
  //                  }
                } else{
                    $product_list[$product_cat] = [];
                    $product_list[$product_cat]['name'] = $product_cat;
                    $product_list[$product_cat]['cant'] = $cart_item['quantity']; 
                    $product_list[$product_cat]['price'] = $price['price'] * $cart_item['quantity'];
                }
            }
            
            $return =  ['state' => State::UPDATE_PRICELIST, 'data' => $product_list]; 
        } else
             $return = ['state' => State::PARAM_ERROR, 'data' => null];
        
        echo json_encode($return);
        wp_die();
    }
}

$checkoutController = new CheckoutController();