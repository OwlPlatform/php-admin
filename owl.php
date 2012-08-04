<html>

<head>
<link rel="stylesheet" type="text/css" href="owl.css" />
<title> GRAIL </title>
</head>

<body>
<!-- Some random instruction display -->

<div id="div-1" class="center"> <br /> <br />
<h1> Welcome to GRAIL </h1>
</div>
<hr width="100%" color=#6699FF>
<br /> <br />
<div id="div-2">
<p align="left">
Steps for using the GRAIL system:
<ul>
<li>Click the 'Turn On' button for the solver you want to run <br />
<li>Enter the values for the arguments needed by the solver   <br />
<li>If the solver needs a config file, upload it or enter values manually <br />

</ul>
</p>
</div>
<div id="div-3">

<table >
<tr>    
<th> MODULES </th>
<th>  </th>
</tr>
<tr>


<?php
$form = 0;

$confdir = /usr/share/grail;
$bindir = /usr/bin/grail;
$webdir = /var/www/htdocs;

$db = new SQLite3($confdir.'/grail_db');

//create table for mapping solver names to user-friendly names displayed on the first page
$q = $db->query('CREATE TABLE IF NOT EXISTS names (uiname varchar(255) PRIMARY KEY NOT NULL, filename varchar(255) NOT NULL, config_file varchar(255), UNIQUE (uiname,filename))');

//iterate throught the directory,run each solver with -? and save solver names corresponding to user friendly names

if ($handle = opendir($bindir))
{

  while (false !== ($file = readdir($handle)))
  {
    if($file !== '.' && $file !== '..')
    {
      $pos = strpos($file, ".");
      $out = array();
      if ($pos === false) 
      {

        exec($bindir.$file." -?", $out);

      }

      else
      {
        $extension = end(explode(".",$file));

        if ($extension == "rb")
        {
          exec("ruby ".$bindir.$file." -?", $out);

        }
      }


      $row = explode(' ', $out[0] );


      $uiname = "";	

      for( $j = 1; $j < count($row); ++$j )
      {

        $uiname .= $row[$j]." ";

      }





      $formid = "form".$form;
      $form++;	

?>

        <form name="<?php echo $formid; ?>"  action="runprogram.php" method="POST">
        <td> <?php echo $uiname; ?> 
        <input type="hidden" name="appname" value="<?php echo $uiname; ?>" />
        </td>
        <td>
        <input type="submit" name="go" value="Turn on" />
        </td>
        </form>
        </tr>

<?php	

      $result = $db->query('INSERT INTO names (uiname, filename) VALUES ("'.$uiname.'","'.$file.'")');
      //if (!$result) echo "";
      //echo $file;
      //echo "<br />";

    }
  }
  closedir($handle);
}
?>


</div>    

</body>

</html>
