<html>
<head>
<title>Submitting new region information</title>
<body>
<?php
//Function to url encode arguments for the swm.php script
function encodeArray($arr) {
  //String of all values
  $postvars='';
  //First value doesn't need an ampersand before it
  $sep='';
  foreach($arr as $key=>$value) { 
    $postvars.= $sep.urlencode($key).'='.urlencode($value); 
    $sep='&'; 
  }
  return $postvars;
}


//Check the map file and save it
if ($_FILES["region_map"]["error"] > 0) {
  echo "<p>Error with map file: " . $_FiLES["region_map"]["error"] . "\n";
}
else {
  //Save the map in the current directory
  move_uploaded_file($_FILES["region_map"]["tmp_name"],
    "./" . $_FILES["region_map"]["name"]);

  //Get input from POST variables
  $region_name = $_POST["region_name"];
  $region_width = $_POST["region_width"];
  $region_height = $_POST["region_height"];
  $units = $_POST["region_units"];
  $origin = $_POST["user_id"];
  //Build the arguments for the swm.php script (every one of these values is a double)
  $args = array( 'origin' => $origin, 'target_uri' => "region.".$region_name, 'data_type' => 'double');
  //Now push each new attribute with curl
  $swm = curl_init();

  $args["attribute"] = "location.maxx";
  $args["data_string"] = $region_width;
  curl_setopt($swm, CURLOPT_URL, "http://localhost/swm.php");
  curl_setopt($swm, CURLOPT_POST, count($args));
  curl_setopt($swm, CURLOPT_POSTFIELDS, encodeArray($args));
  $result = curl_exec($swm);
  echo "<p>Pushing maxx:\n" . $result . "\n";

  $args["attribute"] = "location.maxy";
  $args["data_string"] = $region_height;
  curl_setopt($swm, CURLOPT_POSTFIELDS, encodeArray($args));
  $result = curl_exec($swm);
  echo "<p>Pushing maxy:\n" . $result . "\n";

  $args["attribute"] = "location.units";
  $args["data_type"] = "string";
  $args["data_string"] = $units;
  curl_setopt($swm, CURLOPT_POSTFIELDS, encodeArray($args));
  $result = curl_exec($swm);
  echo "<p>Pushing units:\n" . $result . "\n";

  curl_close($swm);
}

echo "<p>Data initialization complete. Go <a href=\"add_items.php?".encodeArray($_POST)."\">here to add items</a>\n";

?>

</body>
</html>
