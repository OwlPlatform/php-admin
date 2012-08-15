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
          <h2>Current Notifications</h2>
          <table class="table table-compact">
            <thead>
              <th>Event</th>
              <th>Action</th>
              <th>Account</th>
              <th>Actions</th>
            </thead>
            <tbody>
              <tr>
                <td>Coffee brewed <em>and</em> I am home</td>
                <td>Send me an email</td>
                <td>GMail</td>
                <td><i class="icon-wrench" title="Edit Notification"></i> <i class="icon-remove" title="Delete"></i></td>
              </tr>
              <tr>
                <td>Nobody home <em>and</em> motion is detected</td>
                <td>Send me an SMS</td>
                <td>
                  <ol>
                    <li>Mobile phone</li>
                    <li>Work phone</li>
                  </ol>
                </td>
                <td><i class="icon-wrench" title="Edit Notification"></i> <i class="icon-remove" title="Delete"></i></td>
              </tr>
              <tr>
                <td>I arrive home</td>
                <td>Check me in</td>
                <td>foursquare</td>
                <td><i class="icon-wrench" title="Edit Notification"></i> <i class="icon-remove" title="Delete"></i></td>
              </tr>
              <tr>
                <td>Unauthorized WiFi device</td>
                <td>Send me an email</td>
                <td>GMail</td>
                <td><i class="icon-wrench" title="Edit Notification"></i> <i class="icon-remove" title="Delete"></i></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div> <!-- row -->
      <div class="row">
        <div class="span6 offset3">
          <form id='add-notification' action='#' method='post' accept-charset='UTF-8'>
            <fieldset >
              <legend>New Notification</legend>
              <input type='hidden' name='submitted' id='submitted' value='1'/>
              <label for='notification-event' >Event:</label>
              <select name='notification-event' id='notification-action'>
                <option>I arrive home</option>
                <option>Unauthorized WiFi Device</option>
                <option>Nobody home</option>
                <option>Coffee brewed</option>
              </select>
              <label for='notification-action' >Action:</label>
              <select name='notification-action' id='notification-action'>
                <option>Send me an email</option>
                <option>Send me an SMS</option>
                <option>Check me in</option>
                <option>Post to my wall</option>
                <option>Send a Tweet</option>
              </select>
              <label for='notification-account'>Account:</label>
              <select name='notification-account' id='notification-account'>
                <option>GMail &lt;user123@gmail.com&gt;</option>
                <option>GMail &lt;my.account@gmail.com&gt;</option>
                <option>Twitter @user-123</option>
                <option>Facebook</option>
                <option>foursquare</option>
                <option>Yahoo! Messenger</option>
              </select>
              <br />
              <input type='submit' name='add' value='Add Notification'/>
            </fieldset>
          </form>
        </div>
      </div>
      <hr>

      <footer>
        <?php include(ABSPATH.'inc/defaultFooter.php'); ?>
      </footer>

    </div> <!-- /container -->
    <?php include(ABSPATH.'inc/footerScripts.php'); ?>

	</body>
</html>
