<?php
include_once "database_operations.php";
$valid = true; // at the end we will proceed to the next page only if valid is true

$SignInErrorMessage = array();

foreach ($_POST as $key => $value) { // if any of the fields are empty the user has to fix it. 

    if (empty($_POST[$key])) {
        $valid = false;
    }
}

if ($valid == true) {
    // If we reach here then bith username and password fields were filled out and are not empty.
    $AuthenticationResult = Authentication($_POST['userName'], $_POST['password']); // AuthenticationResult will be an array with 3 elements, see database_operations 
    if ($AuthenticationResult[0] == false) {
        $SignInErrorMessage[] = "We couldn't match your Username/Password! Please check...";
        $valid = false;
    }
}
// -------------------------------------------------------------------------------------------------------------
else { // this means one or more of the fields are empty. (valid is not true)
    $SignInErrorMessage[] = "All fields are required.";
}
// -------------------------------------------------------------------------------------------------------------
// every check was passed!
if ($valid == true) {
    $_SESSION["userName"] = $AuthenticationResult[2]; // we set this session variable and will use refer to it on the next pages. (see dashboard pages after welcome word!)
    $userType = $AuthenticationResult[1]; // Based on the table that the username was found in, we will have to show either Employer dashboard or Employee dashboard
    switch ($userType) {
        case "employer":
            echo "<script type='text/javascript'>window.location.href = 'employer_dashboard.php?idh={$idh}&ajax_show=experience';</script>"; //navigate to dashboard    
            break;
        case "employee":
            echo "<script type='text/javascript'>window.location.href = 'employee_dashboard.php?idh={$idh}&ajax_show=experience';</script>"; //navigate to dashboard    
            break;
    }
}
