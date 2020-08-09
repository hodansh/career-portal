<?php session_start();
include_once "../validation/post_job_validation.php"; 
?>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/style.css?version=52" rel="stylesheet" type="text/css" /> <!-- link to css file -->
    <title>Employer Dashboard</title>
</head>

<body>
    <h1>Employer Dashboard</h1>
    <h1> Welcome <?php echo $_SESSION["userName"]; ?>
    <form name="postJob" method="post" action="">
        <!-- we handle the form after submission in formVerification.php -->
        <div class="table">
            <div class="form-head">Post job here:</div>
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
                    <input type="text" class="input_textbox" name="jobTitle" value="test">
                </div>
            </div>
            <div class="form_column">
                <label>Category</label>
                <div>
                    <input type="number" class="input_textbox" name="jobCategory" value="test">
                </div>
            </div>
            <div class="form_column">
                <label>Job Desription</label>
                <div>
                <textarea name="jobDescription" rows="4" cols="50" value="asdasd"></textarea>
                </div>
            </div>
            <div class="form_column">
                <label>Needed employees</label>
                <div>
                    <input type="number" class="input_textbox" name="neededEmployees" value="1">
                </div>
            </div>
            <div>
                <div>
                    <input type="submit" name="postJob" value="Create a new job posting" class="btnRegister">
                </div>
            </div>
        </div>
    </form>
</body>

</html>