(function($){

    let calculatePrices = function(params){
        let target = params['target'];
        if (target != undefined)
            $(target).empty();
        let data = {
            'lista_id' : params['list_id'],
            'action' : 'gs_calculate_prices_by_sucursal',
        };

        $.post(ajaxurl, data, function(response){
            response = JSON.parse(response);
            let state = response['state'];

            if ( state == State.getInstance().UPDATE_PRICELIST ){
                register.notify(response['state'], response['data']);
            } else
                alert('Se produjo un error en el envío de parámetros para calcular el precio de tu perido' + state +" - "+ state.UPDATE_PRICELIST);

        });
    }

    let updatePriceView = function(params){
        let totalPrice = 0;
        for (key in params){
            let target = params[key]['name'].toUpperCase();
            let price = params[key]['price'];
            totalPrice = totalPrice + parseFloat(price);

            console.log(price);
            $('#'+target+" .product-price .price").html('$'+price);
            $('.total-price').html('$'+totalPrice);
        }
    }


    let loadListasPreciosByClient = function(params){
        let data = {
            'client' : params['client'],
            'action' : 'gs_load_pricelist_by_client',
        };


        $.post(ajaxurl, data, function(response){
            response = JSON.parse(response);
            let params = (response['state'] == state.SINGLE_PRICELIST) ?
                         { 'target' : '.priceListTarget', 'list_id' : response['data']['list_id'] } :
                         //state.MULTIPLE_PRICELIST
                         { 'target' : '.priceListTarget', 'listas' : response['data'] };
            console.log(response['state']);
            register.notify(response['state'], params);
        });
    }


    let register = Register.getInstance();
    let state = State.getInstance();

    register.subscribe(state.LIST_SUCURSALES, SucursalDOM.getInstance().selector);
    register.subscribe(state.MULTIPLE_PRICELIST, ListaPreciosDOM.getInstance().selector);
    register.subscribe(state.SINGLE_PRICELIST, calculatePrices);
    register.subscribe(state.UPDATE_PRICELIST, updatePriceView);
    register.subscribe(state.NO_SUCURSALES, loadListasPreciosByClient);


    // se cargan las sucursales dependiendo de la seleccion del cliente.
    $('#clientesList').on('change', '#cliente_id', function(){
        var data = {
	       'client' : this.value,
	       'action' : 'gs_load_sucursales',
        };

        $.post(ajaxurl, data, function(response){
            response = JSON.parse(response);

            let params = (response['state'] == state.LIST_SUCURSALES) ?
                         { 'target' : '.sucursalTarget', 'sucursales' : response['data'] } :
                         { 'targets' : ['.sucursalTarget', '.priceListTarget'], 'client' : data['client'] } ;

            register.notify( response['state'], params );

        });
	});


    // se cargan las listas de precios o se calcula el precio si es unica lista dependiendo de la sucursal
    $('#gbsCheckout').off().on('change', '#selectSucursal', function(){
        var data = {
            'sucursal': this.value,
            'action': 'gs_load_pricelist_by_sucursal',
        };

        $.post(ajaxurl, data, function(response){
            response = JSON.parse(response);

            let params = (response['state'] == state.SINGLE_PRICELIST) ?
                         { 'target' : '.priceListTarget', 'list_id' : response['data']['list_id'] } :
                         //state.MULTIPLE_PRICELIST
                         { 'target' : '.priceListTarget', 'listas' : response['data'] };

            register.notify(response['state'], params);
        });
    });

    $('#gbsCheckout').on('change',  '#selectListaPrecios', function(){
         var data = {
            'list_id': this.value,
        };
        register.notify(state.SINGLE_PRICELIST, data);
    });


})(jQuery);