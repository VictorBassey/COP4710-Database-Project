<div>
<link rel="stylesheet" type="text/css"
href="../Events/eventstyle.css">
</div>

<?php 
    session_start();
    include'../navbar/navbar.php';
    include'../navbar/includes/dbh.php';    

if(!isset($_SESSION['username'])) 
{
      echo '<h1>Sorry, you must be logged in.</h1>';
      echo '</div></div></body></html>';
      die();
}

$username = $_SESSION['username'];

$uid1 = "SELECT uid FROM user WHERE name = '$username'";
$result1 = $mysqli->query($uid1);
$resultRow = mysqli_fetch_assoc($result1); 
$uid = $resultRow['uid'];

$location = $mysqli->real_escape_string($_POST['location']); 
$venuetype = $mysqli->real_escape_string($_POST['venuetype']); 
$time = $mysqli->real_escape_string($_POST['time']); 
$description = $mysqli->real_escape_string($_POST['description']); 
$eventtype = $mysqli->real_escape_string($_POST['event_type']); 
$lng = $mysqli->real_escape_string($_POST['lon']); 
$lat = $mysqli->real_escape_string($_POST['lat']); 

if($eventtype == 'RSO')
    
{
    $rsoid = $mysqli->real_escape_string($_POST['RSO']);

    $sql = 'INSERT INTO events (aid, rsoid, description, time, venuetype, eventtype, location, lat, lng)'. "VALUES( '$uid' , '$rsoid', '$description', '$time', '$venuetype', '$eventtype', '$location', '$lat', '$lng')";

    
    if ($mysqli->query($sql))
    {
        echo 'you sucessfully created an RSO event';
        echo'<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><a href="create_event.php">Go back To Event Panel</a>
        <span class="caret"></span>                 </button>';
    }
    else 
    {
        echo'you could not create an event'; 
        echo'<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><a href="create_event.php">Go back To Event Panel</a>
        <span class="caret"></span> 
        </button>';
    }
}
else
{
    //select a random rsoid  from rso table
    $sql1 = "SELECT rsoid FROM manages ORDER BY RAND() LIMIT 1";

    $result = $mysqli->query($sql1); 
    $row = mysqli_fetch_assoc($result); 
    $rsoid = $row['rsoid']; 
        //check if there's any row
        if(!($result->num_rows == 0))
        {
        $sql = 'INSERT INTO events (aid, rsoid, description, time, venuetype, eventtype, location, lat, lng)'. "VALUES( '$uid' , '$rsoid', '$description', '$time', '$venuetype', '$eventtype', '$location', '$lat', '$lng')";


            if($mysqli->query($sql))
            {
             echo'<br><br><br>';
            //go back to event panel through this button
            echo'you sucessfully created an event';
            echo'<button type="button" class="button" data-toggle="dropdown" aria-expanded="true"><a href="create_event.php">Go back To Event Panel</a>
                <span class="caret"></span> 
                </button>';
            }   
            else
            {
                echo'<br><br><br>';
                
                echo "Your event could not be created.";
                
                echo'<button type="button" class="button" data-toggle="dropdown" aria-expanded="true"><a href="create_event.php">Go back To Event Panel</a>
                <span class="caret"></span> 
                </button>';
            }
        }
}
?>