<?php

require_once('GSModel.php');

class UserClientRelation extends GSModel{
    
    static function createTable(){

        global $wpdb;
        $table_name = static::getTableName('user_client_relation');
        $charset_collate = $wpdb->get_charset_collate();
        if( $wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name ) {

            $sql = "CREATE TABLE $table_name (
                id bigint(20) NOT NULL AUTO_INCREMENT,
                client_id bigint(20) NOT NULL,
                user_id bigint(20) NOT NULL,
                PRIMARY KEY (id)
            ) $charset_collate;";

            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            dbDelta( $sql );
        }
    }
    
    static function validate($user_id, $client_id){
        if (!$user_id ||  !$client_id$ || !is_numeric($user_id) || !is_numeric($client_id))
            return false;
        
        return true;
    }
    
    static function add($user_id, $client_id){
          global $wpdb;

        if (static::validate($user_id, $client_id) ){

            $table_name = self::getTableName('user_client_relation');

            $result = $wpdb->insert($table_name, array('user_id' => $WP_user_id, 'client_id'=> $GS_client_id), array('%d', '%d'));
            
            if (!$result)
                throw new Exception('Se produjo un error al intentar asociar un cliente a un usuario wordpress. ID del cliente: '.$client_id, 1);
            
            
            return ['status' => true, 'insert_id' => $wpdb->insert_id];
        } else  
            throw new Exception('Se produjo un error de validación de entrada de datos al asociar un cliente a un usuario wordpress. ID del cliente: '.$client_id, 1);

    }
    
    static function getAll(){
      global $wpdb;
      $table_name = static::getTableName('user_client_relation');
      $query = "SELECT * FROM " . $table_name;
      return $wpdb->get_results($query, ARRAY_A);
    }
    
}

?>