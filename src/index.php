<?php session_start(); // session will keep the desired info (on the server) when user is navigating to other pages.
$_SESSION["userName"] = ""; //for example, when you register the user, you can use this variable to show his name on the welcome page (welcome USERNAME)
include_once "./validation/sign_up_validation.php"; //including an external php file, so the variables in this page will be accessible in that page and vice versa
include_once "database_operations.php"; // we include each file only once, because otherwise it will give errors and complain about multiple-times declarations 
?>

<html>

<head>
    <title>Welcome to Career-Portal</title>
    <link href="./css/style.css" rel="stylesheet" type="text/css" /> <!-- link to css file -->
</head>

<body>

    <form name="signUpForm" method="post" action="">
        <!-- we handle the form after submission in formVerification.php -->
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
                    <!-- the php code that was written after value= helps preserving user input for when a user put wrong input -->
                    <!-- for each of the input textboxs, whatever name that we chose will be used to get the user input for that
                    text box. for example we refere to $_POST['userName'] to get the value of user input for username -->
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
                    <select name="MembershipType" id="membership_selection">
                        <!-- This is a drop-down menu. $_POST['MembershipType] will give you the value of selected option after form submission. -->
                        <option hidden disabled selected value> -- select an option -- </option>
                        <option value="employer_prime">Employer Prime Membership (5 job posts/month for $50)</option>
                        <option value="employer_gold">Employer Gold Membership (unlimited job posts/month for $100)</option>

                        <option disabled="true" value="divider"></option> <!-- just to make a space between emloyer and employee on the drop-down menu -->

                        <option value="employee_basic">employee Basic Membership (can only view jobs for free)</option>
                        <option value="employee_prime">employee Prime Membership (apply for 5 jobs for $10/month)</option>
                        <option value="employee_gold">employee Gold Membership (apply for any number of jobs for $20/month)</option>

                    </select>
                </div>
                <div class="form_column">
                    <label>Email</label>
                    <div>
                        <input type="text" class="input_textbox" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
                    </div>
                </div>
                <div class="form_column">
                    <label>Company (optional for employees)</label>
                    <div>
                        <input type="text" class="input_textbox" name="company" value="<?php if (isset($_POST['company'])) echo $_POST['company']; ?>">
                    </div>
                </div>
                <div class="form_column">
                    <label>Telephone</label>
                    <div>
                        <input type="text" class="input_textbox" name="tel" value="<?php if (isset($_POST['tel'])) echo $_POST['tel']; ?>">
                    </div>
                </div>
                <div class="form_column">
                    <label>Postal Code</label>
                    <div>
                        <input type="text" class="input_textbox" name="postalCode" value="<?php if (isset($_POST['postalCode'])) echo $_POST['postalCode']; ?>">
                    </div>
                </div>
                <div class="form_column">
                    <label>City</label>
                    <div>
                        <input type="text" class="input_textbox" name="city" value="<?php if (isset($_POST['city'])) echo $_POST['city']; ?>">
                    </div>
                </div>
                <div class="form_column">
                    <label>Address</label>
                    <div>
                        <input type="text" class="input_textbox" name="address" value="<?php if (isset($_POST['address'])) echo $_POST['address']; ?>">
                    </div>
                </div>
                </br>



                <div>
                    <input type="submit" name="signUpFrom" value="signUp" class="btnRegister">
                </div>
            </div>
        </div>
    </form>


    <div class="form_column" style="text-align: center;">
        <p>Already on Career-Portal? &nbsp;&nbsp;
            <a href="sign_in.php">Sign in</a>
        </p>
    </div>


</body>

</html>