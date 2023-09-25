<?php

/*
|--------------------------------------------------------------------------
| Actions Management
|--------------------------------------------------------------------------
|
| Here is where you can add all the actions for your application. These
| actions are connected by the corresponding functions within your "app/functions" folder which
| is assigned in every "pages" group. Enjoy building your Actions!
|
*/

if (!defined('ACCESS')) {
    die('DIRECT ACCESS NOT ALLOWED');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    validate_csrf_token();

    if (isset($_POST['btn-submit'])) {
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $emp_gender = $_POST['emp_gender'];
        $usertype = $_POST['usertype'];

        createUser($fname, $mname, $lname, $username, $password, $emp_gender, $usertype);
        // Redirect or perform additional actions as needed
    }

    if (isset($_POST['btn-update'])) {
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $emp_gender = $_POST['emp_gender'];
        $usertype = $_POST['usertype'];
        $token = $_GET['token'];

        updateUser($fname, $mname, $lname, $username, $password, $emp_gender, $usertype, $token);
        // Redirect or perform additional actions as needed
    }

    if (isset($_POST['btn-updatePassword'])) {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $token = $_GET['token'];

        updateUserPassword($password, $token);
        // Redirect or perform additional actions as needed
    }

    if (isset($_POST['btn-delete'])) {
        $token = $_GET['token'];

        deleteUser($token);
        // Redirect or perform additional actions as needed
    }
}
?>
