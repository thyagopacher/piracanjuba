
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
	
	<div class="img-video">
		<?php 
			if (!empty($news['CNT_EMB'])): 			
				echo ($news['CNT_EMB']);
			endif; 
		?>
	</div>
	
	
    <div class="geral">&nbsp;</div>
    
   
    <div class="conteudo-post">
		<?php 
			if (!empty($news['thb_fto'])): 
			$foto = $news['thb_fto'];
		?>
			<div class="img-post seta-baixo">
			
				<img src="<?php echo ($foto['750x250']); ?>" />
			
			</div>
        <?php
			endif; 
		?>
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