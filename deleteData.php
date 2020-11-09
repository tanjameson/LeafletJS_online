<!DOCTYPE html>
<html>

    <body>
        <?php
    $lat= $_COOKIE['lat'];
    $lng= $_COOKIE['lng'];

    $servername = "localhost";
    $username = "root";
    $password = "jameson123";
    $dbname = "db_articles";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (!$conn -> query("DELETE FROM db_articles.location WHERE lat ='".$lat."' AND lng ='".$lng."'")) {
        echo("Error description: " . $conn -> error);
    }

    $conn->close();

    header("Location: http://localhost:8080/LeafletJS_online/"); 

    ?>

        </body>

    </html>