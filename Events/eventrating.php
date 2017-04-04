<head>
  <title>UCF Events</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>
    
<div class="container">
<div class="events">

<?php
  if (session_status() == PHP_SESSION_NONE)
      session_start();
    
    include 'dbh.php';

	//get all info on the Event, check if it exists
    if(isset($_SESSION['uid']))
    {
        
    $uid = $_SESSION['uid'];
    
	$sql = "SELECT * FROM events WHERE eid IN (SELECT eid FROM registered WHERE uid = '$uid')";
        
	$result = $mysqli->query($sql);
	//no event with this id
	if($result->num_rows == 0)
	{
		echo '<h1>Sorry, there is no event associated with this ID!</h1>';
		echo '</div></div></body></html>';
		die();
	}
  	$eventinfo = $result->fetch_assoc();
    }
 ?>

 <?php
  if (session_status() == PHP_SESSION_NONE)
      session_start();
  //Check credentials depending on if this event is public, private, or RSO
 if($eventinfo['eventtype'] == "private")
 {
    //check if it is approved
    if($eventinfo['approved'] == '0')
    {
      echo '<h1>Sorry, this event has yet to be approved by an administrator!</h1>';
      echo '</div></div></body></html>';
      die();
    }
    //checked if logged in
    if(!isset($_SESSION['uid'])) {
      echo '<h1>Sorry, you must be logged in to view this event.</h1>';
      echo '</div></div></body></html>';
      die();
    }
     
    //check if the user account is tied to the university
    $userid = $_SESSION['id'];
     
    $sql = "SELECT univid FROM rsoaffiliation WHERE rsoid IN (SELECT rsoid FROM events WHERE eid IN(SELECT eid FROM registered WHERE uid = '$uid'))";
     
    $result = $mysqli->query($sql);
   
    if($result->num_rows == 0)
    {
      echo '<h1>Sorry, your account must be of the same university as the private event.</h1>';
      echo '</div></div></body></html>';
      die();
    }
 }
 else if($eventinfo['eventtype'] == "rso")
 {
      //checked if logged in
      if(!isset($_SESSION['uid'])) {
        echo '<h1>Sorry, you must be logged in to view this event.</h1>';
        echo '</div></div></body></html>';
        die();
      }
     
      $rsoid = $eventinfo['rsoid'];
      $uid = $_SESSION['uid'];
     
      //check if user is an accepted in this RSO
      $sql = "SELECT COUNT(*) FROM memberof WHERE uid = '$uid' AND rsoid ='$rsoid'";
     
      $result = $mysqli->query($sql);
      $row = $result->fetch_row();
     
      if($row[0] == 0)
      {
          echo '<h1>Sorry, must be a part of the event\'s RSO to view the event details.</h1>';
          echo '</div></div></body></html>';
          die();
      }
 }
 else if($eventinfo['eventtype'] == "public")
 {
    //check if it is approved
    if($eventinfo['approved'] == 'N')
    {
      echo '<h1>Sorry, this event has yet to be approved by an administrator!</h1>';
      echo '</div></div></body></html>';
      die();
    }
 }
  //the event type is bad!!
 else
 {
    echo '<h1>Error: this event has a malformed Type. Type must be "pub", "priv", or "rso".</h1>';
    echo '</div></div></body></html>';
    die();
 }
/////////////////////////////////////////////////////////////
//////////// Great, now we can display the event! ///////////
/////////////////////////////////////////////////////////////
?>

   <!-- Display basic info on the RSO -->
 <h1><?php echo $eventinfo['description']; ?></h1>
 <p><?php echo $eventinfo['eventtype']; ?></p>


<ul>
  <li>Time: <?php echo $eventinfo['time']; ?></li>
  <li>Address: <?php echo $eventinfo['venuetype']; ?></li>
  <li>Location: <?php echo $eventinfo['Location']; ?></li>
</ul>

 <!-- Button Rating System -->
 <button type="button" class="btn btn-default btn-sm" onclick="rate(1);">1
  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
</button>

<button type="button" class="btn btn-default btn-sm" onclick="rate(2);">2
  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
</button>

<button type="button" class="btn btn-default btn-sm" onclick="rate(3);">3
  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
</button>

<button type="button" class="btn btn-default btn-sm" onclick="rate(4);">4
  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
</button>

<button type="button" class="btn btn-default btn-sm" onclick="rate(5);">5
  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
</button>

<div class="rating-result">
    
<?php
    $eid = $eventinfo['eid']; 
    //print out the current rating
    //get number of rating for this event
    $sql = "SELECT COUNT(*) FROM eventrating WHERE EventID='$id'";
    $result = $mysqli->query($sql);
    $row = $result->fetch_row();
    $numratings = $row[0];
    if($numratings == 0)
    {
      echo 'No one has rated this event yet.';
    }
    else
    {
        //get number of rating for this event
        $sql = "SELECT SUM(Rating) FROM eventrating WHERE EventID='$id'";
        $result = $mysqli->query($sql);
        $row = $result->fetch_row();
        $sum = $row[0];
        $rating = $sum/$numratings;
        echo 'This event has a rating of ' . $rating . ' from the votes of ' . $numratings . ' users.';
    }
?>
<div>
    <p >MAP</p>
</div>
