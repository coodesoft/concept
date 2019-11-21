<?php



class CheckoutController {
    
    
    public function __construct(){
        add_action('wp_ajax_', array($this, '') );
    }
    
    
    public function calculate(){
        $sucursal = $_POST['sucursal'];
        $client = $_POST['client'];
        
        
    }
}