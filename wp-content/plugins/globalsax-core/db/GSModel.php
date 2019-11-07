<?php

class GSModel {
    
    const PLUGIN_PREFIX = 'gs_';

    static function getTableName($name){
        global $wpdb;
        return  $wpdb->prefix . static::PLUGIN_PREFIX . $name;
    }
}

?>