<?php
session_start();

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

    $sql_u_on_employer = "SELECT * FROM Employer WHERE UserName='$userName_input'"; // we check if the username input by user is found on the table
    $sql_u_on_employee = "SELECT * FROM Employee WHERE UserName='$userName_input'";
    $res_u_on_employer = mysqli_query($conn, $sql_u_on_employer);
    $res_u_on_employee = mysqli_query($conn, $sql_u_on_employee);

    if (mysqli_num_rows($res_u_on_employer) > 0 or mysqli_num_rows($res_u_on_employee) > 0) {  //if the username is found, the number of rows for the result would not be zero
        $username_taken = true;
    }

    $sql_e_on_employer = "SELECT * FROM Employer WHERE Email='$email_input'"; // we check if the email input by user is found on the table
    $sql_e_on_employee = "SELECT * FROM Employee WHERE Email='$email_input'";
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

////////////////////////////////////////////////////////////////// JOB //////////////////////////////////////////////////////////////////////

// POST
function AddJobPost($title, $category, $jobDescription, $neededEmployees)
{
    $employerId = $_SESSION['employerId'];
    $todayDate = date("Y-m-d");
    global $conn;
    $sql = "INSERT INTO Job (Title, Category, JobDescription, DatePosted, NeededEmployees, AppliedEmployees, AcceptedOffers, EmployerId)
    VALUES ('$title', $category, '$jobDescription', '$todayDate', $neededEmployees, 0, 0, $employerId);";
    $result = mysqli_query($conn, $sql);
}

// DELETE
function DeleteJobPost($id)
{
    global $conn;
    $message = "You do not have a job with the given id, pick one from the table.";

    $jobFound = GetJobForEmployer($id);

    if (!is_null($jobFound)) {
        $sql = "Delete FROM Job WHERE JobId=$id;";
        if ($result = $conn->query($sql)) {
            $message = "Job successfully deleted.";
        }
    }

    return $message;
}

// UPDATE
function EditJobPost($id, $title, $category, $jobDescription, $neededEmployees)
{
    global $conn;
    $jobFound = GetJobForEmployer($id);
    
    if (!is_null($jobFound)) {
        $sql = "Update Job
        SET Title = '$title', Category = '$category', JobDescription = '$jobDescription', NeededEmployees = '$neededEmployees'
        WHERE JobId = $id;";
        $result = $conn->query($sql);
        $message = $result;
        if ($result = $conn->query($sql)) {
            return "Job successfully updated.";
        }
    }

    return null;
}

// GET
function getJobById($id)
{
    $sql = "SELECT * FROM Job WHERE JobId =$id";
    global $conn;
    if ($result = $conn->query($sql)) {
        if (mysqli_num_rows($result) > 0) { // if JobId was matched
            $row = $result->fetch_row(); // this will get one full row of database for Job where JobId matched
            $result->free_result(); // This will free the memory that was dedicated to preserve the result of the query
            return $row;
        }
    }
    return null;
}

// GET for specific employer
function GetJobForEmployer($id)
{
    $employerId = $_SESSION['employerId'];
    $sql = "SELECT * FROM Job WHERE JobId = $id AND EmployerId = $employerId";
    global $conn;
    if ($result = $conn->query($sql)) {
        if (mysqli_num_rows($result) > 0) { // if JobId was matched
            $row = $result->fetch_row(); // this will get one full row of database for Job where JobId matched
            $result->free_result(); // This will free the memory that was dedicated to preserve the result of the query
            return $row;
        }
    }
    return null;
}

// GET all for employer
function findAllJobsForEmployer()
{
    global $conn;
    $employerId = $_SESSION['employerId'];
    $sql = "SELECT * FROM Job WHERE EmployerId = $employerId;";
    if ($result = $conn->query($sql)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $resultArray[] = $row;
        }
        return $resultArray;
    }
    return "Table is currenty empty.";
}


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////// JOB APPLICATION //////////////////////////////////////////////////////////

// POST
function createJobApplication($jobId)
{
    global $conn;
    $employeeId = $_SESSION['employeeId'];
    $sql = "INSERT INTO JobApplication (EmployeeId, JobId, Status)
    VALUES ($employeeId, $jobId, 'active');";
    if ($result = mysqli_query($conn, $sql)) {
        $sql = "UPDATE Job SET AppliedEmployees = AppliedEmployees+1 WHERE JobId=$jobId; ";
        mysqli_query($conn, $sql);
        return "Job Application successfully created.";
    } else {
        return  "Job application cannot be created";
    }
}

// GET all for specific employer
function findPostedJobs()
{
    global $conn;
    $employerId = $_SESSION['employerId'];
    $sql = "SELECT Employee.EmployeeId, Employee.UserName, Employee.Email, Employee.Telephone, Job.JobId, Job.Title FROM JobApplication, Job, Employee WHERE JobApplication.JobId = Job.JobId AND Employee.EmployeeId = JobApplication.EmployeeId AND EmployerId=$employerId;";
    if ($result = $conn->query($sql)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $resultArray[] = $row;
        }

        return $resultArray;
    }
    return "You have not posted any jobs yet!";
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

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
            if ($match_employer[10] == "inactive") {
                $inactive = true;
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
            if ($match_employee[9] == "inactive") {
                $inactive = true;
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
        while ($row = mysqli_fetch_assoc($result)) {
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
            while ($row = mysqli_fetch_assoc($result)) {
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
    if (findAnEmployer($userNameInput) != "not found!") {
        $sql = "UPDATE Employer SET Status = 'active'  WHERE UserName= '$userNameInput';";
    } else {
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
    if (findAnEmployer($userNameInput) != "not found!") {
        $sql = "UPDATE Employer SET Status = 'inactive'  WHERE UserName= '$userNameInput';";
    } else {
        $sql = "UPDATE Employee SET Status = 'inactive'  WHERE UserName= '$userNameInput';";
    }
    if ($result = $conn->query($sql)) {
        $message = "$userNameInput was successfully deactivated.";
    }
    return $message;
}
function findAppliedJobs($employeeId)
{
    global $conn;
    $sql = "SELECT JobId FROM JobApplication WHERE EmployeeId=$employeeId;";
    if ($result = $conn->query($sql)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $JobIdsArray[] = $row;
        }

        foreach ($JobIdsArray as $row) {
            foreach ($row as $jid) {
                $sql = "SELECT * FROM Job WHERE JobId=$jid;";
                if ($result = $conn->query($sql)) {
                    $resultArray[] = $result;
                }
            }
        }

        return $resultArray;
    }
    return "You have not applied for any jobs yet!";
}

function addCategory($MembershipType,$Status,$MonthlyCharge,$MaxJobs){
    global $conn;
    $sql = "INSERT INTO $MembershipType (Status, MonthlyCharge, MaxJobs) 
    VALUES ('$Status',$MonthlyCharge,$MaxJobs);";
    if($result = $conn->query($sql)){
        return "New category successfully added to $MembershipType table.";
    }
    return "We coulds not add the category.";

}


function connection_close($conn) // This can be used to close the connection, not the best approach! so we will have to figure out about the best way of doing it.
{
    $conn->close();
}
