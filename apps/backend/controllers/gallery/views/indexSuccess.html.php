<!-- Content -->
<div id="internal-page">
	<?php $this->insertBlock("home", "breadCrumb", array("CONTROLLER" => $this, "VARS" => $this->breadCrumb)); ?>
	
	<h1 class="icnPage newPage"><a href="<?php echo($this->Editorial->getURL()); ?>gallery/new.php">{Add Gallery}</a></h1>
	
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
		<h3>{Gallery}</h3>
		<div>
			<?php if(empty($this->itens[0])): ?>
				<p>Nenhum item encontrado</p>
			<?php else: ?>
			<form>
				<fieldset>
					<table class="listTable hasQuickForm">
						<thead>
							<tr>
								<th>ID</th>
								<th class="leftTxt">Data</th>
								<th class="leftTxt">{Title}</th>
								<th>Status</th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($this->itens as $item): ?>
							<!-- Linha Tabela -->
							<tr class="odd">
								<td>
									<?php echo($item->getCNTID()); ?>
								</td>
								<td class="leftTxt">
									<a href="<?php echo($this->Editorial->getURL()); ?>gallery/edit.php?ID=<?php echo($item->getCNTID()); ?>"><?php echo(date("d/m/Y H:i", strtotime($item->getCNTDTA()))); ?></a>
								</td>
								<td class="leftTxt">
									<a href="<?php echo($this->Editorial->getURL()); ?>gallery/edit.php?ID=<?php echo($item->getCNTID()); ?>"><?php echo($item->getCNTTIT()); ?></a>
								</td>
								<?php
								switch($item->getCNTSTS())
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
									default:
										$class = "excluded-color";
										$status = "Deletada";
									break;
								}
								?>
								<td class="<?php echo($class); ?>">
									<?php echo($status); ?>
								</td>
								<td>
									<a href="<?php echo($this->Editorial->getURL()); ?>gallery/edit.php?ID=<?php echo($item->getCNTID()); ?>" rel="Editar" title="Editar" class="btnsAdmin">Editar</a>
									<a href="<?php echo($this->Editorial->getURL()); ?>comments/index.php?ID=<?php echo($item->getCNTID()); ?>" rel="Comentarios" title="Comentários" class="btnsAdmin">Comentários</a>
									<a href="<?php echo($this->Editorial->getURL()); ?>gallery/delete.php?ID=<?php echo($item->getCNTID()); ?>" rel="Remover" title="Deletar" class="btnsAdmin">Deletar</a>
									<a href="<?php echo($this->Editorial->getURL()); ?>gallery/edit.php?ID=<?php echo($item->getCNTID()); ?>" rel="Edicao Rapida" title="Edição Rápida" class="btnsAdmin quickEditBtn">Editar</a>
								</td>
							</tr>
							<tr class="odd quickEditForm">
								<td>
									<input type="hidden" name="quick[CNT_ID]" value="<?php echo($item->getCNTID()); ?>" />
									<?php echo($item->getCNTID()); ?>
								</td>
								<td class="leftTxt">
									<input type="text" name="quick[CNT_DTA]" value="<?php echo(date("d/m/Y H:i", strtotime($item->getCNTDTA()))); ?>" />
								</td>
								<td class="leftTxt">
									<input type="text" name="quick[CNT_TIT]" value="<?php echo($item->getCNTTIT()); ?>" />
								</td>
								<td class="<?php echo($class); ?>">
									<input type="checkbox" id="statusLivro" name="quick[CNT_STS]" class="changeStatus" <?php if($item->getCNTSTS() == "1"){?> checked="checked"<?php } ?> /><span><?php echo($status); ?></span>
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
			<?php endif; ?>
		</div>
		<!-- /div -->
	</div>
	<!-- /Box -->
	<?php $this->includePartial("default", "pagination"); ?>
	
</div>
<!-- /Content -->