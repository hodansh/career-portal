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

// After this line, if you get no errors, that means you are connected to the database. You refer to the database instance by $conn

function userExists($userName_input, $email_input) // To check if a username/email input is already taken in Emloyer table
// This method will return an array[boolean,boolean], the first boolean is true when username was taken and
// the second one is true for when the email taken.
{
    $username_taken = false;
    $email_taken = false;
    global $conn; // we need to globalize $conn inside our function, otherwise function will not have access to it and will give errors.

    $sql_u_on_employer = "SELECT UserName FROM Employer WHERE UserName='$userName_input'"; // we check if the username input by user is found on the table
    $sql_u_on_employee = "SELECT UserName FROM Employee WHERE UserName='$userName_input'";
    $res_u_on_employer = mysqli_query($conn, $sql_u_on_employer);
    $res_u_on_employee = mysqli_query($conn, $sql_u_on_employee);
    if (mysqli_num_rows($res_u_on_employer) > 0 or mysqli_num_rows($res_u_on_employee) > 0) {  //if the username is found, the number of rows for the result would not be zero
        $username_taken = true;
    }

    $sql_e_on_employer = "SELECT UserName FROM Employer WHERE Email='$email_input'"; // we check if the email input by user is found on the table
    $sql_e_on_employee = "SELECT UserName FROM Employee WHERE Email='$email_input'";
    $res_e_on_employer = mysqli_query($conn, $sql_e_on_employer);
    $res_e_on_employee = mysqli_query($conn, $sql_e_on_employee);
    if (mysqli_num_rows($res_e_on_employer) > 0 or mysqli_num_rows($res_e_on_employee) > 0) {  //if the email is found, the number of rows for the result would not be zero
        $email_taken = true;
    }

    $result = array($username_taken,  $email_taken);
    return $result;
}


function AddEmployer($userName, $userPassword, $Email, $Company, $Telephone, $PostalCode, $City, $Address, $EmployerCategoryId, $Status) // adding new employer to the table
{
    global $conn;
    $sql = "INSERT INTO Employer 
     (UserName, UserPassword, Email, Company, Telephone, PostalCode, City, Address, EmployerCategoryId,Status)
     VALUES ('$userName','$userPassword','$Email','$Company', '$Telephone','$PostalCode','$City','$Address',$EmployerCategoryId,'$Status');";
    $results = mysqli_query($conn, $sql);
}
function AddEmployee($userName, $userPassword, $Email, $Telephone, $PostalCode, $City, $Address, $EmployeeCategoryId, $Status) // adding new employee to the table
{
    global $conn;
    $sql = "INSERT INTO Employee
        (UserName, UserPassword, Email, Telephone, PostalCode, City, Address, EmployeeCategoryId,Status)
    VALUES ('$userName','$userPassword','$Email','$Telephone','$PostalCode','$City','$Address',$EmployeeCategoryId,'$Status');";
    $results = mysqli_query($conn, $sql);
}

function AddJobPost($title, $category, $jobDescription, $neededEmployees)
{
    $employerId = $_SESSION['employerId'];
    $todayDate = date("Y-m-d");
    global $conn;
    $sql = "INSERT INTO Job (Title, Category, JobDescription, DatePosted, NeededEmployees, AppliedEmployees, AcceptedOffers, EmployerId)
    VALUES ('$title', $category, '$jobDescription', '$todayDate', $neededEmployees, 0, 0, $employerId);";
    $result = mysqli_query($conn, $sql);
}

function Authentication($userNameInput, $passwordInput)
{
    $isMatched = false;
    $inactive = false;
    $match_employer = findAnEmployer($userNameInput);
    if ($match_employer != "not found") {
        if (strcasecmp($match_employer[1], "$userNameInput") == 0 && $match_employer[2] == "$passwordInput") { // strcasecmp will compare two strings case-insensitively, 
            // example: strcamsecmp(ABC,abc) will return 0
            $isMatched = True;
            $userType = "employer";
            if ($match_employer[10]== "inactive"){
                $inactive=true;
            }
            return [$isMatched, $userType, $match_employer[1], $inactive];
        }
    }
    $match_employee = findAnEmployee($userNameInput);
    if ($match_employee != "not found") {
        if (strcasecmp($match_employee[1], "$userNameInput") == 0 && $match_employee[2] == "$passwordInput") { // strcasecmp will compare two strings case-insensitively, 
            // example: strcamsecmp(ABC,abc) will return 0
            $isMatched = True;
            $userType = "employee";
            if ($match_employee[9]== "inactive"){
                $inactive=true;
            }
            return [$isMatched, $userType, $match_employee[1], $inactive];
        }
    }
    return [false, "", ""]; // This is where the username or password was not a match to the database
}

function findAnEmployer($userNameInput)
{
    $sql_employer = "SELECT * FROM Employer WHERE UserName='$userNameInput'";
    global $conn;
    if ($result = $conn->query($sql_employer)) {
        if (mysqli_num_rows($result) > 0) { // if at least one username was matched
            $row = $result->fetch_row(); // this will get one full row of database for Employer where username matched
            $result->free_result(); // This will free the memory that was dedicated to preserve the result of the query
            return $row;
        }
        return "not found!";
    }
}

function findAnEmployee($userNameInput)
{
    $sql_employee = "SELECT * FROM Employee WHERE UserName='$userNameInput'";
    global $conn;
    if ($result = $conn->query($sql_employee)) {
        if (mysqli_num_rows($result) > 0) { // if at least one username was matched
            $row = $result->fetch_row(); // this will get one full row of database for Employee where username matched
            $result->free_result(); // This will free the memory that was dedicated to preserve the result of the query
            return $row;
        }
        return "not found!";
    }
}

function findAll($tableName)
{
    global $conn;
    $sql = "SELECT * FROM $tableName;";
    if ($result = $conn->query($sql)) {
        while ($row = mysqli_fetch_assoc($result)){
            $resultArray[] = $row;    
        }
        return $resultArray;
    }
    return "Table $tableName is currenty empty.";
}

function findUserByCriterion($searchString, $criterion, $tableName)
{
    global $conn;
    $sql = "SELECT * FROM $tableName WHERE $criterion=\"$searchString\" ORDER BY $criterion;";
    if ($result = $conn->query($sql)) {
        if (mysqli_num_rows($result) > 0) { // if at least one username was matched
            while ($row = mysqli_fetch_assoc($result)){
                $resultArray[] = $row;    
            }
            return $resultArray;
        }
    }
    return "No results found for an $tableName with $criterion: $searchString!";
}

function deleteUser($userNameInput)
{
    global $conn;
    $message = "We could not find any user with UserName= $userNameInput in any of the tables";
    if (findAnEmployer($userNameInput) != "not found!") {
        $sql = "Delete FROM Employer WHERE UserName='$userNameInput';";
        if ($result = $conn->query($sql)) {
            $message = "$userNameInput was successfully deleted from Employers.";
        }
    } else  
if (findAnEmployee($userNameInput) != "not found!") {
        $sql = "Delete FROM Employee WHERE UserName='$userNameInput';";
        if ($result = $conn->query($sql)) {
            $message = "$userNameInput was successfully deleted from Employees.";
        }
    }
    return $message;
}


function activateUser($userNameInput)
{
    global $conn;
    if (findAnEmployer($userNameInput) == "not found!" && findAnEmployee($userNameInput) == "not found!") {
        $message = "The user name you entered cannot be found.";
        return $message;
    }
    if(findAnEmployer($userNameInput) != "not found!"){
    $sql = "UPDATE Employer SET Status = 'active'  WHERE UserName= '$userNameInput';";
    }
    else{
        $sql = "UPDATE Employee SET Status = 'active'  WHERE UserName= '$userNameInput';";
    }
    if ($result = $conn->query($sql)) {
        $message = "$userNameInput was successfully activated.";
    }
    return $message;
}
function deactivateUser($userNameInput)
{
    global $conn;
    if (findAnEmployer($userNameInput) == "not found!" && findAnEmployee($userNameInput) == "not found!") {
        $message = "The user name you entered cannot be found.";
        return $message;
    }
    if(findAnEmployer($userNameInput) != "not found!"){
        $sql = "UPDATE Employer SET Status = 'inactive'  WHERE UserName= '$userNameInput';";
        }
        else{
            $sql = "UPDATE Employee SET Status = 'inactive'  WHERE UserName= '$userNameInput';";
        }
    if ($result = $conn->query($sql)) {
        $message = "$userNameInput was successfully deactivated.";
    }
    return $message;
}


function connection_close($conn) // This can be used to close the connection, not the best approach! so we will have to figure out about the best way of doing it.
{
    $conn->close();
}
