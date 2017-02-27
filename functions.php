<?php

if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' );

function element( $el ) {
	include "./elements/$el.php";
}