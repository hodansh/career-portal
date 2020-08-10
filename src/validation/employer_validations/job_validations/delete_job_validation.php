<?php
$valid = true;

if(isset($_POST['deleteJob']))
{
    $DeleteJobErrorMessage = array();

    if (empty($_POST['jobIdToDelete'])) {
        $valid = false;
    }

    if ($valid) {
        $DeleteJobResult = DeleteJobPost($_POST['jobIdToDelete']);
        $DeleteJobErrorMessage[] = $DeleteJobResult;
        // unset($_POST['deleteJob']);
    } else { $DeleteJobErrorMessage[] = "All fields are required."; }
}