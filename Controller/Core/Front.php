<?php 

namespace Controller\Core;
class Front{
    public static function init(){
        $request = \Mage::getModel('Model\Core\Request');
        $controllerName = ucfirst($request->getControllerName());
        $actionName = $request->getActionName().'Action';
        $controllerName = 'Controller\Admin\\'.$controllerName;
        $controller = new $controllerName();
        $controller->$actionName();
    }
}


?> 