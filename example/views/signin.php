<?php include "/../includes/validations.php";?>
<form id="signin" action="<?php echo $actionUrl;?>" method="post">
	<dl class="field">
		<dt><label for="signin_username">Username</label></dt>
		<dd><input id="signin_username" name="username" type="text" value="<?php echo htmlspecialchars($username);?>"/></dd>
	</dl>
	<dl class="field">
		<dt><label for="signin_password">Password</label></dt>
		<dd><input id="signin_password" name="password" type="password"/></dd>
	</dl>
	<button type="submit">Sign in</button>
</form>