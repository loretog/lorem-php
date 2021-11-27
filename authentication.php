<?php	
	if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' );
	
/* 	$page = clean( isset( $_GET[ 'page' ] ) && !empty( $_GET[ 'page' ] ) ? $_GET[ 'page' ] : 'default' );
	$type = clean( isset( $_SESSION[ AUTH_TYPE ] ) && !empty( $_SESSION[ AUTH_TYPE ] ) ? $_SESSION[ AUTH_TYPE ] : 'default' );

	if( isset( $restricted_pages ) && !empty( $restricted_pages ) ) {				
		if( isset( $page ) && !empty( $page ) ) {	
			if( array_search( $page, $restricted_pages[ $type ] ) === false && $page != LOGIN_REDIRECT ) {				
				redirect( LOGIN_REDIRECT );
			}
		}
	} */

	/* if( ! has_access() ) {
		redirect( LOGIN_REDIRECT );
	} */

	has_access( true );