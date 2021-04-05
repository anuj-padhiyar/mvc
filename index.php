<?php

spl_autoload_register(function($className){
    $className = str_replace('\\','/',$className);
	$filename = $className . ".php";
	if (file_exists($filename)) {
		require $filename;  
	}
});

class Mage
{
    public static function init(){
        Controller\Core\Front::init();
    }

    public static function getController($className){
        $className = self::prepareClassName($className);
        return new $className();
    }

    public static function getBlock($className)
    {
        $className = self::prepareClassName($className);
        return new $className;
    }

    public static function getModel($className)
    {
        $className = self::prepareClassName($className);
        return new $className;
    }
    
    public static function prepareClassName($className){
        $className = str_replace('\\',' ',$className);
        $className = ucwords($className);
        $className = str_replace(' ','\\',$className);
        return $className;
    }
}
\Mage::init();

?>