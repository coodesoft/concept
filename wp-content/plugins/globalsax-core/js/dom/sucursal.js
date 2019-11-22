var SucursalDOM = (function($){
    
    var instance;
    
    function SucursalDOM(){
        let self = this;

        self.selector = (params) => {
            let target      = params['target']
            let sucursales  = params['sucursales'];
          //  let client      = params['client'];

            let html = '<div id="sucursalSelection cuatrocol">';

          //  html += '<input id="clientId" type="hidden" name="clientId" value="'+client+'">';
            html += '<div>Seleccione la sucursal:</div>';
            html += '<div id="sucursalesList">';
            html += '<select id="selectSucursal" name="sucursal" required>';
            html += '<option value="" disabled selected>Seleccione una sucursal</option>';

            for(let t=0; t<sucursales.length; t++){
                let sucursal = sucursales[t];
                html += '<option value="'+sucursal['id']+'">'+sucursal['sucursal']+'</option>';
            }

            html += '</select></div></div>';


            $(target).html(html);                    
        }
    
        self.noSucursal = () => {
            return '<input type="hidden" name="sucursal" value="gbs_noSucursal">'
        }        
    }
    
    return {
        getInstance: function(){
          if (!instance)
            instance = new SucursalDOM();
          return instance;
        }
    }   
        
    
})(jQuery);