<?php 
	
	error_reporting(E_ALL);
	session_start();
	date_default_timezone_set("Asia/Manila");

	define( 'ROOT_DIR', realpath(dirname(__FILE__)) ); // absolute path of the directory	
	define( 'DIR', ( ( dirname( $_SERVER[ 'PHP_SELF' ] ) == "/" ) ? "" : dirname( $_SERVER['PHP_SELF']) ) ); // directory name
	define( 'SITE_URL', ( isset($_SERVER['HTTPS']) ? $_SERVER['HTTPS'] : "http://") . $_SERVER['SERVER_NAME'] . ( isset( $_SERVER[ 'SERVER_PORT' ] ) ? ":" . $_SERVER[ 'SERVER_PORT' ] : "") . DIR ); // absolute URL of the site
	define('DS', DIRECTORY_SEPARATOR);
	define( 'ACCESS', true );		

	require 'config.php';	
	require 'init.php';
	require 'functions.php';	
	require 'authentication.php';	
	require 'actions.php';			

	if( isset( $_GET[ 'page' ] ) && !empty( $_GET[ 'page' ] ) ) {
		if( file_exists( ROOT_DIR . '/pages/' . $_GET[ 'page' ] . ".php" ) ) {
			require ROOT_DIR . '/pages/' . $_GET[ 'page' ] . ".php";
		} else {
			require ROOT_DIR . '/pages/404.php';
		}
	} else {
		require ROOT_DIR . '/pages/default.php';
	}	 