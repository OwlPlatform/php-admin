<html>
<head>
<title> Sensor Specifications </title>
<h3> Fill in sensor details </h3>
</head>

<body>
<form action="addSensor.php" method="post" enctype="multipart/form-data">
Sensor ID: <input type="text" name="id" value="<?php echo $_GET['id'] ?>" /><br />
URI: <input type="text" name="uri" /><br />
Origin: <input type="text" name="origin"/><br />
Sensor Attribute: <input type="text" name="attribute" /><br />
<input type="submit" />
</form>
</body>
</html>
