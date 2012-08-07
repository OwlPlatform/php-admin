<?php
// Get the current file name
$currentFile = $_SERVER["PHP_SELF"];
$parts = Explode('/', $currentFile);
$currentPage = $parts[count($parts) - 1];
?>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="<?php echo URLADDR; ?>"><?php echo $siteName; ?></a>
          <div class="nav-collapse">
            <ul class="nav">
              <li <?php if($currentPage === "index.php"){echo "class=\"active\" ";}?>><a href="<?php echo URLADDR;?>index.php">Home</a></li>
              <li <?php if($currentPage === "browse.php"){echo "class=\"active\" ";}?>><a href="<?php echo URLADDR;?>browse.php">Browse</a></li>
              <li <?php if($currentPage === "account.php"){echo "class=\"active\" ";}?>><a href="<?php echo URLADDR;?>account.php">Account</a></li>
              <li <?php if($currentPage === "admin.php"){echo "class=\"active\" ";}?>><a href="<?php echo URLADDR;?>account.php">Admin</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

