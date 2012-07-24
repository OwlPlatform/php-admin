<html>
<head>
</head>

<body>
<?php

//Use generic locations for storage
$confdir = /usr/share/grail;
$bindir = /usr/bin/grail;
$webdir  = /var/www/htdocs;

//insert config file uploaded/manually written to database for future access
function insertConf ($filename,$file)
{
	//echo $filename;
	//echo $file;
  $db = new SQLite3($confdir.'/grail_db');
	
	$result1 = $db->query('UPDATE names SET config_file="'.$filename.'" WHERE filename="'.$file.'"');
	echo "Your config file is saved for future <br />";
}

/*
$dir_path = "/home/lucky/grailrtls/grail3_ruby/tools/";				//move the uploaded config file here and run solver from here
$directory = '/home/lucky/grailrtls/quest/';
$db = new SQLite3('/home/lucky/db/grail_db');
 */
$db = new SQLite3($confdir.'/grail_db');

$file = $_POST['file'];
//echo "<br />".$file."<br />";
$ruby = "no";

$pos = strpos($file, "."); 
$out = array();
$out1 = array();
if ($pos === false) 
{
	//echo $directory.$file." -?    ";
	exec($bindir.$file." -?", $out);
	//print_r $out;
}

else
{
	$extension = end(explode(".",$file));
	if ($extension == "rb")
	{
		//echo "ruby ".$bindir.$file; 
		exec("ruby ".$bindir.$file." -?", $out);
		$ruby = "yes";
		
		//print_r $out;
	}
}

for( $i = 0; $i < count($out); ++$i )
{
	$row = explode(' ', $out[$i] );
	if ($row[0] == "arguments:")
	{
		$params = $row;
		
		break;
	}

}
//print_r ($params);
$pass = "";
for( $i = 1; $i < count($params); ++$i ) 
{
	$result1 = $db->query('SELECT value FROM arguments WHERE parameters = "'.$params[$i].'"');
	$values = $result1->fetchArray();
	$pass = $pass." ".$values[0];
}
//echo "Pass : ".$pass."<br />";


/* to execute a script which needs no config file*/
if(isset($_POST['noConfig']))
{
	//echo $_POST['noConfig'];
	//echo $file;
	echo "<h2>The solver is now running!</h2>";
	if ($ruby == "yes")
  {
		//echo "ruby ".$bindir.$file." ".$pass;
		exec("ruby ".$bindir.$file." ".$pass." > /dev/null &");
  }
  else
  {
		echo $bindir.$file." ".$pass;
		exec($bindir.$file." ".$pass." > /dev/null &");
  }
}

/* to execute the ruby script with the file listed in the database */
if(isset($_POST['existing']))
{
  $existing = $_POST['existing'];

  //echo $existing;
  echo "<br />";
  $final = $pass." ".$confdir.$existing;
  //echo $final;
  //echo "Executing the command: <br />";
	echo "<h2>The solver is now running!</h2>";

  if ($ruby == "yes")
  {
    //echo "final: ".$final."<br />";
    //echo "ruby ".$bindir.$file." ".$final."<br />";
    //echo "<br />";
    exec("ruby ".$bindir.$file." ".$final." > /dev/null &");
    //print_r $out1;
  }

  else 
  {
    echo $bindir.$file."".$final;
    exec($bindir.$file." ".$final." > /dev/null &");
    //print_r $out1;

  }
}


/*to execute the ruby script with a file uploaded by the user */
if(isset($_FILES['cfile']))
{
  if ($_FILES['cfile']['error'] > 0)
  {
    echo "Error: " . $_FILES['cfile']['error'] . "<br />";
  }
  else
  {

    $filename = $_FILES['cfile']['name'];
    echo "You just uploaded: " .$filename. "<br />";
    move_uploaded_file($_FILES['cfile']['tmp_name'],$confdir.$filename);
    // echo "Stored in: " . $confdir . $_FILES["cfile"]["name"];
    insertConf($filename,$file);
    $final = $pass." ".$confdir.$filename;
    //echo $rbfile;
    // echo $final;
    //echo "Executing the command: <br />";
		echo "<h2>The solver is now running!</h2>";


    if ($ruby == "yes")
    {
      //echo "ruby ".$bindir.$file." ".$final;
      //echo "<br />";
      exec("ruby ".$bindir.$file." ".$final." > /dev/null &");
      //	print_r $out1;
    }

    else
    {
      //echo $bindir.$file."".$final;
      exec($bindir.$file." ".$final." > /dev/null &");
      //print_r $out1;

    }
  }
}


/* To let the user create his own config file and execute the ruby script using that */
if(isset($_POST['configcount']))
{
	//$rbfile = $_POST['rbfile'];
	//echo $rbfile;
	$config_name = $_POST['config_name'];
	$config_count = $_POST['configcount'];
	$fields = 0;
	$extra = $_POST['extra'];
	$compulsory = $_POST['compulsory'];
	$config_file = $confdir.$config_name.".conf";
	echo "Your config file will be called ".$config_file."<br />";
	
	$final = $pass." ".$config_file;
	$fh = fopen($config_file,'w');
	for ($i=0; $i<$compulsory; $i++)
	{
		$tuples = $_POST['configamount'][$i];
		if ($tuples>0)
		{
			$a = $_POST['configvalue'][$i]."=";
			//echo $a;
		
			while ($tuples>0)
			{
			
				
				$b = $_POST['id'][$fields]."\n";
				//echo $b;
			
			
				fwrite($fh, $a);
				fwrite($fh, $b);
				$tuples--;
				$fields++;
			
			}	
			//echo "<br />";
		}
		else 
		{
			
			$a = $_POST['configvalue'][$i]."=";
			//echo $a;
			$b = $_POST['id'][$fields]."\n";
			//echo $b;
			fwrite($fh, $a);
			fwrite($fh, $b);
			$fields++;
			//echo "<br />";
		}
  }
}

if (isset($extra))
	{
		//echo "extra: ".$extra;
		$x=0;
		while ($x<$extra)
		{
			$tuples = $_POST['configamount'][$i];
			$start = 0;
			
			$num_entries = count($_POST['field_'.$x]);
			while ($start<$num_entries)
			{
				$y = $_POST['configvalue'][$i]."=";
				//echo $y;
				fwrite($fh, $y);
				$output = array();
				$output = array_slice(($_POST['field_'.$x]),$start,$tuples);
				foreach ($output as $value)
				{
					//echo $value." ";
					fwrite($fh, $value." ");
				}
				$start += $tuples;
				//echo "<br />";
				fwrite($fh, "\n");
			}
			
			$x++;
			$i++;	
		}
	
	}

insertConf($config_file,$file);
 // echo $final;
//echo "Executing the command: <br />";
echo "<h2>The solver is now running!</h2>";
$pos = strpos($file, ".");
$out = array();			
if ($pos === false) 
{
	
	//echo $dir_path.$file."".$final;
	exec($dir_path.$file." ".$final." > /dev/null &");
	//print_r $out;
}

else
{
	$extension = end(explode(".",$file));
	if ($extension == "rb")
	{
		//echo "final: ".$final."<br />";
		//echo "ruby ".$dir_path.$file." ".$final;
		//echo "<br />";
		exec("ruby ".$dir_path.$file." ".$final." > /dev/null &");
		//print_r $out;
	}
}
?>
</body>
</html>
