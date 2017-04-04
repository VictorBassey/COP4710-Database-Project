<?php session_start() ?>
<?php include 'view_private.php'; ?>
<?php include 'view_rso.php'; ?>
<?php include 'view_public.php'; ?>

<!DOCTYPE html>
<html>
<head>
	<title>View Events</title>
		<style>
			table,tr,th,td
			{
				border: 1px solid black;
			}
		</style>  
</head>
    
<body>
    <center><h3>View Events</h3></center>
    
	<form action = "user_view.php" method = "post">
        
            <input type="text" name="university" placeholder="University Name" required><br><br>
        
            <input type="submit" name="search" value="Filter"><br><br><br>
    
        <?php 
        if(isset($_POST['search'])&&isset($_POST['university'])){
        echo"<select name='type'>
        <option value='' disabled='disabled' selected='selected'>select type</option>
        
        <option name='rso'><a href='view_rso.php'>rso</a></option>
        
        <option name='private'><a href='view_private.php'>private</a></option>
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
				<td>".$row['time']."</td>
                <td><a href = comment.php>comment</a></td>
                <td><a href = rating.php>rating</a></td>
			</tr>";  
            endwhile;
            ?>
		</table>
	</form>
</body>
</html>