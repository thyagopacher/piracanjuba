<!-- Content -->
<div id="internal-page">
	<?php $this->insertBlock("home", "breadCrumb", array("CONTROLLER" => $this, "VARS" => $this->breadCrumb)); ?>
	
	<h1 class="icnPage newPage"><a href="<?php echo($this->Editorial->getURL()); ?>representantes/new.php">Adicionar Representante</a></h1>

	<?php $this->includePartial("default", "indexFilters"); ?>
	
	<div class="box whiteBg clearR">
		<h3>{News}</h3>
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
								<th class="leftTxt">Empresa</th>
								<th class="leftTxt">Nome</th>
								<th class="leftTxt">Cidade</th>
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
									<a href="<?php echo($this->Editorial->getURL()); ?>representantes/edit.php?ID=<?php echo($item->getCNTID()); ?>"><?php echo(date("d/m/Y H:i", strtotime($item->getCNTDTA()))); ?></a>
								</td>
								<td class="leftTxt">
									<a href="<?php echo($this->Editorial->getURL()); ?>representantes/edit.php?ID=<?php echo($item->getCNTID()); ?>"><?php echo($item->getCNTTIT()); ?></a>
								</td>
								<td class="leftTxt">
									<a href="<?php echo($this->Editorial->getURL()); ?>representantes/edit.php?ID=<?php echo($item->getCNTID()); ?>"><?php echo($item->getCNTOLH()); ?></a>
								</td>
								<td class="leftTxt">
									<a href="<?php echo($this->Editorial->getURL()); ?>representantes/edit.php?ID=<?php echo($item->getCNTID()); ?>"><?php echo($item->getCNTRDT()); ?></a>
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
								}
								?>
								<td class="<?php echo($class); ?>">
									<?php echo($status); ?>
								</td>
								<td>
									<a href="<?php echo($this->Editorial->getURL()); ?>representantes/edit.php?ID=<?php echo($item->getCNTID()); ?>" rel="Editar" title="Editar" class="btnsAdmin">Editar</a>

									<a href="<?php echo($this->Editorial->getURL()); ?>representantes/delete.php?ID=<?php echo($item->getCNTID()); ?>" rel="Remover" title="Deletar" class="btnsAdmin">Deletar</a>

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