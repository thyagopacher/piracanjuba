<?php if(!empty($this->comments)): ?>
<ul class="posts">
	<?php foreach($this->comments as $coment): ?>
	<li>
		<div class="tag-author">										
			<span><?php echo(date("d/m/y", strtotime($coment['MSG_DTA'])))?> <?php if(!empty($coment['user'])){?><a href="#"><?php echo(htmlentities($coment['user']['name'])); ?></a><?php } ?></span>																				
		</div>
		<div class="votos">
			<a href="/<?php echo(APP_LANGUAGE); ?>/comment/<?php echo($coment['MSG_ID']); ?>/like" class="voto-up" rel=".votos h2">Up</a>
			<br/>
			<h2><?php echo(htmlspecialchars(utf8_decode($coment['MSG_NOT']))); ?></h2>
			<br/>
			<a href="/<?php echo(APP_LANGUAGE); ?>/comment/<?php echo($coment['MSG_ID']); ?>/unlike" class="voto-down" rel=".votos h2">Down</a>
		</div>
		<div class="texto-perguntas">
			<?php echo(($coment['MSG_TXT'])); ?>
			
		</div>

	</li>
	<?php endforeach; ?>
</ul>
<?php endif; ?>