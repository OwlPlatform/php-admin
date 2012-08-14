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
          <table class="table table-striped"id="account-settings">
            <thead>
             <th><?php echo $siteName; ?></th>
            </thead>
            <tbody>
              <tr>
                <td class="active"><a href="#">Global Settings</a></td>
              </tr>
              <tr>
                <td><a href="#">Users and Permissions</a></td>
              </tr>
              <tr>
                <td><a href="#">Data Sharing</a></td>
              </tr>
              <tr>
                <td><a href="#">Device Management</a></td>
              </tr>
              <tr>
                <td><a href="#">Configure Modules</a></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="span4 offset1">
          <form id='update-settings-global' action='#' method='post' accept-charset='UTF-8'>
            <fieldset >
              <legend>Global Settings</legend>
              <input type='hidden' name='submitted' id='submitted' value='1'/>
              <label for='username' >Setting 1</label>
              <input type='text' name='setting1' id='setting1'  maxlength="50" value="Value" />
              <label for='real-name' >Setting 2</label>
              <input type='text' name='setting2' id='setting2' maxlength="128" value="Value"/>
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
