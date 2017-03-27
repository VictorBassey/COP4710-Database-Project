<head>
  <title>UCF Events</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  <script src="http://maps.googleapis.com/maps/api/js"></script>
  <link rel="stylesheet" href="css/navstuff.css">
  <link rel="stylesheet" href="css/login.css">
  <link rel="stylesheet" href="css/admin.css">
  <link rel="stylesheet" href="css/home.css">
  <link rel="stylesheet" href="css/eventPanel.css">
  
  <style>
	html, body, #map-canvas {
		height: 80%;
		margin: 0px;
		padding: 0px
	}
  </style>

  <script>
    function rsoDropdown(type){
      if(type == "rso"){
        document.getElementById("rso_list").style.display="block";
      }else{
        document.getElementById("rso_list").style.display="none";
      }
    }
    function newEvent() {
    //figure out type and RSO values
    var type = $("input:radio[name='event_type']:checked").val();
    //default value if its NOT an RSO event
    var rso = -1;
    if(type == "rso")
      rso = $("input:radio[name='rso']:checked").val();
    //we will POST to this php file on the server
    //it will process what we send and can return back JSON information
    var request = $.post("eventPanel-script.php",
      {
        //these are defined in the inputs within our form
        //each input is defined by their id attribute in the HTML
        type: type,
        rso: rso,
        name: $("#inputName").val(),
        locLat: marker.getPosition().lat(),
		locLng: marker.getPosition().lng(),
        address: $("#inputAddress").val(),
        city: $("#inputCity").val(),
        state: $("#inputState").val(),
        location: $("#inputLocation").val(),
        locLat: marker.getPosition().lat(),
        locLng: marker.getPosition().lng(),
        date: $("#inputDate").val(),
        time: $("#inputTime").val(),
        ampm: $("input:radio[name='ampm']:checked").val(),
        email: $("#inputContactEmail").val(),
        phone: $("#inputContactPhone").val(),
        description: $("#inputDescription").val()
      },
      //this function is called when we get a response back from the server
     function(json){
      //write back what we get in the "message" field to the resonse div defined in this HTML
      //the response div is located right below the "Add Event" button
      $("div.addevent_response").html(json.message);
      //on success redirect to the event page
      if(json.success === "success")
        self.location="viewEvent.php?id="+json.eventid;
    },
    //defines that we are expecting JSON back from the server
    "json");
    } 
    
// google maps
var marker;
function initialize() {
  var mapOptions = {
    zoom: 4,
    center: new google.maps.LatLng(28.6013406,-81.2035104)
  };
  var map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);
      
  var lat = 28.6013406;
  var lng = -81.2035104;
  var loc = new google.maps.LatLng(lat, lng);
  placeMarker(loc,map);
  google.maps.event.addListener(map, 'click', function(e) {
    placeMarker(e.latLng, map);
  });
}
function placeMarker(position, map) {
	if(marker == null) {
	  marker = new google.maps.Marker({
		position: position,
		map: map
	  });
	}
	else {
		marker.setPosition(position);
	}
  map.panTo(position);
}
google.maps.event.addDomListener(window, 'load', initialize);
  </script>
  
  <?php
    //always call session_start() before accessing any session variables
		if (session_status() == PHP_SESSION_NONE) {
   			session_start();
		}
  ?>
</head>

<body>

<?php
  include 'nav.php';
	displayNav('eventPanel.php' ,'eventPanel');
  
  
  //not a user
  if(!isset($_SESSION['UserEmail'])) {
    echo "You are not registered!";
    echo "</body></html>";
    die();
  }
?>


<div class="container">
<div class="events">

  <h1>Event Panel</h1>
  
  <div class="eventtable">
  
  <?php
    //always call session_start() before accessing any session variables
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
    include '../../keys.php';
    $id =$_SESSION['id'];
    //now connect to the database
    $mysqli = new mysqli("localhost", $mysqluser, $mysqlpassword, "temp");
    $sql = "SELECT Name, EventID, RSOID FROM event WHERE RSOID IN (SELECT RSOID FROM rsomembers WHERE UserID='$id' and isAdmin='Y')";
    $eventinfo = $mysqli->query($sql);
    //admin of an event?
    if(!($eventinfo->num_rows == 0)){
      
      echo '<h2>My Events</h2>';
      
      echo '<table class="table table-bordered table-hover myeventtable"><thead><tr><th>Link to Edit</th><th>Name</th></tr></thead><tbody>';
      
      while($row = mysqli_fetch_assoc($eventinfo)){
        echo '<tr id=' . $row['EventID'] . '><td><a href="editEvent.php?id=' . $row['EventID'] . '">Edit</a></td><td><a href="viewEvent.php?id=' . $row['EventID'] . '">'. $row['Name'] . '</a></td></tr> ';
      }
      
      echo '</tbody></table>';
    }
  ?>
    
  </div>
    
  <h2>Create an Event</h2>
  
  <h4>Choose the type of event:</h4>
  <label class="radio-inline">
    <input type="radio" name="event_type" id="Radio1" value="pub" onClick="rsoDropdown('pub');" checked> Public
  </label>
  <label class="radio-inline">
    <input type="radio" name="event_type" id="Radio2" value="priv" onClick="rsoDropdown('priv');"> Private
  </label>
  <label class="radio-inline">
    <input type="radio" name="event_type" id="Radio3" value="rso" onClick="rsoDropdown('rso');"> RSO
  </label>
  
  <div id="rso_list" class="rsotable" style="display: none">

    <?php
      //always call session_start() before accessing any session variables
      if (session_status() == PHP_SESSION_NONE) {
        session_start();
      }
      include '../../keys.php';
      $id =$_SESSION['id'];
      //now connect to the database
      $mysqli = new mysqli("localhost", $mysqluser, $mysqlpassword, "temp");
      $sql = "SELECT RSOID, Name FROM rso WHERE RSOID IN (SELECT RSOID FROM rsomembers WHERE UserID='$id' and isAdmin='Y')";
      $rsoinfo = $mysqli->query($sql);
      //admin of nothing
      if($rsoinfo->num_rows == 0)
        echo "<p>You are not an Admin of any RSO.</p>";
      //print out a button group with the info
      else {
        while ($row = mysqli_fetch_assoc($rsoinfo)) {
        echo '<label class="radio-inline">';
        echo '<input type="radio" name="rso" id="' . $row['RSOID'] .'" value="' . $row['RSOID'] . '">';
        echo $row['Name'];
        echo '</label>';
        }
      }
    ?>

  </div>


  <br/>
  <br/>
  <div class="event_forms">
        <label for="inputName" class="sr-only">Event Name</label>
        <input type="text" id="inputName" class="form-control" placeholder="Event Name" required autofocus>
        </br>
        
        <label for="inputAddress" class="sr-only">Address</label>
        <input type="text" id="inputAddress" class="form-control" placeholder="Address" required>
        
        <label for="inputCity" class="sr-only">City</label>
        <input type="text" id="inputCity" class="form-control" placeholder="City" required>
        
        <label for="inputState" class="sr-only">State</label>
        <input type="text" id="inputState" class="form-control" placeholder="State" required>
        
        <label for="inputLocation" class="sr-only">Location</label>
        <input type="text" id="inputLocation" class="form-control" placeholder="Location">
        </br>
		
		<div id="map-canvas"></div>
		
        </br>
        
        <label for="inputDate" class="sr-only">Date</label>
        <input type="date" id="inputDate" class="form-control" placeholder="Date: YYYY-MM-DD Format" required>
        
        <label for="inputTime" class="sr-only">Time</label>
        
        <input type="time" id="inputTime" class="form-control" placeholder="Time: HH:MM Format" required>
        <div class="btn-group" data-toggle="buttons">
          <label class="btn btn-primary active">
            <input type="radio" name="ampm" id="option1" autocomplete="off" checked>AM
          </label>
          <label class="btn btn-primary">
            <input type="radio" name="ampm" id="option2" autocomplete="off">PM
          </label>
        </div>
        </br>
        </br>
        
        <label for="inputContactEmail" class="sr-only">Contact Email</label>
        <input type="email" id="inputContactEmail" class="form-control" placeholder="Contact Email" required>
        
        <label for="inputContactPhone" class="sr-only">Contact Phone</label>
        <input type="tel" id="inputContactPhone" class="form-control" placeholder="Contact Phone Number" required>
        
        <label for="inputDescription" class="sr-only">Description</label>
        <textarea id="inputDescription" class="form-control" rows="4" placeholder="Description" required></textarea>
        </br>
        
        <button class="btn btn-lg btn-primary btn-block" onClick="newEvent();">Add Event</button>
  </div>
  <div class="addevent_response"></div>

</div>
</div>

</body>
</html>