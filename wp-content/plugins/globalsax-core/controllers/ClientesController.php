<?php

class ClientesController {

    public function __construct(){
        add_action('wp_ajax_get_sincronizar_cliente', array($this, 'sincronizar') );
    }

    public function sincronizar(){
        $successOperation = true;
        $errorMessage = '';
        
        //$wsNormalizedClients = [];
        
        $jsonClients = Requester::get('Client');
        $clients = json_decode($jsonClients, true);

        $storedClients = Clientes::getAll();
        $storedPriceLists = ListaPrecios::getAll();
        
        $clientCriteria = new ClientesCriteria();
        $listaCriteria = new ListaPreciosCriteria();
        
        Clientes::transaction();
        foreach($clients as $client){
            $client = array_change_key_case($client, CASE_LOWER);
            
            $clientCriteria->prepare($client);
            $stored = Filter::filterArrayElement($storedClients, $clientCriteria);
            if (!$stored){
                
                try{
                    $result = Clientes::add($client);
                    
                    if($result['status']){
                        
                        // Vinculo las listas de precios al cliente 
                        $parcial = static::linkPriceListToClient($storedPriceLists, $client['pricelist'], $client, $listaCriteria);

                        // Agrego y vinculo sucursales con listas de precios existentes
                        $sucursales = array_change_key_case($client['sucs'], CASE_LOWER);
                        static::addSucursales($sucursales, $storedPriceLists, $listaCriteria);

                    } else{
                        $successOperation = false;
                        $errorMessage = 'No se pudo guardar el cliente';
                        break;
                    }                    
                    
                } catch (Exception $e){
                    $successOperation = false;
                    $errorMessage = $e->getMessage();
                    break;
                }


            } else{
                // TO DO: agregar soporte para actualización y borrado
            }
            
        }

        if ($successOperation){
            Clientes::commit();
            echo 'Todo pio';
        }else{
            Clientes::rollBack();
            echo $errorMessage;
        }

        wp_die();

    }

    static function linkPriceListToClient($storedLists, $priceLists, $client, $criteria){
        
        foreach($priceLists as $listName){

            $criteria->prepare(['name' => $listName]);
            $list = Filter::filterArrayElement($storedLists, $criteria);

            if ( $list ){
                $data = [
                    'client_id' => $client['client_id'], 
                    'list_id' => $list['id']
                ];
                ListaPreciosCliente::add($data);    
            }
        }
    }
    
    static function linkPriceListToSucursal($listasPrecios, $storedPriceLists, $criteria, $id){
        
        foreach($listasPrecios as $listaPrecioSucName){
            $criteria->prepare(['name' => $listaPrecioSucName]);
            $list = Filter::filterArrayElement($storedPriceLists, $criteria);

            //si existe la lista de precios, hago la vinculación con la sucursal
            if ($list){
                $data = [
                    'sucursal_id' => $id,
                    'list_id' => $list['id'],
                ];
                ListaPreciosSucursal::add($data);
            }
        }        
    }
    
    static function addSucursales($sucursales, $storedPriceLists, $criteria){
        $result = true;
        foreach($sucursales as $sucursal){
            $sucursal = array_change_key_case($sucursal, CASE_LOWER);
            $result = Sucursal::add($sucursal);
            //retorna status=true si la pudo agregar o si ya existía.
              
            $listasPreciosSucursales = array_change_key_case($sucursal['pricelist'], CASE_LOWER);
            static::linkPriceListToSucursal($listasPreciosSucursales, $storedPriceLists, $criteria, $result['insert_id'] );
        }
    }
    

}

$clientesController = new ClientesController();

?>