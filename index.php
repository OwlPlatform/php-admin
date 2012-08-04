<?php

  class Event {
    private $timestamp;
    private $message;
    private $extraInfo;
    
    public function __construct($timestamp, $message, $extraInfo){
      $this->timestamp = $timestamp;
      $this->message = $message;
      $this->extraInfo = $extraInfo;
    }
    
    public function getTimestamp() {
      return $this->timestamp;
    }
    
    public function getMessage() {
      return $this->message;
    }
    
    public function getExtraInfo() {
      return $this->extraInfo;
    }
  }
  
  class Module {
    private $enabled;
    private $status;
    private $id;
    private $displayName;
    
    public function __construct($id, $displayName, $enabled, $status) {
      $this->id = $id;
      $this->displayName = $displayName;
      $this->enabled = $enabled;
      $this->status = $status;
    }
    
    public function getId(){
      return $this->id;
    }
    
    public function getDisplayName() {
      return $this->displayName;
    }
    
    public function isEnabled() {
      return $this->enabled;
    }
    
    public function getStatus() {
      return $this->status;
    }
  }

  $fakeEvents = array (
    new Event(mktime(13,20,23,8,3,2012), "Meeting about Maker Faire", "Small Conference Room"),
    new Event(mktime(12,07,33,8,3,2012), "Rob ate his lunch", "Small Conference Room"),
    new Event(mktime(11,47,0,8,3,2012), "Tam finished his talk", "Big Conference Room"),
    new Event(mktime(11,31,45,8,3,2012), "Created Event Class", "Rob on his laptop"),
    new Event(mktime(11,05,37,8,3,2012), "Tam started his talk", "Big Conference Room"),
  );
  
  $fakeModules = array (
    new Module('0123242', 'Security System', True, 'Disarmed'),
    new Module('AF23XDf', 'Presence Detector', True, '2 Users Present'),
    new Module('532XCXA', 'Rain Detector', False, 'Last rained July 31, 2012'),
    new Module('1949822', '142 Happy St.', True, 'Online. Last updated 30 seconds ago'),
  );

  function printEvent($event) {
    echo '<div class="event" title="'.$event->getExtraInfo()."\">\n";
    echo '<span class="eventTime">'.date("H:i",$event->getTimestamp()).'</span>';
    echo ' &mdash; '.$event->getMessage();
    echo "</div><br />\n";
  }
  
  function printModule($module) {
    echo '<div class="module" title="'.$module->getStatus()."\">\n";
    echo '<span class="moduleName">'.$module->getDisplayName().'</span>'."\n";
    echo '<div id="'.$module->getId().'" class="toggle basic primary" data-enabled="ON" data-disabled="OFF" data-toggle="toggle" title="'.$module->getStatus().'">'."\n";
    echo '<input type="checkbox" value="1" name="myCheckbox" class="checkbox" checked="checked" />'."\n";
    echo '<label class="check" for="myCheckbox"></label>'."\n";
    echo "</div>\n";
    echo "</div>\n";
    echo "<br />\n";
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Owl Platform Online</title>
    <?php
      require_once('constants.php');
      require_once(ABSPATH . 'inc/defaultHeader.php');
    ?>
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
          <h2>Recent Events</h2>
          <hr />
          <?php
            foreach($fakeEvents as &$event) {
              printEvent($event);
            }
          ?>
          
        </div>
        <div class="span4">
          <h2>Module Status</h2>          
          <hr />
          <?php
            foreach($fakeModules as &$module) {
              printModule($module);
            }
          ?>
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
