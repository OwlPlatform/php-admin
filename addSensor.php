

<?php

function encodeArray($arr) {
  $postvars='';
  $sep='';
  foreach($arr as $key=>$value) { 
    $postvars.= $sep.urlencode($key).'='.urlencode($value); 
    $sep='&'; 
  }
  return $postvars;
}


$id = $_POST["id"];
$uri = $_POST["uri"];
$attr = $_POST["attribute"];
$origin = $_POST["origin"];


$args = array( 'origin' => $origin, 'target_uri' => $uri, 'data_type' => 'sensor');
  
$swm = curl_init();

$args["attribute"] = "sensor.".$attr;
$args["data_string"] = "1.".$id;
curl_setopt($swm, CURLOPT_URL, "http://localhost/swm.php");
curl_setopt($swm, CURLOPT_POST, count($args));
curl_setopt($swm, CURLOPT_POSTFIELDS, encodeArray($args));
$result = curl_exec($swm);

print_r($result);
$test = pow(2.0,32);
//echo "\n The value of pow expression is ".pow(2.0,32)."\n";
//echo "The value of test is ".$test."\n";

curl_close($swm);


echo "<p>Data initialization complete\n";

?>



