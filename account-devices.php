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
      <div class="row show-grid">
        <div class="span2">
          <?php include(ABSPATH.'inc/account-menu.php'); ?>
        </div>
        <div class="span6 offset1">
          <h2>My Devices</h2>
          <table class="table table-compact">
            <thead>
              <th>Device Name</th>
              <th>Type/Model</th>
              <th>PHY/Id</th>
              <th>Info</th>
            </thead>
            <tbody>
              <tr>
                <td>Laptop</td>
                <td>Dell Latitude</td>
                <td>802.11/AA:DF:E2:12:87:45</td>
                <td>
                  <ul>
                    <li>Location (Room) <i class="icon-remove"></i></li>
                    <li>Movement <i class="icon-remove"></i></li>
                  </ul>
                </td>
              </tr>
              <tr>
                <td>Phone</td>
                <td>Samsung Galaxy S3</td>
                <td>802.11/DE:11:56:82:23:99</td>
                <td>
                  <ul>
                    <li>Presence <i class="icon-remove"></i></li>
                    <li>Location (Fine) <i class="icon-remove"></i></li>
                  </ul>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div> <!-- row -->
      
      <hr>

      <footer>
        <?php include(ABSPATH.'inc/defaultFooter.php'); ?>
      </footer>

    </div> <!-- /container -->
    <?php include(ABSPATH.'inc/footerScripts.php'); ?>

	</body>
</html>
