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



//Get input from POST variables
$xoffset = $_POST["xoffset"];
$yoffset = $_POST["yoffset"];
$item_name = $_POST["item_name"];
$region_name = $_POST["region_name"];
$origin = $_POST["user_id"];
//Build the arguments for the swm.php script (x and y offsets are doubles)
$args = array( 'origin' => $origin, 'target_uri' => $region_name.".".$item_name, 'data_type' => 'double');
//Now push each new attribute with curl
$swm = curl_init();

$args["attribute"] = "location.xoffset";
$args["data_string"] = $xoffset;
curl_setopt($swm, CURLOPT_URL, "http://localhost/swm.php");
curl_setopt($swm, CURLOPT_POST, count($args));
curl_setopt($swm, CURLOPT_POSTFIELDS, encodeArray($args));
$result = curl_exec($swm);
echo "<p>Pushing xoffset:\n" . $result . "\n";

$args["attribute"] = "location.yoffset";
$args["data_string"] = $yoffset;
curl_setopt($swm, CURLOPT_POSTFIELDS, encodeArray($args));
$result = curl_exec($swm);
echo "<p>Pushing yoffset:\n" . $result . "\n";

curl_close($swm);

echo "<p>Item information updated. Click <a href=\"add_items.php?".encodeArray($_POST)."\">here</a> to add more items\n";

?>

</body>
</html>
