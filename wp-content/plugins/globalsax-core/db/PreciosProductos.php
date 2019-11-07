<?php

require_once('db/GSModel.php');

class PreciosProductos extends GSModel{


    static function createTable(){

        global $wpdb;
        $table_name = static::getTableName('productPrices');
        if( $wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name ) {

            $sql = "CREATE TABLE $table_name (
                id bigint(20) NOT NULL AUTO_INCREMENT,
                product_id bigint(20) NOT NULL,
                variation_sku varchar(50),
                price float(10) NOT NULL,
                list_id bigint(20) NOT NULL,
                PRIMARY KEY  (id)
            ) $charset_collate;";

            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            dbDelta( $sql );
        }
    }

    static function add($params, $list_id){
        $product_sku = $params['Product_Id'];
        $variation_sku = $params['ProductVariation_Id'];
        $price = $params['Price'];

        if ($price != 0){
            if ($product_sku && is_string($product_sku)){
                $product_id = wc_get_product_id_by_sku( $product_sku );

                $exist = static::getProductPrice($product_id, $product_sku, $list_id);

                if (!$exist){
                    $toSave = [
                        'id' => 0,
                        'product_id'    => $product_id,
                        'variation_sku' => $variation_sku,
                        'price'         => $price,
                        'list_id'       => $list_id
                    ];

                    $table_name = static::getTableName('productPrices');

                    global $wpdb;
                    $result = $wpdb->insert($table_name, $toSave);
                    if ($result)
                        return $wpdb->insert_id;

                }
            }
        }
        return null;
    }



    static function getProductPrice($product_id, $variation_sku, $list_id){

        if ( !is_numeric($product_id) || !is_string($variation_sku) || !is_string($priceList) )
            throw new Exception('PreciosProductos - Párametros inválidos! : Uno o mas parámetros recibidos son inválidos');

        global $wpdb;
        $table_name = static::getTableName('priceList');

        $query  = "SELECT * FROM ". $table_name . " WHERE ";
        $query .= "product_id='" . $product_id . "' AND ";
        $query .= "variation_sku='" . $variation_sku . "' AND ";
        $query .= "list_id='" . $list_id . "'";

        return $wpdb->get_row($query);

    }
}
