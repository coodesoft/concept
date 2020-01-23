<?php
namespace modules;

class BaseModule {

    protected $basePath = '/modules/';

    protected $modulePath;

    private function createRelativePath(){

        $path = isset($this->modulePath) ? $this->modulePath : '';
        $path .= '/js/';

        return $path;
    }

    protected function registerJSAssets($assetNames = null){

        if (!$assetNames)
            return;

        $assets = is_array($assetNames) ?  $assetNames : [$assetNames];

        $count = count($assets);
        for($t=0 ; $t<$count; $t++){
            $pathToAsset = $this->createRelativePath() . $assets[$t] . '.js';
            wp_register_script('gs-'.$assets[$t], plugins_url($pathToAsset, __FILE__), array('jquery'), '1.0', true);
            wp_enqueue_script('gs-'.$assets[$t]);
        }
    }

    protected function registerCSSAssets($styleName = null){
        //TODO: implementar el agregado de estilos
    }

    /************************************** PUBLIC FUNCTION ***********************************/

    public function __construct($assets = null, $styles = null){
        $this->registerJSAssets($assets);
        $this->registerCSSAssets($styles);
    }
}

?>
