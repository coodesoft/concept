<?php

class ClientesController {

    public function __construct(){
        add_action('wp_ajax_get_sincronizar_clientes', array($this, 'sincronizar') );
    }

    public function sincronizar(){
        $successOperation = false;
        $errorMessage = '';

        $jsonClients = Requester::get('Client');
        $clients = json_decode($jsonClients, true);

        $storedClients = Clientes::getAll();

        Clientes::transtaction();
        foreach($clients as $client){
            $client = array_change_key_case($client, CASE_LOWER);

            $stored = Clientes::getByClientId($client['client_id']);
            if (!$stored){
                
                $result = Clientes::add($client);
                if($result['status']){
                    ListaPreciosCliente::add($client['pricelist']);
                    $sucursales = array_change_key_case($client['sucs'], CASE_LOWER);
                    
                    foreach($sucursales as $sucursal){
                        $result = Sucursal::add($sucursal);
                        if ($result['status']){
                            $listasPreciosSucursales = array_change_key_case($sucursal['pricelist'], CASE_LOWER);
                            foreach($listasPreciosSucursales as $listaPrecioSuc){
                                $list = ListaPrecios::getByName($listaPrecioSuc);
                                ListaPreciosSucursal::add($list);
                            }
                        } 
                    }
                } else{
                    $successOperation = false;
                    break;
                } 
            }
        }

        if ($successOperation){
            Clientes::commit();
            echo 'Todo pio';
        }else{
            Clientes::rollBack();
            echo 'Cagamos la verga';
        }
        
        wp_die();
        
    }


}

?>