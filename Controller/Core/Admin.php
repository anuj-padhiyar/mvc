<?php 

namespace Controller\Core;
class Admin{
	protected $request = null;
    protected $layout = null;
	protected $message = null;
	protected $filter = null;

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


    public function redirect($actionName = NULL, $controllerName = NULL, $params = [] , $resetParams = False)
    {
        header("location:" . $this->getUrl($actionName, $controllerName,$params,$resetParams));
    }

    public function getUrl($actionName = NULL, $controllerName = NULL, $params = [] , $resetParams = False)
    {
        $final = $this->getRequest()->getGet();

		if ($resetParams){
			$final = [];
		}
		if ($actionName == NULL){
			$actionName = $this->getRequest()->getGet('a');
		}
		if ($controllerName == NULL){
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

	public function setFilter($filter = null){
		$this->filter =  \Mage::getModel('Model\Admin\Filter');
		return $this;
	}
	public function getFilter(){
		if(!$this->filter){
			$this->setFilter();
		}
		return $this->filter;
	}

	public function makeResponse($block){
		$response = [
			'status' => 'success',
			'message' =>'this is grid action.',
			'element' =>[
				'selector' =>'#contentHtml',
				'html' =>$block
			]
		];
		header("Content-Type: application/json");
		echo json_encode($response);
	}
}
?>