
  <!--DESTAQUE TOPO-->
  <div id="destaque-topo">
	<div class="logo-segmento-interno"><img src="<?php echo (APP_JS_PREFIX); ?>img/logos-categoria/<?php if(!empty($this->items["PDT_URL"])): echo ($this->logos("/".$this->items["PDT_URL"])); endif; ?>" width="300" height="210" /></div>
	<!---redes sociais--->
	<?php $this->insertBlock("home", "redesocial"); ?>
	
	
	<!--área de pesquisa-->
	<?php $this->includePartial("home", "busca"); ?>
	<!--banner principal-->
	<h1 class="cor-<?php if(!empty($this->items["PDT_URL"])): echo ($this->cores("/".$this->items["PDT_URL"])); endif; ?>"><?php echo ((!empty($this->items['PDT_NOM']))?$this->items['PDT_NOM']:"Cidade Alerta - Marcelo Rezende");?></h1>		
	
		<div class="forumm">
			<ul>
				
				<?php if(!empty($this->content)): ?><li><a href="#recents" class="hideShowDiv">Recentes</a></li><?php endif; ?>
				<?php if(!empty($this->contentHelped)): ?><li><a href="#popular" class="hideShowDiv">Populares</a></li><?php endif; ?>
					<?php if(!empty($this->contentWeek)): ?><li><a href="#semana" class="hideShowDiv">Semana</a></li><?php endif; ?>
				
			 	<li class="direito"><a href="<?php echo(APP_WEB_PREFIX); ?>forum/novo.html">+ Criar novo tópico</a></li>
			</ul>
		</div>

		<div class="abas">
			<?php if(!empty($this->content)): ?>
			<div id="recents" class="topicos-forum">      
				<h1>Recentes</h1>
				<ul>
					<?php foreach($this->content['news'] as $content): ?>
					<li>
						<div class="img-forum seta-esquerdo-cc" <?php if(!empty($content['user'])): ?>style="background-image: url(https://graph.facebook.com/<?php echo($content['user']['fb']) ?>/picture?type=large); background-size: 120px;"<?php endif; ?>>		
						</div>
						<div class="conteudo-forum">
							<h2><a href="<?php echo($this->generateContentLink($content['CNT_TIP'], $content['CNT_DTA'], $content['CNT_TIT'], $content['CNT_ID'])); ?>"><?php echo(($content['CNT_TIT'])); ?></a></h2>
							<?php if(!empty($content['user'])): ?><div class="creditos-forum">Postado por <strong><?php echo(($content['user']['name'])); ?></strong> em <?php echo(date("d/m/Y", strtotime($content['CNT_DTA']))); ?> </div><?php endif; ?>
						</div>
						<!--div class="posicao-forum">
							<div class="seta-forum"></div>
							<div class="desempenho-forum"><?php echo($content['CNT_ENQ']); ?></div>
						</div-->
						<div class="pontos-forum">
							RESPOSTAS
							<h3><a href="<?php echo($this->generateContentLink($content['CNT_TIP'], $content['CNT_DTA'], $content['CNT_TIT'], $content['CNT_ID'])); ?>"><?php echo($content['totComments']); ?></a></h3>
						</div>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php endif; ?>
			<?php if(!empty($this->contentHelped)): ?>
			<div id="popular" class="topicos-forum">      
				<h1>Populares</h1>
				<ul>
					<?php foreach($this->contentHelped['news'] as $content): ?>
						<li>
							<div class="img-forum seta-esquerdo-cc" <?php if(!empty($content['user'])): ?>style="background-image: url(https://graph.facebook.com/<?php echo($content['user']['fb']) ?>/picture?type=large); background-size: 120px;"<?php endif; ?>>		
							</div>
							<div class="conteudo-forum">
								<h2><a href="<?php echo($this->generateContentLink($content['CNT_TIP'], $content['CNT_DTA'], $content['CNT_TIT'], $content['CNT_ID'])); ?>"><?php echo(($content['CNT_TIT'])); ?></a></h2>
								<?php if(!empty($content['user'])): ?><div class="creditos-forum">Postado por <strong><?php echo(($content['user']['name'])); ?></strong> em <?php echo(date("d/m/Y", strtotime($content['CNT_DTA']))); ?> </div><?php endif; ?>
							</div>
							<!--div class="posicao-forum">
								<a class="seta-forum"></a>
								<div class="desempenho-forum"><?php echo($content['CNT_ENQ']); ?></div>
							</div-->
							<div class="pontos-forum">
								RESPOSTAS
								<h3><a href="<?php echo($this->generateContentLink($content['CNT_TIP'], $content['CNT_DTA'], $content['CNT_TIT'], $content['CNT_ID'])); ?>"><?php echo($content['totComments']); ?></a></h3>
							</div>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php endif; ?>
			<?php if(!empty($this->contentWeek)): ?>
			<div id="semana" class="topicos-forum">      
				<h1>+ Semana</h1>
				<ul>
					<?php foreach($this->contentWeek['news'] as $content): ?>
						<li>
							<div class="img-forum seta-esquerdo-cc" <?php if(!empty($content['user'])): ?>style="background-image: url(https://graph.facebook.com/<?php echo($content['user']['fb']) ?>/picture?type=large); background-size: 120px;"<?php endif; ?>>		
							</div>
							<div class="conteudo-forum">
								<h2><a href="<?php echo($this->generateContentLink($content['CNT_TIP'], $content['CNT_DTA'], $content['CNT_TIT'], $content['CNT_ID'])); ?>"><?php echo(($content['CNT_TIT'])); ?></a></h2>
								<?php if(!empty($content['user'])): ?><div class="creditos-forum">Postado por <strong><?php echo(($content['user']['name'])); ?></strong> em <?php echo(date("d/m/Y", strtotime($content['CNT_DTA']))); ?> </div><?php endif; ?>
							</div>
							<!--div class="posicao-forum">
								<div class="seta-forum"></div>
								<div class="desempenho-forum"><?php echo($content['CNT_ENQ']); ?></div>
							</div-->
							<div class="pontos-forum">
								RESPOSTAS
								<h3><a href="<?php echo($this->generateContentLink($content['CNT_TIP'], $content['CNT_DTA'], $content['CNT_TIT'], $content['CNT_ID'])); ?>"><?php echo($content['totComments']); ?></a></h3>
							</div>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php endif; ?>
		</div>
		<style>
		.pontos-forum h3 a { color: #FFF; text-decoration: none; }
		</style>
	<script>
	$("a.hideShowDiv").click(function(e){
		if(e.preventDefault){e.preventDefault();}
		var $target = $($(this).attr("href"));
		if($target[0])
		{
			$target.parent().children("div").addClass("hidden");
			$target.removeClass("hidden");
			
		}
		return false;
	})
	</script>
	
	
	
	
<br style=" clear:both">
</div>
<!--FINAL DO TOPO DO SITE-->