<?php

	session_start();
	session_destroy();

	header( "Location: " . SITE_URL );
	exit;