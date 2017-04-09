<?php
//always call session_start() before accessing any session variables
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
//check if logged in
if(!isset($_SESSION['uid'])) {
	$return = array('rating' => -1, 'numratings' => -1); //-1 -> not logged in. kind of hacky but it will work
	echo json_encode($return);
   die();
}
$uid =$_SESSION['uid'];
//now connect to the database
include 'dbh.php';
//here we can extract information from the client's POST request
//	this was submitted by the jQuery function
//always use mysql_real_escape_string when taking in user input
//	this prevents SQL injection
$eventid = $mysqli->real_escape_string($_POST['eventid']);
$rating = $mysqli->real_escape_string($_POST['rating']);

//check if rating is valid
if($rating > 5 || $rating < 1)
	die();
//check if they have already rated
//Then UPDATE or INSERT if they havent
$uid = $_SESSION['uid'];
$sql = "SELECT COUNT(*) FROM comment WHERE uid ='$uid' and eid ='$eventid'";
$result = $mysqli->query($sql);
$row = $result->fetch_row();
//they havent rated on this event, lets insert
if($row[0] == 0)
{
	$sql = 'INSERT INTO comment (eid, uid, rating) ' .
  		"VALUES ('$eventid', '$uid', '$rating')";
}
else
{
	$sql = "UPDATE comment SET rating='$rating' WHERE eid ='$eventid' AND uid ='$uid'";
}
$mysqli->query($sql);
//return the current rating
//get number of rating for this event
$sql = "SELECT COUNT(*) FROM comment WHERE eid ='$eventid'";
$result = $mysqli->query($sql);
$row = $result->fetch_row();
$numratings = $row[0];
if($numratings == 0)
	$rating=0;
else
{
	//get number of rating for this event
	$sql = "SELECT SUM(rating) FROM comment WHERE eid='$eventid'";
	$result = $mysqli->query($sql);
	$row = $result->fetch_row();
	$sum = $row[0];
	$rating = $sum/$numratings;
}
//return it in JSON format
$return = array('rating' => $rating, 'numratings' => $numratings);
echo json_encode($return);
?>