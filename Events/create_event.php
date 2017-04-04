<?php 
session_start(); 
//if logged in
if(isset($_SESSION['username']) && isset($_POST['submit']) && $_SESSION['accountType'] == 1)
{
    $description = $_POST['description']; 
    $venuetype = $_POST['venuetype']; 
    
   if(isset($_POST['type']))
    {
    if($_POST['type'] == 'public')
        $eventtype = $_POST['type'];
   
    if($_POST['type'] == 'private')
        $eventtype = $_POST['type'];
    
    if($_POST['type'] == 'rso')
        $eventtype = $_POST['type'];
    }

$date = $_POST['date']; 
$location = $_POST['location']; 
    $username = $_SESSION['username'];
    $user = "SELECT * FROM user WHERE name = '$username'";
    $users = $mysqli->query($user);
    $row = mysqli_fetch_array($users, MYSQL_ASSOC);

    $uid = $row['uid'];
    
    //check if user is an admin
    $admin = "SELECT* FROM events WHERE aid IN (SELECT aid FROM admin WHERE aid = '$uid'"; 
    
    $count = $mysqli->query($admin);
    $result = mysqli_fetch_array($count, MYSQL_ASSOC); 
    
    if($count->num_rows > 0)
    {
        $sql = "INSERT INTO events (aid, description, time, venuetype, eventtype, location, approved)". "VALUES('$uid', '$description', '$date', '$venuetype', '$eventtype', '$location')";
        echo 'You created an event sucessfully'; 
    } 
    else
    {
        echo'Something went wrong'; 
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Create Events</title> 
</head>
    
<body>
    
<div id="page">
		<center><p class="body">
			
			<form action="create_event.php" method="post">
				<h3> Create Event </h3>
				
				<table>
					
					<tr><td> Description:</td>
					<td> <input type="text" name="description" value="" required> </td></tr>
                    
                    <tr><td> Venue-type:</td>
					<td> <input type="text" name="venuetype" value="" required> </td></tr>
					
					<tr><td> Event type : </td>
					<td> <select name='type' required>
                            <option value='' disabled='disabled' selected='selected'>select type</option>
                            <option value ='public'><a href='view_rso.php'>public</a></option>
                            <option value='rso'><a href='view_rso.php'>rso</a></option>
                            <option value='private'><a href='view_private.php'>private</a></option>
                            </select> </td></tr>

					<tr><td> Event Date: </td>
					<td> <input type="datetime-local" name="date" placeholder="" required> </td></tr>					
					
					<tr><td> Location: </td>
                    <td> <input type="text" name="location" value="" required></td></tr>
	
					<tr><td><input name="submit" type="submit" value="Submit"> </td></tr>
				</table>
			</form>
		</p> 
</div>
</body>
</html>