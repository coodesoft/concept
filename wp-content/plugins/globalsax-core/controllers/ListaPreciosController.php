<?php


class ListaPreciosController {

    public function __construct(){
      add_action('wp_ajax_get_sincronizar_precios', array($this,'sincronizar'));
    }

    public function sincronizar(){
        $jsonLists = Requester::get('PriceList');
        $lists = json_decode($jsonLists, true);

        $errors = [];
        $newLists = [];
        $storedLists = ListaPrecios::getAll();
        PreciosProductos::batchReset();

        $criteria = new ListaPreciosCriteria();
        foreach($lists as $list){
            $name = $list['Name'];

            $criteria->preprare($name);
            $stored = Filter::filterArrayElement($storedLists, $criteria);

            if (!$stored){
                $result = ListaPrecios::add($name);
                if ($result['status']){
                  $newLists[] = $name;
                  $items = $list['Items'];
                  PreciosProductos::batchSave($items, $result['insert_id']);
                }
            } else {
                PreciosProductos::batchSave($items, $stored['id']);
            }
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
