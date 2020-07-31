<?php session_start(); // session will keep the desired info (on the server) when user is navigating to other pages.
$_SESSION["userName"] = ""; //for example, when you register the user, you can use this variable to show his name on the welcome page (welcome USERNAME)
include_once "formValidation.php";
include_once "database_operations.php" //including an external php file, so the variables in this page will be accessible in that page and vice versa
?>

<html>

<head>
    <title>Welcome to Career-Portal</title>
    <link href="./css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>

    <form name="signUpForm" method="post" action="">
        <div class="table">
            <div class="form-head">Sign up here:</div>
            <!--  ----------------------------------------------------------------------------------------------------------------------------------------------------------- -->
            <?php // to show error messages about bad inputs, we would have to show them on top of the page. Error messages are created in formValidation page
            if (!empty($errorMessage) && is_array($errorMessage) && isset($_POST["signUpFrom"])) {
            ?>
                <div class="error-message">
                    <?php
                    foreach ($errorMessage as $message) {
                        echo $message . "<br/>";
                    }
                    if (isset($_POST['signUpFrom'])) {
                    ?>
                    <?php
                    }
                    ?>
                </div>
            <?php
            }
            ?>
            <!--  ----------------------------------------------------------------------------------------------------------------------------------------------------------- -->
            <div class="form_column">
                <label>Username</label>
                <div>
                    <input type="text" class="input_textbox" name="userName" value="<?php if (isset($_POST['userName'])) echo $_POST['userName']; ?>">
                </div>
            </div>

            <div class="form_column">
                <label>Password</label>
                <div><input type="password" class="input_textbox" name="password" value=""></div>
            </div>
            <div class="form_column">
                <label>Confirm Password</label>
                <div>
                    <input type="password" class="input_textbox" name="confirm_password" value="">
                </div>
            </div>
            <div class="form_column">
                <label>Please select your user preference:</label>
                <div>
                    <input type="radio" name="userType" <?php if (isset($_POST['userType']) && $$_POST['userType'] = "employer") echo "checked"; ?> value="employer">Employer
                    <input type="radio" name="userType" <?php if (isset($_POST['userType']) && $_POST['userType'] == "applicant") echo "checked"; ?> value="applicant">Applicant

                </div>
                <div class="form_column">
                    <label>Email</label>
                    <div>
                        <input type="text" class="input_textbox" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
                    </div>
                </div>

                <div>
                    <input type="submit" name="signUpFrom" value="signUp" class="btnRegister">
                </div>
            </div>
        </div>
    </form>


    <div class="form_column" style="text-align: center;">
        <p>Already on Career-Portal? &nbsp;&nbsp;
            <a href="signin.php">Sign in</a>
        </p>
    </div>


</body>

</html>
