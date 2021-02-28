<!-- Login Info -->
<ul class="loginTools">
	<li>
		<!-- User Logged Info -->
		<span class="userInfo">Usuário: <?php if(!empty($this->user)){ echo($this->user->getUSUNOM()); } ?></span><br />
		<span><?php echo(date("d/m/Y H:i")); ?></span>
		<!-- /User Logged Info -->
	</li>
	<li>
		<a href="/marcelo-rezende/adm/login/logout.php" class="logoutBtn">Sair</a>
	</li>
</ul>
<!-- /Login Info -->