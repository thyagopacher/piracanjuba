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
		
		
			 <?php 
				if(!empty($_GET)){
					$result = $_GET['resultado'];
				}else{
					$result = FALSE;
				}
			 
				if (!empty($this->enquete)):
					$item = $this->enquete;
			?> 
			<div class="conteudo-post post-cinza">
				<div class="titulo-post" style="width: 710px;"><h1><?php echo ($item['name']); ?></h1></div>
				<div class="img-post seta-baixo">					
					<?php 
						if (!empty($item['dtq_fto'])):
						$foto = $item['dtq_fto']['fto'];
					?>
						<img src="<?php echo ($foto['750x250']); ?>" />
					<?php
						endif; 
					?>
				</div>
				
				<div class="texto-conteudo-post">
					<div class="texto">
						<div class="enquete-conteudo">
							<form name="enquete-<?php echo ($item['id']); ?>" class="enquetes" action="?resultado=TRUE" method="POST">
								<?php if (!empty($this->Message)){?>
									<div class="enquete-message"><?php echo ($this->Message); ?></div>
								<?php }?>
								<?php if (!empty($this->errors)){?>
									<div class="enquete-message"><?php echo ($this->errors); ?></div>
								<?php }?>
								<ul>
									<?php 
										if (!empty($item['value1'])):									
									?>
									<li>
										<?php 											
											if($result == "TRUE"){
										?>
										<div class="enquete-op">
											<?php echo ($item["value1"]); ?>
											<div class="enquete-va"><b><?php echo ($item["voto1"]); ?> votos</b></div>
										</div>
										<?php		
											}else{
										?>
										<div class="enquete-ip"><input type="radio" name="enquete[op]" value="op1-<?php echo ($item['id']); ?>" id="op1-<?php echo ($item['id']); ?>" /><label for="op1-<?php echo ($item['id']); ?>"></label></div>
										<div class="enquete-op"><?php echo ($item["value1"]); ?></div>
										<?php		
											}
										?>
									</li>
									<?php
										endif; 
									?>
									<?php 
										if (!empty($item['value2'])):									
									?>
									<li>
										<?php 											
											if($result == "TRUE"){
										?>
										<div class="enquete-op">
											<?php echo ($item["value2"]); ?>
											<div class="enquete-va"><b><?php echo ($item["voto2"]); ?> votos</b></div>
										</div>
										<?php		
											}else{
										?>
										<div class="enquete-ip"><input type="radio" name="enquete[op]" value="op2-<?php echo ($item['id']); ?>" id="op2-<?php echo ($item['id']); ?>" /><label for="op2-<?php echo ($item['id']); ?>"></label></div>
										<div class="enquete-op"><?php echo ($item["value2"]); ?></div>
										<?php		
											}
										?>
									</li>
									<?php
										endif; 
									?>
									<?php 
										if (!empty($item['value3'])):									
									?>
									<li>
										<?php 											
											if($result == "TRUE"){
										?>
										<div class="enquete-op">
											<?php echo ($item["value3"]); ?>
											<div class="enquete-va"><b><?php echo ($item["voto3"]); ?> votos</b></div>
										</div>
										<?php		
											}else{
										?>
										<div class="enquete-ip"><input type="radio" name="enquete[op]" value="op3-<?php echo ($item['id']); ?>" id="op3-<?php echo ($item['id']); ?>" /><label for="op3-<?php echo ($item['id']); ?>"></label></div>
										<div class="enquete-op"><?php echo ($item["value3"]); ?></div>
										<?php		
											}
										?>
									</li>
									<?php
										endif; 
									?>
									<?php 
										if (!empty($item['value4'])):									
									?>
									<li>
										<?php 											
											if($result == "TRUE"){
										?>
										<div class="enquete-op">
											<?php echo ($item["value4"]); ?>
											<div class="enquete-va"><b><?php echo ($item["voto4"]); ?> votos</b></div>
										</div>
										<?php		
											}else{
										?>
										<div class="enquete-ip"><input type="radio" name="enquete[op]" value="op4-<?php echo ($item['id']); ?>" id="op4-<?php echo ($item['id']); ?>" /><label for="op4-<?php echo ($item['id']); ?>"></label></div>
										<div class="enquete-op"><?php echo ($item["value4"]); ?></div>
										<?php		
											}
										?>
									</li>
									<?php
										endif; 
									?>
									<?php 
										if (!empty($item['value5'])):									
									?>
									<li>
										<?php 											
											if($result == "TRUE"){
										?>
										<div class="enquete-op">
											<?php echo ($item["value5"]); ?>
											<div class="enquete-va"><b><?php echo ($item["voto5"]); ?> votos</b></div>
										</div>
										<?php		
											}else{
										?>
										<div class="enquete-ip"><input type="radio" name="enquete[op]" value="op5-<?php echo ($item['id']); ?>" id="op5-<?php echo ($item['id']); ?>" /><label for="op5-<?php echo ($item['id']); ?>"></label></div>
										<div class="enquete-op"><?php echo ($item["value5"]); ?></div>
										<?php		
											}
										?>
									</li>
									<?php
										endif; 
									?>
								</ul>								
								<div class="enquete-botoes">
									<a href="<?php echo (APP_WEB_PREFIX."enquete/".Slugfy($item["name"])."-".$item["id"].".html?resultado=TRUE"); ?>" class="enquete-resultado">Ver Resultados</a>
									
									<?php 											
										if($result == "TRUE"){
									?>
									<a href="<?php echo (APP_WEB_PREFIX."enquete/".Slugfy($item["name"])."-".$item["id"].".html"); ?>" class="enquete-votar">Votar</a>
									<?php		
										}else{
									?>
									<input type="submit" class="enquete-votar" value="Votar" />
									<?php		
										}
									?>
								</div>
							</form>
						</div>
					</div> 
					
					<div class="compartilher-rede">
					
						<!--Definições de redes sociais-->
						<?php $this->insertBlock("home", "shares"); ?>
						<!--final das definições de rede sociais-->        
					
					</div>
				
				</div>
			</div>		
			<?php 
				endif; 
			?>	
			
			
		</div>
		
		<!--FINAL DESTAQUE TOPO-->


		
		<div class="geral"></div>
		
		
		
	<br style=" clear:both">
	</div>
	<!--FINAL DO TOPO DO SITE-->