<?php
$valid = true; // at the end we will proceed to the next page only if valid is true

if(isset($_POST["getJob"]))
{
    $GetJobErrorMessage = array();

    foreach ($_POST as $key => $value) { // if any of the fields are empty the user has to fix it. 

        if (empty($_POST[$key])) {
            $valid = false;
        }
    }

    if ($valid) {
        $GetJobResult = GetJobForEmployer($_POST['jobId']);
        if (is_null($GetJobResult)) {
            $GetJobErrorMessage[] = "You do not have a job with the given id, pick one from the table.";
        }      
        
    } else { $GetJobErrorMessage[] = "All fields are required."; }
}