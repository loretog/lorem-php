<?php	
	if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' );
	
	$page = isset( $_GET[ 'page' ] ) && !empty( $_GET[ 'page' ] ) ? $_GET[ 'page' ] : 'default';	

	if( isset( $restricted_pages ) && !empty( $restricted_pages ) ) {		
		if( isset( $page ) && !empty( $page ) ) {										
			if( array_search( $page, $restricted_pages ) !== FALSE ) {							
				if( !isset( $_SESSION[ AUTH_ID ] ) && empty( $_SESSION[ AUTH_ID ] ) ) {					
					header( "Location: ./?page=login" );
					exit;
				}			
			}
		}
	}