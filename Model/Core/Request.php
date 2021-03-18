<?php
namespace Model\Core;

class Request
{
	public function getPost($key=NULL,$option=NULL)
	{
		if (!$key) {
			return $_POST;
		}
		if (!array_key_exists($key, $_POST)) {
			return $option;
		}
		return $_POST[$key];
	}

	public function getGet($key=NULL,$option=NULL)
	{
		if (!$key) {
			return $_GET;
		}
		if (!array_key_exists($key, $_GET)) {
			return $option;
		}
		return $_GET[$key];
	}

	public function isPost(){
		if ($_SERVER['REQUEST_METHOD'] != 'POST') {
			return false;
		}
		return true;
	}

	public function isGet(){
		if ($_SERVER['REQUEST_METHOD'] != 'GET') {
			return false;
		}
		return true;
	}

	public function getActionName()
	{
		return $this->getGet('a','index');
	}

	public function getControllerName()
	{
		return $this->getGet('c','index');
	}

}


?>