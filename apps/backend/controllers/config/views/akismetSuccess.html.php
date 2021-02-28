<h1>{Akismet}</h1>
<p>{Configure here your akismet key}</p>
<?php if(!empty($this->msg)): ?>
	<div class="message">
		<?php echo($this->msg); ?>
	</div>
<?php endif; ?>
<?php if(!empty($this->error)): ?>
	<ul class="error">
		<li><?php echo($this->error); ?></li>
	</ul>
<?php endif; ?>
<form method="post">
	<div class="box">
		<h3 class="titleBlock">{Akismet}</h3>
		<div>
				<label for="akismet_key">{Akismet key}</label><input type="text" name="akismet_key" id="akismet_key" value="<?php if(!empty($this->config)):?><?php echo(htmlentities($this->config->getValue())); ?><?php endif; ?>" placeholder="{Akismet key}"/>
				<input type="submit" value="{Submit}" />
		</div>
	</div>
</form>