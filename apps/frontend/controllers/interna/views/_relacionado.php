<div class="titulo-pagina">
	<div class="box-titulo">
		<h2>NOTÍCIAS RELACIONADAS</h2>
	</div>
</div>
<div class="tumb_noticias_relacionadas">
	<?php
		if (!empty($this->related)):
	?>  
	<ul>
		<?php 
			foreach($this->related as $news):
		?>
		<li>
			<div class="box-relacionadas post-cinza">
				<div class="data-relacioanada"><?php echo (date('d', strtotime($news['CNT_DTA'])));?><br />{Month2: <?php echo(date('m', strtotime($news['CNT_DTA'])))?>}</div>
				<div class="titulo-relacioanada"><?php echo ($news['CNT_TIT']);?></div>
				<div class="img-relacioanada">
					<?php 
						if (!empty($news['thb_fto'])): 
						$foto = $news['thb_fto'];
					?>
						<img src="<?php echo ($foto['350x170']); ?>" />
					<?php
						endif; 
					?>
				</div>
				
				 <!--Definições de redes sociais-->
				<?php $this->insertBlock("home", "shares")?>
				<!--final das definições de rede sociais-->
				 <div class="botaoMais"><a href="<?php echo($this->generateContentLink($news['CNT_TIP'], $news['CNT_DTA'], $news['CNT_TIT'], $news['CNT_ID'])); ?>"> + </a></div>
			  </div>
		</li>
		<?php
			endforeach; 
		?>
		
	</ul>
	<?php 
		endif; 
	?>
</div>