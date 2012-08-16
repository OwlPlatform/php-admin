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
  
  $currentUser = $_SESSION['currentUser'];
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
        <div class="span2">
          <?php include(ABSPATH.'inc/admin-menu.php'); ?>
        </div>
        <div class="span6 offset1">
          <h2>Known Devices</h2>
          <table class="table table-compact">
            <thead>
              <th>Device Name</th>
              <th>Type/Model</th>
              <th>PHY/ID</th>
              <th>Abilities</th>
            </thead>
            <tbody>
              <tr>
                <td>Phone</td>
                <td>Samsung Galaxy S3</td>
                <td>802.11/DE:11:56:82:23:99</td>
                <td>
                  <ul>
                    <li>802.11 b/g</li>
                    <li>BlueTooth 3.0</li>
                    <li>Light sensor</li>
                    <li>Camera (&gt;3MP)</li>
                    <li>Accelerometer</li>
                    <li>Barometer</li>
                    <li>GPS</li>
                  </ul>
                </td>
              </tr>
              <tr>
                <td>Laptop</td>
                <td>Dell Latitude</td>
                <td>802.11/AA:DF:E2:12:87:45</td>
                <td>
                  <ul>
                    <li>802.11 a/b/g/n</li>
                    <li>BlueTooth 2.0</li>
                    <li>Camera (&le;3MP)</li>
                  </ul>
                </td>
              </tr>
              <tr>
                <td>Front door Tag</td>
                <td>TPIPv3.1</td>
                <td>RollCall 902.1MHz/31</td>
                <td>
                  <ul>
                    <li>Beacon (1s)</li>
                    <li>Switch Sensor</li>
                  </ul>
                </td>
              </tr>
              <tr>
                <td>Water heater tag</td>
                <td>TPIPv3.1</td>
                <td>RollCall 902.1MHz/19</td>
                <td>
                  <ul>
                    <li>Beacon (10s)</li>
                    <li>Water Sensor</li>
                  </ul>
                </td>
              </tr>
              <tr>
                <td>Back door tag</td>
                <td>TPIPv3.1</td>
                <td>RollCall 902.1MHz/82</td>
                <td>
                  <ul>
                    <li>Beacon (1s)</li>
                    <li>Switch Sensor</li>
                  </ul>
                </td>
              </tr>
            </tbody>
          </table>

        </div>
      </div> <!-- Row -->
      
      <div class="row">
        <div class="span6 offset3">
          <h2>New Devices</h2>
          <table class="table table-compact">
            <thead>
              <th>PHY</th>
              <th>Identifier</th>
              <th>Last Seen</th>
              <th>Add</th>
            </thead>
            <tbody>
              <tr>
                <td>802.11b</td>
                <td>AA:31:F4:78:91:01</td>
                <td>2012-07-22 03:44:27pm</td>
                <td><i class="icon-plus"></i></td>
              </tr>
              <tr>
                <td>RollCall 902.1MHz</td>
                <td>2</td>
                <td><?php echo date("Y-m-d h:i:sa",mktime()); ?></td>
                <td><i class="icon-plus"></i></td>
              </tr>
            </tbody>
          </table>

        </div>
      </div> <!-- Row -->
      <hr>

      <footer>
        <?php include(ABSPATH.'inc/defaultFooter.php'); ?>
      </footer>

    </div> <!-- /container -->
    <?php include(ABSPATH.'inc/footerScripts.php'); ?>

	</body>
</html>
