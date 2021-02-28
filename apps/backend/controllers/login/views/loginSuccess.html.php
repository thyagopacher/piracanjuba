<div id="loginForm">
	<h1 id="logoUniversal">Container Digital</h1>
	<form id="loginFormComponent" method="post" action="<?php echo(APP_WEB_PREFIX); ?>login/login.php">
		<fieldset>
			<legend class="hidden">Login</legend>
			<label for="username" class="no-points">Login</label><br />
			<input type="text" id="username" name="username" />
			<br />
			<label for="pass" class="no-points">Senha</label><br />
			<input type="password" id="pass" name="pass" />
			<br />
			<p class="rightTxt"><input type="submit" value="Login"></p>
		</fieldset>
	</form>
	<p class="rightTxt"><a href="/forget.php">Esqueceu a senha?</a></p>
</div>