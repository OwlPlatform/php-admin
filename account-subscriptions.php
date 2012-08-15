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
          <h2>My Subscriptions</h2>
          <table class="table table-compact">
            <thead>
              <th>Name</th>
              <th>Address</th>
              <th>Status</th>
              <th>Actions</th>
            </thead>
            <tbody>
              <tr>
                <td>142 Happy St.</td>
                <td>166.23.22.94:7009/7010</td>
                <td>Last updated 30 seconds ago</td>
                <td><i class="icon-pause" title="Suspend"></i> <i class="icon-remove" title="Delete"></i></td>
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
