<!DOCTYPE html>
<html>
  <head>
    <title>GRAIL Region Setup</title>
    <script type='text/javascript'>
    </script> 
  </head>
  <body>
    <form action='add_item_location.php' method='post' enctype='multipart/form-data'>
      <label for='item_name'>Object Name:</label><input type='text' name='item_name' />
      <p><label for='xoffset'>X Offset:</label><input type='text' name='xoffset' />
<?php
echo "(between 0 and ".$_GET["region_width"].")\n";
?>
      <p>Y Offset <input type='text' name='yoffset' />
<?php
echo "(between 0 and ".$_GET["region_height"].")\n";
?>
<?php
echo "      <p>Region Name: <input type='text' name='region_name' value=\"".$_GET["region_name"]."\" />\n";
echo "      <p>Your ID: <input type='text' name='user_id' value=\"".$_GET["user_id"]."\" />\n";
?>
      <p><input type='submit' />
    </form>
<?php

?>
  </body>
</html>


