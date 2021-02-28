<!-- Content -->
<div id="internal-page">
	<?php $this->insertBlock("home", "breadCrumb", array("CONTROLLER" => $this, "VARS" => $this->breadCrumb)); ?>
	
	<h1>{Versicles}</h1>
	
	<?php $this->includePartial("default", "pagination"); ?>
	
	<form id="search_right" action="<?php echo($_SERVER['REQUEST_URI']); ?>" method="get">
		<fieldset id="versicleFilters">
			<legend class="hidden">{Search}</legend>
			<label for="q" class="hidden">{Search}</label>
			<input type="text" id="q" name="q" <?php if(!empty($this->filters['q'])){ echo(" value=\"{$this->filters['q']}\"");}?> placeholder="Buscar" />
			<?php
			if(!empty($this->books))
			{
				$opts = array("" => "Selecione um livro");
				foreach($this->books as $book)
				{
					$opts[$book->getlivroid()] = $book->getnome();
				}
				$select = new FuriousSelect("livro", "{Book}", $opts, array("class" => "smallSel"));
				if(!empty($this->filters['livro']))
				{
					$select->setValue($this->filters['livro']);
				}
				$select->setFormatRender("%INPUT%");
				echo($select);
			}
			?>
			<label>Cap:Ver</label>
			<input type="text" id="cap" class="smallFtxt" name="cap" <?php if(!empty($this->filters['cap'])){ echo(" value=\"{$this->filters['cap']}\"");}?> /> : <input type="text" class="smallFtxt" id="ver" name="ver" <?php if(!empty($this->filters['ver'])){ echo(" value=\"{$this->filters['ver']}\"");}?> />
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
	
	
	<div id="VersiclesBox" class="box whiteBg clearR">
		<h3>{Versicles}</h3>
		<div>
			<?php if(empty($this->itens[0])): ?>
				<p>{Nothing found}</p>
			<?php else: ?>
				<fieldset>
					<table class="listTable">
						<thead>
							<tr>
								<th>{Book}</th>
								<th>{Text}</th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($this->itens as $item): ?>
							<!-- Linha Tabela -->
							<tr>
								<td rel="formatedVersicle"><?php echo($item->formatedVersicle());?></td>
								<td rel="texto" class="leftTxt"><?php echo($item->gettexto());?></td>
								<td><a href="<?php echo($this->Editorial->getURL()); ?>versicles/edit.php?ID=<?php echo($item->gettextoid()); ?>" rel="Edicao Rapida" title="Edição Rápida" class="btnsAdmin quickEditBtn2">Editar</a></td>
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