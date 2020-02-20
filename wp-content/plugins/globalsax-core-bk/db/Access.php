<?php
namespace GlobalSaxBK\db;

class Access extends BaseModel{

  protected $tableName = 'access';

  protected function getStructure(){
    $structure = "CREATE TABLE $table_name (
                  access_id bigint(20) NOT NULL AUTO_INCREMENT,
                  file_id bigint(20) NOT NULL ,
                  user_id bigint(20) NOT NULL,
                  download_date timestamp DEFAULT '0000-00-00 00:00:00' NOT NULL,
                  PRIMARY KEY  (access_id) )";
    return $structure;
  }

  protected function valdiate($data){
    //TODO crear validación para el save de un nuevo registro de acceso.
  }

  public function deleteByIDs($ids){
    $table = $this->getTableName();
    $query = "DELETE FROM $table WHERE access_id IN ($ids)";
    return $this->db->query($query);
  }

  public function deleteByUser($id){
    $table = $this->getTableName();
    return $this->db->delete( $table, ['user_id' => $id], ['%d']) ;
  }

}
