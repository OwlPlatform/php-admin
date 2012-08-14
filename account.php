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
          <table class="table table-striped"id="account-settings">
            <thead>
             <th><?php echo $currentUser->getLogin(); ?></th>
            </thead>
            <tbody>
              <tr>
                <td class="active">Profile</td>
              </tr>
              <tr>
                <td><a href="#">Password</a></td>
              </tr>
              <tr>
                <td><a href="#">Notifications</a></td>
              </tr>
              <tr>
                <td><a href="#">Devices</a></td>
              </tr>
              <tr>
                <td><a href="#">Subscriptions</a></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="span4 offset1">
          <form id='profile-update' action='#' method='post' accept-charset='UTF-8'>
            <fieldset >
              <legend>Account Profile</legend>
              <input type='hidden' name='submitted' id='submitted' value='1'/>
              <label for='username' >UserName:</label>
              <input type='text' name='username' id='username'  maxlength="50" value="<?php echo $currentUser->getLogin(); ?>" disabled="disabled"/>
              <label for='real-name' >Real Name:</label>
              <input type='text' name='real-name' id='real-name' maxlength="128" value="<?php echo $currentUser->getName(); ?>"/>
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
    <script type="text/javascript">
     $(document).ready(function(){
       $('input[type="submit"]').attr('disabled','disabled');
       $('input[type="text"]').keyup(function(){
          if($(this).val() != ''){
             $('input[type="submit"]').removeAttr('disabled');
          }
       });
     });
    </script>

	</body>
</html>
