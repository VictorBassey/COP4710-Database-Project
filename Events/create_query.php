<div>
<link rel="stylesheet" type="text/css"
href="../Events/eventstyle.css">
</div>
<?php 

    session_start();
    include'../navbar/navbar.php';
    include'../navbar/includes/dbh.php';

//if logged in 
if(!isset($_SESSION['username'])) {
      echo '<h1>Sorry, you must be logged in to view this event.</h1>';
      echo '</div></div></body></html>';
      die();
    }

$username = $_SESSION['username'];
//get user id
$uid = "SELECT uid FROM user WHERE name = '$username'";

$location = $mysqli->real_escape_string($_POST['location']); 
$venuetype = $mysqli->real_escape_string($_POST['venuetype']); 
$time = $mysqli->real_escape_string($_POST['time']); 
$description = $mysqli->real_escape_string($_POST['description']); 
$eventtype = $mysqli->real_escape_string($_POST['event_type']); 

if($eventtype == 'rso'){
    
$rsoid = $mysqli->real_escape_string($_POST['rso']);

$sql = 'INSERT INTO events (aid, rsoid, description, time, venuetype, eventtype, location)'. "VALUES( '$uid' , '$rsoid', '$description', '$time', '$venuetype', '$eventtype', '$location')";

echo'you successfully created a rso event';
    
echo'<br><br><br>';
//go back to event panel through this button
echo'<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><a href="create_event.php">Go back To Event Panel</a>
        <span class="caret"></span> 
        </button>';
}
else
{
//select a random rsoid  from rso table
$sql = "SELECT rsoid FROM manages ORDER BY RAND() LIMIT 1";
    
$result = $mysqli->query($sql); 
$row = mysqli_fetch_assoc($result); 
$rsoid = $row['rsoid']; 

    //check if there's any row
    if(!($result->num_rows == 0))
    {
    $sql = 'INSERT INTO events (aid, rsoid, description, time, venuetype, eventtype, location)'. "VALUES( '$uid' , '$rsoid', '$description', '$time', '$venuetype', '$eventtype', '$location')";
        
    echo'you successfully crated a event';
        
    echo'<br><br><br>';
    //go back to event panel through this button
    echo'<button type="button" class="button" data-toggle="dropdown" aria-expanded="true"><a href="create_event.php">Go back To Event Panel</a>
        <span class="caret"></span> 
        </button>';
    
    }
    else
    {
        'You could not create a event, try another one';
        
        echo'<br><br><br>';
        //go back to event panel through this button
        echo'button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><a href="create_event.php" style="text-decoration: none">Go back To View Events</a>
        <span class="caret"></span> 
        </button>';
    }
}
?>