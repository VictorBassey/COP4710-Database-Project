<html>
    <?php 
    session_start();
    include'../navbar/navbar.php';
    include'../navbar/includes/dbh.php';
    ?>
<head>
  <title>UCF Events</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
    
</head>

  <script>
    function rsoDropdown(type){
      if(type == "rso"){
        document.getElementById("rso_list").style.display="block";
      }else{
        document.getElementById("rso_list").style.display="none";
      }
    }
   </script>

<body>  
<div class="container">

  <h1>Event Panel</h1>
  
  <div class="eventtable">
  
  <?php
   
    //$uid = $_SESSION['uid']; 
    
    $sql="SELECT description, eid, rsoid FROM events"; 
    $eventinfo = $mysqli->query($sql); 
    
    if(!($eventinfo->num_rows == 0))
    {
        echo '<h2>My Events</h2>';
        
        echo '<table class="table table-bordered table-hover myeventtable"><thead><tr><th>Link to Edit</th><th>Name</th></tr></thead><tbody>';
        
        while($row = mysqli_fetch_assoc($eventinfo)){
        echo '<tr id=' . $row['eid'] . '><td><a href="editevent.php?id=' . $row['eid'] . '">Edit</a></td><td><a href="displayEvent.php?varname=' . $row['eid'] . '">'. $row['description'] . '</a></td></tr> ';
      }
    
      echo '</tbody></table>';
    }
  ?>
  </div>
    
  <h2>Create an Event</h2>
  
  <h4>Choose the type of event:</h4>
    
  <form action="create_query.php" method="post">      
    <label class="radio-inline">
    <input type="radio" name="event_type" id="Radio1" value="public" checked> Public
    </label>
    <label class="radio-inline">
    <input type="radio" name="event_type" id="Radio2" value="private"> Private
    </label>
    <label class="radio-inline">
    <input type="radio" name="event_type" id="Radio3" value="rso"> RSO
    </label>

    <div id="rso_list" class="rsotable" style="display: none">
    <?php
      //always call session_start() before accessing any session variables
      $eventttype = $_POST['event_type'];
    
     //$uid =$_SESSION['uid'];
      //now connect to the database
     include 'dbh.php';
      
     $sql = "SELECT name, eid, rsoid FROM evetns WHERE rsoid IN (SELECT rsoid FROM memberof m INNER JOIN admin a ON m.uid = a.aid)"; 
      
      $rsoinfo = $mysqli->query($sql);
      //admin of nothing
      if($rsoinfo->num_rows == 0)
        echo "<p>You are not an Admin of any RSO.</p>";
      //print out a button group with the info
      else {
        while ($row = mysqli_fetch_assoc($rsoinfo)) {
        echo '<label class="radio-inline">';
        echo '<input type="radio" name="rso" id="' . $row['rsoid'] .'" value="' . $row['rsoid'] . '">';
        echo $row['venuetype'];
        echo '</label>';
        }
      }
    ?>
 </div>
    
  <br/>
  <br/>
      
  <div class="event_forms">
      
        <label for="inputName" class="sr-only">Event Name</label>
        <input type="text" name="venuetype" class="form-control" placeholder="Event Name" required autofocus>
        
        <label for="inputTime" class="sr-only">Time</label>
        <input type="datetime-local" name="time" id="inputTime" class="form-control" placeholder="Time: HH:MM Format" required>
      
        <label for="inputDescription" class="sr-only">Description</label>
        <textarea name="description" id="inputDescription" class="form-control" rows="4" placeholder="Description" required></textarea>
        </br>
        <button type="submit" class="btn btn-lg btn-primary btn-block">Add Event</button>
    </form>
    
  </div>
    
</body>
</html>