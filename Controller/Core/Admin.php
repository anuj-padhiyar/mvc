<?php 
namespace Controller\Core;
\Mage::loadFileByClassName("Model\Core\Request");
\Mage::loadFileByClassName("Block\Core\Layout");
\Mage::loadFileByClassName("Block\Core\Template");
class Admin{
	protected $request = null;
    protected $layout = null;
	protected $message = null;

	public function __construct(){
		$this->setRequest();
		$this->setLayout();
	}

	public function setLayout(\Block\Core\Layout $layout=NULL){    
    	if(!$layout){
			$layout= \Mage::getBlock('Block\Core\Layout');
    	}
        $this->layout=$layout;
        return $this;
	}
    public function getlayout(){
    	return $this->layout;
    }

    // public function renderLayout(){
    // 	$this->getLayout()->toHtml();
    // }	

	public function setRequest(){
		$this->request = \Mage::getModel('Model\Core\Request');
		return $this;
	}

	public function getRequest(){
		if(!$this->request){
			$this->setRequest();
		}
		return $this->request;
	}


    public function redirect($actionName = NULL, $controllerName = NULL)
    {
        header("location:" . $this->getUrl($actionName, $controllerName,[],true));
    }

    public function getUrl($actionName = NULL, $controllerName = NULL, $params = [] , $resetParams = False)
    {
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
}
?>