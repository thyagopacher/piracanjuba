	
	<!--DESTAQUE TOPO-->
	<div id="destaque-topo">
		<div class="logo-segmento-interno"><?php $this->insertBlock("home", "logos", array("SCOPE" => $this)); ?></div>
		<!---redes sociais--->
		<?php $this->insertBlock("home", "redesocial"); ?>
		
		
		<!--área de pesquisa-->
		<?php $this->includePartial("home", "busca"); ?>

		<div class="titulo-pagina">
			<div class="box-titulo">
				<h1 class="cor-<?php if(!empty($this->items["PDT_URL"])): echo ($this->cores("/".$this->items["PDT_URL"])); endif; ?>"><?php echo ((!empty($this->items['PDT_NOM']))?$this->items['PDT_NOM']:"Cidade Alerta - Marcelo Rezende");?></h1>
			</div>		 
		</div>	
		
		<div class="geral">&nbsp;</div>
		<div class="geral">&nbsp;</div>
		
		<div class="forum-interno">
			
			<h2><?php echo($this->content['CNT_TIT']); ?></h2>
		</div>
		
		<div class="box-assunto-forum">
		  
			<div class="topo-box-forum">
				<div class="foto-box-forum seta-esquerdo-cc" <?php if(!empty($this->content['user'])): ?>style="background-image: url(https://graph.facebook.com/<?php echo($this->content['user']['fb']) ?>/picture?type=large); background-size: 70px;"<?php endif; ?>></div>
				<div class="creditos-box-forum"> Postado por: <?php echo($this->content['user']['name']); ?>. <br /> em <?php echo(date("d/m/Y", strtotime($this->content['CNT_DTA']))); ?>, possui 500 pontos.</div>
				<div class="reputacao-box-forum">
				REPUTAÇÃO<br/> <h3 class="topicNote"><?php echo($this->content['CNT_ENQ']); ?></h3>
				</div>
			</div>
		  
			<div class="conteudo-box-forum">
				<?php echo($this->content['CNT_TXT']); ?>
		  
			</div>
		  
			<div class="rodape-box-forum">
				<div class="avaliacao-box-forum">
					<div class="avaliacao-topico">
						<h4>AVALIAÇÃO DO TÓPICO</h4>
						<ul>
							<li class="sobe"><a data-target=".reputacao-box-forum h3.topicNote" href="<?php echo($this->generateUpDownLink($this->content['CNT_TIP'], $this->content['CNT_DTA'], $this->content['CNT_TIT'], $this->content['CNT_ID'], 'UP')); ?>"></a></li>
							<li class="desce"><a data-target=".reputacao-box-forum h3.topicNote" href="<?php echo($this->generateUpDownLink($this->content['CNT_TIP'], $this->content['CNT_DTA'], $this->content['CNT_TIT'], $this->content['CNT_ID'], 'DOWN')); ?>"></a></li>
						</ul>
					</div>
				</div>
				
				
				<div class="btn-responder-box-forum">
					<a href="#comentario-forum">Responder</a>
				</div>
			</div>
		</div>
		
		<div class="redes-box-forum">
			COMPARTILHAR
		</div>
		<div class="detalhe-bg-esquerdo"></div>
		
		
		
		<div class="geral">&nbsp;</div>
		<div class="geral">&nbsp;</div>
		
		
		<div id="comentario-forum">
		  
			<div id="lightbox-facebook">
				<div class="texto-do-loguin"><p>PARA RESPONDER, É PRECISO ESTA LOGADO. </p></div>
				<div class="btn-login-facebook"> <a href="#">
					<div class="logo-facebook"></div>
					<div class="texto-facebook">FAÇA SEU LOGIN PELO FACEBOOK</div></a>
				</div>
			</div>
			<div class="commentForm">
				<form method="post">
					<h2>Responder</h2>
					<textarea name="comment[text]" id="text" placeholder="Resposta"></textarea>
					<input type="hidden" name="comment[user][uid]" class="facebook-uid"/>
					<input type="hidden" name="comment[user][name]" class="facebook-name"/>
					<input type="hidden" name="comment[user][email]" class="facebook-email"/>
					<input type="submit" value="Enviar" />
				</form>
			</div>
		</div>

		
		<div class="geral">&nbsp;</div>
		
		<div class="comentarios-forum">
			<?php if(!empty($this->content['comments'])): ?>
			<ul>
				
				<?php 
					$i = 0; 
				foreach($this->content['comments'] as $coment): 
						if($i >= $this->startItem && $i < $this->endItem): 
					?>
				
				<li>
					<div class="foto-coment-forum seta-esquerdo-br" <?php if(!empty($coment['user'])): ?>style="background-image: url(https://graph.facebook.com/<?php echo($coment['user']['fb']) ?>/picture?type=large); background-size: 70px;"<?php endif; ?>></div>
					<div class="conteudo-coment-forum">
						<div class="titulo-coment-forum">Postado por: <?php echo($coment['user']['name']); ?><br /> 
						em <?php echo(date("d/m/Y", strtotime($coment['MSG_DTA']))); ?></div>
						<div class="descri-coment-forum">
							<?php echo(utf8_decode($coment['MSG_TXT'])); ?>
						</div>
					</div>
					
					<div class="posicao-coment-forum">
						<div id="nota-<?php echo($coment['MSG_ID']); ?>" class="pontos-coment-forum"><?php echo($coment['MSG_NOT']); ?></div>
						<div class="posicionamento-coment-forum">
								<div class="sobe"><a data-target="#nota-<?php echo($coment['MSG_ID']); ?>" href="<?php echo($this->generateUpDownLink('MG', $coment['MSG_DTA'], $this->content['CNT_TIT'], $coment['MSG_ID'], 'UP')); ?>"></a></div>
								<div class="desce"><a data-target="#nota-<?php echo($coment['MSG_ID']); ?>" href="<?php echo($this->generateUpDownLink('MG', $coment['MSG_DTA'], $this->content['CNT_TIT'], $coment['MSG_ID'], 'DOWN')); ?>"></a></div>
							
						</div>
						<div class="botao-citar"><a href="#">CITAR POST</a></div>
					</div>
				</li>
				<?php endif; $i++;  endforeach; ?>
			</ul>
			<?php $this->includePartial('default', 'pagination'); ?>
			<?php endif; ?>
		</div>
		<div class="geral">&nbsp;</div>
		
	</div>
	<!--FINAL DESTAQUE TOPO-->