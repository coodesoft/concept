<?php

require_once('GSModel.php');

class ListaPreciosCliente extends GSModel{

    static function createTable(){

        global $wpdb;
        $table_name = static::getTableName('priceListClient');
        $charset_collate = $wpdb->get_charset_collate();
        if( $wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name ) {

            $sql = "CREATE TABLE $table_name (
                client_id bigint(20) NOT NULL,
                list_id bigint(20) NOT NULL,
                PRIMARY KEY (id)
            ) $charset_collate;";

            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            dbDelta( $sql );
        }
    }

    static function add($params){

    }


}