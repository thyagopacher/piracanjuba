<div class="align <?php if(empty($this->user)){echo("noBar");}?>">
	<div class="div-laranja">
		<div class="align-laranja">
			<?php $this->insertBlock("login", "userBar"); ?>
		</div>
	</div>
	<!-- /User Bar -->
	<!-- Content -->
	<div class="div-cinza">
		<div class="align-cinza">
		
			<span class="titulo forum">{Forum}</span>
			<br />
			<br />
		
			<div class="barra-busca">
				<form action="/<?php echo(APP_LANGUAGE); ?>/forum/busca.html" name="form-busca" method="GET">
					<input type="text" name="q" /> 
					<input type="submit" value="{Search}" class="btn-buscar" />
				</form>
			</div>
		
			<div class="div-perguntas">
				<h3>{Search}: <?php echo($this->term); ?></h3>
			</div>
		
		
			<?php if(!empty($this->rows)): ?>
			<ul class="lista-perguntas">
				<?php 
				foreach($this->rows as $row): 
					$url = "/".APP_LANGUAGE."/forum/".($row->getCNTID())."-".(Slugfy($row->getCNTTIT()));
				?>
				<li>
					<ul class="votos-perguntas">
						<li><?php echo($row->getCNTENQ()); ?> <br />
							<span>{votes}</span>
						</li>
						<li><?php echo($row->getApprovedComments()); ?> <br />
						<span class="respostas">{repply}</span>
						</li>
					</ul>
				
					<div class="post-perguntas">
							<h2><a href="<?php echo($url); ?>"><?php echo(($row->getCNTTIT())); ?></a></h2>
							<?php 
								$user = $row->getUser();
							?>
							<div class="tag-author">
								<span><?php echo(date("d/m/y", strtotime($row->getCNTDTA()))); ?> <?php if(!empty($user)){?><a href="<?php echo($url); ?>"><?php echo($user->getUSUNOM()); ?></a><?php } ?></span>
								<?php 
								$tags = $row->getTags();
								if(!empty($tags[0])): ?>
								<div class="segura-tags">
									<?php foreach($tags as $tag): ?>
									<a href="/<?php echo(APP_LANGUAGE); ?>/forum/tags/<?php echo(($tag->getTAGID())."-".(Slugfy(($tag->getTAGNOM())))); ?>" class="btP"><?php echo(utf8_decode($tag->getTAGNOM()))?></a>
									<?php endforeach; ?>
								</div>
								<?php endif; ?>
							</div>
							
					</div>
				</li>
				<?php endforeach; ?>
		
			</ul>
			<?php endif; ?>
			<?php $this->includePartial("default", "pagination"); ?>
		
		</div>
	</div>
	<!-- /Content -->
</div>