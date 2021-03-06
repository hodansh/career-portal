<?php session_start();
include_once "../validation/employer_validations/job_validations/post_job_validation.php"; 
include_once "../validation/employer_validations/job_validations/post_job_offer_validation.php"; 
include_once "../validation/employer_validations/payment_validations/payment_validation.php"; 
include_once "../validation/employer_validations/payment_validations/delete_payment_validation.php"; 
include_once "../validation/employer_validations/job_validations/delete_job_validation.php";
include_once "../validation/employer_validations/job_validations/get_job_For_Employer_validation.php";
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
    <h1>Payments Dashboard</h1>
    <div class="form-head">Welcome <?php echo $_SESSION["userName"]; ?> to the payments page</div>
    <br>
    <table>
        <tr>
            <td>
                <form name="postPayment" method="post" action="">
                    <!-- we handle the form after submission in formVerification.php -->
                    <div class="table">
                        <div class="form-head2">Payment Method:</div>
                        <!--  ----------------------------------------------------------------------------------------------------------------------------------------------------------- -->
                        <?php // to show error messages about bad inputs, we would have to show them on top of the page. Error messages are created in formValidation page
                        if (!empty($PostJobErrorMessage) && is_array($PostJobErrorMessage) && isset($_POST["postPayment"])) {
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
                            <label>Account/Credit Card Number:</label>
                            <div>
                                <input type="text" class="input_textbox" name="accountNumber" value ="<?php if (isset($_POST['accountNumber'])) echo $_POST['accountNumber']; ?>">
                            </div>
                        </div>
                        <div class="form_column">
                            <label for="">Payment Type:</label>
                            <div>
                                <label for="checking">Checking Account: </label>
                                <input type="radio" name="paymentType" id="checking" value="Checking Account" required>
                                <label for="credit">Credit Card: </label>
                                <input type="radio" name="paymentType" id="credit" value="Credit Card" required>
                            </div>
                        </div>
                        <div class="form_column">
                            <label>Withdrawal Method:</label>
                            <div>
                                <label for="automatic">Automatic: </label>
                                <input type="radio" name="withdrawalType" id="automatic" value="Automatic" <?php if (isset($_POST['withdrawalType'])) echo $_POST['withdrawalType']; ?> required>
                                <label for="manual">Manual: </label>
                                <input type="radio" name="withdrawalType" id="manual" value="Manual" <?php if (isset($_POST['withdrawalType'])) echo $_POST['withdrawalType']; ?> required>
                            </div>
                        </div>
                        <div>
                            <div>
                                <input type="submit" name="postPayment" value="Create a Payment Method" class="btnRegister">
                            </div>
                        </div>
                    </div>
                </form>
            </td>
            <td>
                <form name="getJob" method="post" action="">
                    <!-- we handle the form after submission in formVerification.php -->
                    <div class="table">
                        <div class="form-head2">Get payment details by payment Id :</div>
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
        </tr>
        <tr>
            <td>
                <form name="deletePayment" method="post" action="">
                    <div class="table">
                    <label style="font-weight:200 ;">Enter the id of the payment to delete:</label>
                    <!--  ----------------------------------------------------------------------------------------------------------------------------------------------------------- -->
                    <?php // to show error messages about bad inputs, we would have to show them on top of the page. Error messages are created in formValidation page
                        if (!empty($DeleteJobErrorMessage) && is_array($DeleteJobErrorMessage) && isset($_POST["paymentIdToDelete"])) {
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
                        <input type="number" min="0" class="input_textbox" name="paymentIdToDelete" value="<?php if (isset($_POST['paymentIdToDelete'])) echo $_POST['paymentIdToDelete']; ?>">
                    </div>
                    <div>
                        <input type="submit" name="deletePayment" value="Delete" class="btnRegister">
                    </div>
                </form>
            </td>    
            <td>
                <form name="showPaymentMethods" method="post" action="">
                    <div class="table">
                        <label style="font-weight:200 ;">Click to see all your jobs: </label>
                    </div>
                    <div>
                        <input type="submit" name="showPaymentMethods" value="Show All Payment Methods" class="btnRegister">
                    </div>
                </form>
            </td> 
        </tr>
    </table>
    <?php
    //----------------------------------------------------------------------------------------------------------------------------------
    if (isset($_POST["showPaymentMethods"])) {
        $_SESSION["allPaymentMethods"] = findAllPaymentMethods();
    }
    if (isset($_SESSION["allPaymentMethods"])) { //show all the jobs:
        $res_jobs = $_SESSION["allPaymentMethods"];

        if (is_array($res_jobs)) {

            echo "</br><div class='form-head'>All Payment Methods on File:</div><br>
        
        <table> <tr>
        <td>Payment ID</td>
        <td>Account Number</td>
        <td>Payment Type</td>
        <td>Withdrawal Type</td>
        <td>Status</td>
        <td>Balance</td>
        <td>Employee ID</td>
        <td>Employer ID</td>
        </tr>";
            foreach ($res_jobs as $row) {
                foreach ($row as $key => $value) {
                    if ($key == "PaymentId") {
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