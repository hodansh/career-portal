<?php
include_once "../database_operations.php";
$valid = true; // at the end we will proceed to the next page only if valid is true

$SignInErrorMessage = array();

foreach ($_POST as $key => $value) { // if any of the fields are empty the user has to fix it. 

    if (empty($_POST[$key])) {
        $valid = false;
    }
}

if ($valid == true) {
    if(isset($_POST['searchCriterion'])&& isset($_POST['searchString'])){
$search_results_employers = findUserByCriterion($_POST['searchCriterion'],"EMPLOYER");
$search_results_employees = findUserByCriterion($_POST['searchCriterion'],"EMPLOYEE");    
}

// -------------------------------------------------------------------------------------------------------------
else { // this means one or more of the fields are empty. (valid is not true)
    $SignInErrorMessage[] = "All fields are required.";
}
// -------------------------------------------------------------------------------------------------------------
// every check was passed!
if ($valid == true && !strcasecmp($_POST['userName'], 'admin')==0) {
    $_SESSION["userName"] = $AuthenticationResult[2]; // we set this session variable and will use refer to it on the next pages. (see dashboard pages after welcome word!)
    $userType = $AuthenticationResult[1]; // Based on the table that the username was found in, we will have to show either Employer dashboard or Employee dashboard
    switch ($userType) {
        case "employer":
            echo "<script type='text/javascript'>window.location.href = '../dashboards/employer_dashboard.php?idh={$idh}&ajax_show=experience';</script>"; //navigate to dashboard    
            break;
        case "employee":
            echo "<script type='text/javascript'>window.location.href = '../dashboards/employee_dashboard.php?idh={$idh}&ajax_show=experience';</script>"; //navigate to dashboard    
            break;
    }
}
