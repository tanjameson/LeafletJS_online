<!-- <?php
$host = "localhost";
$username = "root";
$password = "jameson123";
$database = "db_articles";

// Create connection
$connection = mysqli_connect($host, $username, $password, $database);
// Check connection
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }
echo "Connected successfully"; ?> -->

<?php
define('DBHOST', 'localhost');
define('DBNAME', 'db_articles');
define('DBUSER', 'root');
define('DBPASS', 'jameson123');
?>