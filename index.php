<!DOCTYPE html>
<html>
    <!-- get map setup   -->
    <?php include 'mapApi.html';?>

    <!-- Load markers in SQL -->
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

$sql = "SELECT lat, lng,address,description,radius FROM db_articles.location;";
$i = 0;

if ($result = $conn -> query($sql)) {
  //printf("<b>Select query returned %d rows.</b><br><br>", $result->num_rows);
    while ($row = $result -> fetch_row()) {
      $array[$i][0] = $row[0]; //lat
      $array[$i][1] = $row[1]; //lng
      $array[$i][2] = $row[2]; //address
      $array[$i][3] = $row[3]; //description
      $array[$i][4] = $row[4]; //radius
      $i++;
    }
    $data = $array;
    $result -> free_result();
  }

$conn->close();
?>
    <script type="text/javascript">

    //add markers retreived from SQL

    var data = <?php echo json_encode($data, JSON_PRETTY_PRINT) ?>;

var i;

if(data != null)
for (i = 0; i < data.length; i++) {
  //console.log("This",books);
  console.log(data[i][3]);
  console.log(data[i][0]);
  L.marker(
    L.latLng(
    parseFloat(data[i][0]),
    parseFloat(data[i][1])
  )
  )
      .addTo(mymap)
      .bindPopup("<form name='form' action='deleteData.php' method='post'>  <b>Address: </b>"+data[i][2] +"<br><br>"+"<b>Description: </b>" + data[i][3] + "<br> <br> <button type='submit' id='delete' name='delete' value='call'>Delete</button> </form>").on('click',function(e){
        //console.log(e.latlng);

        document.getElementById("delete").addEventListener("click", function() {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;
            console.log("this is lat", lat);
            console.log("this is lng", lng);
            document.cookie = "lat = " + lat;
            document.cookie = "lng = " + lng;
  
});
        // document.addEventListener("click", function() {
        //     //alert(this.getLatLng());
        //     // var temp = data[0][5];
        //     // console.log(temp);
            
        //     var lat = e.latlng.lat;
        //     var lng = e.latlng.lng;
        //     console.log("this is lat", lat);
        //     console.log("this is lng", lng);
        // });
      });

      var circle = L.circle(
                [parseFloat(data[i][0]), parseFloat(data[i][1])], {
                    color: "red",
                    fillColor: "#f03",
                    fillOpacity: 0.5,
                    radius: data[i][4],
                }
            ).addTo(mymap);

        
}
    //****************************SEARCH CONTROL************************************//

    // create the geocoding control and add it to the map
    var searchControl = L.esri.Geocoding.geosearch().addTo(mymap);

    // create an empty layer group to store the results and add it to the map
    var results = L.layerGroup().addTo(mymap);

    // listen for the results event and add every result to the map
    searchControl.on("results", function(data) {
        //results.clearLayers();
        for (var i = data.results.length - 1; i >= 0; i--) {
            console.log("This is stored in the results", data.results);
            document.cookie = "lat = " + data.results[0].latlng.lat;
            document.cookie = "lng = " + data.results[0].latlng.lng;
            document.cookie = "text = " + data.results[0].text;

            results.addLayer(
                L.marker(data.results[i].latlng).bindPopup(
                    data.results[i].text +
                    "</br>" +
                    data.results[i].latlng.toString() +
                    "<br><form name='form' action='insertData.php' method='post'> <textarea type='text' rows='4' cols='40' name='subject' id='subject' value='' placeholder='Enter a Description'></textarea> <br><br> <table><tr><td>Radius of Red Zone: </td><td><input id='slide'0 type='range' min='0' max='5000' step='10' value='0' onchange='updateSlider(this.value)'></td><td id='sliderAmount'>0</td><td>mm</td></tr></table> <br>  <button type='submit' name='sub' value='call'>Save</button> <br> <p id='someText'></p> </form>"
                    //"<br><br><form name='form' action='insertData.php' method='post'> <textarea type='text' name='subject' id='subject' value='' placeholder='Enter a Description'></textarea> <br><br> <input type=number name='radiusInput'  id='radiusInput' placeholder='Radius of Red Zone'/> <br><br>  <button type='submit' name='sub' value='call'>Save</button> <br> <p id='someText'>fff</p> </form>"
                )
            );
            
            //listening to the submit btn in the map

            
            document.addEventListener("click", function() {
                var radiusInput = document.getElementById("sliderAmount").innerText;
                var temp = document.getElementById("subject").value;
                var temp2 = temp.toString();
                //var radiusInput = document.getElementById("radiusInput").value;
                console.log("radius input",radiusInput);
                document.getElementById("someText").innerHTML = temp2;
                document.cookie = "description = " + temp2;
                document.cookie = "radiusInput = " + radiusInput;
            });
            //Add circle based on the lat long

            var circle = L.circle(
                [data.results[i].latlng.lat, data.results[i].latlng.lng], {
                    color: "red",
                    fillColor: "#f03",
                    fillOpacity: 0.5,
                    radius: 500,
                }
            ).addTo(mymap);
        }
        
    });
</script>
    
    <script>
    function updateSlider(slideAmount) {
        var sliderDiv = document.getElementById("sliderAmount");
        sliderDiv.innerHTML = slideAmount;
    }
</script>
</html>