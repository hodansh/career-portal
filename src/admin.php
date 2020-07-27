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
                $host = "database";
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