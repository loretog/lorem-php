<?php

if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' );

if( isset( $_REQUEST[ 'action' ] ) && file_exists( "./actions/" . $_REQUEST[ 'action' ] . ".php" ) ) {		
	include './actions/' . $_REQUEST[ 'action' ] . '.php';
}