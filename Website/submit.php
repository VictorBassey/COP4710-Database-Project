<?php
session_start();
	include '../navbar/navbar.php';
	
	
?>
<!DOCTYPE html>

<html lang = "en">
    <head>
        <meta charset="UTF-8">
        <meta name="University" content="This web page is for super admins to submit universities.">
        
        <title>University Submission</title>
        
        <style>
            *{
                
            }
            html
            {
                margin: 0;
                padding: 2px;
                background-color: #777;
				text-align: center;
                background:url('http://clevertechie.com/img/bnet-bg.jpg') #0f2439 no-repeat center top;
            }
		
            			
			form 
			{ 
				margin: 0 auto; 
				width:300px;
			}
			
			.submissionField 
			{ 
				margin: 1px auto;
				width: 225px; 
				height: 50px; 
				border: 1px 
				solid #999999; 
				padding: 5px; 
			}
			
			.submit
			{
				width: 225px; 
				height: 45px; 
				border: 1px 
				solid #999999; 
				padding: 5px; 
			}
			
        </style>
    </head>
    <body>
        
        <h1 id="submit"> University Submission</h1>
        
        
		<!--Sets up a form that a user will submit appropriate information in-->
		<form action = "uniInfo.php" method="POST">
			<input class = "submissionField" type= "text" name= "universityName" placeholder = "Name of University"/><br> 
			<input class = "submissionField" type= "text" name= "location" placeholder = "Location Of University"/><br>  	
			<input class = "submissionField" type= "text" name= "description" placeholder = "Describe The University" /><br>  	
			<input class = "submissionField" type= "text" name= "noofstudents" placeholder = "How Many Students Are Attending"/><br>  	
			<button class = "submit" type = "submit">SUBMIT!</button>
		</form>
    </body>
</html>
