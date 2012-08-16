<?php
// Get the current file name
$currentFile = $_SERVER["PHP_SELF"];
$parts = Explode('/', $currentFile);
$currentPage = $parts[count($parts) - 1];
?>
        <table class="table table-striped"id="admin-settings">
            <thead>
             <th><?php echo $currentUser->getLogin(); ?></th>
            </thead>
            <tbody>
              <tr>
                <td <?php if($currentPage==="admin-global.php"){echo 'class="active"';} ?>><a href="admin-global.php">Global Settings</a></td>
              </tr>
              <tr>
                <td <?php if($currentPage==="admin-users.php"){echo 'class="active"';} ?>><a href="admin-users.php">Users and Permission</a></td>
              </tr>
              <tr>
                <td <?php if($currentPage==="admin-sharing.php"){echo 'class="active"';} ?>><a href="admin-sharing.php">Data Sharing</a></td>
              </tr>
              <tr>
                <td <?php if($currentPage==="admin-devices.php"){echo 'class="active"';} ?>><a href="admin-devices.php">Device Management</a></td>
              </tr>
              <tr>
                <td <?php if($currentPage==="admin-modules.php"){echo 'class="active"';} ?>><a href="admin-modules.php">Configure Modules</a></td>
              </tr>
            </tbody>
          </table>

