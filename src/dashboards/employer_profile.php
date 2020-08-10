<?php session_start();
include_once "../database_operations.php";
?>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/style.css?version=52" rel="stylesheet" type="text/css" /> <!-- link to css file -->
    <title>Edit Profile - Employer</title>
</head>

<body>
    <a href="./employer_dashboard.php" style="font-weight: 600; font-size: large; ">Back to Employer</a>
    <?php
    $employer_row = findAnEmployer($_SESSION['userName']);
    echo "<div class=form-head2 style='font-size: large;'>Your current information:</div><br>
        
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
    <td>Status</td>         
    
    </tr>";

    foreach ($employer_row as $key => $value) {
        if ($key == "EmployerId") {
            echo "<tr>";
        } else {
            echo "<td> $value";

            if ($key == "Status") {
                echo "</tr>";
            }
        }
    }
    echo "</tr></table><br>";
    ?>
    <form name="updateCredentials" method="post" action="">
        <div class='form-head'> You can update any field of your information that you like:</div>
        <div>
            <label>Email</label>
            <div>
                <input type="text" class="input_textbox" name="Email" value="<?php if (isset($_POST['Email'])) echo $_POST['Email']; ?>">
            </div>
        </div>
        <div>
            <label>Company</label>
            <div>
                <input type="text" class="input_textbox" name="Company" value="<?php if (isset($_POST['Company'])) echo $_POST['Company']; ?>">
            </div>
        </div>
        <div>
            <label>Telephone</label>
            <div>
                <input type="text" class="input_textbox" name="Telephone" value="<?php if (isset($_POST['Telephone'])) echo $_POST['Telephone']; ?>">
            </div>
        </div>
        <div>
            <label>Postal Code</label>
            <div>
                <input type="text" class="input_textbox" name="PostalCode" value="<?php if (isset($_POST['PostalCode'])) echo $_POST['PostalCode']; ?>">
            </div>
        </div>
        <div>
            <label>City</label>
            <div>
                <input type="text" class="input_textbox" name="City" value="<?php if (isset($_POST['City'])) echo $_POST['City']; ?>">
            </div>
        </div>
        <div>
            <label>Address</label>
            <div>
                <input type="text" class="input_textbox" name="Address" value="<?php if (isset($_POST['Address'])) echo $_POST['Address']; ?>">
            </div>
        </div>
        </br>
        <div>
            <input type="submit" name="updateCredentials" value="Update" class="btnRegister">
        </div>



</body>

</html>
<?php
$employerId = $_SESSION["employerId"];
if (isset($_POST['updateCredentials'])) {
    foreach ($_POST as $key => $value) {
        if (!empty($value)) {
            global $conn;
            $sql = "UPDATE Employer SET $key='$value' WHERE EmployerId=$employerId;";
            $result = mysqli_query($conn, $sql);
        }
    }
}
