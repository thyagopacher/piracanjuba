<!-- Content -->
<div id="internal-page">
	<?php $this->insertBlock("home", "breadCrumb", array("CONTROLLER" => $this, "VARS" => $this->breadCrumb)); ?>
	
	<h1><?php if(!empty($this->news)){ ?>{Comments for}:<?php echo($this->news->getCNTTIT()); ?><?php } else { ?>{List Comments}<?php } ?> </h1>
	
	<form class="alignRight" id="search_right" action="<?php echo($_SERVER['REQUEST_URI']); ?>" method="get">
		<fieldset>
			<legend class="hidden">{Search}</legend>
			<label for="q" class="hidden">{Search}</label>
			<input type="text" id="q" name="q" <?php if(!empty($this->filters['q'])){ echo(" value=\"{$this->filters['q']}\"");}?> placeholder="Buscar" />
			<input type="submit" value="{Ok}" />
		</fieldset>
	</form>
		
		
		
	<?php $this->includePartial("default", "pagination"); ?>
	<ul class="filterMenu">
		<li><a href="<?php echo($_SERVER['REDIRECT_URL']); ?>">Todos</a></li>		
		<?php if(!empty($this->approvedTotal)){ ?><li <?php if(!empty($this->filters['publishedSearch'])){ echo(" class=\"selected\"");}?>><a href="<?php echo($_SERVER['REDIRECT_URL']); ?>?publishedSearch=1">Aprovados (<?php echo($this->approvedTotal);?>)</a></li><?php } ?>
		<?php if(!empty($this->pendantTotal)){ ?><li <?php if(!empty($this->filters['notpublishedSearch'])){ echo(" class=\"selected\"");}?>><a href="<?php echo($_SERVER['REDIRECT_URL']); ?>?notpublishedSearch=0">Pendentes (<?php echo($this->pendantTotal);?>)</a></li><?php } ?>
		<?php if(!empty($this->excludedTotal)){ ?><li><a href="<?php echo($_SERVER['REDIRECT_URL']); ?>?excluded=1">Excluidos (<?php echo($this->excludedTotal);?>)</a></li><?php } ?>
		<?php if(!empty($this->spamTotal)){ ?><li><a href="<?php echo($_SERVER['REDIRECT_URL']); ?>?spam=1">Spam (<?php echo($this->spamTotal);?>)</a></li><?php } ?>
	</ul>
	<?php //$this->includePartial("default", "indexFilters"); ?>
	
	
	<form method="post">
		<fieldset>
			<legend class="hidden">Ações em Massa</legend>
			<label for="actions" class="hidden">Ações em Massa</label>
			<select name="actions" id="actions">
				<option value="">Ações em massa</option>
				<option value="delete">Deletar todos</option>
			</select>
			<input type="submit" value="Aplicar">
		</fieldset>	
	
	
	
	<?php if(!empty($this->msg)): ?>
		<div class="message">
			<?php echo($this->msg); ?>
		</div>
	<?php endif; ?>
	<?php if(!empty($this->Errors)): ?>
		<div class="error">
			<?php echo($this->Errors); ?>
		</div>
	<?php endif; ?>
	
	
	<div class="box whiteBg clearR">
		<h3>{Comments}</h3>
		<div>
			<?php if(empty($this->itens[0])): ?>
				<p>Nenhum item encontrado</p>
			<?php else: ?>
				<fieldset>
					<table class="listTable">
						<thead>
							<tr>
								<th><input type="checkbox" class="checkAll" /></th>
								<th class="leftTxt">{Author}</th>
								<th class="leftTxt">{Comment}</th>
								<th>{In Repply to}</th>
								<!-- <th>&nbsp;</th> -->
							</tr>
						</thead>
						<tbody>
							<?php foreach($this->itens as $item): ?>
							<!-- Linha Tabela -->
							<tr>
								<td>
									<input type="checkbox" name="index[<?php echo($item->getMSGID()); ?>][ID]" class="selComment" value="<?php echo($item->getMSGID()); ?>" />
								</td>
								<td class="leftTxt comment-author">
									<?php echo(($item->getMSGNOM())); ?>
								</td>
								<td class="leftTxt">
									<p class="comment-date">{Sent on} <?php echo(date("d-m-Y \{\a\\t\} H:i", strtotime($item->getMSGDTA()))); ?></p>
									<div class="comment-txt">
										<p><?php echo(($item->getMSGTXT()))?></p>
									</div>
									<ul class="actsComment">
										<?php $status = $item->getMSGSTS(); if($status == 0): ?>
										<li><a href="<?php echo($this->Editorial->getURL()); ?>comments/approve.php?ID=<?php echo($item->getMSGID()); ?>" class="aproveBtn" rel="Aprovar" title="Aprovar">{Approve}</a></li>
										<?php endif; ?>
										<?php $status = $item->getMSGSTS(); if($status == 8): ?>
										<li><a href="<?php echo($this->Editorial->getURL()); ?>comments/not_spam.php?ID=<?php echo($item->getMSGID()); ?>" class="spamBtn" rel="SPAM" title="SPAM">{Not SPAM}</a></li>
										<?php endif; ?>
										<li><a href="<?php echo($this->Editorial->getURL()); ?>comments/reply.php?ID=<?php echo($item->getMSGID()); ?>" class="ReplyComment" rel="Responder" title="Responder">{Reply}</a></li>
										<li><a href="<?php echo($this->Editorial->getURL()); ?>comments/edit.php?ID=<?php echo($item->getMSGID()); ?>" class="EditComment" rel="Editar" title="Editar">{Edit}</a></li>
										<?php if($item->getMSGSTS() != 9){ ?>
										<li><a href="<?php echo($this->Editorial->getURL()); ?>comments/delete.php?ID=<?php echo($item->getMSGID()); ?>" rel="Lixeira" title="Lixeira" >{Trash}</a></li>
										<?php } ?>
										
									</ul>
								</td>
								
								<td>
									<?php 
										$content = $item->getContent(); 
										if(!empty($content))
										{
											printf("<p><a href=\"%s\">%s</a></p>", $content->getURLADM(),$content->getCNTTIT());
										
									?>
									<?php
										switch($item->getMSGSTS())
										{
											case "0":
												//$class = "pendant-color";
												printf("<span rel=\"%s\" class=\"ballon pendant-color\">Pendentes (%s)</span>", $content->getApprovedComments(), $content->getApprovedComments());
											break;
											case "1":
												//$class = "approved-color";
												printf("<span rel=\"%s\" class=\"ballon approved-color\">Aprovados</span>", $content->getApprovedComments());
											break;
											case "9";
												//$class = "excluded-color";
												printf("<span rel=\"%s\" class=\"ballon excluded-color\">Lixeira (%s)</span>", $content->getApprovedComments(), $content->getApprovedComments());
											break;
											case "8";
												//$class = "excluded-color";
												printf("<span rel=\"%s\" class=\"ballon pendant-color\">Spam (%s)</span>", $content->getSpamComments(), $content->getSpamComments());
											break;
											default;
												printf("<span rel=\"%s\" class=\"ballon pendant-color\">Pendentes (%s)</span>", $content->getApprovedComments(), $content->getApprovedComments());
											break;
										}
									}
									?>
									<?php //echo($status); ?>
								</td>
								
							</tr>
							
							<!-- /Linha Tabela -->
							<?php endforeach; ?>
						</tbody>
					</table>
				</fieldset>
				<?php endif; ?>
			</div>
			<!-- /div -->
		</div>
		<!-- /Box -->
	</form>
	<?php $this->includePartial("default", "pagination"); ?>
	
</div>
<!-- /Content -->
