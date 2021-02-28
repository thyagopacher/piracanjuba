<script>
	$(document).ready(function(){
		$("form.enquetes").each(function (){
			$(this).submit(function (){  
				if($(":radio:checked").length <= 0){ 
					alert("Selecione um campo para votar!"); 
					return false; 
				}  
			});
		});
	});
</script>
	
	
	
	<!--DESTAQUE TOPO-->
	  <div id="destaque-topo" class="cor-<?php if(!empty($this->items["PDT_URL"])): echo ($this->cores("/".$this->items["PDT_URL"])); endif; ?>">
		<div class="logo-segmento-interno"><?php $this->insertBlock("home", "logos", array("SCOPE" => $this)); ?></div>
		<!---redes sociais--->
		<?php $this->insertBlock("home", "redesocial"); ?>
		
		
		<!--área de pesquisa-->
		<?php $this->includePartial("home", "busca"); ?>
		<!--banner principal-->
		<h1 class="cor-cinza-escuro">Enquetes</h1>
			<div class="geral"></div>	
		</div>
		
		<!--FINAL DESTAQUE TOPO-->




		<!--CONTEUDO DO CORPO-->
		
		
			 <div class="lista-enquete">
				 <?php 
					if (!empty($this->itens)):
				?> 
				<ul>
					<?php
							$i = 0;
							foreach($this->itens["items"] as $item):								
							//var_dump($item);
								if($i >= $this->startItem && $i < $this->endItem){
					?>
				
				
					<li>
						<h3><a href="<?php echo (APP_WEB_PREFIX."enquete/".Slugfy($item["name"])."-".$item["id"].".html"); ?>"><?php echo ($item["name"]); ?></a></h3>
						<a href="<?php echo (APP_WEB_PREFIX."enquete/".Slugfy($item["name"])."-".$item["id"].".html"); ?>">
							<?php 
								if (!empty($item['dtq_fto'])):
								$foto = $item['dtq_fto']['fto'];
							?>
								<img src="<?php echo ($foto['355x130']); ?>" />
							<?php
								endif; 
							?>
						</a>				
						<form name="enquete-<?php echo ($item['id']); ?>" class="enquetes" action="<?php echo (APP_WEB_PREFIX."enquete/".Slugfy($item["name"])."-".$item["id"].".html?resultado=TRUE"); ?>" method="POST">							
							<ul class="enquete-conteudo">
								<?php 
									if (!empty($item['value1'])):									
								?>
								<li>
									<div class="enquete-ip"><input type="radio" name="enquete[op]" value="op1" id="op1-<?php echo ($item['id']); ?>" /><label for="op1-<?php echo ($item['id']); ?>"></label></div>
									<div class="enquete-op"><?php echo ($item["value1"]); ?></div>
								</li>
								<?php
									endif; 
								?>
								<?php 
									if (!empty($item['value2'])):									
								?>
								<li>
									<div class="enquete-ip"><input type="radio" name="enquete[op]" value="op2" id="op2-<?php echo ($item['id']); ?>" /><label for="op2-<?php echo ($item['id']); ?>"></label></div>
									<div class="enquete-op"><?php echo ($item["value2"]); ?></div>
								</li>
								<?php
									endif; 
								?>
								<?php 
									if (!empty($item['value3'])):									
								?>
								<li>
									<div class="enquete-ip"><input type="radio" name="enquete[op]" value="op3" id="op3-<?php echo ($item['id']); ?>" /><label for="op3-<?php echo ($item['id']); ?>"></label></div>
									<div class="enquete-op"><?php echo ($item["value3"]); ?></div>
								</li>
								<?php
									endif; 
								?>
								<?php 
									if (!empty($item['value4'])):									
								?>
								<li>
									<div class="enquete-ip"><input type="radio" name="enquete[op]" value="op4" id="op4-<?php echo ($item['id']); ?>" /><label for="op4-<?php echo ($item['id']); ?>"></label></div>
									<div class="enquete-op"><?php echo ($item["value4"]); ?></div>
								</li>
								<?php
									endif; 
								?>
								<?php 
									if (!empty($item['value5'])):									
								?>
								<li>
									<div class="enquete-ip"><input type="radio" name="enquete[op]" value="op5" id="op5-<?php echo ($item['id']); ?>" /><label for="op5-<?php echo ($item['id']); ?>"></label></div>
									<div class="enquete-op"><?php echo ($item["value5"]); ?></div>
								</li>
								<?php
									endif; 
								?>
							</ul>
							<div class="enquete-botoes">
								<a href="<?php echo (APP_WEB_PREFIX."enquete/".Slugfy($item["name"])."-".$item["id"].".html?resultado=TRUE"); ?>" class="enquete-resultado">Ver Resultados</a>
								<input type="submit" class="enquete-votar" value="Votar" />
							</div>
						</form>
					</li>
					<?php
								}	
								$i++;								
							endforeach; 
					?>		
					
					
				</ul>
				<?php 
					endif; 
				?>
			</div> 
		
			<div class="geral"></div>
			
			<?php $this->includePartial("default", "pagination"); ?>
		<!--FINAL DO CONTEUDO DO CORPO-->	

		
		
		
	<br style=" clear:both">
	</div>
	<!--FINAL DO TOPO DO SITE-->