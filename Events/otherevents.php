<!DOCTYPE html>
<html>
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
    
<body>
    <center><h3>View Events</h3></center>
    
   <div class="uniName">
    <form action="otherevents.php" method="post">
        <input type="text" name="uni" placeholder="University Name" required><br><br>
        <a href="otherevents.php"?id='uni'><input type="submit" name="search" value="Filter"></a><br><br>
        </form>
    </div>
    
    <div class="date">
        <p id="date"></p>
        <script>
        document.getElementById("date").innerHTML = Date();
        </script>
    </div>
    
    <div class="dropdown"> 
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true"> View By... 
        <span class="caret"></span> 
        </button> 
        <ul class="dropdown-menu" role="menu" style="overflow-y: hidden;"> 
            <li class="active"><a href="/">Day View</a></li>
            <li> <a href="public_event.php">public</a> </li> 
            <li> <a href="rso_event.php">RSO</a> </li> 
            <li> <a href="priv_event.php">Private</a> </li> 
        </ul> 
    </div>


<?php 

include 'dbh.php';

echo'<br>';
    
 $univname = $mysqli->real_escape_string($_POST['uni']);

    $sql = "SELECT * FROM events WHERE eventtype = 'public' AND location = '$univname'";

    //$sql = "SELECT * FROM events WHERE eventtype = 'public' AND rsoid IN (SELECT rsoid FROM rsoaffiliation WHERE univid IN (SELECT univid FROM university WHERE name = '$univname'))"; 

    $result = $mysqli->query($sql); 
    
    if($result->num_rows == 0)
    {
        echo '<h2>No public events with that university name, Please Type another university name</h2>'; 
    }
    else 
    {   
        echo "<h2 style='color:blue;'>Events from ".$_POST['uni']." : </h2>";
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
                <td><h3><a href="displayEvent.php?varname='.$row['eid'].'">Display Event</a></h3></td></tr>';
                echo'</table>'; 
        } 
    ?>
        