<?php	

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
|
| Here is where you can register all the pages you want to allow for your web application. These
| page authentication giving you access in all "pages" which
| depends in every "Usertype". Now create more authentication pages!
|
*/

/*
|--------------------------------------------------------------------------
| TO USE:
|--------------------------------------------------------------------------
|
| To add restricted pages, just uncomment the variable $restricted_pages,
| each array elements are page names found in your pages folder.
| When added, these pages will not be accessible unless the SESSION AUTH_ID
| is assigned with a value.
|
*/

/*
|--------------------------------------------------------------------------
| NOTE:
|--------------------------------------------------------------------------
|
| ONLY SET THESE IF YOU WANT TO ALLOW AUTHENTICATION. IF NOT THEN JUST COMMENT THEM OUT
|
*/


if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' );

// table columns found in your 'users' table
define( 'AUTH_ID', 'id' );
define( 'AUTH_NAME', 'username' );
define( 'AUTH_TYPE', 'usertype' );
define( 'AUTH_TOKEN', 'token' );

// default page to login, name of the file found in /pages
define( 'LOGIN_REDIRECT', 'default' ); 



/* $restricted_pages[ 'admin' ]['access'] = [ "admin-page" ];
$restricted_pages[ 'admin' ][ 'default_page' ] = "default";

$restricted_pages[ 'user' ]['access'] = [ "user-page" ];
$restricted_pages[ 'user' ][ 'default_page' ] = "default";
*/
$restricted_pages[ 'default' ]['access'] = [ "default", "login", "register" ];
$restricted_pages[ 'default' ][ 'default_page' ] = "default"; 

has_access( true );
