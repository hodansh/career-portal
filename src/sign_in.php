<?php session_start(); // session will keep the desired info (on the server) when user is navigating to other pages.
$_SESSION["userName"] = ""; //for example, when you register the user, you can use this variable to show his name on the welcome page (welcome USERNAME)
include_once "database_operations.php";
include_once "./validation/sign_in_validation.php"; // we include each file only once, because otherwise it will give errors and complain about multiple-times declarations 
?>

<html>

<head>
    <title>Sign in</title>
    <link href="./css/style.css?version=52" rel="stylesheet" type="text/css" /> <!-- link to css file -->
</head>

<body>

    <form name="signIn" method="post" action="">
        <!-- we handle the form after submission in formVerification.php -->
        <div class="table">
            <div class="form-head">Sign in here:</div>
            <!--  ----------------------------------------------------------------------------------------------------------------------------------------------------------- -->
            <?php // to show error messages about bad inputs, we would have to show them on top of the page. Error messages are created in sign_up_validation page
            if (!empty($SignInErrorMessage) && is_array($SignInErrorMessage) && isset($_POST["signInFrom"])) {
            ?>
                <div class="error-message">
                    <?php
                    foreach ($SignInErrorMessage as $message) {
                        echo $message . "<br/>";
                    }
                    ?>
                </div>
            <?php
            }
            ?>
            <!--  ----------------------------------------------------------------------------------------------------------------------------------------------------------- -->
            <div >
                <label>Username</label>
                <div>
                    <input type="text" class="input_textbox" name="userName" value="<?php if (isset($_POST['userName'])) echo $_POST['userName']; ?>">
                    
                </div>
            </div>

            <div >
                <label>Password</label>
                <div><input type="password" class="input_textbox" name="password" value=""></div>
            </div>
                    

                <div>
                    <input type="submit" name="signInFrom" value="Sign in" class="btnRegister">
                </div>
            </div>
            <div  style="text-align: center;">
        
            <a href="index.php" style="font-weight: 600;">Create a new account</a>
        
    </div>
        </div>
    </form>




</body>

</html>