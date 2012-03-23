<?php if($this -> failed()):?>
	<p class="error">We could not sign you in, please check your password</p>
<?php endif;?>

<?php if($this -> hasValidationErrors()):?>
	<ul class="validation_errors">
		<?php foreach($this -> getValidationErrors() as $error):?>
			<li class="validation_error"><?php echo $error;?>
		<?php endforeach;?>
	</ul>
<?php endif;?>

<form action="<?php echo $this -> getAction();?>" method="post">
	<dl>
		<dt>
			<label for="signin_password">Password</label>
		</dt>
		<dd>
			<input id="signin_password" name="password" type="password"/>
		</dd>
	</dl>
	<button type="submit">Sign in</button>
</form>
