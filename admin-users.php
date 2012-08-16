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
          <h2>Users</h2>
          <table class="table table-striped">
            <thead>
              <th>Username</th>
              <th>Real Name</th>
              <th>Roles</th>
            </thead>
            <tbody>
              <tr>
                <td>jsmith81</td>
                <td>Jane Smith</td>
                <td>
                  <ul>
                    <li>Administrator</li>
                    <li>All Notifications</li>
                  </ul>
                </td>
              </tr>
              <tr>
                <td>bigsmithers</td>
                <td>John Smith</td>
                <td>
                  <ul>
                    <li>User</li>
                    <li>All Notifications</li>
                  </ul>
                </td>
              </tr>
              <tr>
                <td>jilliebean92</td>
                <td>Jill Smith</td>
                <td>
                  <ul>
                    <li>User</li>
                  </ul>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div> <!-- Row -->
      <div class="row">
        <div class="span6 offset3">
          <h2>Roles</h2>
          <table class="table table-striped">
            <thead>
              <th>Role Name</th>
              <th>Actions</th>
              <th>Identifier</th>
              <th>Attribute</th>
            </thead>
            <tbody>
              <tr>
                <td>Administrator</td>
                <td>
                  <ul>
                    <li>Read</li>
                    <li>Create</li>
                    <li>Update</li>
                    <li>Expire</li>
                    <li>Delete</li>
                  </ul>
                </td>
                <td>
                  <ul>
                    <li>[ALL]</li>
                  </ul>
                </td>
                <td>
                  <ul>
                    <li>[ALL]</li>
                  </ul>
                </td>
              </tr>
              <tr>
                <td>All Notifications</td>
                <td>
                  <ul>
                    <li>Read</li>
                  </ul>
                </td>
                <td>
                  <ul>
                    <li>[ALL]</li>
                  </ul>
                </td>
                <td>
                  <ul>
                    <li>[ALL]</li>
                  </ul>
                </td>
              </tr>
              <tr>
                <td>User</td>
                <td>
                  <ul>
                    <li>Read</li>
                  </ul>
                </td>
                <td>
                  <ul>
                    <li>$username.*</li>
                  </ul>
                </td>
                <td>
                  <ul>
                    <li>[ALL]</li>
                  </ul>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div> <!-- Row -->
            <div class="row">
        <div class="span6 offset3">
          <h2>Permissions</h2>
          <table class="table table-striped">
            <thead>
              <th>Permission Name</th>
              <th>Actions</th>
              <th>Identifier</th>
              <th>Attribute</th>
            </thead>
            <tbody>
              <tr>
                <td>Configure System</td>
                <td>
                  <ul>
                    <li>Read</li>
                    <li>Create</li>
                    <li>Update</li>
                    <li>Expire</li>
                    <li>Delete</li>
                  </ul>
                </td>
                <td>system.*</td>
                <td>[ALL]</td>
              </tr>
              <tr>
                <td>Update System</td>
                <td>
                  <ul>
                    <li>Read</li>
                    <li>Update</li>
                    <li>Expire</li>
                  </ul>
                </td>
                <td>system.*</td>
                <td>[ALL]</td>
              </tr>
              <tr>
                <td>Configure User</td>
                <td>
                  <ul>
                    <li>Read</li>
                    <li>Create</li>
                    <li>Update</li>
                    <li>Expire</li>
                  </ul>
                </td>
                <td>$username.*</td>
                <td>[ALL]</td>
              </tr>
              <tr>
                <td>Monitor (Public)</td>
                <td>
                  <ul>
                    <li>Read</li>
                  </ul>
                </td>
                <td>[ALL]</td>
                <td>[ALL]</td>
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
