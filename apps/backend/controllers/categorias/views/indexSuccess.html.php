<!-- Content -->
<div id="internal-page">
	<?php $this->insertBlock("home", "breadCrumb", array("CONTROLLER" => $this, "VARS" => $this->breadCrumb)); ?>

	<h1 class="icnPage newPage"><a href="<?php echo($this->Editorial->getURL()); ?>categorias/<?=$this->type?>/new.php">Adicionar categoria</a></h1>

	<?php $this->includePartial("default", "indexFilters"); ?>

	<div class="box whiteBg clearR">
		<h3>Categorias</h3>
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
								<th class="leftTxt">Nome</th>
								<th>Status</th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($this->itens as $item): ?>
							<!-- Linha Tabela -->
							<tr class="odd">
								<td>
									<?php echo($item->getCATID()); ?>
								</td>

								<td class="leftTxt">
									<a href="<?php echo($this->Editorial->getURL()); ?>categorias/<?=$this->type?>/edit.php?ID=<?php echo($item->getCATID()); ?>"><?php echo($item->getCATNOM()); ?></a>
								</td>
								<?php
								switch($item->getCATSTS())
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
									<a href="<?php echo($this->Editorial->getURL()); ?>categorias/<?=$this->type?>/edit.php?ID=<?php echo($item->getCATID()); ?>" rel="Editar" title="Editar" class="btnsAdmin">Editar</a>
									<a href="<?php echo($this->Editorial->getURL()); ?>categorias/<?=$this->type?>/delete.php?ID=<?php echo($item->getCATID()); ?>" rel="Remover" title="Deletar" class="btnsAdmin">Deletar</a>

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