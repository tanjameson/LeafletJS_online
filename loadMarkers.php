<!DOCTYPE html>
<html>

    <body>
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

$sql = "SELECT lat, lng,address,description FROM db_articles.location;";
$i = 0;

if ($result = $conn -> query($sql)) {
  printf("<b>Select query returned %d rows.</b><br><br>", $result->num_rows);
    while ($row = $result -> fetch_row()) {
      $array[$i][0] = $row[0];
      $array[$i][1] = $row[1];
      $array[$i][2] = $row[2];
      $array[$i][3] = $row[3];
      
      echo($array[$i][0] . "<br>");
      echo($array[$i][1] . "<br>");
      echo($array[$i][2] . "<br> ");
      echo($array[$i][3] . "<br><br>");
      $i++;

    }
    $data = $array;
    $result -> free_result();
  }

$conn->close();
?>
<script type="text/javascript">
// pass PHP array to JavaScript 
var data = <?php echo json_encode($data, JSON_PRETTY_PRINT) ?>;

var i;
for (i = 0; i < data.length; i++) {
  //console.log("This",books);
  console.log(data[i][3]);
}

//console.log( books[1]); 
</script>


    </body>

</html>