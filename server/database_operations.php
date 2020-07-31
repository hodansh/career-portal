<?php
$host = "database"; // service name from docker-compose.yml
$user = "devuser";
$password = "devpass";
$db = "test_db";

$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
};
// echo "Successfully connected to MySQL";

function EmployerExists($userName_input, $email_input)
{
    $username_taken = false;
    $email_taken = false;
    global $conn;
    $sql_u = "SELECT UserName FROM Employer WHERE UserName=\"$userName_input\"";
    $res_u = mysqli_query($conn, $sql_u);
    if (mysqli_num_rows($res_u) > 0) {
        $username_taken = true;
    }

    $sql_e = "SELECT Email FROM Employer WHERE Email=\"$email_input\"";
    $res_e = mysqli_query($conn, $sql_e);
    if (mysqli_num_rows($res_e) > 0) {
        $email_taken = true;
    }
    $result = array($username_taken,  $email_taken);
    return $result;
}


function AddEmployer($ID,$userName, $userPassword, $Email, $Company, $Telephone, $PostalCode, $City, $Address, $EmployerCategoryId){
    global $conn;
    $sql= "INSERT INTO Employer VALUES($ID,'$userName', '$userPassword', '$Email', '$Company', '$Telephone', '$PostalCode', '$City', '$Address', $EmployerCategoryId)";
    $results = mysqli_query($conn, $sql);
    echo "SAVED!";
}


function connection_close($conn)
{
    $conn->close();
}
?>