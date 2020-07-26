<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $host = "database"; // service name from docker-compose.yml
        $user = "devuser";
        $password = "devpass";
        $db = "test_db";

        $conn = new mysqli($host, $user, $password, $db);
        if ($conn->connect_error) {
            echo "connection failed" . $conn->connect_error;
        };
        echo "Successfully connected to MySQL";
    ?>
</body>
</html>