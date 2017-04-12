<div>
<link rel="stylesheet" type="text/css"
href="../Events/eventstyle.css">
</div>

<?php 
    session_start();
    include'../navbar/navbar.php';
    include'../navbar/includes/dbh.php';

  //checked if logged in
    if(!isset($_SESSION['username'])) {
      echo '<h1>Sorry, you must be logged in to view this event.</h1>';
      echo '</div></div></body></html>';
      die();
    }

$eid = $_SESSION['eid'];

$location = $mysqli->real_escape_string($_POST['location']); 
$venuetype = $mysqli->real_escape_string($_POST['venuetype']); 
$time = $mysqli->real_escape_string($_POST['time']); 
$description = $mysqli->real_escape_string($_POST['description']); 

$sql = "UPDATE events SET venuetype = '$venuetype', location = '$location', description = '$description', time = '$time' WHERE eid = '$eid'";

if($mysqli->query($sql))
{
    echo 'You successfully edited this Event';
    echo'<br><br><br>';
    echo'<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><a href="create_event.php">Go back To Event Panel</a><span class="caret"></span> 
    </button>';
}
else
{
    echo 'Your event could not be edited';
    echo'<br><br><br>';
    echo'<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><a href="create_event.php">Go back To Event Panel</a><span class="caret"></span> 
    </button>';
}

?>