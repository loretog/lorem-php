<?php

class Route
{
	private $controller = null;
	private $action = null;
	private $args = null;	
	private $registry = null;
	
	public function __construct(&$registry) {
		$this->registry = $registry;		
	}
	public function load() {
		$this->getController();		
		$this->registry->template->render($this->controller, $this->action);		
	}
	public function getController() {
		if(isset($_GET['route'])) {
			$segment = explode("/", $_GET['route']);
			$total_segment = count($segment);
			$this->controller = $segment[0];
			$this->action = isset($segment[1]) ? $segment[1] : 'index';
			for($i = 2; $i < $total_segment; $i++) {
				if(isset($segment[$i]) && $segment[$i] != "") $this->args[] = $segment[$i];
			}
		} else {
			$this->controller = 'home'; // go to the homepage	or load the default controller
		}
		$file = ROOT . DS . "controllers" . DS . $this->controller . ".php";
		$controller = null;
		if(file_exists($file)) {
			include $file; // load the controller
		} else { // load error controller
			include ROOT . DS . "controllers" . DS . "error.php"; 
			$this->controller = "error";
			$this->action = "controller_not_found";
		}
		$controller = new $this->controller($this->registry);
		if($this->action == "") { $this->action = 'index'; } // load the default view
		if(!isset($_SESSION['admin'])) { $this->action = 'login'; } // show login form if admin doesn't exist
		if(is_callable(array($controller, $this->action)) == false) {
			$this->action = 'page404'; // let user know that the page doesn't exist
		}				
		
		$this->registry->template->controller = $this->controller;
		$this->registry->template->action = $this->action;
		$action = $this->action;
		
		$admin_role = 0;
		if(isset($_SESSION['admin_role'])) {
			$admin_role = $_SESSION['admin_role'];
		}
		
		$pages = array(0 => array('students' => array('view_grades'), 
															'schedules' => array('view_schedules')), 
									 1 => array(), 
									 2 => array(), 
									 3 => array('payments' => array('pay_balance')), 
									 4 => array()
									);
		
		$controller->$action($this->args);
	}
}