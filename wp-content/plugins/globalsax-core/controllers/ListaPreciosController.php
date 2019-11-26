<?php


class ListaPreciosController {

    public function __construct(){
        add_action('wp_ajax_get_sincronizar_precios', array($this,'sincronice'));
    }

    public function sincronice(){
        $successOperation = false;
        $errorMessage = '';
        ListaPrecios::transaction();
        try {
            PreciosProductos::batchReset();
            $successOperation = true;
        } catch (Exception $e) {
            $successOperation = false;
            $errorMessage = $e->getMessage();
        }


        if ($successOperation){

          $wsNormalizedLists = [];
          $jsonLists = Requester::get('PriceList');
          $lists = json_decode($jsonLists, true);
          $storedLists = ListaPrecios::getAll();

          $criteria = new ListaPreciosCriteria();

          foreach($lists as $list){
              //normalizo la clave ya que dede el webservice viene de la forma "Name: value"
              //así puedo comparar usando el objeto criteria para luego ver que listas
              //se deben borrar. Dejo todas las claves en lowercase.
              $list = array_change_key_case($list, CASE_LOWER);
              $wsNormalizedLists[] = $list;

              $criteria->prepare($list);
              $stored = Filter::filterArrayElement($storedLists, $criteria);

              try {
                if (!$stored) {
                    $result = ListaPrecios::add($list['name']);
                    if ($result['status'])
                       PreciosProductos::batchSave($list['items'], $result['insert_id']);
                } else
                    PreciosProductos::batchSave($list['items'], $stored['id']);

                $successOperation = true;
              } catch (Exception $e) {
                $successOperation = false;
                $errorMessage = $e->getMessage();
                break;
              }
          }
        }


        if ($successOperation){
          //filtro las listas de la db que no vienen en el webservice, asi se borran.
          $listsToDelete = Filter::diffArrays($storedLists, $wsNormalizedLists, $criteria);
          foreach($listsToDelete as $toDelete){
            try {
              ListaPrecios::delete($toDelete['id']);
              PreciosProductos::deleteByListId($toDelete['id']);
              $successOperation = true;
            } catch (Exception $e) {
              $successOperation = false;
              $errorMessage = $e->getMessage();
            }
          }
        }

        if ($successOperation){
          ListaPrecios::commit();
          echo json_encode(['status' => true, 'msg' => 'Sincronización de listas de precios exitosa!']);

        } else{
          ListaPrecios::rollBack();
          echo json_encode(['status' => false, 'msg' => $errorMessage]);
        }

        wp_die();

    }

  
}

$listaPreciosController = new ListaPreciosController();

?>
