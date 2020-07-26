<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>ADMIN PAGE</header>
    <div class="data">
        <h1> THIS PROJECT SUCKS! </h1>

        <form id="foo" method="POST">
            <br>
            <label>Insert Query</label>
            <br>
            <textarea name="query10" rows="5" cols="50">
                <?php if (isset($_POST['query10'])) {
                    echo htmlentities($_POST['query10']);
                } 
                ?>
            </textarea>
            <br>
            <input type="submit" value="Send Query" name="anyQuery" />
        </form>
        <div id="commandLine">
            <?php
            // $servername = "127.0.0.1:12000";
            // $username = "qyc353_1";
            // $password = "1234qwer";
            // $dbname = "qyc353_1";

            // // Create connection
            // $conn = new mysqli($servername, $username, $password, $dbname);
            // // Check connection
            // if ($conn->connect_error) {
            //     die("Connection failed: " . $conn->connect_error);
            // }

                $host = "database"; // service name from docker-compose.yml
                $user = "devuser";
                $password = "devpass";
                $db = "test_db";

                $conn = new mysqli($host, $user, $password, $db);
                if ($conn->connect_error) {
                    echo "connection failed" . $conn->connect_error;
                };
                echo "Successfully connected to MySQL";

                if (isset($_POST['anyQuery'])) {
                    $sql = $_POST['query10'];
                    $insert = "insert";
                    $delete = "delete";
                    if (stripos($sql, $insert) !== FALSE) {
                        $result = $conn->query($sql) or die($conn->error);
                        echo "Item added";
                    } elseif (stripos($sql, $delete) !== FALSE) {
                        $result = $conn->query($sql) or die($conn->error);
                        echo "Item deleted";
                    } else {
                        $result = $conn->query($sql) or die($conn->error);
                        while ($row = $result->fetch_assoc()) {
                            print("<pre>" . print_r($row, true) . "</pre>");
                        }
                    }
                }
                $conn->close();
            ?>
        </div>
    </div>
</body>

</html>