<?php
include_once "database_operations.php";
$valid = true;
$errorMessage = array();
foreach ($_POST as $key => $value) {
    if (empty($_POST[$key])) {
        $valid = false;
    }
}

if ($valid == true) {
    if ($_POST['password'] != $_POST['confirm_password']) {
        $errorMessage[] = 'Passwords should be the same!';
        $valid = false;
    }

    if (!isset($error_message)) {
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) { //This is a server-side validation for correct email format from PHP 
            $errorMessage[] = "Invalid email address.";
            $valid = false;
        }
    }

    if (!isset($error_message)) {
        if (!isset($_POST["userType"])) {
            $errorMessage[] = "You should choose your user preference!";
            $valid = false;
        }
    }
    $member_exists = EmployerExists($_POST['userName'], $_POST["email"]);
    if ($member_exists[0] == true) {
        $errorMessage[] = "This username is not available, please choose another username.";
        $valid = false;
    }
    if ($member_exists[1] == true) {
        $errorMessage[] = "This email is not available, please use another email.";
        $valid = false;
    }
} else {
    $errorMessage[] = "All fields are required.";
}
if ($valid == true) {
    $_SESSION["userName"] = $_POST["userName"];
    AddEmployer(50,$_POST["userName"],$_POST["password"], $_POST["email"],"company", "5145603910", "H9G2B3", "DDO", "9 rue Mansfied", 50);
    echo "<script type='text/javascript'>window.location.href = 'dashboard.php?idh={$idh}&ajax_show=experience';</script>";
}
