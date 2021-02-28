<!-- Content -->
<div id="internal-page">
	<?php $this->insertBlock("home", "breadCrumb", array("CONTROLLER" => $this, "VARS" => $this->breadCrumb)); ?>
	
	<?php if((empty($this->limit) || (!empty($this->limit) && $this->totalItens < $this->limit))): ?>
		<h1 class="icnPage newPage"><a href="<?php echo($this->Editorial->getURL()); ?><?php echo($this->type);?>/new.php">{Add Featured}</a></h1>
	<?php endif; ?>
	<form action="<?php echo($_SERVER['REQUEST_URI']); ?>" method="get">
		<fieldset>
			<legend class="hidden">Busca</legend>
			<label for="q">Busca</label>
			<input type="text" id="q" name="q" <?php if(!empty($this->filters['q'])){ echo(" value=\"{$this->filters['q']}\"");}?> />
			<input type="checkbox" id="publishedSearch" name="publishedSearch" value="1" <?php if(!empty($this->filters['publishedSearch'])){ echo(" checked=\"checked\"");}?>/><label for="publishedSearch" class="no-points">Publicado</label>
			<input type="checkbox" id="notpublishedSearch" name="notpublishedSearch" value="0" <?php if(isset($this->filters['notpublishedSearch'])){ echo(" checked=\"checked\"");}?>/><label for="notpublishedSearch" class="no-points">Não Publicado</label>
			<!-- <input type="checkbox" id="pendantSearch" name="filters[pendantSearch]" /><label for="pendantSearch" class="no-points">Pendente</label>-->
			<input type="submit" value="Ok" />
		</fieldset>
	</form>
	
	<div class="box whiteBg clearR">
		<h3>{Featured}</h3>
		<div>
			<?php if(empty($this->itens[0])): ?>
				<p>{Nothing Found}</p>
			<?php else: ?>
			<form>
				<fieldset>
					<table class="listTable hasQuickForm">
						<thead>
							<tr>
								<th>{ID}</th>
								<th>{Order}</th>
								<th class="leftTxt">{Date}</th>
								<th class="leftTxt">{Featured}</th>
								<th class="leftTxt" style="width: 400px">Image</th>
								<th>{Status}</th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($this->itens as $item): ?>
								<!-- Linha Tabela -->
								<tr class="odd">
									<td>
										<?php echo($item->getDTQID()); ?>
									</td>
									<td >
										<a href="<?php echo($this->Editorial->getURL()); ?><?php echo($this->type);?>/edit.php?ID=<?php echo($item->getDTQID()); ?>"><?php echo($item->getDTQCID()); ?></a>
									</td>
									<td class="leftTxt">
										<a href="<?php echo($this->Editorial->getURL()); ?><?php echo($this->type);?>/edit.php?ID=<?php echo($item->getDTQID()); ?>"><?php echo(date("d/m/Y H:i", strtotime($item->getDTQINI()))); ?></a>
									</td>
									
									<td class="leftTxt">
										<a href="<?php echo($this->Editorial->getURL()); ?><?php echo($this->type);?>/edit.php?ID=<?php echo($item->getDTQID()); ?>"><?php echo($item->getDTQTIT()); ?></a>
									</td>
									<td class="leftTxt">
										<?php 
										$fto = $item->getDTQFTO();
										if(!empty($fto)){
											$file = $fto->getFile();
											?>
											<img src="<?php echo($file->getFormat('100x100')); ?>" />
											<?php 
										}
										?>
									</td> 
									<?php
									switch($item->getDTQSTS())
									{
										case "0":
											$class = "pendant-color";
											$status = "Não publicada";
										break;
										case "1":
											$class = "approved-color";
											$status = "Publicada";
										break;
										case "9";
											$class = "excluded-color";
											$status = "Deletada";
										break;
									}
									?>
									<td class="<?php echo($class); ?>">
										<?php echo($status); ?>
									</td>
									<td>
										<a href="<?php echo($this->Editorial->getURL()); ?><?php echo($this->type);?>/edit.php?ID=<?php echo($item->getDTQID()); ?>" rel="Editar" title="Editar" class="btnsAdmin">Editar</a>
										<!--<a href="<?php echo($this->Editorial->getURL()); ?>comments/index.php?ID=<?php echo($item->getDTQID()); ?>" rel="Comentarios" title="Comentários" class="btnsAdmin">Comentários</a>-->
										<a href="<?php echo($this->Editorial->getURL()); ?><?php echo($this->type);?>/delete.php?ID=<?php echo($item->getDTQID()); ?>" rel="Remover" title="Deletar" class="btnsAdmin">Deletar</a>
										<a href="<?php echo($this->Editorial->getURL()); ?><?php echo($this->type);?>/edit.php?ID=<?php echo($item->getDTQID()); ?>" rel="Edicao Rapida" title="Edição Rápida" class="btnsAdmin quickEditBtn">Editar</a>
									</td>
								</tr>
								<tr class="odd quickEditForm">
									<td>
										<input type="hidden" name="quick[DTQ_ID]" value="<?php echo($item->getDTQID()); ?>" />
										<?php echo($item->getDTQID()); ?>
									</td>
									<td class="leftTxt">
										<input type="text" name="quick[DTQ_INI]" value="<?php echo(date("d/m/Y H:i", strtotime($item->getDTQINI()))); ?>" />
									</td>
									<td class="leftTxt">
										<input type="text" name="quick[DTQ_TIT]" value="<?php echo($item->getDTQTIT()); ?>" />
									</td>
									<td class="<?php echo($class); ?>">
										<input type="checkbox" id="statusLivro" name="quick[DTQ_STS]" value="1" class="changeStatus" <?php if($item->getDTQSTS() == "1"){?> checked="checked"<?php } ?> /><span><?php echo($status); ?></span>
									</td>
									<td>
										<a href="#" class="bot saveQuickEdit">Salvar</a>
									</td>
								</tr>
								<!-- /Linha Tabela -->
								<?php endforeach; ?>
						</tbody>
					</table>
				</fieldset>
			</form>
		</div>
	</div>
	<?php endif; ?>
	<!-- /Box -->
	<?php $this->includePartial("default", "pagination"); ?>
</div>
<!-- /Content -->