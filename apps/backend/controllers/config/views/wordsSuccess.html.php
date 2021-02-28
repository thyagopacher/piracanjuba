<h1>{Blocked Words List}</h1>
<p>{One item per line}</p>
<?php if(!empty($this->msg)): ?>
	<div class="message">
		<?php echo($this->msg); ?>
	</div>
<?php endif; ?>
<?php if(!empty($this->error)): ?>
	<ul class="error">
		<li><?php echo($this->error); ?></li>
	</div>
<?php endif; ?>
<form method="post">
	<div class="box">
		<h3 class="titleBlock">{Blocked Words}</h3>
		<div>
				<textarea name="words" id="wordsarea"><?php if(!empty($this->config)):?><?php echo($this->config->getValue()); ?><?php endif; ?></textarea>
				<input type="submit" value="{Submit}" />
		</div>
	</div>
</form>