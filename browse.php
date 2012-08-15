<?php
  // Application-wide constants
  require_once('constants.php');
  // Installation-specific values
  require_once(ABSPATH.'inc/site-settings.php');
  // Include Event class
  require_once(ABSPATH.'inc/user.php');
  
  session_start();
  if(!isset($_SESSION['currentUser'])) {
    $_SESSION['nextPage'] = $_SERVER['PHP_SELF'];
    header('location:login.php');
    exit;
  }
  
  // World State class
  require_once(ABSPATH.'inc/worldstate.php');
  
  // Attribute class
  require_once(ABSPATH.'inc/attribute.php');
  
  $idArray = array();
  
  $smithStates = array(
    new WorldState("kitchen.refrigerator",
      array(new Attribute('temperature', '4.0 C', 'fridge-monitor',mktime(11,55,37,8,7,2012),mktime(0,0,0,1,1,1970)),
            new Attribute('temperature', '5.5 C', 'fridge-monitor',mktime(11,50,22,8,7,2012),mktime(11,55,37,8,7,2012)),
            new Attribute('temperature', '7.0 C', 'fridge-monitor',mktime(11,45,22,8,7,2012),mktime(11,50,22,8,7,2012)),
            new Attribute('temperature', '3.5 C', 'fridge-monitor',mktime(11,40,22,8,7,2012),mktime(11,45,22,8,7,2012)),
      )
    ),
    new WorldState("living room.television",
      array(new Attribute('on', 'true', 'power-monitor',mktime(20,03,14,8,6,2012),mktime(21,59,07,8,6,2012)),
            new Attribute('on', 'false', 'power-monitor',mktime(15,32,22,8,6,2012),mktime(16,01,7,8,6,2012)),
      )
    ),
  );
  
  $winlabStates = array (
    new WorldState("sprinkler.front",
      array(
        new Attribute('watering', 'false', 'binary-switch-solver', strtotime('-5 minutes', mktime()),mktime(0,0,0,1,1,1970)),
        new Attribute('watering', 'true', 'binary-switch-solver', strtotime('-1 hours', mktime()),strtotime('-5 minutes',mktime())),
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
      if($editable){echo '<i class="icon-pencil" title="Update value" data-toggle="modal" data-target="#update-modal"></i> ';}
      if($hasOld && ($isNew || $isFirst)){
        echo '<span class="icon-list" id="hist-'.$tagId.'" title="Show/Hide history"></span>'; 
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
          <h3>142 Happy St.</h3>
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
        </div> <!-- Span-8 -->
      </div> <!-- Row -->
                <div class="modal hide" id="update-modal">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">×</button>
              <h3>Update Value</h3>
            </div>
            <div class="modal-body">
              <form id="update-attr-form" action="update-attribute.php" method="post" >
		          <fieldset>
			          <div class="clearfix">
			          <input type="text" id="update-id" name="identifier" placeholder="identifier" />
			          </div>
			          <div class="clear"></div>
			
			          <div class="clearfix">
			          <input type="text" id="update-attr-name" name="attr-name" placeholder="attribute" />
			          </div>
			          <div class="clear"></div>
			          
       			    <div class="clearfix">
			          <input type="text" id="update-attr-value" name="attr-value" placeholder="new value" />
			          </div>
			          <div class="clear"></div>

                <div class="clearfix">
			          <input type="text" id="update-attr-time" name="attr-created" placeholder="<?php echo date("Y/m/d H:i:s"); ?>" />
			          </div>
			          <div class="clear"></div>
		          </fieldset>
	          </form>
            </div>
            <div class="modal-footer">
              <a href="#" class="btn" data-dismiss="modal">Close</a>
              <a href="#" class="btn btn-primary">Save changes</a>
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
