<!-- Content -->
<div id="internal-page">

	<div class="box whiteBg clearR">
		<h3>Traduções</h3>
		<div>
			<?php if(empty($this->itens[0])): ?>
				<p>Nenhum item encontrado</p>
			<?php else: ?>
			<form>
				<fieldset>
					<table class="listTable">
						<thead>
							<tr>
								<th>Name</th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($this->itens as $item): ?>
							<!-- Linha Tabela -->
							<tr>
								<td class="">
									<?php echo($item); ?>
								</td>
								<td>
									<a href="<?php echo($this->Editorial->getURL()); ?>translator/edit.php?item=<?php echo($item); ?>" rel="Editar" title="Editar" class="btnsAdmin">Editar</a>
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
</div>
<!-- /Content -->
