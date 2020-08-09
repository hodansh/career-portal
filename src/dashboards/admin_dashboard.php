<?php
session_start();
include_once "../validation/admin_search_validation.php";
include_once "../database_operations.php";
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/style.css?version=52" rel="stylesheet" type="text/css" /> <!-- link to css file -->
    <a href="../index.php" style="font-weight: 600;">Sign-out</a>
    <title>Admin Dashboard</title>
</head>

<body>

    <table>
        <tr>
            <td colspan="2">
                <form name="search" method="post" action="">
                    <div class="table">

                        <div class="form-head">Welcome admin</div></br>
                        <!--  ----------------------------------------------------------------------------------------------------------------------------------------------------------- -->
                        <?php // to show error messages about bad inputs, we would have to show them on top of the page. Error messages are created in formValidation page
                        if (!empty($AdminErrorMessage) && is_array($AdminErrorMessage) && isset($_POST["search"])) {
                        ?>
                            <div class="error-message">
                                <?php
                                foreach ($AdminErrorMessage as $message) {
                                    echo $message . "<br/>";
                                }
                                ?>
                            </div>
                        <?php
                        }
                        ?>
                        <!--  ----------------------------------------------------------------------------------------------------------------------------------------------------------- -->
            </td>
        </tr>
        <tr>
            <td>

                <div >
                    <label>Search for a user:</label>
                    <div>
                        <select name="searchCriterion" id="searchCriterion">
                            <!-- This is a drop-down menu. $_POST['searchCriterion] will give you the value of selected option after form submission. -->
                            <option hidden disabled selected value> -- select an option -- </option>
                            <option value="UserName">by username</option>
                            <option value="Email">by email address</option>
                            <option value="Company">by company name</option>
                            <option value="Telephone">by telephone number</option>
                            <option value="Address">by address</option>
                            <option value="City">by city</option>
                            <option value="PostalCode">by postal code</option>
                            <option value="Status">active/inactive</option>
                        </select>
                    </div>
                </div>
                <div >

                    <div>
                        <input type="text" class="input_textbox" name="searchString" value="<?php if (isset($_POST['searchString'])) echo $_POST['searchString']; ?>">
                    </div>
                </div>

                <div>
                    <input type="submit" name="search" value="Search" class="btnRegister">
                </div>
                </div>
                </form>
                <div>
                </div>
            </td>

            <td>
                <form name="deleteUser" method="post" action="">
                    <div class="table">
                        <label style="font-weight:200 ;">Enter the username of the user you want to delete:</label>
                        <div>
                            <input type="text" class="input_textbox" name="userNameToBeDeleted" value="<?php if (isset($_POST['userNameToBeDeleted'])) echo $_POST['userNameToBeDeleted']; ?>">
                        </div>
                        <div>
                            <input type="submit" name="deleteByUserName" value="Delete" class="btnRegister">
                        </div>
            </td>
        </tr>


        <tr>
            <td>
                <form name="activateUser" method="post" action="">
                    <div class="table">
                        <label style="font-weight:200 ;">Enter the username of the user account you want to activate:</label>
                        <div>
                            <input type="text" class="input_textbox" name="userNameToBeActivated" value="<?php if (isset($_POST['userNameToBeActivated'])) echo $_POST['userNameToBeActivated']; ?>">
                        </div>
                        <div>
                            <input type="submit" name="activateUser" value="Activate User" class="btnRegister">
                        </div>

                    </div>
                </form>
            </td>
            <td>
                <form name="deactivateUser" method="post" action="">
                    <div class="table">
                        <label style="font-weight:200 ;">Enter the username of the user account you want to deactivate:</label>
                        <div>
                            <input type="text" class="input_textbox" name="userNameToBeDeactivated" value="<?php if (isset($_POST['userNameToBeDeactivated'])) echo $_POST['userNameToBeDeactivated']; ?>">
                        </div>
                        <div>
                            <input type="submit" name="deactivateUser" value="Deactivate User" class="btnRegister">
                        </div>
                    </div>
                </form>
            </td>
        </tr>
    
        <tr>
            <td colspan="2">
                <form name="showAll" method="post" action="">
                    <div class="table">
                        <label style="font-weight:200 ;">Click on this button to see all the users of the system: </label>
                    </div>
                    <div>
                        <input type="submit" name="showAll" value="Show All Users" class="btnRegister">
                    </div>
                </form>

                <!-- all the results for any of the buttons will be shown here: -->
                <?php

                if (isset($_SESSION["deleteResult"])) { //showing the results for delete user:
                    echo "<div class='form-head2'>" . $_SESSION["deleteResult"] . "</div>";
                }

                if (isset($_SESSION["activationResult"])) { //showing the results for activate/deactivate user:
                    echo "<div class='form-head2'>" . $_SESSION["activationResult"] . "</div>";
                }

                // ------------------------------------------------------------------------------------------------------------------------------------------------------------

                if (isset($_SESSION["search_results_employers"]) && isset($_SESSION["search_results_employees"])) { //showing the results for search user by criterion:
                    $res_employers = $_SESSION["search_results_employers"];
                    $res_employees = $_SESSION["search_results_employees"];
                    if (is_array($res_employers)) {

                        echo "<div class='form-head2'>Search Results in Employers:</div><br>
        
        <table> <tr>
        <td styles>UserName</td>
        <td>Password</td>
        <td>Email</td>
        <td>Company</td>
        <td>Telephone</td>
        <td>PostalCode</td>
        <td>City</td>
        <td>Address</td>
        <td>CategoryID</td>
        <td>Status</td>         
        
        </tr>";
                        foreach ($res_employers as $row) {
                            foreach ($row as $key => $value) {
                                if ($key == "EmployerId") {
                                    echo "<tr>";
                                } else {
                                    echo "<td> $value";

                                    if ($key == "Status") {
                                        echo "</tr>";
                                    }
                                }
                            }
                        }
                        echo "</table>";
                    } else {
                        echo "<h3 class='form-head2'>$search_results_employers</h3><br>"; // Because no results found in employers.
                    }
                    if (is_array($res_employees)) {

                        echo "<div class='form-head2'><br>Search Results in Employees:</div><br>
        <table> <tr>
        <td styles>UserName</td>
        <td>Password</td>
        <td>Email</td>
        <td>Telephone</td>
        <td>PostalCode</td>
        <td>City</td>
        <td>Address</td>
        <td>CategoryID</td>  
        <td>Status</td>      
        </tr>";
                        foreach ($res_employees as $row) {
                            foreach ($row as $key => $value) {
                                if ($key == "EmployeeId") {
                                    echo "<tr>";
                                } else {
                                    echo "<td> $value";

                                    if ($key == "Status") {
                                        echo "</tr>";
                                    }
                                }
                            }
                        }
                        echo "</table>";
                    } else {
                        echo "<h3 class='form-head2'>$search_results_employees</h3><br>"; // Because no results found in employees.  
                    }
                }
                // ------------------------------------------------------------------------------------------------------------------------------------------------------------

                if (isset($_SESSION["showAllEmployers"]) && isset($_SESSION["showAllEmployees"])) { //show all the tables:
                    $res_employers = $_SESSION["showAllEmployers"];
                    $res_employees = $_SESSION["showAllEmployees"];
                    if (is_array($res_employers)) {

                        echo "<div class='form-head2'>All the entries in Employer table:</div><br>
        
        <table> <tr>
        <td styles>UserName</td>
        <td>Password</td>
        <td>Email</td>
        <td>Company</td>
        <td>Telephone</td>
        <td>PostalCode</td>
        <td>City</td>
        <td>Address</td>
        <td>CategoryID</td>
        <td>Status</td>         
        
        </tr>";
                        foreach ($res_employers as $row) {
                            foreach ($row as $key => $value) {
                                if ($key == "EmployerId") {
                                    echo "<tr>";
                                } else {
                                    echo "<td> $value";

                                    if ($key == "Status") {
                                        echo "</tr>";
                                    }
                                }
                            }
                        }
                        echo "</table>";
                    } else {
                        echo "<h3 class='form-head2'>$search_results_employers</h3><br>"; // Because no results found in employers.
                    }
                    if (is_array($res_employees)) {

                        echo "<div class='form-head2'><br>All the entries in Employee table:</div><br>
        <table> <tr>
        <td styles>UserName</td>
        <td>Password</td>
        <td>Email</td>
        <td>Telephone</td>
        <td>PostalCode</td>
        <td>City</td>
        <td>Address</td>
        <td>CategoryID</td>  
        <td>Status</td>      
        </tr>";
                        foreach ($res_employees as $row) {
                            foreach ($row as $key => $value) {
                                if ($key == "EmployeeId") {
                                    echo "<tr>";
                                } else {
                                    echo "<td> $value";

                                    if ($key == "Status") {
                                        echo "</tr>";
                                    }
                                }
                            }
                        }
                        echo "</table>";
                    } else {
                        echo "<h3 class='form-head2'>$search_results_employees</h3><br>"; // Because no results found in employees.  
                    }
                }


                ?>







</body>

</html>