<?php

require_once('GSModel.php');

class ListaPrecios extends GSModel{

    static function createTable(){

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

    static function validate($param){
      return ( isset($param) && is_string($param) && strlen($param)>0 );
    }

    static function add($name){

        if ( static::validate($name) ){
            global $wpdb;
            $table_name = self::getTableName('priceList');
            $result = $wpdb->insert( $table_name, ['id'=> 0, 'name' => $name], ['%d', '%s'] );
            if ($result)
                return [ 'status' => true, 'insert_id' => $wpdb->insert_id ];
            else
                return [ 'status' => false, 'insert_id' => 0 ];
        }
        return [ 'status' => false, 'insert_id' => 0 ];
    }

    static function getByName($name, $limit = null){

        if (static::validate($name)){
          global $wpdb;
          $table_name = static::getTableName('priceList');

          $trimed = trim($name);
          $name = stripslashes($trimed);

          if ($name != $trimed)
              throw new Exception('ListaPrecios - Dato inválido! : El nombre contiene espacios: ['.$name. "] [".$spaces ."] [". $trimed."]");

          $query = "SELECT * FROM " . $table_name . " WHERE name='" . $name . "'";

          if (!$limit && is_numeric($limit) && $limit > 0)
              $query .= ' LIMIT ' . $limit;

          return $wpdb->get_results($query, ARRAY_A);
        }

        return null;
    }

    static function getAll(){
      global $wpdb;
      $table_name = static::getTableName('priceList');
      $query = "SELECT * FROM " . $table_name;
      return $wpdb->get_results($query, ARRAY_A);
    }
}

?>
