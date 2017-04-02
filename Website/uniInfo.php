 <?php 
	session_start();
	//This php files connects to the database
//include 'databaseConnection.php';
   
include '../Navbar/includes/dbh.php';
	
	//The following variables are taking in information from the user  
	$name = $_POST['universityName'];
	$location = $_POST['location'];
	$description = $_POST['description'];
	$noofstudents = $_POST['noofstudents'];	
	
	
	//Insert the user submitted information into the database


	$insert = "INSERT INTO university (name, location, description, noofstudents) 
	VALUES ('$name', '$location', '$description', '$noofstudents')";
	
	$result = mysqli_query($mysqli,$insert);
	
    if(!$result) {
        echo "no likey";
    }
	/*
	//If the query didn't process then
	if ($result == NULL)
	{
		//Informs the user that their data failed to be added
		echo nl2br ("Your information could not be added to the database. \n");
	}
	else 
	{
		//Informs the user that their data was successfully added
		echo nl2br ("Your information was added to the database. \n");
	}*/
	
	//Informs the user they are about to be redirected
    echo "\n Redirecting...";
	
	//Redirects the user back to the university page with a delay of 5 seconds
	header ("refresh:3;url=http://localhost/COP4710-Database-Project/Website/university.php" );
	die();
	