<!-- Content -->
<div id="internal-page">
	<?php $this->insertBlock("home", "breadCrumb", array("CONTROLLER" => $this, "VARS" => $this->breadCrumb)); ?>
	
	<h1>{Books}</h1>
	
	<?php $this->includePartial("default", "pagination"); ?>
	
	<form id="search_right" action="<?php echo($_SERVER['REQUEST_URI']); ?>" method="get">
		<fieldset>
			<legend class="hidden">{Search}</legend>
			<label for="q" class="hidden">{Search}</label>
			<input type="text" id="q" name="q" <?php if(!empty($this->filters['q'])){ echo(" value=\"{$this->filters['q']}\"");}?> placeholder="Buscar" />
			
			<?php 
				$opts = array("" => "{Testament}", "1" => "Antigo Testamento", "2" => "Novo Testamento"); 
				$select = new FuriousSelect("test", "{Testament}", $opts);
				if(!empty($this->filters['test']))
				{
					$select->setSelected($this->filters['test']);
				}
				$select->getLabel()->setAttribute("class", "hidden");
				$select->setFormatRender("%INPUT%");
				echo($select);
			?>
			
			<input type="submit" value="{Ok}" />
		</fieldset>
	</form>
	
	<form method="post">
		
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
		<h3>{Books}</h3>
		<div>
			<?php if(empty($this->itens[0])): ?>
				<p>{Nothing found}</p>
			<?php else: ?>
				<fieldset>
					<table class="listTable">
						<thead>
							<tr>
								<th>{Book}</th>
								<th class="leftTxt">{Name}</th>
								<th>{Testament}</th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($this->itens as $item): ?>
							<!-- Linha Tabela -->
							<tr>
								<td rel="sigla"><?php echo($item->getsigla());?></td>
								<td rel="nome" class="leftTxt"><?php echo($item->getnome());?></td>
								<td rel="testamento_nome"><?php echo($item->gettestamento()->getnome());?></td>
								<td><a href="<?php echo($this->Editorial->getURL()); ?>bible/edit.php?ID=<?php echo($item->getlivroid()); ?>" rel="Edicao Rapida" title="Edição Rápida" class="btnsAdmin quickEditBtn2">Editar</a></td>
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
	<br />
</div>
<!-- /Content -->