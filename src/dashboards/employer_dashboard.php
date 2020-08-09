<?php session_start();
include_once "../validation/employer_validations/job_validations/post_job_validation.php"; 
include_once "../validation/employer_validations/job_validations/delete_job_validation.php";
include_once "../validation/employer_validations/job_validations/get_job_for_employer_validation.php";
include_once "../validation/employer_validations/job_validations/update_job_validation.php";
?>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/style.css?version=52" rel="stylesheet" type="text/css" /> <!-- link to css file -->
    <title>Employer Dashboard</title>
</head>

<body>
    <a href="../index.php" style="font-weight: 600;">Sign-out</a>
    <h1>Employer Dashboard</h1>
    <div class="form-head"> Welcome <?php echo $_SESSION["userName"]; ?></div>
    <br>
    <table>
        <tr>
            <td>
                <form name="postJob" method="post" action="">
                    <!-- we handle the form after submission in formVerification.php -->
                    <div class="table">
                        <div class="form-head2">Post jobs here:</div>
                        <!--  ----------------------------------------------------------------------------------------------------------------------------------------------------------- -->
                        <?php // to show error messages about bad inputs, we would have to show them on top of the page. Error messages are created in formValidation page
                        if (!empty($PostJobErrorMessage) && is_array($PostJobErrorMessage) && isset($_POST["postJob"])) {
                        ?>
                            <div class="error-message">
                                <?php
                                foreach ($PostJobErrorMessage as $message) {
                                    echo $message . "<br/>";
                                }
                                ?>
                            </div>
                        <?php
                        }
                        ?>
                        <!--  ----------------------------------------------------------------------------------------------------------------------------------------------------------- -->
                        <div class="form_column">
                            <label>Job Title</label>
                            <div>
                                <input type="text" class="input_textbox" name="jobTitle" value ="<?php if (isset($_POST['jobTitle'])) echo $_POST['jobTitle']; ?>">
                            </div>
                        </div>
                        <div class="form_column">
                            <label>Category</label>
                            <div>
                                <input type="number" min="0" class="input_textbox" name="jobCategory" value ="<?php if (isset($_POST['jobCategory'])) echo $_POST['jobCategory']; ?>">
                            </div>
                        </div>
                        <div class="form_column">
                            <label>Job Description</label>
                            <div>
                            <textarea name="jobDescription" rows="4" cols="50" placeholder ="<?php if (isset($_POST['jobDescription'])) echo $_POST['jobDescription']; ?>"></textarea>
                            </div>
                        </div>
                        <div class="form_column">
                            <label>Needed employees</label>
                            <div>
                                <input type="number" min="0" class="input_textbox" name="neededEmployees" value ="<?php if (isset($_POST['neededEmployees'])) echo $_POST['neededEmployees']; ?>">
                            </div>
                        </div>
                        <div>
                            <div>
                                <input type="submit" name="postJob" value="Create a new job posting" class="btnRegister">
                            </div>
                        </div>
                    </div>
                </form>
            </td>
            <td>
                <form name="getJob" method="post" action="">
                    <!-- we handle the form after submission in formVerification.php -->
                    <div class="table">
                        <div class="form-head">Get job details by JobId :</div>
                        <!--  ----------------------------------------------------------------------------------------------------------------------------------------------------------- -->
                        <?php // to show error messages about bad inputs, we would have to show them on top of the page. Error messages are created in formValidation page
                        if (!empty($GetJobErrorMessage) && is_array($GetJobErrorMessage) && isset($_POST["getJob"])) {
                        ?>
                            <div class="error-message">
                                <?php
                                foreach ($GetJobErrorMessage as $message) {
                                    echo $message . "<br/>";
                                }
                                ?>
                            </div>
                        <?php
                        }
                        ?>
                        <!--  ----------------------------------------------------------------------------------------------------------------------------------------------------------- -->
                        <?php // to show error messages about bad inputs, we would have to show them on top of the page. Error messages are created in formValidation page
                        if (!empty($EditJobErrorMessage) && is_array($EditJobErrorMessage) && isset($_POST["editJob"])) {
                        ?>
                            <div class="error-message">
                                <?php
                                foreach ($EditJobErrorMessage as $message) {
                                    echo $message . "<br/>";
                                }
                                ?>
                            </div>
                        <?php
                        }
                        ?>
                        <!--  ----------------------------------------------------------------------------------------------------------------------------------------------------------- -->
                        <div class="form_column">
                            <label>JobId</label>
                            <div>
                                <input type="number" class="input_textbox" name="jobId">
                            </div>
                            <div>
                                <input type="submit" name="getJob" value="Get details" class="btnRegister">
                            </div>
                            <?php // to show error messages about bad inputs, we would have to show them on top of the page. Error messages are created in formValidation page
                                if (!empty($GetJobResult) && is_array($GetJobResult) && isset($_POST["getJob"])) {
                            ?>
                                <form name="editJob" method="post" action="">
                                    <!-- we handle the form after submission in formVerification.php -->
                                    <div class="table">
                                        <div class="form-head">Edit job details here:</div>
                                        <div class="form_column">
                                            <label>JobId</label>
                                            <div>
                                                <input type="number" class="input_textbox" name="editJobId" value="<?php echo $GetJobResult[0]; ?>">
                                            </div>
                                            <label>Job Title</label>
                                            <div>
                                                <input type="text" class="input_textbox" name="editJobTitle" value ="<?php echo $GetJobResult[1]; ?>">
                                            </div>
                                        </div>
                                        <div class="form_column">
                                            <label>Category</label>
                                            <div>
                                                <input type="number" min="0" class="input_textbox" name="editJobCategory" value ="<?php echo $GetJobResult[2]; ?>">
                                            </div>
                                        </div>
                                        <div class="form_column">
                                            <label>Job Desription</label>
                                            <div>
                                            <textarea name="editJobDescription" rows="4" cols="50"><?php echo $GetJobResult[3]; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form_column">
                                            <label>Needed employees</label>
                                            <div>
                                                <input type="number" min="0" class="input_textbox" name="editNeededEmployees" value ="<?php echo $GetJobResult[5]; ?>">
                                            </div>
                                        </div>
                                        <div>
                                            <div>
                                                <input type="submit" name="editJob" value="Finish editing job details" class="btnRegister">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            <?php
                            }
                            ?>
                            <?php // to show error messages about bad inputs, we would have to show them on top of the page. Error messages are created in formValidation page
                                if (!empty($EditJobSuccessMessage) && is_array($EditSuccessMessage) && isset($_POST["editJob"])) {
                            ?>
                                <?php
                                foreach ($EditJobSuccessMessage as $message) {
                                    echo $message . "<br/>";
                                }
                                ?>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </form>
            </td>
            <td>
                <form name="deleteJob" method="post" action="">
                    <div class="table">
                    <label style="font-weight:200 ;">Enter the id of the job to delete :</label>
                    <!--  ----------------------------------------------------------------------------------------------------------------------------------------------------------- -->
                    <?php // to show error messages about bad inputs, we would have to show them on top of the page. Error messages are created in formValidation page
                        if (!empty($DeleteJobErrorMessage) && is_array($DeleteJobErrorMessage) && isset($_POST["jobIdToDelete"])) {
                        ?>
                            <div class="error-message">
                                <?php
                                foreach ($DeleteJobErrorMessage as $message) {
                                    echo $message . "<br/>";
                                }
                                ?>
                            </div>
                        <?php
                        }
                        ?>
                        <!--  ----------------------------------------------------------------------------------------------------------------------------------------------------------- -->
                    <div>
                        <input type="number" min="0" class="input_textbox" name="jobIdToDelete" value="<?php if (isset($_POST['jobIdToDelete'])) echo $_POST['jobIdToDelete']; ?>">
                    </div>
                    <div>
                        <input type="submit" name="deleteJob" value="Delete" class="btnRegister">
                    </div>
                </form>
            </td>    
            <td>
                <form name="showJobs" method="post" action="">
                    <div class="table">
                        <label style="font-weight:200 ;">Click to see all your jobs: </label>
                    </div>
                    <div>
                        <input type="submit" name="showJobs" value="Show All the Jobs" class="btnRegister">
                    </div>
                </form>
            </td> 
        </tr>
        <tr>
            <td>
                <form name="showJobApplications" method="post" action="">
                    <div class="table">
                        <label style="font-weight:200 ;">Click to see all applications to your jobs: </label>
                    </div>
                    <div>
                        <input type="submit" name="showJobApplications" value="Show All Job Applications" class="btnRegister">
                    </div>
                </form>
            </td>
        </tr>
    </table>
    <?php
    //----------------------------------------------------------------------------------------------------------------------------------
    if (isset($_POST["showJobs"])) {
        $_SESSION["allJobs"] = findAllJobsForEmployer();
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
 
    if (isset($_POST["showJobApplications"])) {
        $applied_jobs = findPostedJobs();
        if (is_array($applied_jobs)) {
            echo "</br><div class='form-head'>List of job applications recieved:</div><br>
                    <table> 
                    <tr>
                        <th styles>EmployeeId</th>
                        <th styles>Applicant</td>
                        <th styles>Applicant Email</td>
                        <th styles>Applicant Telephone</td>
                        <th styles>JobId</td>
                        <th styles>Job</td>
                    </tr>";
                    foreach ($applied_jobs as $application) {
                        foreach ($application as $key => $value) {
                            if ($key == "EmployeeId") {
                                echo "<tr><td>$value</td>";
                            } else {
                                echo "<td> $value";
        
                                if ($key == "Title") {
                                    echo "</tr>";
                                }
                            }
                        }
                    }
                    echo "</table>";
        } else {
            echo "<h3 class='form-head2'>$applied_jobs</h3><br>"; // Because no results found in jobs.
        }
    }
?>

</body>
</html>