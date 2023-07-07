<?php

	
	session_destroy();

	session_start();
    	set_message( "<i class='fas fa-check'></i> Logout Successfully." . $DB->error, "success" );
	header( "Location: " . "./login" );
	exit;
