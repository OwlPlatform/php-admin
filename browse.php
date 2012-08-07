<?php
  // Application-wide constants
  require_once('constants.php');
  // Installation-specific values
  require_once(ABSPATH.'inc/site-settings.php');
  
  // World State class
  require_once(ABSPATH.'inc/worldstate.php');
  
  // Attribute class
  require_once(ABSPATH.'inc/attribute.php');
  
  $idArray = array();
  
  $smithStates = array(
    new WorldState("kitchen.refrigerator",
      array(new Attribute('temperature', '4.0', 'fridge-monitor',mktime(11,55,37,8,7,2012),mktime(0,0,0,1,1,1970)),
            new Attribute('temperature', '4.5', 'fridge-monitor',mktime(11,50,22,8,7,2012),mktime(11,55,37,8,7,2012)),
      )
    ),
    new WorldState("living room.television",
      array(new Attribute('on', 'true', 'power-monitor',mktime(20,03,14,8,6,2012),mktime(21,59,07,8,6,2012)),
            new Attribute('on', 'false', 'power-monitor',mktime(15,32,22,8,6,2012),mktime(16,01,7,8,6,2012)),
      )
    ),
  );
  
  $winlabStates = array (
    new WorldState("winlab.door.front door",
      array(
        new Attribute('open', 'false', 'binary-switch-solver', mktime(),mktime(0,0,0,1,1,1970)),
        new Attribute('open', 'true', 'binary-switch-solver', mktime(12,05,22,8,7,2012),mktime(12,05,52,8,7,2012)),
      )
    ),
  );
  
  function printState(WorldState $state, $editable) {
    $unsafeChars = array(".","/","\\","$", "\n", "\r", " ", "\t");
    global $idArray;
    $id = $state->getId();
    $attributes = $state->getAttributes();
    $hasOld = count($attributes) > 1;
    $isFirst = True;
    foreach($attributes as &$attr) {
      $isNew = $attr->getExpiration() === NULLDATE;
      $tagId = str_replace($unsafeChars,'_',$id.'/'.$attr->getName());
      // Push tag ID onto the array of all ids for scripting below
      echo "<tr class=\"";
      if($isNew || $isFirst) {
        echo 'state-current"';
        echo ' id="'.$tagId."\">\n";
        $idArray[] =  $tagId;
      } else {
        echo 'state-old state-hidden old-'.$tagId.'">';
      }
      
      echo "<td>".$id."</td>\n";
      echo "<td>".$attr->getName()."</td>\n";
      echo "<td>".$attr->getValue()."</td>\n";
      echo "<td>".$attr->getOrigin()."</td>\n";
      echo "<td>".date("M j, Y H:i",$attr->getCreation())."</td>\n";
      echo "<td>";
      if($isNew) {
        echo "&mdash;";
      }else {      
        echo date("M j, Y H:i",$attr->getExpiration());
      }
      echo "</td>\n";
      echo '<td>';
      if($editable){echo '<i class="icon-pencil"></i> ';}
      if($hasOld && ($isNew || $isFirst)){
        echo '<span class="icon-list" id="hist-'.$tagId.'"></span>'; 
      }
      
      echo "</td>\n";
      echo "</tr>\n";
      $isFirst = False;
    }
  }  
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Owl Platform Online</title>
    <?php include(ABSPATH . 'inc/defaultHeader.php'); ?>
  </head>	
  <body>
    <?php include(ABSPATH.'inc/navbar.php'); ?>
  <div class="container">
      <?php include(ABSPATH.'login.php'); ?>
      <div class="page-header">
        <h1>Owl Platform @ <?php echo $siteName; ?></h1>
      </div>
      <div class="row">
        <div class="span8">
          <h2>World Model Browser</h2>
          <hr />
          <div class="browser-search-form">
	          <div class="input-prepend">
              <span class="add-on">
                <i class="icon-search"></i>
              </span>
              <input type="search" class="span3" placeholder="Search" name="search" id="search"/>
            </div>
          </div>
          <h3>The Smiths</h3>
          <table class="table table-striped">
            <thead>
              <th>Id</th>
              <th>Attribute</th>
              <th>Status</th>
              <th>Origin</th>
              <th>Created</th>
              <th>Expires</th>
              <th>Action</th>
            </thead>
            <tbody>
            <?php
              foreach($smithStates as &$state) {
                printState($state, True);
              }
            ?>
            </tbody>
          </table>
          <h3>WINLAB</h3>
          <table class="table table-striped">
            <thead>
              <th>Id</th>
              <th>Attribute</th>
              <th>Status</th>
              <th>Origin</th>
              <th>Created</th>
              <th>Expires</th>
              <th>Action</th>
            </thead>
            <tbody>
            <?php
              foreach($winlabStates as &$state) {
                printState($state, False);
              }
            ?>
            </tbody>
          </table>
        </div>
      </div>
      <hr>

      <footer>
        <?php include(ABSPATH.'inc/defaultFooter.php'); ?>
      </footer>

    </div> <!-- /container -->
    <?php include(ABSPATH.'inc/footerScripts.php'); ?>
    <?php
      foreach($idArray as &$tag){
         echo "<script>\n";
          echo '$("#hist-'.$tag.'").click(function () {';
          echo '$(".old-'.$tag.'").toggleClass("state-hidden");';
          echo '});';
          echo '</script>';
      }
    ?>
	</body>
</html>
