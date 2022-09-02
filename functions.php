<?php

if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' );

function element( $el ) {	
	include ROOT_DIR . "/elements/$el.php";
}

function has_message() {
	return isset( $_SESSION[ 'MESSAGE' ] ) && !empty( $_SESSION[ 'MESSAGE' ] );
}

function set_message( $msg, $type = "success" ) {
	$_SESSION[ 'MESSAGE' ] = $msg; 
	$_SESSION[ 'MESSAGE_TYPE' ] = $type; 
}

function show_message() {		
	if( isset( $_SESSION[ 'MESSAGE' ] ) && !empty( $_SESSION[ 'MESSAGE' ] ) ) {
		echo "<div class='alert alert-" . $_SESSION[ 'MESSAGE_TYPE' ] . " m-2'>" . $_SESSION[ 'MESSAGE' ] . "</div>";	
		unset( $_SESSION[ 'MESSAGE' ] );	
		unset( $_SESSION[ 'MESSAGE_TYPE' ] );
	}
}

function redirect( $page = "", $q = "" ) {
	header( "Location: " . SITE_URL . "/?page=$page" . ( !empty( $q ) ? '&' . $q : '' ) );
	exit;
}

function get_page() {	
	global $restricted_pages;
	if( isset( $_GET[ 'page' ] ) && !empty( $_GET[ 'page' ] ) ) {
		$page = $_GET[ 'page' ];
		if( file_exists( ROOT_DIR . DS . 'pages' . DS . $page . ".php" ) ) {
			return $page;
		} else {
			return '404';
		}
	} else {	
		if( isset( $_SESSION[ AUTH_TYPE ] ) && !empty( $_SESSION[ AUTH_TYPE ] ) ) {
			return $restricted_pages[ $_SESSION[ AUTH_TYPE ] ][ 'default_page' ];
		} else {
			return $restricted_pages[ 'default' ][ 'default_page' ];
		}		
	}	 
}

function has_access( $redirect = false ) {
	global $restricted_pages;	
	$page = clean( isset( $_GET[ 'page' ] ) && !empty( $_GET[ 'page' ] ) ? $_GET[ 'page' ] : 'default' );	
	if( isset( $_SESSION[ AUTH_ID ] ) ) { 						
		if( isset( $_REQUEST[ 'action' ] ) ) return;		 		
		$type = clean( isset( $_SESSION[ AUTH_TYPE ] ) && !empty( $_SESSION[ AUTH_TYPE ] ) ? $_SESSION[ AUTH_TYPE ] : 'default' );				
		$page = clean( isset( $_GET[ 'page' ] ) && !empty( $_GET[ 'page' ] ) ? $_GET[ 'page' ] : $restricted_pages[ $type ][ 'default_page' ] );			
		if( isset( $restricted_pages ) && !empty( $restricted_pages ) ) {					
			if( isset( $restricted_pages[ $type ] ) && !empty( $restricted_pages[ $type ] ) ) {										
				if( isset( $page ) && !empty( $page ) ) {											
					if( array_search( $page, $restricted_pages[ $type ][ 'access' ] ) === false && ( $page != LOGIN_REDIRECT && $restricted_pages[ $type ][ 'default_page' ] != $page ) ) {										
						// no access, either redirect to a page or return false							
						if( $redirect ) {					
							set_message( "You have no access to page <span class='fw-bold'>$page</span>", "warning" );
							redirect( $restricted_pages[ $type ][ 'default_page' ] );
						}	else {							
							return false;
						}
					} else {						
						return true;				
					}
				}
			} else {
				set_message( "User type is not found.", "warning" );
				unset( $_SESSION[ AUTH_ID ] );
				unset( $_SESSION[ AUTH_NAME ] );
				unset( $_SESSION[ AUTH_TYPE ] );
				redirect();
			}
		}
	} else {			
		if( isset( $restricted_pages ) && !isset( $_SESSION[ AUTH_ID ] )) {					
			if( array_search( $page, $restricted_pages[ 'default' ][ 'access' ] ) === false ) {
				redirect(LOGIN_REDIRECT);
			}			
			
		} 
	}
}

function is_usertype( $check_type ) {
	if( $_SESSION[ AUTH_TYPE ] == $check_type ) {
		return true;
	} else {
		return false;
	}
}

function has_action() {

}

function all_records( $name ) {
	global $DB;
	return $DB->query( "SELECT * FROM $name" );
}

function add_record( $name, $fields = [] ) {
	global $DB;

	if( ( isset( $name ) && isset( $fields ) ) && !empty( $name ) && !empty( $fields ) && is_array( $fields ) ) {
		$cols = implode( " , ", array_keys( $fields ) );
		$x = [];
		foreach( array_values( $fields) as $a) {
			$x[] = $DB->real_escape_string($a);
		}
		$vals = "'" . implode( "' , '", array_values( $x)) . "'";
		$sql = "INSERT INTO $name ( $cols ) VALUES( $vals )";
		//echo $sql; exit;
		$DB->query( $sql );
		return $DB->insert_id;
	} else {
		return false;
	}
}

// sample
// update_record( "persons", [ 'key' => 'id', 'val' => $_POST[ 'id' ] ], $_POST[ 'data' ] )
function update_record( $name, $id, $fields = [] ) {
	global $DB;

	if( ( isset( $name ) && isset( $fields ) ) && !empty( $name ) && !empty( $fields ) && is_array( $fields ) ) {

		$f = [];

		foreach ( $fields as $key => $value ) {
			$f[] = "$key='" . $DB->real_escape_string($value) . "'";
		}
		$f = implode( ",", $f );	
		$sql = "UPDATE $name SET $f WHERE {$id['key']}={$id['val']}";
		//echo $sql; exit;
		return $DB->query( $sql );
	} else {
		return false;
	}
}

function delete_record( $tbname, $id, $idval ) {
	global $DB;
	return $DB->query( "DELETE FROM $tbname WHERE $id = $idval" );
}

function clean( $string, $space = false ) {
	if( !empty( $string ) ) {
		if( $space ) {
		  $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
		}

  		return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	} else {
		return null;
	}
}

function generateRandomString($length = 10) {
	return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length) . "-" . rand( 10, 99 );
}

function log_errors( $message ) {
	//error_log( date( "Y-m-d h:i A" ) . ": $message - {$_SERVER["REQUEST_URI"]}\n", 3, ROOT_DIR . DS . "error_logs.txt");
	global $DB;
	$DB->query( "INSERT INTO error_logs1 (message) VALUES('$message')" );
}
/* ADD YOUR CUSTOM FUNCTIONS IN custom_functions.php */
require 'custom_functions.php';
