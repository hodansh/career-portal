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
                            <option value="userName">by username</option>
                            <option value="email">by email address</option>
                            <option value="company">by company name</option>
                            <option value="tel">by telephone number</option>
                            <option value="address">by address</option>
                            <option value="city">by city</option>
                            <option value="postalCode">by postal code</option>
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
     


</body>

</html>