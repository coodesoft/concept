<?php

require_once('db/GSModel.php');

class ListaPrecios extends GSModel{

    static function createTables(){

        global $wpdb;
        $table_name = static::getTableName('priceList');
        $charset_collate = $wpdb->get_charset_collate();
        if( $wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name ) {

            $sql = "CREATE TABLE $table_name (
                id bigint(20) NOT NULL AUTO_INCREMENT,
                name varchar(50) NOT NULL,
                PRIMARY KEY  (id)
            ) $charset_collate;";
            
            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            dbDelta( $sql );
        }
    }

    static function add($params){

        $name = trim($params['Name']);
        $items = $parmams['Items'];
        if (!is_array($items))
            throw new Exception('ListaPrecios - Tpo de datos inválido! : Items no es un array.');
        
        $stored = self::getByName($name, 1);
        
        if (!$stored){
            $table_name = self::getTableName('priceList');
            $result = $wpdb->insert( $table_name, ['id'=> 0, 'name' => $name], ['%d', '%s'] );
            
            if ($result){
                foreach($items as $item){
                    PreciosProductos::add($item);
                }
                return $wpdb->insert_id;
            }
        }
        return null;
    }
    
    static function getByName($name, $limit = null){
        global $wpdb;
        $table_name = static::getTableName('priceList');
        
        if ($name == trim($name) && strpos($name, ' ') !== false)
            throw new Exception('ListaPrecios - Dato inválido! : El nombre contiene espacios.');
        
        $query = "SELECT * FROM " . $table_name . " WHERE name='" . $name . "'";
        
        if (!$limit && is_numeric($limit) && $limit > 0)
            $query .= ' LIMIT ' . $limit;
        
        return $wpdb->get_results($query, ARRAY_A);
    }

}

?>
