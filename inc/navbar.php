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
          <a class="brand" href="http://www.owlplatform.com">Owl Platform</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li <?php if($currentPage === "index.php"){echo "class=\"active\" ";}?>><a href="/index.php">Home</a></li>
              <li <?php if($currentPage === "developers.php"){echo "class=\"active\" ";}?>><a href="/developers.php">Developers</a></li>
              <li><a href="blog/">Blog</a></li>
              <li <?php if($currentPage === "about.php"){echo "class=\"active\" ";}?>><a href="#about">About</a></li>
              <li <?php if($currentPage === "contact.php"){echo "class=\"active\" ";}?>><a href="#contact">Contact</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

