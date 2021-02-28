<!-- Content -->
<div id="internal-page">
	<?php $this->insertBlock("home", "breadCrumb", array("CONTROLLER" => $this, "VARS" => $this->breadCrumb)); ?>
	
	<h1>{Book}</h1>
	<!--ul class="filterMenu">
		<li><a href="< ?php echo($this->generateEdtURL(array("livro", "download"))); ?>" target="_blank">Download em Excel</a></li>
	</ul-->
	<?php $this->includePartial("default", "pagination"); ?>
	
	<form action="<?php echo($_SERVER['REQUEST_URI']); ?>" method="get">
		<fieldset>
			<legend class="hidden">{Search}</legend>
			<label for="q">{Search}</label>
			<input type="text" id="q" placeholder="{Search}" name="q" <?php if(!empty($this->filters['q'])){ echo(" value=\"{$this->filters['q']}\"");}?> />
			
			<label for="start_period">{Period}</label>
			<input type="text" id="start_period" name="start_period" placeholder="dd/mm/YYYY" <?php if(!empty($this->filters['start_period'])){ echo(" value=\"{$this->filters['start_period']}\"");}?> />
			
			<label for="end_period">{until}</label>
			<input type="text" id="end_period" name="end_period" placeholder="dd/mm/YYYY" <?php if(!empty($this->filters['end_period'])){ echo(" value=\"{$this->filters['end_period']}\"");}?> />
			<input type="submit" value="Ok" />
		</fieldset>
	</form>
	
	<div class="box whiteBg clearR">
		<h3>{Book}</h3>
		<div>
			<?php if(empty($this->itens[0])): ?>
				<p>{Nothing found}</p>
			<?php else: ?>
			<form>
				<fieldset>
					<table class="listTable">
						<thead>
							<tr>
								<th class="leftTxt">Data</th>
								<th class="leftTxt">{Name}</th>
								<th class="leftTxt">{Email}</th>
								<th class="leftTxt">{Archive}</th>
								<th>Status</th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($this->itens as $item): 
								$params = $item->getProperties();
							?>
							<!-- Linha Tabela -->
							<tr>
								<td class="leftTxt">
									<?php echo(date("d/m/Y H:i", strtotime($item->getMSGDTA()))); ?>
								</td>
								<td class="leftTxt">
									<?php echo($item->getMSGNOM()); ?>
								</td>
								<td class="leftTxt">
									<?php echo($item->getMSGEMA()); ?>
								</td>
								<td class="leftTxt">
									<?php echo($params['MSG_TXT']); ?>
								</td>
								<?php
								switch($item->getMSGSTS())
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
									<a href="<?php echo($this->Editorial->getURL()); ?>livro/edit.php?ID=<?php echo($item->getMSGID()); ?>" rel="Editar" title="Editar" class="btnsAdmin">Editar</a>
									<a href="<?php echo($this->Editorial->getURL()); ?>livro/delete.php?ID=<?php echo($item->getMSGID()); ?>" rel="Remover" title="Deletar" class="btnsAdmin">Deletar</a>
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