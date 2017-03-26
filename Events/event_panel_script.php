<?php
//sets the following variables:
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
//check if logged in
if(!isset($_SESSION['id'])) {
   die();
}
$id =$_SESSION['id'];
//now connect to the database
$mysqli = new mysqli("localhost", $mysqluser, $mysqlpassword, "temp");
//here we can extract information from the client's POST request
//	this was submitted by the jQuery function
//always use mysql_real_escape_string when taking in user input
//	this prevents SQL injection
$type = $mysqli->real_escape_string($_POST['type']);
$rso = $mysqli->real_escape_string($_POST['rso']);
$name = $mysqli->real_escape_string($_POST['name']);
$address = $mysqli->real_escape_string($_POST['address']);
$city = $mysqli->real_escape_string($_POST['city']);
$state = $mysqli->real_escape_string($_POST['state']);
$location = $mysqli->real_escape_string($_POST['location']);
$locLat = $mysqli->real_escape_string($_POST['locLat']);
$locLng = $mysqli->real_escape_string($_POST['locLng']);
$date = $mysqli->real_escape_string($_POST['date']);
$time = $mysqli->real_escape_string($_POST['time']);
$ampm = $mysqli->real_escape_string($_POST['ampm']);
$email = $mysqli->real_escape_string($_POST['email']);
$phone = $mysqli->real_escape_string($_POST['phone']);
$description = $mysqli->real_escape_string($_POST['description']);
/////////Validate Date///////////////
$date_regex = '/^(19|20)\d\d[\-\/.](0[1-9]|1[012])[\-\/.](0[1-9]|[12][0-9]|3[01])$/';
if (!preg_match($date_regex, $date)) {
  $success = 'fail';
  $message = 'Error: Please use YYYY-MM-DD format for date.';
  $return = array('message' => $message, 'success' => $success);
  echo json_encode($return);
}
////////////Validate Time////////////////
if(!preg_match("/(1[012]|0[0-9]):[0-5][0-9]/", $time)) {
  $success = 'fail';
  $message = 'Error: Please use HH:MM 12 hour format for the time value.';
  $return = array('message' => $message, 'success' => $success);
  echo json_encode($return);
}
//pm, need to add 12 hrs to time
if($ampm == "pm") {
  $expltime = explode(":", $time);
  $hour = intval($expltime[0]) + 12;
  $time = $hour . ":" . $expltime[1];
}
//create DATETIME SQL object format YYYY-MM-DD HH:MM:SS
$DATETIME = $date . " " . $time . ":00";
//set approved
if($type == "rso")
  $approved='Y';
else
  $approved='N';
//set get this user's university
$sql = "SELECT UniversityID FROM user WHERE UserID='$id'";
$result = $mysqli->query($sql);
$row = $result->fetch_row();
$UniversityID = $row[0];
//create our SQL statement
$sql = 'INSERT INTO event (RSOID, UniversityID, Name, Location, Address, Description, Time, ContactEmail, ContactPhone, Type, Approved,State,City,Longitude,Latitude) ' .
  "VALUES ('$rso', '$UniversityID', '$name', '$location', '$address', '$description', '$DATETIME', '$email', '$phone', '$type', '$approved','$state','$city', '$locLng', '$locLat')";
//run the query
//returns true on success
if($mysqli->query($sql))
{
	$success = 'success';
	$message = 'Successfully created Event';
  $return = array('message' => $message, 'success' => $success, 'eventid' => $mysqli->insert_id);
  echo json_encode($return);
}
else
{
	$success = 'fail';
	$message = 'Error updating database: ' . $mysqli->error;
  $return = array('message' => $message, 'success' => $success);
  echo json_encode($return);
}
?>