<?php
include_once "../database_operations.php";
$valid = true; // at the end we will proceed to the next page only if valid is true

if(isset($_POST["postPayment"]))
{
    $PostJobErrorMessage = array();

    foreach ($_POST as $key => $value) { // if any of the fields are empty the user has to fix it. 

        if (empty($_POST[$key])) {
            $valid = false;
        }
    }

    if ($valid) {
        $PostJobResult = addPaymentMethod($_POST['accountNumber'], $_POST['paymentType'], $_POST['withdrawalType']);
        
    } else { $PostJobErrorMessage[] = "All fields are required."; }
}