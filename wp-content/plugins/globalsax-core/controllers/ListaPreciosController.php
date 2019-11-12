<?php


class ListaPreciosController {

    public function __construct(){
      add_action('wp_ajax_get_sincronizar_precios', array($this,'sincronizar'));
    }

    public function sincronizar(){
        $jsonLists = Requester::get('PriceList');
        //echo $jsonLists;
        

        $listas = json_decode($jsonLists, true);
        
        $errors = [];
        foreach($listas as $lista){
            $result = ListaPrecios::add($lista);
            if (!$result)
                $errors[] = $lista['Name'];
        }
        
        if (count($errors)==0)
            echo 'Salio todo regio';
        else
            echo 'Saltaron los siguientes errores: ' . json_encode($errors);
        wp_die();

    }

}

$listaPreciosController = new ListaPreciosController();

?>
