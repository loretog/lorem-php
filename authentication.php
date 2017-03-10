<?php

	if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' );
	$page = isset( $_GET[ 'page' ] ) && !empty( $_GET[ 'page' ] ) ? $_GET[ 'page' ] : 'default';	
	if( ( isset( $restricted_pages ) && !empty( $restricted_pages ) ) && 
		( !isset( $_SESSION[ AUTH_NAME ] ) && empty( $_SESSION[ AUTH_NAME ] ) ) &&
		( array_search( $page, $restricted_pages ) !== FALSE ) 
	) {		
		header( "Location: " . SITE_URL );
		exit;
	}