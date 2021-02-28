
<?php 
	$news = $this->vars['content'];
	//$edito = $news['editorials'][0]['CAT_NOM'];
	//$cor = Slugfy2($edito);
	
	//var_dump($news);
?>
<!--DESTAQUE TOPO-->
<div id="destaque-topo">
	<div class="logo-segmento-interno"><img src="<?php echo (APP_JS_PREFIX); ?>img/logos-categoria/cidade-alerta.png" width="300" height="210" /></div>
    
    <!---redes sociais--->
    <?php $this->insertBlock("home", "redesocial"); ?>
    
    
    <!--área de pesquisa-->
    <?php $this->includePartial("home", "busca"); ?>
    

    
 	
    
	<?php if((!empty($news["CNT_EMB"])) && ($news["CNT_EMB"] == "vinho")) {?>
	
      
		<!--banner principal-->
		<div class="titulo-pagina">
			<div class="box-titulo">
				<h1 class="cor-amarelo">NA ADEGA</h1>
			</div>
		</div> 
		
		<div class="geral"></div>
		<div class="geral">
			<h3 class="cor-cinza"><?php echo ($news['CNT_TIT']); ?></h3>
		</div>
		
		<div class="banner-na-adega">
   	  
			<div class="conteudo-banner-na-dega">
				<h2><?php echo ($news['CNT_TIT']); ?></h2>
				<p><?php echo ($news['CNT_OLH']); ?></p>
			</div>
      
			<div class="img-banner-na-dega">
				<?php 
					if (!empty($news['thb_fto'])): 
					$foto = $news['thb_fto'];
				?>
					<img src="<?php echo ($foto['370x370']); ?>" />
				<?php
					endif; 
				?>
			</div>
			<?php
				if(!empty($news['CNT_LOC'])){
					if($news['CNT_LOC'] == "rose" || $news['CNT_LOC'] == "branco" || $news['CNT_LOC'] == "verde"){
			?>
				<h1 class="destaque-banner-na-dega-<?php echo ($news['CNT_LOC']); ?>" title="<?php echo (strtoupper($news['CNT_LOC'])); ?>"><?php echo (strtoupper($news['CNT_LOC'])); ?></h1>
				<?php
					}else{
				?>
					<h1 class="destaque-banner-na-dega-rose" title="<?php echo (strtoupper($news['CNT_LOC'])); ?>"><?php echo (strtoupper($news['CNT_LOC'])); ?></h1>
				<?php
					}
				?>
			<?php
				}else{
			?>
				<h1 class="destaque-banner-na-dega-rose"></h1>
			<?php
				}
			?>
		</div>
		
		<div class="geral">
			<div class="titulos" >
				<div class="texto-titulos">
					<h1 class="cor-cinza">HARMONIZA</h1>
				</div>
			</div>
		</div>

		<div class="geral">&nbsp;</div>


	<div class="geral">&nbsp;
		<p><?php echo ($news['CNT_TXT']); ?></p>  
	</div>
	
	<div class="compartilher-rede">
	
		<!--Definições de redes sociais-->
		<?php $this->insertBlock("home", "shares"); ?>
		<!--final das definições de rede sociais-->        
	
	</div>
	
		<div class="geral">&nbsp;</div>
		<?php $this->insertBlock("home", "fbcomments"); ?>
		<div class="geral">&nbsp;</div>
	
	
	<?php $this->insertBlock("home", "vinho", array("ID" => 46)); ?>
	
	
	
	
	<?php }else{ ?>
	
		<div class="geral">&nbsp;</div>   
		<div class="titulo-pagina">
			<div class="box-titulo">
				<h1 class="cor-<?php if(!empty($this->bodyClasses)): echo ($this->cores("/".$this->bodyClasses."/")); endif; ?>"><?php echo ($news['CNT_TIT']); ?></h1>
			</div>
		</div> 
		
		
		<div class="geral">&nbsp;</div>
		
		<div class="conteudo-post post-<?php if(!empty($this->bodyClasses)): echo ($this->cores("/".$this->bodyClasses."/")); endif; ?>">
			<?php 
				if (!empty($news['thb_fto'])): 
				$foto = $news['thb_fto'];
			?>
				<div class="img-post">
				
					<img src="<?php echo ($foto['750x250']); ?>" />
				
				</div>
			<?php
				endif; 
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
			
			
		</div>
		
		<div class="geral">&nbsp;</div>
		<?php $this->insertBlock("home", "fbcomments"); ?>
		<div class="geral">&nbsp;</div>
		
		
	<?php } ?>
   </div>


