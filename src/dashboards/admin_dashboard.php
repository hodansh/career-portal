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

                <div>
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
                <div>

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
                        <label style="font-weight:200 ;">Click to see all the users: </label>
                    </div>
                    <div>
                        <input type="submit" name="showAll" value="Show All Users" class="btnRegister">
                    </div>
                </form>
            </td>
        </tr>
        <tr>
            <td>
                <form name="showJobs" method="post" action="">
                    <div class="table">
                        <label style="font-weight:200 ;">Click to see all the jobs:</label>
                    </div>
                    <div>
                        <input type="submit" name="showJobs" value="Show All the Jobs" class="btnRegister">
                    </div>
                </form>
            </td>
            <td>
                <form name="showCategories" method="post" action="">
                    <div class="table">
                        <label style="font-weight:200 ;">Click to see membership categories:</label>
                    </div>
                    <div>
                        <input type="submit" name="showCategories" value="Show Membership Choices" class="btnRegister">

                    </div>
                </form>
            </td>
        <tr>
            <td colspan="2">
                <form name="addCategory" method="post" action="">
                    <div class="table">
                        <label style="font-weight:200 ;">Add a new membership category:</label>
                    </div>
                    
                    <label>Membership name (golden, prime, ...)</label>
                    <div>
                        <input type="text" class="input_textbox" name="Status">
                    </div>

                    <label>Monthly Charge</label>
                    <div>
                        <input type="number" class="input_textbox" name="MonthlyCharge">
                    </div>
                    
                    <label>Maximum Jobs</label>
                    <div>
                        <input type="number" class="input_textbox" name="MaxJobs">
                    </div>

                    <div>
                    <select name="MembershipType">
                        <option hidden disabled selected value> -- select an option -- </option>
                        <option value="EmployerCategory">add a membership type for Employers</option>
                        <option value="EmployeeCategory">add a membership type for Employees</option>
                    </select>
                </div>

                <div>
                        <input type="submit" name="addCategory" value="Add Membership Category" class="btnRegister">

                    </div>
                    <?php 
                    if(isset($_SESSION['addCategoryResult']) && isset($_POST['addCategory']))
                    {
                        echo "<div class='form-head2'>". $_SESSION['addCategoryResult']. "</div>";
                        }
                        ?>
                </form>
            </td>
        </tr>
    </table>



    <!-- all the results for any of the buttons will be shown here: -->
    <?php

    if (isset($_POST["deleteByUserName"])) { //showing the results for delete user:
        echo "<div class=form-head2 style='font-size: large;'>" . $_SESSION["deleteResult"] . "</div>";
    }

    if (isset($_POST["activateUser"]) or isset($_POST["deactivateUser"])) { //showing the results for activate/deactivate user:
        echo "<div class=form-head2 style='font-size: large;'>" . $_SESSION["activationResult"] . "</div>";
    }


    // ------------------------------------------------------------------------------------------------------------------------------------------------------------

    if (isset($_POST["searchString"])) { //showing the results for search user by criterion:
        $res_employers = $_SESSION["search_results_employers"];
        $res_employees = $_SESSION["search_results_employees"];
        if (is_array($res_employers)) {

            echo "<div class=form-head2 style='font-size: large;'>Search Results in Employers:</div><br>
        
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
            echo "<h3 class=form-head2 style='font-size: large;'>$search_results_employers</h3><br>"; // Because no results found in employers.
        }
        if (is_array($res_employees)) {

            echo "<div class=form-head2 style='font-size: large;'><br>Search Results in Employees:</div><br>
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
            echo "<h3 class=form-head2 style='font-size: large;'>$search_results_employees</h3><br>"; // Because no results found in employees.  
        }
    }
    // ------------------------------------------------------------------------------------------------------------------------------------------------------------

    if (isset($_POST["showAll"])) { //show all the tables:
        $res_employers = $_SESSION["showAllEmployers"];
        $res_employees = $_SESSION["showAllEmployees"];
        if (is_array($res_employers)) {

            echo "<div  class=form-head2 style='font-size: large;'>All the entries in Employer table:</div><br>
        
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
            echo "<h3 class=form-head2 style='font-size: large;'>$search_results_employers</h3><br>"; // Because no results found in employers.
        }
        if (is_array($res_employees)) {

            echo "<div class=form-head2 style='font-size: large;'><br>All the entries in Employee table:</div><br>
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
            echo "<h3 class=form-head2 style='font-size: large;'>$search_results_employees</h3><br>"; // Because no results found in employees.  
        }
    }
    //--------------------------------------------------------------------------------------------------------------------------------

    if (isset($_POST["showJobs"])) { //show all the jobs:
        $res_jobs = $_SESSION["allJobs"];

        if (is_array($res_jobs)) {

            echo "<div class=form-head2 style='font-size: large;'>All the entries in Job table:</div><br>
        
        <table> <tr>
        <td styles>JobId</td>
        <td>Title</td>
        <td>Category</td>
        <td>JobDescription</td>
        <td>DatePosted</td>
        <td>NeededEmployees</td>
        <td>AppliedEmployees</td>
        <td>AcceptedOffer</td>
        <td>EmployerId</td>
        
        </tr>";
            foreach ($res_jobs as $row) {
                foreach ($row as $key => $value) {
                    if ($key == "JobId") {
                        echo "<tr><td>$value";
                    } else {
                        echo "<td> $value";

                        if ($key == "EmployerId") {
                            echo "</tr>";
                        }
                    }
                }
            }
            echo "</table>";
        } else {
            echo "<h3 class=form-head2 style='font-size: large;'>$res_jobs</h3><br>"; // Because no results found in jobs.
        }
    }

    if (isset($_POST["showCategories"])) {
        $employer_categories = findAll("EmployerCategory");
        $employee_categories = findAll("EmployeeCategory");
        echo "<div class=form-head2 style='font-size: large;'> Here is the membership choices for Employers: </div>
                    <table> <tr>
        <td>EmployerCategoryId</td>
        <td>Status</td>
        <td>MonthlyCharge</td>
        <td>MaxJobs</td>
         </tr>";
        foreach ($employer_categories as $row) {
            foreach ($row as $key => $value) {
                if ($key == "EmployeeCategoryId") {
                    echo "<tr><td>$value";
                } else {
                    if ($value == null) {
                        echo "<td> unlimited";
                    } else {
                        echo "<td> $value";
                    }

                    if ($key == "MaxJobs") {
                        echo "</tr>";
                    }
                }
            }
        }


        echo "</table><br><div class=form-head2 style='font-size: large;'> Here is the membership choices for Employees: </div>
                <table> <tr>
    <td>EmployeeCategoryId</td>
    <td>Status</td>
    <td>MonthlyCharge</td>
    <td>MaxJobs</td>
     </tr>";
        foreach ($employee_categories as $row) {
            foreach ($row as $key => $value) {
                if ($key == "EmployeeCategoryId") {
                    echo "<tr><td>$value";
                } else {
                    if ($value == null) {
                        echo "<td> unlimited";
                    } else {
                        echo "<td> $value";
                    }

                    if ($key == "MaxJobs") {
                        echo "</tr>";
                    }
                }
            }
        }
        echo "</table>";
    }

    if(isset($_POST['addCategory'])){
        $_SESSION['addCategoryResult'] = addCategory($_POST["MembershipType"],$_POST["Status"],$_POST["MonthlyCharge"],$_POST["MaxJobs"]);
    }


    ?>







</body>

</html>