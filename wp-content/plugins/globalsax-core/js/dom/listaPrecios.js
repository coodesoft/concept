var ListaPreciosDOM = (function($){

    var instance;

    function ListaPreciosDOM(){
        let self = this;

        self.selector = (params) => {
            let target      = params['target']
            let listas  = params['listas'];

            let html = '<div class="listaPreciosSelection cuatrocol">';

            html += '<div>Seleccione la lista de precios:</div>';
            html += '<div id="listaPreciosList">';
            html += '<select id="selectListaPrecios" name="priceList" required>';
            html += '<option value="" disabled selected>Seleccione una lista de precios</option>';

            for(let t=0; t<listas.length; t++){
                let lista = listas[t];
                html += '<option value="'+lista['list_id']+'">'+lista['name']+'</option>';
            }

            html += '</select></div></div>';


            $(target).html(html);
        }

        self.noListaPrecios = () => {
            return '<input type="hidden" name="sucursal" value="gbs_noSucursal">'
        }
    }

    return {
        getInstance: function(){
          if (!instance)
            instance = new ListaPreciosDOM();
          return instance;
        }
    }


})(jQuery);
