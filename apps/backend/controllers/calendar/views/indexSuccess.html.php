<!-- Content -->
<div id="internal-page">
	<?php $this->insertBlock("home", "breadCrumb", array("CONTROLLER" => $this, "VARS" => $this->breadCrumb)); ?>
	
	<h1 class="icnPage newPage"><a href="<?php echo($this->Editorial->getURL()); ?>calendar/new.php">{Add Event}</a></h1>

	<?php $this->includePartial("default", "pagination"); ?>
	
	<form action="<?php echo($_SERVER['REQUEST_URI']); ?>" method="get">
		<fieldset>
			<legend class="hidden">{Search}</legend>
			<label for="q" class="hidden">{Search}</label>
			<input type="text" id="q" name="q" placeholder="{Search for}" <?php if(!empty($this->filters['q'])){ echo(" value=\"{$this->filters['q']}\"");}?> />
			
			<label for="start_period">{Period}</label>
			<input type="text" id="start_period" name="start_period" placeholder="dd/mm/YYYY" <?php if(!empty($this->filters['start_period'])){ echo(" value=\"{$this->filters['start_period']}\"");}?> />
			
			<label for="end_period">{until}</label>
			<input type="text" id="end_period" name="end_period" placeholder="dd/mm/YYYY" <?php if(!empty($this->filters['end_period'])){ echo(" value=\"{$this->filters['end_period']}\"");}?> />
			
			
			<input type="submit" value="{Search events}" />
		</fieldset>
	</form>
	
	
	<div class="box whiteBg clearR">
		<h3>{Calendar}</h3>
		<div>
			<?php if(empty($this->itens[0])): ?>
				<p>{Nothing found}</p>
			<?php else: ?>
			<form>
				<fieldset>
					<table class="listTable">
						<thead>
							<tr>
								<th>ID</th>
								<th class="leftTxt">Data</th>
								<th class="leftTxt">Destaques</th>
								<th class="leftTxt">Local</th>
								<th>Status</th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($this->itens as $item): ?>
							<!-- Linha Tabela -->
							<tr>
								<td>
									<?php echo($item->getCNTID()); ?>
								</td>
								<td class="leftTxt">
									<a href="<?php echo($this->Editorial->getURL()); ?>calendar/edit.php?ID=<?php echo($item->getCNTID()); ?>"><?php echo(date("d/m/Y H:i", strtotime($item->getCNTDTF()))); ?></a>
									
								</td>
								<td class="leftTxt">
									<a href="<?php echo($this->Editorial->getURL()); ?>calendar/edit.php?ID=<?php echo($item->getCNTID()); ?>"><?php echo($item->getCNTTIT()); ?></a>
								</td>
								<td class="leftTxt">
									<a href="<?php echo($this->Editorial->getURL()); ?>calendar/edit.php?ID=<?php echo($item->getCNTID()); ?>"><?php echo($item->getCNTLOC()); ?></a>
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
									<a href="<?php echo($this->Editorial->getURL()); ?>calendar/edit.php?ID=<?php echo($item->getCNTID()); ?>" rel="Editar" title="Editar" class="btnsAdmin">Editar</a>
									<a href="<?php echo($this->Editorial->getURL()); ?>calendar/delete.php?ID=<?php echo($item->getCNTID()); ?>" rel="Remover" title="Deletar" class="btnsAdmin">Deletar</a>
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