<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset="UTF-8">
        <meta name="University" content="This web page is for super admins to submit universities.">
        
        <title>University Submission</title>
        
        <style>
            
            html
            {
                margin: 0;
                padding: 2px;
                background-color: #777;
            }
            body
            {
                width: 80%;
                margin: 0 auto;
                font-family:Arial,Helvetica,sans-serif;
                font-size: 1em;
                background: #FFFF;
                border-bottom: 10px solid gold
            }
            
            h1 
            {
                font-family: Georgia, "Times New Roman", serif;
                font-size: 2em;
                font-weight: bold;
                font-style: bold;
            }
            
            h2
            {
                color:red;
                font-weight:normal;
            }
            
            p
            {
                line-height: 1.6;
                text-align: justify;
            }
			
			table 
			{
				border: 2px solid red;
				background-color: #FFC;
			}
            
			th 
			{
				border-bottom: 5px solid #000;
			}
			
			td
			{
				border-bottom: 2px solid #666;
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
        
        <nav> 
            <p>Site Navigation</p>
        </nav>
        
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
