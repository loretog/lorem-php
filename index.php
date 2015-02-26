<?php 
	
	error_reporting(E_ALL);
	session_start();
	date_default_timezone_set("Asia/Manila");

	define('ROOT', realpath(dirname(__FILE__))); // absolute path of the directory
	$dir = ((dirname($_SERVER['PHP_SELF']) == "/") ? "" : dirname($_SERVER['PHP_SELF']));
	define('DIR', $dir); // directory name
	define('URL', (isset($_SERVER['HTTPS']) ? $_SERVER['HTTPS'] : "http://") . $_SERVER['SERVER_NAME'] . DIR); // absolute URL of the site
	define('DS', DIRECTORY_SEPARATOR);

	require 'config.php';
	require 'init.php';

	if( isset( $_GET ) && !empty( $_GET ) ) {
		if( file_exists( './pages/' . $_GET[ 'page' ] . ".php" ) ) {
			require './pages/' . $_GET[ 'page' ] . ".php";
		} else {
			require './pages/404.php';
		}
	} else {
		require './pages/default.php';
	}	