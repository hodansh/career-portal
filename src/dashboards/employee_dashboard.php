<?php session_start();
include_once "../database_operations.php";
?>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/style.css?version=52" rel="stylesheet" type="text/css" /> <!-- link to css file -->
    <title>Employee Dashboard</title>
</head>

<body>
    <a href="../payments/payments.php" style="font-weight: 600; font-size: large;">Payments</a>
    <div>
    <a href="../index.php" style="font-weight: 600; font-size: large; ">Sign-out</a>
    <br>
    <a href="./employee_profile.php" style="font-weight: 600; font-size: large; ">Edit Profile</a>

    <form name="deleteAccount" method="post" action="">
        <div>
            <br>
            <label style="font-size:medium;"> Click here to permanently delete your account (this cannot be undone!)</label>
            <br>
            <input type='submit' style="width:auto" name='deleteAccount' value='Delete Your Account' class="btnRegister">
        </div>
    </form>
    <?php
    if (isset($_POST['deleteAccount'])) {
        deleteUser($_SESSION['userName']);
        echo "<script type='text/javascript'>window.location.href = '../index.php?idh={$idh}&ajax_show=experience';</script>"; //navigate to index page
    }
    ?>

    <h1>Employee Dashboard</h1>
    <table>
        <tr>
            <td>
                <div class="form-head"> Welcome <?php echo $_SESSION["userName"]; ?></div>
                <?php

                $_SESSION['AllOffers'] = findAll('JobOffer');
                if (isset($_SESSION['AllOffers'])) {
                    foreach ($_SESSION['AllOffers'] as $offer) {
                        if ($offer['EmployeeId'] == $_SESSION['employeeId'] && $offer['Status'] == "Approved") {
                            echo "<div style='font-size: large; color:red;'> Congratulations! You have an accepted offer for your application to jobID=" . $offer["JobId"] . "</div>";
                        }
                    }
                }
                ?>
            </td>

            <td>
                <form name="UpdateMembership" method="post" action="">
                    <?php
                    $userName = $_SESSION["userName"];
                    $employeeId = $_SESSION['employeeId'];
                    $employeeCategoryId = findAnEmployee($_SESSION["userName"])[8];
                    $employee_categories = findAll("EmployeeCategory");


                    foreach ($employee_categories as $row) {
                        if ($row['EmployeeCategoryId'] == $employeeCategoryId) {
                            echo "<div class='form-head2'>You are now a " . $row['Status'] . " employee</div>";
                        }
                    }

                    echo "<div class='form-head3'>Upgrade/Downgrade your membership type:</div><br>";





                    echo "<select name='newMembershipType'>";

                    foreach ($employee_categories as $row) {
                        if ($row['MaxJobs'] == null) {
                            $row['MaxJobs'] = "unlimited";
                        }
                        if ($row['EmployeeCategoryId'] !== $employeeCategoryId) {
                            echo "<option value='employee_" . $row['EmployeeCategoryId'] . "'>Employee " . $row['Status'] . " Membership (" . $row['MaxJobs'] . " job applications/month for $" . $row['MonthlyCharge'] . ")</option>";
                        }
                    }

                    ?>
                    <div>
                        <input type="submit" name="UpdateMembership" value="Update Membership" class="btnRegister">
                    </div>
                </form>
                <?php
                if (isset($_POST["newMembershipType"])) {
                    $categoryId = trim($_POST['newMembershipType'], "employee_");
                }
                $sql = "UPDATE Employee SET EmployeeCategoryId = $categoryId WHERE UserName= '$userName';";
                mysqli_query($conn, $sql);
                ?>
            </td>
        </tr>

        <br>

        <tr>
            <td>
                <form name="showJobs" method="post" action="">
                    <div class="table">
                        <label style="font-weight:200 ;">Click to see all the jobs: </label>
                    </div>
                    <div>
                        <input type="submit" name="showJobs" value="Show All the Jobs" class="btnRegister">
                    </div>
                </form>
            </td>
            <td>
                <form name="applyForJob" method="post" action="">
                    <div class="table">
                        <label style="font-weight:200 ;">Enter the id of the job you want to apply for: </label>
                    </div>
                    <div>
                        <input type="number" class="input_textbox" name="jobIdToBeAppliedFor" value="">
                    </div>
                    <br>
                    <div>
                        <input type="submit" name="showJobs" value="Apply!" class="btnRegister">
                    </div>
                </form>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <form name="appliedJobsList" method="post" action="">
                    <div class="table">
                        <label style="font-weight:200 ;">Click to see all the jobs you have applied for: </label>
                    </div>
                    <div>
                        <input type="submit" name="appliedJobsList" value="Show my Jobs" class="btnRegister">
                    </div>
                </form>
            </td>
    </table>
    <?php

    if (isset($_POST["appliedJobsList"])) {
        $applied_jobs = findAppliedJobs($_SESSION['employeeId']);
        if (is_array($applied_jobs)) {
            echo "</br><div class='form-head'>Here is the list of jobs you applied:</div><br>
        
        <table> <tr>
        <td styles>Job Id</td>
        <td>Title</td>
        <td>JobDescription</td>
        <td>Date Posted</td>
        </tr>";


            foreach ($applied_jobs as $row) {
                foreach ($row as $row) {
                    foreach ($row as $key => $value) {
                        if ($key == "JobId") {
                            echo "<tr><td>$value";
                        } else {
                            if ($key == "Title" or $key == "JobDescription" or $key == "DatePosted") {
                                echo "<td> $value";
                            }
                            if ($key == "EmployerId") {
                                echo "</tr>";
                            }
                        }
                    }
                }
            }
            echo "</table>";
        } else {
            echo "<h3 class='form-head2'>$applied_jobs</h3><br>"; // Because no results found in jobs.
        }
    }

    //----------------------------------------------------------------------------------------------

    if (isset($_POST["showJobs"])) {
        $_SESSION["allJobs"] = findAll("Job");
        //show all the jobs:
        $res_jobs = $_SESSION["allJobs"];

        if (is_array($res_jobs)) {

            echo "</br><div class='form-head'>All the entries in Job table:</div><br>
        
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
            echo "<h3 class='form-head2'>$res_jobs</h3><br>"; // Because no results found in jobs.
        }
    }
    if (isset($_POST["jobIdToBeAppliedFor"])) {
        $result = createJobApplication($_POST["jobIdToBeAppliedFor"]);
        echo "<h3 class='form-head2'>$result</h3><br>";
    }


    ?>
</body>

</html>