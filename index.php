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
  
  // Include Event class
  require_once(ABSPATH.'inc/event.php');
  // Include Module class
  require_once(ABSPATH.'inc/module.php');
  

  $fakeEvents = array (
    new Event(mktime(17,40,00,8,1,2012), "Module \"Sprinklers\" stopped.", ""),
    new Event(mktime(17,28,00,8,1,2012), "Alarm disarmed by John Smith", "Front Panel"),
    new Event(mktime(17,27,00,8,1,2012), "John Smith arrived home", "Keys + Phone + Wallet"),
    new Event(mktime(13,56,00,8,1,2012), "Stopped raining", "Roof + Yard"),
    new Event(mktime(13,23,00,8,1,2012), "Started raining", "Roof + Yard + Neighbors"),
    new Event(mktime(11,44,00,8,1,2012), "Mail arrived", "4.3 oz."),
    new Event(mktime(8,03,00,8,1,2012), "Alarm armed automatically", "No authorized users detected"),
    new Event(mktime(8,01,00,8,1,2012), "Jane Smith left the house", "Keys + Phone"),
    new Event(mktime(7,47,00,8,1,2012), "John Smith left the house", "Key + Phone + Wallet"),
    new Event(mktime(6,00,00,8,1,2012), "Sprinklers cancelled", "60% chance of rain + Barometer"),
  );
  
  $fakeModules = array (
    new Module('0123242', 'Security System', TRUE, 'Disarmed'),
    new Module('AF23XDf', 'Presence Detector', TRUE, '2 Users Present'),
    new Module('532XCXA', 'Rain Detector', FALSE, 'Last rained July 31, 2012'),
    new Module('1949822', '142 Happy St.', TRUE, 'Online. Last updated 30 seconds ago'),
  );

  function printEvent(Event $event) {
    echo '<tr title="'.$event->getExtraInfo()."\">\n";
    echo '<td>'.date("H:i",$event->getTimestamp())."</td>\n";
    echo '<td>'.$event->getMessage()."</td>\n";
    echo "</tr>\n";
  }
  
  function printModule(Module $module) {
    echo "<tr>\n";
    echo '<td>'.$module->getDisplayName()."</td>\n";
    echo '<td>'.$module->getStatus()."</td>\n";
    echo "<td><div class=\"module\">\n";
    echo '<div id="'.$module->getId().'" class="toggle basic" data-enabled="ON" data-disabled="OFF" data-toggle="toggle">'."\n";
    echo '<input type="checkbox" value="1" name="myCheckbox" class="checkbox" ';
      if($module->isEnabled()){ echo 'checked ';}
    echo "\" />.\n";
    echo '<label class="check" for="myCheckbox"></label>'."\n";
    echo "</div>\n"; // Button div
    echo "</td>\n";
    echo "</tr>\n";
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
        <div class="span6">
          <h2>Recent Events</h2>
          <hr />
          <table class="table table-striped">
            <thead>
              <th>When</th>
              <th>What</th>
            </thead>
            <tbody>
          <?php
            foreach($fakeEvents as &$event) {
              printEvent($event);
            }
          ?>
            </tbody>
          </table>
        </div>
        <div class="span5">
          <h2>Operating Status</h2>
          <hr />
          <table class="table table-striped">
            <thead>
            <th>Name</th>
            <th>Status</th>
            <th>Enabled</th>
            </thead>
            <tbody>
          <?php
            foreach($fakeModules as &$module) {
              printModule($module);
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
    <script type="text/javascript">
    
      <?php
        foreach ($fakeModules as &$module) {
          echo "$('#".$module->getId()."').toggle({\n";
          ?>
          onClick: function (event, status) {}, // Do something on status change if you want
          text: {
            enabled: false, // Change the enabled disabled text on the fly ie: 'ENABLED'
            disabled: false // and for 'DISABLED'
          },
          style: {
            enabled: 'primary', // default button styles like btn-primary, btn-info, btn-warning just remove the btn- part.
            disabled: 'danger' // same goes for this, primary, info, warning, danger, success. 
          }
        });  
      <?php
      } // foreach ($module)
    ?>
    </script>
	</body>
</html>
