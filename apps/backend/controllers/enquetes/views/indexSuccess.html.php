<script type="text/javascript">
	/*$(document).ready(function(){
		$("a[rel=Remover]").click(function(){			
			if(confirm("Deseja realmente excluir este item?")){
				return true;				
			}
			
			return false;
		});			
	});*/
</script>

<!-- Content -->
<div id="internal-page">
	<?php $this->insertBlock("home", "breadCrumb", array("CONTROLLER" => $this, "VARS" => $this->breadCrumb)); ?>
	
	<h1 class="icnPage newPage"><a href="<?php echo($this->Editorial->getURL()); ?>enquetes/new.php">Adicionar item</a></h1>

	<?php // $this->includePartial("default", "indexFilters"); ?>
	
	<div class="box whiteBg clearR">
		<h3>Enquete</h3>
		<div>
			<?php if(empty($this->itens) || count($this->itens) < 1): ?>
				<p>Nenhum item encontrado</p>
			<?php else: ?>
			<form>
				<fieldset>
					<table class="listTable">
						<thead>
							<tr>
								<th>ID</th>
								<th class="leftTxt">Enquete</th>
								<th class="leftTxt">Imagem</th>
								<th>&nbsp;</th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								foreach($this->itens as $item): 
									$ID = $item->id;
							//var_dump($item->id);
									if ($item->status == 9 ){
									
									}else{
							?>
							
							<!-- Linha Tabela -->
							<tr>
								<td>
									<?php echo($ID);  ?>
								</td>
								
								<td class="leftTxt">
									<a href="<?php echo($this->Editorial->getURL()); ?>enquetes/edit.php?ID=<?php echo($ID); ?>"><?php echo($item->name); ?></a>
								</td>
								<td class="leftTxt">									
									<?php 
									$fto = $item->getFTO();
									if(!empty($fto)){
										$file = $fto->getFile();
										?>
										<img src="<?php echo($file->getFormat('100x100')); ?>" />
										<?php 
									}
									?>
								</td>
								<?php
								switch($item->status)
								{
									case "0":
										$class = "pendant-color";
										$status = "N&atilde;o publicada";
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
									<a href="<?php echo($this->Editorial->getURL()); ?>enquetes/edit.php?ID=<?php echo($ID); ?>" rel="Editar" title="Editar" class="btnsAdmin">Editar</a>
									<a href="<?php echo($this->Editorial->getURL()); ?>enquetes/delete.php?ID=<?php echo($ID); ?>" rel="Remover" title="Deletar" class="btnsAdmin">Deletar</a>
								</td>
							</tr>
							<!-- /Linha Tabela -->
							<?php 
									}
								endforeach; 
							?>
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