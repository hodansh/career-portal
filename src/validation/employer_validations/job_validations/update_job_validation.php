<?php
$valid = true; // at the end we will proceed to the next page only if valid is true

if(isset($_POST["editJob"]))
{
    $EditJobErrorMessage = array();
    $_POST['jobId'] = $GetJobResult[0];

    foreach ($_POST as $key => $value) {
        
        if (empty($_POST[$key]) && $key != "jobId") {
            $valid = false;
        }
    }

    if ($valid) {
        $EditJobResult = EditJobPost($_POST['editJobId'] , $_POST['editJobTitle'], $_POST['editJobCategory'], $_POST['editJobDescription'], $_POST['editNeededEmployees']);
        
        if (is_null($EditJobResult)) {
            $EditJobErrorMessage[] = "You do not have a job with the given id, pick one from the table.";
        } else { $EditJobSuccessMessage[] = $EditJobResult;  }
               
    } else { $EditJobErrorMessage[] = "All fields are required."; }
}