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
  <link rel="stylesheet" href="css/navstuff.css">
  <link rel="stylesheet" href="css/admin.css">
  <link rel="stylesheet" href="css/home.css">
  <link rel="stylesheet" href="css/eventPanel.css">
  <link rel="stylesheet" type="text/css" href="../Events/eventstyle.css">
  
</head>

<body>


<div class="container">
  <div class="events">
    
      
      <h2>Edit Event Selected</h2>
    
    <?php
      //checked if logged in
    if(!isset($_SESSION['username'])) {
      echo '<h1>Sorry, you must be logged in to view this event.</h1>';
      echo '</div></div></body></html>';
      die();
    }
      
      $eid =$mysqli->real_escape_string($_GET['id']);
      
      $_SESSION['eid'] = $eid;
      //now connect to the database
      $sql = "SELECT * FROM events WHERE eid ='$eid'";
      $result = $mysqli->query($sql);
      
      //check if this is actually an event
      if($result->num_rows == 0){
        echo '<h1>Sorry, there is no event associated with this ID!</h1>';
        echo '</div></div></div></body></html>';
        die();
          
      }
      
        $eventinfo = $result->fetch_assoc();
        ?>
      
        <br/>
        <br/>
        <div class="event_forms">
            
        <form action="edit_query.php" method="post">
            
        <label for="inputName" class="sr-only">Location</label>
        <input type="text" name="location" class="form-control" placeholder="Location" required autofocus>
        
           <label for="inputName" class="sr-only">Event Name</label>
        <input type="text" name="venuetype" class="form-control" placeholder="Event Name" required autofocus>
        
        <label for="inputTime" class="sr-only">Time</label>
        <input type="datetime-local" name="time" id="inputTime" class="form-control" placeholder="Time: HH:MM Format" required>
      
        <label for="inputDescription" class="sr-only">Description</label>
        <textarea name="description" id="inputDescription" class="form-control" rows="4" placeholder="Description" required></textarea>
        
          <button type="submit" class="btn btn-lg btn-primary btn-block">Edit Event</button>
        <form>
    </div>
</body>
</html>