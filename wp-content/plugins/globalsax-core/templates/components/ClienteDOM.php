<?php

// TODO: corregir el html  porque es copia de SucursalDOM
class ClienteDOM {
    
    
    static function selector($clientes){ ?>
       
        <div id="clienteSelection cuatrocol" style="margin-right:1%">
            <div>Seleccione la Razón Social:</div>
            <div id="clientesList">
                <select name="cliente_id" id ="cliente_id" required>
                    <option  value="" disabled selected>Seleccione una Razón Social</option>
                    <?php foreach ($clientes as $key => $cliente) { ?>
                        <option value="<?php echo $cliente['id']; ?>"><?php echo $cliente['name']?></option>
                    <?php }?>
                </select>
            </div>
        </div>       
        
    <?php }
}

?>