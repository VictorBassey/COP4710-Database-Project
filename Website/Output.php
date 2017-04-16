<?php
include '../dbh.php';

//Parses the information to XML
function parseToXML($htmlStr)
{
	$xmlStr=str_replace('<','&lt;',$htmlStr);
	$xmlStr=str_replace('>','&gt;',$xmlStr);
	$xmlStr=str_replace('"','&quot;',$xmlStr);
	$xmlStr=str_replace("'",'&#39;',$xmlStr);
	$xmlStr=str_replace("&",'&amp;',$xmlStr);
	return $xmlStr;
}


// Select all the rows in the events table
$getInfo = "SELECT * FROM events";
				
//Makes the query
$result = mysqli_query($conn, $getInfo) or die('Error getting data');

header("Content-type: text/xml");

//Starts the XML file and echoes the parent node
echo '<markers>';

//Print XML nodes for each row in the table
while ($row = @mysqli_fetch_assoc($result))
{
	// Add to XML document node
	echo '<marker ';
	//echo 'eid="' . $ind . '" ';
	echo 'description="' . parseToXML($row['description']) . '" ';
	echo 'time="' . $row['time'] . '" ';
	echo 'location="' . parseToXML($row['location']) . '" ';
	echo 'lat="' . $row['lat'] . '" ';
	echo 'lng="' . $row['lng'] . '" ';
	echo 'eventtype="' . $row['eventtype'] . '" ';
	echo 'venuetype="' . $row['venuetype'] . '" ';
	echo '/>';
}

//Ends XML file
echo '</markers>';

?>
