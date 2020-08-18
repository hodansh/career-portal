<?php
$valid = true;

if(isset($_POST['deletePayment']))
{
    $DeleteJobErrorMessage = array();

    if (empty($_POST['paymentIdToDelete'])) {
        $valid = false;
    }

    if ($valid) {
        $DeleteJobResult = deletePaymentMethod($_POST['paymentIdToDelete']);
        $DeleteJobErrorMessage[] = $DeleteJobResult;
    } else { 
        $DeleteJobErrorMessage[] = "All fields are required."; 
    }
}