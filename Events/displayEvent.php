
<head>
  <title>UCF Events</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  
</head>

<body>
  <script>
  function rate(rating)
  {
      var request = $.post("rating_script.php",
      {
        rating: rating,
        eventid: <?php echo $_GET['varname']; ?>
      },
     function(json){
        //-1 -> user was not logged in
          $('div.rating-result').html('This event has a rating of '  + json.rating + ' from the votes of ' + json.numratings + ' users.');   
      },
    "json");
  }
  </script>

<div class="container">
<div class="events">

<?php
	//get all info on the Event, check if it exists
    include 'dbh.php';  
    
    $id = $_GET['varname'];
    
    $_SESSION['eid'] = $id;
    
	$sql = "SELECT * FROM events WHERE eid='$id'";
    
	$result = $mysqli->query($sql);
	//no event with this id
	if($result->num_rows == 0)
	{
		echo '<h1>Sorry, there is no event associated with this ID!</h1>';
		echo '</div></div></body></html>';
		die();
	}
  	$eventinfo = $result->fetch_assoc();
 ?>
    
 <p><?php echo $eventinfo['description']; ?></p>

<ul>
  <li>Time: <?php echo $eventinfo['time']; ?></li>
  <li>Event-type: <?php echo $eventinfo['venuetype']; ?></li>
  <li>Location: <?php echo $eventinfo['location']; ?></li>
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
    //print out the current rating
    //get number of rating for this event
    $sql = "SELECT COUNT(*) FROM comment WHERE eid ='$id'";
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
        $sql = "SELECT SUM(rating) FROM comment WHERE eid ='$id'";
        $result = $mysqli->query($sql);
        $row = $result->fetch_row();
        $sum = $row[0];
        $rating = $sum/$numratings;
        echo 'This event has a rating of ' . $rating . ' from the votes of ' . $numratings . ' users.';
    }
?>
</div>
</body>
</html>