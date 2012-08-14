<?php 
  session_start(); 
?>
<div class="login-form">
<?php
  if(isset($_SESSION['error'])){
    echo '<div class="error">'.$_SESSION['error']."</div>\n";
  }
?>
	<form id="login-form" action="verify-login.php" method="post" >
		<fieldset>
			<legend>Log in</legend>
			<div class="clearfix">
			<input type="text" id="login" name="login" placeholder="Username" />
			</div>
			<div class="clear"></div>
			
			<div class="clearfix">
			<input type="password" id="password" name="password" placeholder="Password" />
			</div>
			<div class="clear"></div>
			
			<label for="remember_me" style="padding: 0;">Remember me?</label>
			<input type="checkbox" id="remember_me" style="position: relative; top: 3px; margin: 0;" name="remember_me" />
			<div class="clear"></div>
			
			<br />
			<button class="btn primary" type="submit">Sign In</button>
			
		</fieldset>
	</form>
</div>
