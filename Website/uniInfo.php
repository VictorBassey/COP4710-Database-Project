				
<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset="UTF-8">
        <meta name="UniInfo" content="This web page is for super admins to know if their data was submitted.">		

		<title>University Submission</title>
        
        <style>		
			body
			{	
				background:url('http://clevertechie.com/img/bnet-bg.jpg') #0f2439 no-repeat center top;
			}
		</style>
	</head>
	<body>
		 <?php 
			
			//This php files connects to the database
			include '../navbar/includes/dbh.php';
			
			//The following variables are taking in information from the user  
			$name = $_POST['universityName'];
			$location = $_POST['location'];
			$description = $_POST['description'];
			$noofstudents = $_POST['noofstudents'];	
			
			
			//Insert the user submitted information into the database
			$insert = "INSERT INTO university (name, location, description, noofstudents) 
			VALUES ('$name', '$location', '$description', '$noofstudents')";
			
			$select = "SELECT * FROM university WHERE name = '$name'";
			$duplicateCheck = mysqli_query($mysqli,$select);
			
			if (mysqli_num_rows($duplicateCheck)>=1)
			{
				echo nl2br ("This university has already been added to the database. \n");
				//Informs the user they are about to be redirected
				echo "\n Redirecting...";
				header ("refresh:3;url=http://localhost:8081/website/university.php" );
				die();
			}
			
			else
			{
				$result = mysqli_query($mysqli,$insert);
				//If the query didn't process then
				if (!$result)
				{
					//Informs the user that their data failed to be added
					echo nl2br ("Your information could not be added to the database. \n");
				}
				else 
				{
					//Informs the user that their data was successfully added
					echo nl2br ("Your information was added to the database. \n");
				}
				
				//Informs the user they are about to be redirected
				echo "\n Redirecting...";
				
				//Redirects the user back to the university page with a delay of 5 seconds
				header ("refresh:3;url=http://localhost:8081/website/university.php" );
				die();
			}
		?>
	</body>