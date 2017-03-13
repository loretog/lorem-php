<?php		

if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' );

	$DB = new mysqli( DBHOST, DBUSER, DBPASS, DBNAME ); 

	$_SESSION[ 'MESSAGE' ] = null;	