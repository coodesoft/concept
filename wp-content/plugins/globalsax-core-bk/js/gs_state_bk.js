var StateBK = (function($){

  var instance;

  function StateBK(){
      let self = this;

      self.NO_SUCURSALES        = 'BK10000';

      self.LIST_SUCURSALES      = 'BK10001';

      self.SINGLE_SUCURSAL      = 'BK10002';

      self.SINGLE_PRICELIST     = 'BK20000';

      self.MULTIPLE_PRICELIST   = 'BK20001';

      self.UPDATE_PRICELIST     = 'BK30000';

      self.PARAM_ERROR          = 'BK70000';

  }

  return {
    getInstance: function(){
      if (!instance)
        instance = new StateBK();
      return instance;
    }
  }

})(jQuery);
