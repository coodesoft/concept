<?php

namespace GlobalSaxBK\db;

abstract class BaseModel {

  protected $db;

  protected $tableName;

  protected $pluginPrefix = 'gs_bk_';

  abstract protected function getStructure();

  abstract protected function validate($data);

  public function __construct(){
    global $wpdb;
    $this->db = $wpdb;
  }

  protected function getPrefix(){
    return $this->db->prefix . $this->pluginPrefix;
  }

  public function getTableName(){
    return $this->getPrefix() . $this->tableName;
  }

  public function createTable(){
    if ( $this->db-get_var("SHOW TABLES LIKE '$this->getTableName()'") != $this->getTableName() ){
      $charsetCollate = $this->db->get_charset_collate();
      $query = $this->getStructure() . " " . $charsetCollate;

      require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
      dbDelta( $query );
    }
  }

}

?>
