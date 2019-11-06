<?php


class ListaPrecios{

    const PLUGIN_PREFIX = 'gs_';

    static function getTableName($name){
        global $wpdb;
        return  $wpdb->prefix . self::PLUGIN_PREFIX . $name;
    }

    static function createTables(){
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

        global $wpdb;
        $table_name = self::getTableName('priceList');
        $charset_collate = $wpdb->get_charset_collate();
        if( $wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name ) {

            $sql = "CREATE TABLE $table_name (
                id bigint(20) NOT NULL AUTO_INCREMENT,
                name varchar(50) NOT NULL,
                PRIMARY KEY  (id)
            ) $charset_collate;";

            dbDelta( $sql );
        }

        $table_name = self::getTableName('productPrices');
        if( $wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name ) {

            $sql = "CREATE TABLE $table_name (
                id bigint(20) NOT NULL AUTO_INCREMENT,
                product_id varchar(50) NOT NULL,
                variation_id varchar(50),
                price float(10) NOT NULL,
                list_id bigint(20) NOT NULL,
                PRIMARY KEY  (id)
            ) $charset_collate;";

            dbDelta( $sql );
        }

    }




}

?>
