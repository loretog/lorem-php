<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?php element( 'header' ); ?>

<?php 

//show_message(); 
var_dump($_SESSION);
?>

<h1>Login</h1>

<?php element( 'login_form' ) ?>

<?php element( 'footer' ); ?>