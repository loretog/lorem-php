<?php

Abstract Class Controller
{
	public $registry;
	public $db;
	public $template;
	public function __construct(&$registry) {
		$this->registry = $registry;		
		$this->db = $registry->db;
		$this->template = $registry->template;
	}
	public function getReg() {
		return $this->registry;
	}
	public function page404() { 
		//$this->template->render('page404'); 
	}
	public function login() {
		echo $this->registry->controller;
		if(!empty($_POST)) {
			$username = $_POST['Username'];
			$password = $_POST['Password'];
			$admins = $this->db->query("select * from admins where username='$username' and password='" . md5($password) . "'");			
			if($admins->num_rows) {
				$admin = $admins->fetch_object();
        $_SESSION['admin_id'] = $admin->id;
				$_SESSION['admin'] = $username;	
				$_SESSION['admin_role'] = $admin->group_id;	
				header("Location: " . DIR . "/");
				exit;
			} else {
				$_SESSION['message'] = 'Invalid Login. User not found or Username and Password does not match.';
				header("Location: " . DIR . "/home/login");
				exit;
			}
		} else {
			//$this->template->render('login');
		}		
	}
	public function logout() {
		session_destroy();
		header("Location: " . DIR . "/");
	}
	Abstract function index();
}