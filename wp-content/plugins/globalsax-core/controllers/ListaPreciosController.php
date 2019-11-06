<?php

class ListaPreciosController {

    public function __construct(){
      add_action('wp_ajax_get_sincronizar_precios', array($this,'sincronizar'));
    }

    public function sincronizar(){
        $jsonLists = Requester::get('PriceList');
        echo $jsonLists;
        wp_die();

    }

}

$listaPreciosController = new ListaPreciosController();

?>
