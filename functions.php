<?php

if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' );

function element( $el ) {	
	include ROOT_DIR . "/elements/$el.php";
}

function set_message( $msg ) {
	$_SESSION[ 'MESSAGE' ] = $msg;
}

function show_message() {
	echo "<div class='alert'>xxx" . $_SESSION[ 'MESSAGE' ] . "</div>";
	//unset( $_SESSION[ 'MESSAGE' ] );
}

/* ADD YOUR CUSTOM FUNCTIONS IN custom_functions.php */
require 'custom_functions.php';