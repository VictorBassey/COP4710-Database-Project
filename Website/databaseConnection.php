<?php

	//Sets the variable to connect to the database
	$mysqli = new mysqli('localhost','root','','eventdb');

	//If the connnection fails
	if ($mysqli->connect_errno > 0)
	{
		//Inform the user of the connection error and kills the process
		die("Connection failed: " .mysqli_connect_error);
	}

