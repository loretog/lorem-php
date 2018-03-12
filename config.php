<?php

if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' );

define( 'DBHOST', 'localhost' );
define( 'DBUSER', 'root' );
define( 'DBPASS', '' );
define( 'DBNAME', 'mysite' );

/* 
NOTE:
ONLY SET THESE IF YOU WANT TO ALLOW AUTHENTICATION 
IF NOT THEN JUST COMMENT THEM OUT 
*/

define( 'AUTH_ID', 'userid' );
define( 'AUTH_NAME', 'username' );
define( 'AUTH_TYPE', 'usertype' );

/*
	TO USE:
		To add restricted pages, just uncomment the variable $restricted_pages,
		each array elements are page names found in your pages folder.
		When added, these pages will not be accessible unless the SESSION AUTH_ID
		is assigned with a value.
*/
//$restricted_pages = array( "payments", "shop", "users", "products" );