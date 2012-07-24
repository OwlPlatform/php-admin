<?php 
	$siteName = "localhost";
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Owl Platform Online</title>
		<link rel='stylesheet' id='grail-css'  href='grail.css' type='text/css' media='all' />
		<link rel='stylesheet' id='login-css'  href='login.css' type='text/css' media='all' />
	</head>
	
	<body>
		<div id="site-title"><h1 id="site-title-header">Owl Platform @ <?php print $siteName ?></h1></div>	
	
		<?php include("login.php"); ?>	
	
	</body>
</html>