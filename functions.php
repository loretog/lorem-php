<?php

if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' );

function element( $el ) {	
	include ROOT_DIR . "/elements/$el.php";
}

function set_message( $msg ) {
	$_SESSION[ 'MESSAGE' ] = $msg; 
}

function show_message() {
	echo "<div class='alert'>" . $_SESSION[ 'MESSAGE' ] . "</div>";	
	$_SESSION[ 'MESSAGE' ] = null;	
}

function redirect( $page ) {
	header( "Location: " . SITE_URL . "/?page=$page" );
	exit;
}

function has_access( $user, $page ) {
	global $restricted_pages;	

	return isset( $restricted_pages[ $user ][ 'access' ][ $page ] );
}

function all_records( $name, $fields = "*" ) {
	global $DB;
	return $DB->query( "SELECT $fields FROM $name" );
}

function add_table( $name, $fields = [] ) {
	global $DB;

	if( ( isset( $name ) && isset( $fields ) ) && !empty( $name ) && !empty( $fields ) && is_array( $fields ) ) {
		$cols = implode( " , ", array_keys( $fields ) );
		$vals = "'" . implode( "' , '", array_values( $fields ) ) . "'";
		$sql = "INSERT INTO $name ( $cols ) VALUES( $vals )";
		return $DB->query( $sql );
	} else {
		return false;
	}
}

function clean( $string, $space = false ) {
	if( $space )
  	$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

  return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

/* ADD YOUR CUSTOM FUNCTIONS IN custom_functions.php */
require 'custom_functions.php';