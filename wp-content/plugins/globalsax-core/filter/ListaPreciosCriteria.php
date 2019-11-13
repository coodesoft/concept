<?php


class ListaPreciosCriteria {

  private $internal_name;

  function prepare($name){
    $this->internal_name = strtolower($name);
  }

  fnction

  function check($listElement){
    return strtolower($listElement['name']) == $this->internal_name;
  }

}

 ?>
