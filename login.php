<div id="login-modal">
	<form id="login-form" action="verify-login.php" method="post" >
		<fieldset>
			<legend>Log in</legend>
			
			<label for="login">Username</label>
			<input type="text" id="login" name="login" />
			<div class="clear"></div>
			
			<label for="password">Password</label>
			<input type="password" id="password" name="password" />
			<div class="clear"></div>
			
			<label for="remember_me" style="padding: 0;">Remember me?</label>
			<input type="checkbox" id="remember_me" style="position: relative; top: 3px; margin: 0;" name="remember_me" />
			<div class="clear"></div>
			
			<br />
			
			<input type="submit" style="margin: -20px 0 0 287px;" class="button" name="commit"value="Log in" />
		</fieldset>
	</form>
</div>