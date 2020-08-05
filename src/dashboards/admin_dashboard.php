<?php
session_start();
include_once "../validation/admin_search_validation.php";
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/style.css" rel="stylesheet" type="text/css" /> <!-- link to css file -->
    <title>Admin Dashboard</title>
</head>

<body>

    <form name="search" method="post" action="">
        <div class="table">

            <div class="form-head">Welcome admin</div>
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
            <div class="form_column">
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
                    </select>
                </div>
            </div>


            <div class="form_column">

                <div>
                    <input type="text" class="input_textbox" name="searchString" value="<?php if (isset($_POST['searchString'])) echo $_POST['searchString']; ?>">
                </div>
            </div>

            <div>
                <input type="submit" name="search" value="search" class="btnRegister">
            </div>
        </div>
    </form>
    <div>
        <?php

        if (isset($_SESSION["search_results_employers"]) && isset($_SESSION["search_results_employees"])) {
            $res_employers = $_SESSION["search_results_employers"];
            $res_employees = $_SESSION["search_results_employees"];
            if (is_array($res_employers)) {

                echo "<div class='form-head'>Search Results in Employers:</div><br>
                <style> 
                table, th, td{
                  padding: 10px;
                  border: 1.5px solid green;
                  border-collapse: collapse;
                  margin-left:auto;
                  margin-right:auto;
                }
              </style>
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
       
     </tr><tr>";
                foreach ($res_employers as $key => $value) {
                    if ($key != "EmployerId") {
                        echo "<td> $value";
                    }
                }
                echo "</tr>
   </table>";
            } else{
                echo "<h3 class='form-head'>$search_results_employers</h3><br>"; // Because no results found in employers.
            }
            if (is_array($res_employees)) {

                echo "<div class='form-head'><br>Search Results in Employees:</div><br>
                <style> 
                table, th, td{
                  padding: 10px;
                  border: 1.5px solid green;
                  border-collapse: collapse;
                  margin-left:auto;
                  margin-right:auto;
                }
              </style>
                <table> <tr>
                    <td styles>UserName</td>
                    <td>Password</td>
       <td>Email</td>
       <td>Telephone</td>
       <td>PostalCode</td>
       <td>City</td>
       <td>Address</td>
       <td>CategoryID</td>      
       
     </tr><tr>";
                foreach ($res_employees as $key => $value) {
                    if ($key != "EmployeeId") {
                        echo "<td> $value";
                    }
                }
                echo "</tr>
    </table>";
            }
            else{
                echo "<h3 class='form-head'>$search_results_employees</h3><br>"; // Because no results found in employees.  
            }
        }
        
       
        // echo $_SESSION["search_results_employees"];

        //  $search_res = $_SESSION["search_results_employers"];
        //  foreach ($search_res as $row){
        //      echo "<p> $row </p>";







        ?>
    </div>


</body>

</html>