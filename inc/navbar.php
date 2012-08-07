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
              <li <?php if($currentPage === "index.php"){echo "class=\"active\" ";}?>><a href="<?php echo URLADDR;?>index.php"><i class="icon-home <?php if($currentPage === "index.php"){echo 'icon-white';}?>"></i> Home</a></li>
              <li <?php if($currentPage === "browse.php"){echo "class=\"active\" ";}?>><a href="<?php echo URLADDR;?>browse.php"><i class="icon-globe <?php if($currentPage === "browse.php"){echo 'icon-white';}?>"></i> Browse</a></li>
              <li <?php if($currentPage === "account.php"){echo "class=\"active\" ";}?>><a href="<?php echo URLADDR;?>account.php"><i class="icon-user <?php if($currentPage === "account.php"){echo 'icon-white';}?>"></i> Account</a></li>
              <li <?php if($currentPage === "admin.php"){echo "class=\"active\" ";}?>><a href="<?php echo URLADDR;?>admin.php"><i class="icon-wrench <?php if($currentPage === "admin.php"){echo 'icon-white';}?>"></i> Admin</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

