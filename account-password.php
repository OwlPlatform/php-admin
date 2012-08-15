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
        <div class="span4 offset1">
          <form id='password-change' action='#' method='post' accept-charset='UTF-8'>
            <fieldset >
              <legend>Change Password</legend>
              <input type='hidden' name='submitted' id='submitted' value='1'/>
              <label for='current-password' >Current Password:</label>
              <input type='password' name='current-password' id='current-password'  maxlength="128"/>
              <label for='new-password1' >New Password:</label>
              <input type='password' name='new-password1' id='new-password1' maxlength="128" />
              <label for='new-password2' >Confirm Password:</label>
              <input type='password' name='new-password2' id='new-password2' maxlength="128" />
              <br />
              <input type='submit' name='Submit' value='Save'/>
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
