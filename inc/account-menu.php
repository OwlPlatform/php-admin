<?php
// Get the current file name
$currentFile = $_SERVER["PHP_SELF"];
$parts = Explode('/', $currentFile);
$currentPage = $parts[count($parts) - 1];
?>
        <table class="table table-striped"id="account-settings">
            <thead>
             <th><?php echo $currentUser->getLogin(); ?></th>
            </thead>
            <tbody>
              <tr>
                <td <?php if($currentPage==="account-profile.php"){echo 'class="active"';} ?>><a href="account-profile.php">Profile</a></td>
              </tr>
              <tr>
                <td <?php if($currentPage==="account-password.php"){echo 'class="active"';} ?>><a href="account-password.php">Password</a></td>
              </tr>
              <tr>
                <td <?php if($currentPage==="account-notifications.php"){echo 'class="active"';} ?>><a href="account-notifications.php">Notifications</a></td>
              </tr>
              <tr>
                <td <?php if($currentPage==="account-devices.php"){echo 'class="active"';} ?>><a href="account-devices.php">Devices</a></td>
              </tr>
              <tr>
                <td <?php if($currentPage==="account-subscriptions.php"){echo 'class="active"';} ?>><a href="account-subscriptions.php">Subscriptions</a></td>
              </tr>
            </tbody>
          </table>

