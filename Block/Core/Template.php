<?php
namespace Block\Core;
class Template{
    private $children = [];
    private $template = null;
    protected $controller = null;
    protected $message = null;
    protected $request = null;
    protected $url = null;
    protected $tabs = [];
    protected $defaultTab = null;

    public function __construct(){
        
    }

    public function createBlock($className){
        return \Mage::getBlock($className);
    }
    
    public function setTemplate($template){
        $this->template = $template;
        return $this;
    }
    public function getTemplate(){
        if(!$this->template){
            $this->setTemplate();
        }
        return $this->template;
    }

    public function setController(\Controller\Core\Admin $controller){
        $this->controller = $controller;
        return $this;
    }
    public function getController(){
        return $this->controller;
    }

    public function toHtml(){
        ob_start();
        require_once $this->getTemplate();
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
    
    public function getChildren(){
        return $this->children;
    }
    public function setChildren(array $children = []){
        $this->children = $children;
        return $this;
    }
    public function addChild($child, $key = null){
        if(!$key){
            $key = get_class($child);
        }
        $this->children[$key] = $child;
        return $this;
    }
    public function getChild($key){
        if(!array_key_exists($key,$this->children)){
            return null;
        }
        return $this->children[$key];
    }
    public function removeChildren($key){
        if(!array_key_exists($key,$this->children)){
            unset($this->childern[$key]);
        }
        return $this;
    }

    public function setRequest($request = NULL)
    {
        if(!$request){
            $request = \Mage::getModel('Model\Core\Request');
        }
        $this->request = $request;
    }
    public function getRequest(){
        if(!$this->request){
           $this->setRequest(); 
        }
        return $this->request;
        
    }

    public function setMessage($message = null){
		$this->message =  \Mage::getModel('Model\Admin\Message');
		return $this;
	}
	public function getMessage(){
		if(!$this->message){
			$this->setMessage();
		}
		return $this->message;
	}

    public function setUrl($url = null){
        if(!$url){
            $url = \Mage::getModel('Model\Core\Url');
        }
        $this->url = $url;
        return $this;
    }
    public function getUrl() {
        if(!$this->url){
            $this->setUrl();
        }
        return $this->url;
    }

    public function baseUrl($subUrl = null){
        return $this->getUrl()->baseUrl($subUrl);
    }

    public function setDefaultTab($defaultTab){
        $this->defaultTab = $defaultTab;
        return $this;
    }
    public function getDefaultTab(){
        if(!$this->defaultTab){
            $this->setDefaultTab();
        }
        return $this->defaultTab;
    }
    public function setTabs(array $tabs= []){
        $this->tabs = $tabs;
        return $this;
    }
    public function getTabs($key = null){
        if($key){
            if(array_key_exists($key, $this->tabs)){
                return $this->tabs[$key];
            }
        }
        else{
            return $this->tabs;
        }
    }
    public function addTab($key, $tab = []){
        $this->tabs[$key] = $tab;
        return $this;
    }

    // public function getTab($key){
    //     if(!array_key_exists($key, $this->tabs)){
    //         return null;
    //     }
    //     return $this->tabs[$key];
    // }

    public function removeTab($key){
        if(array_key_exists($key, $this->tabs)){
            unset($tabs[$key]);
        }
    }
}

?>