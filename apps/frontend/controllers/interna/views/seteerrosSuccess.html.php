<?php 		

	$news = $this->vars['content'];	
	$url = $this->items['PDT_URL'];		
	$cor = $this->cores("/".$url);
					
	
	
?>
<!--DESTAQUE TOPO-->
<div id="destaque-topo">
	<div class="logo-segmento-interno"><img src="<?php echo (APP_JS_PREFIX); ?>img/logos-categoria/cidade-alerta.png" width="300" height="210" /></div>
    
    <!---redes sociais--->
    <?php $this->insertBlock("home", "redesocial"); ?>
    
    
    <!--área de pesquisa-->
    <?php $this->includePartial("home", "busca"); ?>
    

    
 	<div class="geral">&nbsp;</div>   
    <div class="titulo-pagina">
		<div class="box-titulo">
			<h1 class="cor-<?php echo ($cor); ?>"><?php echo ($news['CNT_TIT']); ?></h1>
		</div>
    </div> 
    
    
    <div class="geral">&nbsp;</div>
	
	   
    <div>
	
						<script type="text/javascript">
							var txt;
							var currentErros = {
								achados: 0,
								achado: function (){
									this.achados++;
									document.getElementById("txtImage").innerHTML = "Você achou <strong>"+ this.achados + "</strong> erros ";
									if(this.achados == 7)
									{
										window.alert("Parabéns, você achou todos os erros!");
									}
								}
								
							}
							window.onload = function ()
							{
								var stage = new Kinetic.Stage({
									container: "Container",
									width: 370,
									height: 370
								})
								
								var images = {image1: "<?php echo($news['img1']['370x370']); ?>", image2: "<?php echo($news['img2']['370x370']); ?>"};
								var coords = {ponto1: [<?php echo($news['coord1']); ?>], ponto2: [<?php echo($news['coord2']); ?>], ponto3: [<?php echo($news['coord3']); ?>], ponto4: [<?php echo($news['coord4']); ?>], ponto5: [<?php echo($news['coord5']); ?>], ponto6: [<?php echo($news['coord6']); ?>], ponto7: [<?php echo($news['coord7']); ?>]};
								
								

								var layer = new Kinetic.Layer();		
								// Changed
								var img = new Image();
								img.onload = function ()
								{
									
									stage.setSize(img.width, img.height);
									
									var imageK = new Kinetic.Image({
										x: 0,
										y: 0,
										image: img
									});
									layer.add(imageK);
									stage.add(layer);
									
									var layer2 = new Kinetic.Layer();
									
									for(var i in coords)
									{
										var square = new Kinetic.Circle({
											x: (coords[i][0]+5),
											y: (coords[i][1]+5),
											radius: 15,
											fill: "#a13e57",
											stroke: "#FFF",
											strokeWidth: 1,
											alpha: 0
										})
										square.on("click", function (){
											if(this.attrs.alpha != 0.7){
												this.setAlpha(0.7); 
												layer2.draw();
												currentErros.achado();
											}
											
										});
										layer2.add(square);
									}
									
									
									stage.add(layer2);
									
								}
								img.src = images.image2;
								
								// Original Image
								var img2 = new Image();
								img2.onload = function ()
								{
									document.getElementById("originalImage").appendChild(img2);
								}
								img2.src = images.image1;
								
								
								
								
							}
						</script>

						<div class="sete-erros">
								
								<div id="originalImage"></div>
								<div id="Container"></div>
								<div id="txtImage">&nbsp;</div>	
							
						</div>
		
		
		
		<?php 
			if (!empty($news['CNT_TXT'])): 
		?>
        <div class="texto-conteudo-post">
        	<div class="texto">
				<p><?php echo($news['CNT_TXT'])?></p>
			</div>
            <div class="compartilher-rede">
            
    			<!--Definições de redes sociais-->
				<?php $this->insertBlock("home", "shares"); ?>
				<!--final das definições de rede sociais-->        
            
            </div>
    
        </div>
        <?php
			endif;
		?>
        
    </div>
    
    
     
    <div class="geral">&nbsp;</div>
    

   
 </div>
    
    
    <!--FINAL DAS NOTICIAS RELACIONADAS-->