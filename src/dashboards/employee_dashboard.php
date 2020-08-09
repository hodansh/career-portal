<?php session_start();
include_once "../validation/post_job_validation.php";
?>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/style.css?version=52" rel="stylesheet" type="text/css" /> <!-- link to css file -->
    <title>Employee Dashboard</title>
</head>

<body>
    <a href="../index.php" style="font-weight: 600;">Sign-out</a>
    <h1>Employee Dashboard</h1>
    <div class="form-head"> Welcome <?php echo $_SESSION["userName"]; ?></div>
    <br>
    <table>
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
                        <label style="font-weight:200 ;">Click to see all the jobs you have appleid for: </label>
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
    }
    if (isset($_SESSION["allJobs"])) { //show all the jobs:
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