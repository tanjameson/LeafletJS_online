<!DOCTYPE html>
<html>

    <body>

        <?php
    $description =  $_COOKIE['description'];
    $radiusInput =  $_COOKIE['radiusInput'];
    $address= $_COOKIE['text'];
  $lat= $_COOKIE['lat'];
  $lng= $_COOKIE['lng'];
  echo $address . "<br> Sucessfully saved!";
  echo $radiusInput;
  if($radiusInput ==null)
  $radiusInput=0;
 ?>


        <?php
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

if (!$conn -> query("INSERT INTO db_articles.location(lat,lng,radius,address,description) VALUES ('".$lat."','".$lng."','" .$radiusInput."','" .$address."','" .$description."') ON DUPLICATE KEY UPDATE description= '".$description."', radius=".$radiusInput.";")) {
    echo("Error description: " . $conn -> error);
  }

$conn->close();

header("Location: http://localhost:8080/LeafletJS_online/"); 

?>

    </body>



</html>