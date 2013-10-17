<?php
Class Template
{	
	private $vars = array();
	private $registry;
	private $layout = null;
	public function __construct(&$registry) {
		$this->DTD = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
		$this->meta_char_set = 'UTF-8';
		$this->meta_desc = 'Iloilo National High School Computerized Enrollement System';
		$this->meta_keywords = 'enrollment';
		$this->meta_author = 'authors';
		$this->css = array('style', 'reset');
		$this->js = array('jquery.min', 'ajax');
		$this->layout = "layout3";	
		
		$this->registry = $registry;
	}
	public function __set($key, $value) {
		$this->vars[$key] = $value;
	}
	public function __get($key) {
		return $this->vars[$key];
	}
	public function render($controller, $action) {		
		foreach($this->vars as $key=>$value) {
			$$key = $value;			
		}
		$file = "";
		if($action == "login") {
			$file = ROOT . DS . "view" . DS . "login.php";
		} elseif($action == "page404") {
			$file = ROOT . DS . "view" . DS . "page404.php";
		}else {
			$file = ROOT . DS . "view" . DS . $controller . DS . $action . ".php";
		}
		if(file_exists($file)) {
			$the_view = $file;
		} else {
			$view_name = $action;
			$the_view = ROOT . DS . "view" . DS . "view_missing.php";
		}			
		include ROOT . DS . "view" . DS . $this->layout . ".php";		
	}
}