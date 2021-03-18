<?php 

namespace Controller\Core;
\Mage::loadFileByClassName("Model\Core\Request");

class Front{
    public static function init(){
        $request = \Mage::getModel('Model\Core\Request');
        $controllerName = ucfirst($request->getControllerName());
        $actionName = $request->getActionName().'Action';
        $controllerName = 'Controller\Admin\\'.$controllerName;
        
        \Mage::loadFileByClassName($controllerName);
        $controller = new $controllerName();
        $controller->$actionName();
    }
}


?> 