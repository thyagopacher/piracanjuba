<!-- Content -->
<div id="internal-page">
	<?php $this->insertBlock("home", "breadCrumb", array("CONTROLLER" => $this, "VARS" => $this->breadCrumb)); ?>
	
	<h1 class="icnPage newPage"><a href="<?php echo($this->Editorial->getURL()); ?>answers/new.php">{Add FAQ}</a></h1>

	<?php $this->includePartial("default", "indexFilters"); ?>
	
	<div class="box whiteBg clearR">
		<h3>{FAQ}</h3>
		<div>
			<?php if(empty($this->itens[0])): ?>
				<p>{Nothing Found}</p>
			<?php else: ?>
			<form>
				<fieldset>
					<table class="listTable hasQuickForm">
						<thead>
							<tr>
								<th>ID</th>
								<th class="leftTxt">{Date}</th>
								<th class="leftTxt">{Title}</th>
								<th>{Status}</th>
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
									<a href="<?php echo($this->Editorial->getURL()); ?>answers/edit.php?ID=<?php echo($item->getCNTID()); ?>"><?php echo(date("d/m/Y H:i", strtotime($item->getCNTDTA()))); ?></a>
								</td>
								<td class="leftTxt">
									<a href="<?php echo($this->Editorial->getURL()); ?>answers/edit.php?ID=<?php echo($item->getCNTID()); ?>"><?php echo($item->getCNTTIT()); ?></a>
								</td>
								<?php
								switch($item->getCNTSTS())
								{
									case "0":
										$class = "pendant-color";
										$status = "N�o publicada";
									break;
									case "1":
										$class = "approved-color";
										$status = "Publicada";
									break;
									case "9";
										$class = "excluded-color";
										$status = "Deletada";
									break;
									case "8";
										$class = "excluded-color";
										$status = "Deletada";
									break;
								}
								?>
								<td class="<?php echo($class); ?>">
									<?php echo($status); ?>
								</td>
								<td>
									<a href="<?php echo($this->Editorial->getURL()); ?>answers/edit.php?ID=<?php echo($item->getCNTID()); ?>" rel="Editar" title="Editar" class="btnsAdmin">Editar</a>
									<a href="<?php echo($this->Editorial->getURL()); ?>answers/delete.php?ID=<?php echo($item->getCNTID()); ?>" rel="Remover" title="Deletar" class="btnsAdmin">Deletar</a>
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