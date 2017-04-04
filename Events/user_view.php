<?php session_start() ?>
<?php include 'view_private.php'; ?>
<?php include 'view_rso.php'; ?>
<?php include 'view_public.php'; ?>

<!DOCTYPE html>
<html>
<head>
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
<body>
    <center><h3>View Events</h3></center>
    
	<form action = "user_view.php" method = "post">
        
            <input type="text" name="university" placeholder="University Name" required><br><br>
        
            <input type="submit" name="search" value="Filter"><br><br><br>
    
        <?php 
        if(isset($_POST['search'])&&isset($_POST['university'])){
        echo"<select name='type'>
        <option value='' disabled='disabled' selected='selected'>select type</option>
        
        <option name='rso'>rso</option>
        
        <option name='private'>private</option>
        </select>";
        }
        ?>
        
        <br>
        
		<table align = "center" border = "1" cellspacing="0" cellpadding="0" width="500">
			<tr>
				<th>Description</th>
				<th>Event</th>
				<th>Type</th>
				<th>Location</th>
				<th>Time</th>
                <th>comment</th>
                <th>rate</th>
			</tr>
            
			<?php 
            while($row = mysqli_fetch_array($result)):
			echo"<tr>
				<td>".$row['description']."</td>
				<td>".$row['venuetype']."</td>
				<td>".$row['eventtype']."</td>
				<td>".$row['location']."</td>
				<td>".$row['time']."</td>;
                <td><a href='eventcomments.php'>comment</a></td>
                <td><a href='eventrating.php'>rate</a></td>
			</tr>";  
            endwhile;
            ?>
		</table>
	</form>
</body>
</html>