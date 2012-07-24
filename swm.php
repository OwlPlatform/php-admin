#!/usr/bin/php
<?php

function packuint64($val)
{
  //Pack the "big" part first for a big endian 64 number
  return pack('N', ($val/pow(2,32))).pack('N', ($val%pow(2,32)));
}

function packuint128($val)
{
  $offsets = array(32, 64, 96);
  $packed = pack('N', ($val%pow(2,32)));
  //Pack the "big" part first for a big endian 64 number
  foreach($offsets as $offset) {
    $packed = pack('N', ($val/pow(2,$offset))%pow(2,32)).$packed;
  }
  unset($offset);

  return pack('N', ( ($val/pow(2,32))%pow(2,32) )).pack('N', ($val%pow(2,32)));
}

//Get input from POST variables
$origin = $_POST["origin"];
$attribute = $_POST["attribute"];
$target_uri = $_POST["target_uri"];
$data_type = $_POST["data_type"];
$data_string = $_POST["data_string"];
/*
//Testing and examples
$origin = "Ben";
$attribute = "Test Attribute";
$target_uri = "Test URI";
$data_type = "double";
$data_string = "3.14159";
$data_type = "sensor";
$data_string = "1.257";
 */

//Attribute name and alias number
$type_pairs = array(1, $attribute);

//Get time in seconds but multiply by 1000 to get milliseconds
$now = 1000*gettimeofday(true);
$wmdata_vector = array($now*1000,$target_uri);
//print_r($wmdata_vector);


$ip = "127.0.0.1";
$port = 7009;

ob_implicit_flush();

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if ($socket === false)
  throw new Exception("Socket Creation Failed");


$connected = socket_connect($socket, $ip, $port);
if ($connected === false)
  throw new Exception("Connection Failed");


$ver_string = "GRAIL world model protocol";

$ver_len = pack('N', strlen($ver_string));
$handshake = $ver_len.$ver_string."\x00\x00";				//creating the handshake message

$sent = socket_write($socket, $handshake, 32);				//sending the handshake msg


$recvd = socket_read($socket, 32, PHP_BINARY_READ);

if (strlen($recvd) != 32)
  throw new Exception("Handshake failure with world model!");


for ($i=0; $i<32;$i++)							//comparing the handshake that was sent and received
{
  if ($handshake[$i] != $recvd[$i])
    throw new Exception("Handshake failure with world model!");
}

//One attribute announcement
$buff = pack('C',1).pack('N',1);
$pair = $type_pairs;

$attr_len = mb_strlen(mb_convert_encoding($pair[1],'utf-16'));
//Write the alias number, string length, string, and transient type (hard coded to not transient)
$buff = $buff.pack('N',$pair[0]).pack('N',$attr_len).mb_convert_encoding($pair[1],'utf-16')."\x00";
$buff = $buff.mb_convert_encoding($origin, 'utf-16');
$buflen = mb_strlen($buff, 'latin1');

$announce = socket_write($socket,pack('N',$buflen).$buff, $buflen+4);

//echo "Announce length was ".$announce."\n";

$create_uris= true;

//Solver data message
$buff = pack('C',4);

if ($create_uris)
  $buff = $buff.pack('C',1);
else
  $buff = $buff.pack('C',0);

$buff = $buff.pack('N',1);		//total solutions is 1

//Push back the alias, creation time, sized uri string, and sized data
$converted = mb_convert_encoding($wmdata_vector[1], 'utf-16');
$buff = $buff.pack('N', $pair[0]).packuint64($wmdata_vector[0]).pack('N', mb_strlen($converted)).$converted;
//Check data type
if ($data_type == "double") {
  //Double data type
  $pack_data = pack('d', $data_string);
}
elseif ($data_type == "sensor") {
  //1 byte of phy, 16 bytes of ID
  $parts = explode(".", $data_string, 2);
  $pack_data = pack('C', $parts[0]).packuint128($parts[1]);
}
//Otherwise assume string
else {
  //String data type (not sized)
  $pack_data = mb_convert_encoding($data_string, 'utf-16');
}
$datalen = mb_strlen($pack_data, 'latin1');
$buff = $buff.pack('N', $datalen).$pack_data;

$buflen = mb_strlen($buff, 'latin1');

//Transfer the data, allowing 4 more bytes for the length itself
$transfer = socket_write($socket,pack('N',$buflen).$buff, 4+$buflen);

//echo "Data transfer size was ".$transfer."\n";

// Close and return.
socket_close($socket);

?>
