<?php
include_once "../database_operations.php";
$valid = true; // at the end we will proceed to the next page only if valid is true

$SignInErrorMessage = array();

foreach ($_POST as $key => $value) { // if any of the fields are empty the user has to fix it. 

    if (empty($_POST[$key]) && $key!= "deleteByUserName") {
        $valid = false;
    }
}
if (!isset($_POST["searchCriterion"])) {
    $AdminErrorMessage[] = "Please select a search criterion!";
}

if ($valid == true) {
    if (isset($_POST['searchCriterion']) && isset($_POST['searchString'])) {
        $search_results_employers = findUserByCriterion($_POST['searchString'], $_POST['searchCriterion'], "Employer");
        $search_results_employees = findUserByCriterion($_POST['searchString'], $_POST['searchCriterion'], "Employee");

        $_SESSION["search_results_employers"] = $search_results_employers;
        $_SESSION["search_results_employees"] = $search_results_employees;
    }
}

// -------------------------------------------------------------------------------------------------------------
else { // this means one or more of the fields are empty. (valid is not true)
    $AdminErrorMessage[] = "All fields are required.";
}
if (isset($_POST["deleteByUserName"])) {
    $_SESSION["deleteResult"] = deleteUser($_POST["userNameToBeDeleted"]);
}
if (isset($_POST["userNameToBeActivated"])) {
    $_SESSION["activationResult"] = activateUser($_POST["userNameToBeActivated"]);
}
if (isset($_POST["userNameToBeDeactivated"])) {
    $_SESSION["activationResult"] = deactivateUser($_POST["userNameToBeDeactivated"]);
}
if (isset($_POST["showAll"])) {
    $_SESSION["showAllEmployers"] = findAll("Employer");
    $_SESSION["showAllEmployees"] = findAll("Employee");
}
if (isset($_POST["showJobs"])) {
    $_SESSION["allJobs"] = findAll("Job");
}
