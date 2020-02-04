<?php

require_once('GSModel.php');

class GSError extends GSModel{

  static function createTable(){
    //TODO: definir la estructura a crear
  }

  static function validate($error){
    return ( isset($error['cliente_id']) &&
             isset($error['resultado']) &&
             isset($error['json']) &&
             isset($error['tipo']) );
  }

  static function add($error){
    if (static::validate($error)){
      global $wpdb;

      $table_name = self::getTableName('error');
      $types = array( '%d', '%s', '%s', '%s' );
      $result = $wpdb->insert($table_name, $error, $types);

      // se hace la comparación dura (!==) porque puede retornar cero (filas modificadas) que no es lo mismo que un false de retorno
      if ($result !== false)
        return ($result > 0) ? ['status' => true, 'insert_id' => $wpdb->insert_id] : ['status' => true, 'insert_id' => 0];
      else
        throw new Exception("Se produjo un error al guardar el error: " . json_encode([$error, $wpdb->last_query]), 1);

    } else{
      throw new Exception("Se produjo un error de validación de parámetros al guardar el error: ". json_encode($error), 1);
    }
  }

}
