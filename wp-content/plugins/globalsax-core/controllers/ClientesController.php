<?php

class ClientesController {

    public function __construct(){
        add_action('wp_ajax_get_sincronizar_cliente', array($this, 'sincronizar') );
    }

    public function sincronizar(){
        $successOperation = false;
        $errorMessage = '';
        
        //$wsNormalizedClients = [];
        
        $jsonClients = Requester::get('Client');
        $clients = json_decode($jsonClients, true);

        $storedClients = Clientes::getAll();
        $storedPriceLists = ListaPrecios::getAll();
        
        $criteria = new ClientesCriteria();
        $listaCriteria = new ListaPreciosCriteria();
        
        Clientes::transaction();
        foreach($clients as $client){
            $client = array_change_key_case($client, CASE_LOWER);
            
            //$wsNormalizedClients[] = $client;

            $criteria->prepare($client);
            $stored = Filter::filterArrayElement($storedClients, $criteria);
            if (!$stored){
                
                try{
                    $result = Clientes::add($client);
                    if($result['status']){
                        /*
                         * Vinculo las listas de precios al cliente 
                         */
                        $priceLists = $client['pricelist'];
                        foreach($priceLists as $listName){

                            $listaCriteria->prepare(['name' => $listName]);
                            $list = Filter::filterArrayElement($storedPriceLists, $listaCriteria);

                            if ( $list ){
                                $data = [
                                    'client_id' => $client['client_id'], 
                                    'list_id' => $list['id']
                                ];
                                ListaPreciosCliente::add($data);    
                            }

                        }
                         /*
                         * Agrego y vinculo sucursales con listas de precios existentes
                         */                   
                        $sucursales = array_change_key_case($client['sucs'], CASE_LOWER);
                        foreach($sucursales as $sucursal){

                            $result = Sucursal::add($sucursal);
                            //retorna status=true si la pudo agregar o si ya existía.
                            if ($result['status']){

                                $listasPreciosSucursales = array_change_key_case($sucursal['pricelist'], CASE_LOWER);
                                foreach($listasPreciosSucursales as $listaPrecioSucName){
                                    $listaCriteria->prepare(['name' => $listaPrecioSucName]);
                                    $list = Filter::filterArrayElement($storedPriceLists, $listaCriteria);

                                    //si existe la lista de precios, hago la vinculación con la sucursal
                                    if ($list){
                                        $data = [
                                            'sucursal_id' => $result['insert_id'],
                                            'list_id' => $list['id'],
                                        ];
                                        ListaPreciosSucursal::add($data);

                                    }
                                }

                            } 
                        }

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


}

$clientesController = new ClientesController();

?>
