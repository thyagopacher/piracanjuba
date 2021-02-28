<!-- Content -->
<div id="internal-page">
	<?php $this->insertBlock("home", "breadCrumb", array("CONTROLLER" => $this, "VARS" => $this->breadCrumb)); ?>

	<h1 class="icnPage newPage"><a href="<?php echo($this->Editorial->getURL()); ?>tabela/<?php echo($this->ID); ?>/new.php">Adicionar Item</a></h1>



	<div class="box whiteBg clearR">
		<h3>{Tabela}</h3>
		<div>
			<?php if(empty($this->itens[0])): ?>
				<p>Nenhum item encontrado</p>
			<?php else: ?>
			<form>
				<fieldset>
					<table class="listTable">
						<thead>
							<tr>
								<th>ID</th>
								<th class="leftTxt">Valor Energético</th>
								<th class="leftTxt">Quantidade Porção</th>
								<th class="leftTxt">Porcentagem Porção</th>
								<th>Status</th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($this->itens as $item): ?>
							<!-- Linha Tabela -->
							<tr>
								<td>
									<?php echo($item->getID()); ?>
								</td>
								<td class="leftTxt">
									<a href="<?php echo($this->Editorial->getURL()); ?>tabela/<?php echo($this->ID);?>/edit.php?ID=<?php echo($item->getID()); ?>"><?php echo($item->getTABELAVALORENERGICO()); ?></a>
								</td>

								<td class="leftTxt">
									<a href="<?php echo($this->Editorial->getURL()); ?>tabela/<?php echo($this->ID);?>/edit.php?ID=<?php echo($item->getID()); ?>"><?php echo($item->getTABELAQUANTIDADE()); ?></a>
								</td>
								<td class="leftTxt">
									<a href="<?php echo($this->Editorial->getURL()); ?>tabela/<?php echo($this->ID);?>/edit.php?ID=<?php echo($item->getID()); ?>"><?php echo($item->getTABELAPORCENTAGEM()); ?></a>
								</td>
								<?php
								switch($item->getTABELASTATUS())
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
									<a href="<?php echo($this->Editorial->getURL()); ?>tabela/<?php echo($this->ID);?>/edit.php?ID=<?php echo($item->getID()); ?>" rel="Editar" title="Editar" class="btnsAdmin">Editar</a>
									<a href="<?php echo($this->Editorial->getURL()); ?>tabela/<?php echo($this->ID);?>/delete.php?ID=<?php echo($item->getID()); ?>" rel="Remover" title="Deletar" class="btnsAdmin">Deletar</a>
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
