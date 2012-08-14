<?php
  // Application-wide constants
  require_once('constants.php');
  // Installation-specific values
  require_once(ABSPATH.'inc/site-settings.php');
  // Include Event class
  require_once(ABSPATH.'inc/event.php');
  // Include Module class
  require_once(ABSPATH.'inc/module.php');
  

  $fakeEvents = array (
    new Event(mktime(13,20,23,8,3,2012), "Meeting about Maker Faire", "Small Conference Room"),
    new Event(mktime(12,07,33,8,3,2012), "Rob ate his lunch", "Small Conference Room"),
    new Event(mktime(11,47,0,8,3,2012), "Tam finished his talk", "Big Conference Room"),
    new Event(mktime(11,31,45,8,3,2012), "Created Event Class", "Rob on his laptop"),
    new Event(mktime(11,05,37,8,3,2012), "Tam started his talk", "Big Conference Room"),
    new Event(mktime(10,25,37,8,3,2012), "Tam is practicing his talk", "Tam's cubicle"),
    new Event(mktime(9,42,37,8,3,2012), "Coffee was brewed", "Kitchen"),
    new Event(mktime(8,00,00,8,3,2012), "WINLAB was unlocked", "Front door"),
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
      <?php include(ABSPATH.'login.php'); ?>
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
