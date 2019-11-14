<?php


class ListaPreciosController {

    public function __construct(){
      add_action('wp_ajax_get_sincronizar_precios', array($this,'sincronizar'));
    }

    public function sincronizar(){
        $jsonLists = Requester::get('PriceList');
        $lists = json_decode($jsonLists, true);

        $errors = [];
        $wsNormalizedLists = [];
        $storedLists = ListaPrecios::getAll();

        //PreciosProductos::batchReset();

        $criteria = new ListaPreciosCriteria();
        foreach($lists as $list){
            $name = $list['Name'];

            //normalizo la clave ya que dede el webservice viene de la forma "Name: value"
            //así puedo comparar usando el objeto criteria para luego ver que listas
            //se deben borrar.
            $wsNormalizedLists[]['name'] = $name;
                
            $criteria->prepare( ['name' => $name] );
            $stored = Filter::filterArrayElement($storedLists, $criteria);
            
            if (!$stored){
               // $result = ListaPrecios::add($name);
                if ($result['status']){
                  $items = $list['Items'];
                 // PreciosProductos::batchSave($items, $result['insert_id']);
                }
            } else {
               // PreciosProductos::batchSave($items, $stored['id']);
            }
        }
        
        //filtro las listas de la db que no vienen en el webservice, asi se borran
        $listsToDelete = Filter::diffArrays($storedLists, $wsNormalizedLists, $criteria);
        echo json_encode($listsToDelete);
        
        if (count($errors)==0)
            echo 'Salio todo regio';
        else
            echo 'Saltaron los siguientes errores: ' . json_encode($errors);
        wp_die();

    }

}

$listaPreciosController = new ListaPreciosController();

?>
