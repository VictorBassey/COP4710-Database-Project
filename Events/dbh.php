<?php

//$conn = mysqli_connect("localhost", "root","", "eventdb");  
$mysqli = new mysqli('localhost', 'root', '', 'DBproject');
// server, username of database,password for server,name of database

// error handling
if(!$mysqli){
    die("Connection failed: ".mysqli_connect_error()); 
    // destroys the connection and gives error message
    // make sure to delete .mysqli_connect_error() when releasing website (sql injection!!!)
    
}
?>