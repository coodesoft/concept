<?php
namespace modules;

class BaseModule {

    protected $basePath = '/modules/';

    protected $modulePath;

    private function createRelativePath(){

        $path = isset($this->modulePath) ? $this->modulePath : '';
        return $path;
    }

    protected function registerJSAssets($assetNames = null){

        if (!$assetNames)
            return;

        $assets = is_array($assetNames) ?  $assetNames : [$assetNames];

        $count = count($assets);
        for($t=0 ; $t<$count; $t++){
            $pathToAsset = $this->createRelativePath() ."/js/". $assets[$t] . '.js';
            wp_register_script('gs-JS-'.$assets[$t], plugins_url($pathToAsset, __FILE__), array('jquery'), '1.0', true);
            wp_enqueue_script('gs-JS-'.$assets[$t]);
        }
    }

    protected function registerCSSAssets($styleNames = null){
        if (!$styleNames)
            return;

        $styles = is_array($styleNames) ?  $styleNames : [$styleNames];

        $count = count($styles);
        for($t=0 ; $t<$count; $t++){
            $pathToStyle = $this->createRelativePath() . '/css/'. $styles[$t] . '.css';
            wp_register_style('gs-CSS-'.$styles[$t], plugins_url($pathToStyle, __FILE__), array(), '1.0', 'screen');
            wp_enqueue_style('gs-CSS-'.$styles[$t]);
        }
    }

    /************************************** PUBLIC FUNCTION ***********************************/

    public function __construct($assets = null, $styles = null){
        $this->registerJSAssets($assets);
        $this->registerCSSAssets($styles);
    }
}

?>
