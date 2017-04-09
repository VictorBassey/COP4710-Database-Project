<?php
require("phpsqlajax_dbinfo.php");
include 'dbh.php';
// Start XML file, create parent node
$doc = domxml_new_doc("1.0");
$node = $doc->create_element("markers");
$parnode = $doc->append_child($node);



// Select all the rows in the markers table
$query = "SELECT * FROM events WHERE 1";
$result = mysqli_query($query);
if (!$result) 
{
  die('Invalid query: ' . mysqli_error());
}

header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each
while ($row = @mysql_fetch_assoc($result)){
  // Add to XML document node
  $node = $doc->create_element("events");
  $newnode = $parnode->append_child($node);

  $newnode->set_attribute("eid", $row['eid']);
  $newnode->set_attribute("time", $row['time']);
  $newnode->set_attribute("description", $row['description']);
  $newnode->set_attribute("location", $row['location']);
  $newnode->set_attribute("lat", $row['lat']);
  $newnode->set_attribute("lng", $row['lng']);
  $newnode->set_attribute("venuetype", $row['venuetype']);
  $newnode->set_attribute("eventtype", $row['eventtype']);
}

$xmlfile = $doc->dump_mem();
echo $xmlfile;

?>