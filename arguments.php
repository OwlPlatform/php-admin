<html>
<head>
<link rel="stylesheet" type="text/css" href="grail.css" />
<title> Input Solver Arguments </title>
<h3> Enter values for the following arguments</h3>

<script type="text/javascript">
function closeSelf(){
	window.close();
}

</script>

</head>

<body>

<?php 

$file = $_GET['foo'];

$confdir = /usr/share/grail;
$bindir = /usr/bin/grail;
$db = new SQLite3($confdir.'/grail_db');

if (isset ($_POST['value0']))
{
	$index = 0;
	$noValue = $_POST['noValue'];
	while ($index < $noValue)
	{

		/*echo $_POST['param'.$index];
		echo "<br />";
		echo $_POST['value'.$index];
		echo "<br />"; */
		$result = $db->query('INSERT INTO arguments (parameters, value) VALUES ("'.$_POST['param'.$index].'","'.$_POST['value'.$index].'")');
		$index++;

	}
	echo "Argument values saved!"."<br /><br />";
	?>
	<button onclick="javascript:closeSelf();"> Close this window </button>
	<?php
}

else
{
	echo $file."<br /><br />";
	$result = $db->query('SELECT filename FROM names WHERE uiname = "'.$file.' "');
	$ans = $result->fetchArray();
	$out = array();

	$pos = strpos($ans[0], ".");

			
	if ($pos === false) 
	{
	
		exec($bindir.$ans[0]." -?", $out);

	}

	else
	{
	
		$extension = end(explode(".",$ans[0]));
		if ($extension == "rb")
		{
			exec("ruby ".$bindir.$ans[0]." -?", $out);
	
		}
	}

	for( $i = 0; $i < count($out); ++$i )
	{

		$row = explode(' ', $out[$i] );
		//echo $out[$i];
		if ($row[0] == "arguments:")
			$params = $row;
	
	}
	$noValue = 0;
	$args = $out[1];
	$params = explode(' ', $args );
	for( $i = 1; $i < count($params); ++$i ) 
	{
	$q = $db->query('CREATE TABLE IF NOT EXISTS arguments (parameters varchar(255) primary key, value varchar(255), UNIQUE (parameters) ON CONFLICT REPLACE)');
	$result1 = $db->query('SELECT value FROM arguments WHERE parameters = "'.$params[$i].'"');
	$values = $result1->fetchArray();

	echo "<form id=\"loginbox\" method=\"post\" action=\"\" enctype=\"multipart/form-data\" name=\"args_form\">";
	//echo $values[0];
	if ($values[0] == null and $params[$i] != "config_file")
	{ 

	echo "<p><label>".$params[$i].": </label>";
	?>

	<input type="hidden" name="param<?php echo $noValue;?>" value="<?php echo $params[$i];?>" />
	<input type="text" name="value<?php echo $noValue;?>" />
	</p>

	<?php 
	$noValue++;
	}

	} ?>
	<input type="hidden" name="noValue" value="<?php echo $noValue;?>" />
	<br /> <br />
	<input type="submit" value="Save" />
	</form>
<?php
}
?>

</body>

</html>
