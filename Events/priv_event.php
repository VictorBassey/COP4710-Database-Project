<!DOCTYPE html>
<html>
    <?php 
    session_start();
    include'../navbar/navbar.php';
    include'../navbar/includes/dbh.php';
    ?>
<head>
  <title>UCF Events</title>
        <style>
			table,tr,th,td
			{
				border: 1px solid black;
			}
		</style> 
    
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
    </head>
    <link rel="stylesheet" type="text/css"
    href="../Events/eventstyle.css">
    
     <p>Date/Time: <span id="datetime"></span></p>

    <script>
        var dt = new Date();
        document.getElementById("datetime").innerHTML = dt.toLocaleDateString();
    </script>
    
<body>
    <center><h3>View Events</h3></center>
    
    <div class="uniName">
    <form action="otherevents.php" method="post">
        <input type="text" name="uni" placeholder="University Name" required><br><br>
        <a href="otherevents.php"?id='uni'><input type="submit" name="search" value="Filter"></a><br><br>
        </form>
    </div>
    
    <div class="dropdown"> 
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true"> View By... 
        <span class="caret"></span> 
        </button> 
        <ul class="dropdown-menu" role="menu" style="overflow-y: hidden;"> 
            <li> <a href="public_event.php">public</a> </li> 
            <li> <a href="rso_event.php">RSO</a> </li> 
            <li> <a href="priv_event.php">Private</a> </li> 
        </ul> 
    </div>
    
<?php 
        
//Public events
echo '<br><center><h1>Private Events</h1>';

   //checked if logged in
    if(!isset($_SESSION['username'])) {
      echo '<h1>Sorry, you must be logged in to view this event.</h1>';
      echo '</div></div></body></html>';
      die();
    }

$username = $_SESSION['username'];
//get user id
 $uid = "SELECT uid FROM userWHERE name = '$username'";

$sql ="SELECT * FROM events WHERE eventtype='private' AND rsoid IN (SELECT rsoid FROM memberof uid='$uid')"; 

$result = $mysqli->query($sql); 

    if($result->num_rows == 0)
    {
        echo'No private events found'; 
    }
    else
    {  
    ?>
        <table class="table table-bordered table-hover myeventtable">
			<tr>
				<th>Description</th>
				<th>Event</th>
				<th>Type</th>
				<th>Location</th>
				<th>Time</th>
                <th>Display</th>
			</tr>
            
        <?php while($row = mysqli_fetch_assoc($result))
            echo'<tr>
				<td>'.$row['description'].'</td>
				<td>'.$row['venuetype'].'</td>
                <td>'.$row['eventtype'].'</td>
                <td>'.$row['location'].'</td>
                <td>'.$row['time'].'</td>
                <td><h3><a href="event_comments.php?varname='.$row['eid'].'">Display</a></h3></td></tr>';
            echo'</table>';
    }
?>
    </body>
</html>
