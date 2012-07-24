<html>
<head>
<link rel="stylesheet" type="text/css" href="grail.css" />
<h1 align="center" color=#6699FF> Running the application </h1>

<script type="text/javascript">

// switches display of file upload div and manual configuration div 
function toggleLayer( whichLayer )
{
  var elem, vis;
  if( document.getElementById ) 
    elem = document.getElementById( whichLayer );
  else if( document.all ) // this is the way old msie versions work
    elem = document.all[whichLayer];
  else if( document.layers ) // this is the way nn4 works
    elem = document.layers[whichLayer];
  vis = elem.style;
  // if the style.display value is blank we try to figure it out here
  if(vis.display==''&&elem.offsetWidth!=undefined&&elem.offsetHeight!=undefined)
    vis.display = (elem.offsetWidth!=0&&elem.offsetHeight!=0)?'block':'none';
  vis.display = (vis.display==''||vis.display=='block')?'none':'block';

}




var a=0;

// to add new text boxes for input fields with variable number of tuples

function add(count,extra) {

  var html = "";

  var i=0;
  var newElem = document.getElementById("mytext"+extra);
  var newcontent = document.createElement('div');
  while (i<count)
  {

    newcontent.innerHTML += ' <input type="text" name="field_'+extra+'['+a+']" id="field_'+extra+a+'" >';
    i++;
    a++;
  }

  while (newcontent.firstChild) 
  {
    newElem.appendChild(newcontent.firstChild);
  }


}
</script>
</head>

<body>

<br />
<div id="wrapper">
<?php


$confdir = /usr/share/grail;
$bindir = /usr/bin/grail;
$webdir  = /var/www/htdocs;


if(isset($_POST['appname']))
{
  $noValue=0;
  $file =  $_POST['appname'];
  echo $file;
  $db = new SQLite3($confdir.'/grail_db');

  $result = $db->query('SELECT filename FROM names WHERE uiname = "'.$file.'"');
  $ans = $result->fetchArray();


//run each solver with -? and display the values returned

  //echo $ans[0];
  echo "<br />";
  $config = "no";
  $out = array();

  $pos = strpos($ans[0], ".");

  #No filename extension -- must be a binary program
  if ($pos === false) 
  {
    exec($bindir.$ans[0]." -?", $out);
  }
  #Otherwise this is an interpreted program -- send it to an interpreter
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
    echo $out[$i];
    $row = explode(' ', $out[$i] );
    if ($row[0] == "arguments:")
      $params = $row;
    else if ($row[0] == "config_file:")
      $config = "yes";
    echo "<br />";
  }

  echo "<br />";


//check database for values of arguments needed by this solver

  $args = $out[1];
  $params = explode(' ', $args );
  for( $i = 1; $i < count($params); ++$i ) 
  {
    //echo $params[$i];
    $q = $db->query('CREATE TABLE IF NOT EXISTS arguments (parameters varchar(255) primary key, value varchar(255), UNIQUE (parameters) ON CONFLICT REPLACE)');
    $result1 = $db->query('SELECT value FROM arguments WHERE parameters = "'.$params[$i].'"');
    $values = $result1->fetchArray();

    //echo $values[0];
    if ($values[0] == null and $params[$i] != "config_file")
    { 
      $noValue++;
    }
  }

//if the values for any parameters are missing, pop up a window and ask user to enter values

  if ($noValue > 0)
  {
    echo "Some parameters are missing !";
?>

    <script type="text/javascript">
    // Popup window code
    function newPopup(url) {
      popupWindow = window.open(			url,'popUpWindow','height=400,width=400,left=10,top=10,resizable=yes,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no,status=yes')
    }
    </script>

  <button onClick="javascript:newPopup('arguments.php?foo=<?php echo $file; ?>')">Enter values for parameters</button>

<?php
  }


  echo "<br/>";

//if solver does not need a config file	
  if ($config == "no")
  {
    echo "<form method=\"post\" action=\"choose_config.php\" enctype=\"multipart/form-data\">";
    echo "<input type=\"hidden\" name=\"noConfig\" value=\"yes\" />";
    echo "<input type=\"hidden\" name=\"file\" value="."\"$ans[0]\""."/>";
    echo "<input type=\"submit\" value=\"Run the solver\">";

    echo "</form>";
  }

  else if ($config == "yes")
  {
?>
  </div>

  <div id="config">

  <h2>This service needs a config file</h2>

  <button type="button" onclick="javascript:toggleLayer('uploadForm');">Upload the config file</button> 	

  <div id="uploadForm">
  <form method="post" action="choose_config.php" enctype="multipart/form-data"> 

<!-- If user wants to upload a config file -->

  <label>Filename:</label> 
  <input type="file" name="cfile" id="cfile" /> <br /> <br />
  <input type="hidden" name="file" value="<?php echo $ans[0]; ?>" />

  <input type="submit" value="Save file and Run Solver" name="Submit">

  </form> 

  <input type="reset" name="reset" value="Cancel" onclick="javascript:toggleLayer('uploadForm');" />

  <br /> <br />
  </div>

  <button type="button" onclick="javascript:toggleLayer('commentForm');">Add values manually</button>

  <div id="commentForm">
  <form method="post" action="choose_config.php" enctype="multipart/form-data"> 
<?php
	
// if user wants to enter the config file fields manually, read argument rows starting with 'config_file' and display the field, description and the appropriate number of text boxes
	
    echo $noValue;
    $field = 0;
    $config_count = 0;
    $amount = 0;
    $extra = 0;
    $compulsory = 0;
    for( $i = 0; $i < count($out); ++$i )
    {
      //	echo $out[$i];
      $row = explode(' ', $out[$i] );
      if ($row[0] == "config_file:")
      {

        echo "<input type=\"hidden\" name=\"configvalue[".$config_count."]\" value=".$row[2]." />";

        $desc = count($row);
        //echo $desc;
        //echo "<br />";

        if ($row[1] == "key_value" or $row[1] == "tuple")
        {
          $compulsory++;
          $des = 3;
          while ($des < $desc)
          {
            echo $row[$des]." ";		//extract description of the field
            $des++;		
          }

          if ($row[1] == "key_value")
          {
            echo " - ";
            echo $row[2].": <input type=\"text\" name=\"id[" . $field . "]\">";
          }
          else
            echo " <input type=\"text\" name=\"id[" . $field . "]\">";
          echo "<input type=\"hidden\" name=\"configamount[".$config_count."]\" value=\"0\" />";
          $field++;
        }	
        else if ($row[1] == "key_tuple" )	 //will need more than one entries for the field
        {
          $compulsory++;
          $des = 4;
          $tuple_count = 0;
          while ($des < $desc)
          {
            echo $row[$des]." ";
            $des++;
          }
          echo " - ";
          echo $row[2].": ";
          while ($tuple_count < $row[3])			//$row[3] tells how many text boxes to be displayed
          {				
            echo "<input type=\"text\" name=\"id[" . $field . "]\">";
            $field++;
            $tuple_count++;
          }
          echo "<input type=\"hidden\" name=\"configamount[".$config_count."]\" value=".$row[3]." />";
        }
        else if ($row[1] == "key_tuple*" or $row[1] == "tuple*")		//fields with * are optional. user can add more or no fields
        {
          $des = 4;
          $tuple_optional = 0;
          if ($row[1] == "key_tuple*")
          {
            while ($des < $desc)
            {
              echo $row[$des]." ";
              $des++;
            }
            echo " - ";

            echo $row[2]." (Optional): ";
            echo "<input type=\"button\" value=\"Add\" onclick=\"add($row[3],$extra)\" />";
          }
          else if ($row[1] == "tuple*")
          {
            $des = 3;
            while ($des < $desc)
            {
              echo $row[$des]." ";
              $des++;
            }
            echo " - ";

            echo " (Optional): ";
            echo "<input type=\"button\" value=\"Add\" onclick=\"add($row[2],$extra)\" />";
          }

          echo "<div id=\"mytext".$extra."\" class=\"mytext".$extra."\"> &nbsp </div>";
          $extra++;

          echo "<input type=\"hidden\" name=\"configamount[".$config_count."]\" value=".$row[3]." />";

        } 	

        echo "<br />";
        $config_count++;
      }
    }
    //echo $ans[0];

    $config_name  = strtok($ans[0], '.');

    echo "<input type=\"hidden\" name=\"configcount\" value=".$config_count." />";
    echo "<input type=\"hidden\" name=\"config_name\" value=".$config_name." />";

    echo "<input type=\"hidden\" name=\"file\" value="."\"$ans[0]\""."/>";
    echo "<input type=\"hidden\" name=\"extra\" value="."\"$extra\""." />";
    echo "<input type=\"hidden\" name=\"compulsory\" value="."\"$compulsory\""." />";


?>

  <br />

  <input type="reset" name="reset" value="Cancel" onclick="javascript:toggleLayer('commentForm');" />
  <input type="submit" value="Create config file">

  </form>
  </div>

<?php	
//for a filename already existing in table 'names', ask if user just wants to use that

    $result2 = $db->query('SELECT config_file FROM names WHERE uiname="'.$file.'"'); 
    $ans1 = $result2->fetchArray();

    echo "<br />";
    if ($ans1[0]!=NULL)
    {
      echo "<br /><br />";
      echo "Here's the existing config file: ";
      echo $ans1[0];
      echo "<br />Run with existing file?";
      echo "<form method=\"post\" action=\"choose_config.php\" enctype=\"multipart/form-data\">";
      echo "<input type=\"hidden\" name=\"existing\" value="."\"$ans1[0]\""."/>";

      echo "<input type=\"hidden\" name=\"file\" value="."\"$ans[0]\""."/>";
      echo "<input type=\"submit\" value=\"Yes\" name=\"Yes\" />";
      echo "</form>";
      //echo $ans[0];
    }
  }
  $db->close();
}
?>
</div>
</body>
</html>
