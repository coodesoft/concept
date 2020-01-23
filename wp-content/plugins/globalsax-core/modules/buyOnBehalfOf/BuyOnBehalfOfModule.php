<?php
use modules\BaseModule;

class BuyOnBehalfOfModule extends BaseModule{

    protected $modulePath = 'buyOnBehalfOf';

    public function __construct(){
        parent::__construct('buyOnBehalfOf');
    }
}

$buyOnBehalf = new BuyOnBehalfOfModule();
?>
