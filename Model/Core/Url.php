<?php
namespace Model\Core;
\Mage::loadFileByClassName("Model\Core\Request");

class Url
{
	protected $request=null;

	function __construct(){
		$this->setRequest();
	}

	public function setRequest(){
        $this->request = \Mage::getModel('Model\Core\Request');
        return $this;
    }

    public function getRequest(){
        return $this->request;
    }

    public function getUrl($actionName = NULL, $controllerName = NULL, $params = [] , $resetParams = False){
        $final = $this->getRequest()->getGet();

        if ($resetParams) {
           $final = [];
        }
        if ($actionName == NULL) {
            $actionName = $this->getRequest()->getGet('a');
        }
        if ($controllerName == NULL) {
            $controllerName = $this->getRequest()->getGet('c');
        }
        $final['c'] = $controllerName;
        $final['a'] = $actionName;
       
        $final = array_merge($final,$params);
        $queryString = http_build_query($final);
        unset($final);

        return "http://localhost/phpCode/Session3_Php/MVC/index.php?{$queryString}";
    }
    public function baseUrl($subUrl = null){
        $url = "http://localhost/phpCode/Session3_Php/MVC/";
        if($subUrl){
            $url .= $subUrl;
        }
        return $url;
    }
}
?>