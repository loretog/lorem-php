<?php 
	
	error_reporting(E_ALL|E_STRICT);
	session_start();
	date_default_timezone_set("Asia/Manila");

	define('ROOT', realpath(dirname(__FILE__))); // absolute path of the directory
	$dir = ((dirname($_SERVER['PHP_SELF']) == "/") ? "" : dirname($_SERVER['PHP_SELF']));
	define('DIR', $dir); // directory name
	define('URL', (isset($_SERVER['HTTPS']) ? $_SERVER['HTTPS'] : "http://") . $_SERVER['SERVER_NAME'] . DIR); // absolute URL of the site
	define('DS', DIRECTORY_SEPARATOR);			
	
	include ROOT . DS . "load_init.php";
	
	$registry = new Registry();				
	
	$registry->db = new Db();
	
	$registry->route = new Route($registry);
	
	$registry->template = new Template($registry);
	
	$registry->route->load(); // where live! go!!!
	
	$registry->db->close();	
	
	unset($registry); // trashing