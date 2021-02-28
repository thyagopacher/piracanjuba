<!-- Content -->
<div id="internal-page">
	<?php $this->insertBlock("home", "breadCrumb", array("CONTROLLER" => $this, "VARS" => $this->breadCrumb)); ?>
	
	<h1 class="icnPage newPage"><a href="<?php echo($this->Editorial->getURL()); ?>groups/new.php">{Add Profile}</a></h1>

	
	<div class="box whiteBg clearR">
		<h3>{Profile}</h3>
		<div>
			<?php if(empty($this->itens[0])): ?>
				<p>{Nothing Found}</p>
			<?php else: ?>
			<form>
				<fieldset>
					<table class="listTable">
						<thead>
							<tr>
								<th>ID</th>
								<th class="leftTxt">{Name}</th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($this->itens as $item): ?>
							<!-- Linha Tabela -->
							<tr class="odd">
								<td>
									<?php echo($item->getGRPID()); ?>
								</td>
								<td class="leftTxt">
									<a href="<?php echo($this->Editorial->getURL()); ?>groups/edit.php?ID=<?php echo($item->getGRPID()); ?>"><?php echo($item->getGRPTIT()); ?></a>
								</td>
								
								<td>
									<a href="<?php echo($this->Editorial->getURL()); ?>groups/edit.php?ID=<?php echo($item->getGRPID()); ?>" rel="Editar" title="Editar" class="btnsAdmin">Editar</a>
									<a href="<?php echo($this->Editorial->getURL()); ?>groups/delete.php?ID=<?php echo($item->getGRPID()); ?>" rel="Remover" title="Deletar" class="btnsAdmin">Deletar</a>
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