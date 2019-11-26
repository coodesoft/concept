<?php

class SucursalDOM {
    
    
    static function selector($sucursales = null){
        
        if ($sucursales){ ?>
            <div class="sucursalTarget">
                <div class="sucursalSelection cuatrocol">
                    <div>Seleccione la sucursal:</div>
                    <div id="sucursalesList">
                    <select id="selectSucursal" name="sucursal" required>
                        <option value="" disabled selected>Seleccione una sucursal</option>
                        <?php foreach($sucursales as $sucursal) { ?>
                            <option value="<?php echo $sucursal['id'] ?>"><?php echo $sucursal['sucursal']?></option>
                        <?php } ?>
                    </select>
                    </div>
                </div>
            </div>
            
        <?php } else{ ?>
            <div class="sucursalTarget"></div>
        <?php }
    }
}

?>