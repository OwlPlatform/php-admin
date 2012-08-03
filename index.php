<!DOCTYPE html>
<html>
  <head>
    <title>Owl Platform Online</title>
    <?php
      require_once('constants.php');
      require_once(ABSPATH . 'inc/defaultHeader.php');
    ?>
  </head>	
  <body>
    <?php include(ABSPATH.'inc/navbar.php'); ?>
    <?php include(ABSPATH.'login.php'); ?>
  <div class="container">
      <div class="page-header">
        <h1>Coding Examples</h1>
        <p>All of the example code here is available in one of our Git repositories.  Specific links are provided below,
        but you may also wish to check out our <a href="http://www.github.com/OwlPlatform">GitHub organization page</a>, which contains links to all of our open source code
        repositories.</p>
        <h3>Java Examples Git</h3>
        <pre>git clone git://github.com/OwlPlatform/java-examples.git</pre>
        <h3>C++ Examples Git</h3>
        <p>Coming soon!</p>
        <h3>Ruby Examples Git</h3>
        <p>Coming soon!</p>
      </div>
      <div class="row">
        <div class="span4">
          <h2>Sensor Examples</h2>
          <p>Writing a new type of sensor?  Want to integrate an embedded device, smartphone, laptop, or something else?  Learn
          how to interact with the aggregator so that solvers can stream your data by digging through the examples below.</p>
          
        </div>
        <div class="span4">
          <h2>Solver Examples</h2>
          <p>Solvers are the "intelligence" of the
          system, the driving force behind the platform's versatility.  So exercise your brain and expand the Owl's
          consciousness. Check out these examples to see how to use the Owl libraries to write a new solver.  </p>
          
        </div>
        <div class="span4">
          <h2>Application Examples</h2>
          <p>Visualizations, notifications, Apps, and integration.  Applications are how we experience the platform, and a good
          application makes all the difference.  Follow along with these examples to jump-start your application development.  
          Whether you're writing a standalone tool or integrating Owl Platform data into an existing program, this 
          is the place to start.</p>
        </div>
      </div>
      <hr>

      <footer>
        <?php include($pathPrefix."/inc/defaultFooter.php"); ?>
      </footer>

    </div> <!-- /container -->
    <?php include($pathPrefix."/inc/footerScripts.php"); ?>
  </body>
	</body>
</html>
