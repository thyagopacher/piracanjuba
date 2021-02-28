<?php

	$news = $this->vars['content'];
	$edito = $news['editorials'][0]['CAT_NOM'];
	$cor = Slugfy2($edito);

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
			<h1 class="cor-<?php if(!empty($this->bodyClasses)): echo ($this->cores("/".$this->bodyClasses."/")); endif; ?>"><?php echo ($news['CNT_TIT']); ?></h1>
		</div>
    </div>

    <?php if(!empty($this->items['PDT_URL'])): ?>
	<script>
	var pag = 'http://www.r7.com/marcelo-rezende/<?php echo($this->items['PDT_URL']); ?>';
	</script>
	<?php endif; ?>

    <div class="geral url"><?php //echo ("$agoravai"); ?></div>

	<?php if(($this->bodyClasses == "na-cozinha") || ($this->bodyClasses == "na-adega")) {?>


    <div class="img-materia-gourmet">
		<?php
			if (!empty($news['thb_fto'])):
			$foto = $news['thb_fto'];
		?>
			<img src="<?php echo ($foto['750x665']); ?>" />
		<?php
			endif;
		?>
	</div>

	<div class="geral">&nbsp;</div>
	<h2 class="titulo-materia-gourmet"><?php echo ($news['CNT_OLH']); ?></h2>
	<div class="geral">&nbsp;</div>


	<div class="conteudo-materia-gourmet">
		<div class="ingredientes-mateira-gourmet">
			<?php
				 if($this->bodyClasses == "na-cozinha") {
			?>
			<h3>INGREDIENTES</h3>
			<?php
				}else{
			?>
			<h3>ACOMPANHAMENTOS</h3>
			<?php
				}

				if (!empty($news["links"])):
			?>
			<ul>
			<?php
					foreach($news["links"] as $link):

			?>

				<li><a href="<?php echo ($link['LNK_LNK']); ?>" target="_blank"><?php echo ($link['LNK_TIT']); ?></a></li>
			<?php
					endforeach;
			?>
			</ul>
			<?php
				endif;
			?>
		</div>

		<div class="preparo-mateira-gourmet">
			<?php
				 if($this->bodyClasses == "na-cozinha") {
			?>
			<h3>PREPARO</h3>
			<?php
				}else{
			?>
			<h3>SOBRE</h3>
			<?php
				}
			?>
			<p><?php echo ($news['CNT_TXT']); ?></p>
		</div>
	</div>
	<div class="geral">
		<!--Definições de redes sociais-->
		<div class="compartilhar-rede">
			<!--Definições de redes sociais-->
			<?php $this->insertBlock("home", "shares"); ?>
			<!--final das definições de rede sociais-->
		</div>
		<!--final das definições de rede sociais-->
	</div>
	<!--div class="classificacao-gourmet"> CLASSIFICAÇÃO
		<form class="five-star stars-1">
			<label for="stars-1">1</label>
			<label for="stars-2">2</label>
			<label for="stars-3">3</label>
			<label for="stars-4">4</label>
			<label for="stars-5">5</label>
			<input type="radio" name="stars" value="1"  id="stars-1"/>
			<input type="radio" name="stars" value="2"  id="stars-2"/>
			<input type="radio" name="stars" value="3"  id="stars-3"/>
			<input type="radio" name="stars" value="4"  id="stars-4"/>
			<input type="radio" name="stars" value="5"  id="stars-5"/>
		</form>
	</div-->

	<div class="geral">&nbsp;</div>
	<div class="geral">
		<?php $this->insertBlock("home", "fbcomments"); ?>
	</div>

		<?php $this->insertBlock("home", "vinho", array("ID" => 46)); ?>
	</div>
	<?php }else{ ?>

		<div class="conteudo-post post-<?php
			if(!empty($this->bodyClasses)){
				if($this->cores("/".$this->bodyClasses."/") == ""){
					echo ("cinza");
				}else{
					echo ($this->cores("/".$this->bodyClasses."/"));
				}
			}
		?>">
			<div class="data">
				<div class="data-dia"><?php echo (date('d', strtotime($news['CNT_DTA'])));?></div>
				<div class="data-mes">{Month2: <?php echo(date('m', strtotime($news['CNT_DTA'])))?>}</div>
			</div>
			<div class="titulo-post"><h1><?php echo ($news['CNT_RES']); ?></h1></div>
			<?php
				if (!empty($news['thb_fto'])):
				$foto = $news['thb_fto'];
				$size = (!empty($news['CNT_TAG']))?$news['CNT_TAG']:"750x250";

			?>
				<div class="img-post" style="height: auto; width: auto;">

					<img src="<?php echo ($foto[$size]); ?>"  />

				</div>
			<?php
				endif;
			?>
			<div class="texto-conteudo-post">
				<div class="texto">
					<p><?php echo($news['CNT_TXT'])?></p>
					<?php
						if (!empty($news['CNT_EMB'])):
					?>
					<p><?php echo($news['CNT_EMB'])?></p>
					<?php
						endif;
					?>
				</div>
				<div class="compartilher-rede">

					<!--Definições de redes sociais-->
					<?php $this->insertBlock("home", "shares"); ?>
					<!--final das definições de rede sociais-->

				</div>

			</div>


		</div>



		<div class="geral">&nbsp;</div>

		<div class="titulo-pagina">
			<div class="box-titulo">
				<h2>Comentários</h2>
			</div>
		</div>
		<!--FINAL DESTAQUE TOPO-->




		<div class="geral">&nbsp;</div>
		<div class="geral">
			<?php $this->insertBlock("home", "fbcomments"); ?>
		</div>



		<!--ÁREA DE NOTÍCIAS RELACIONADAS-->
		<?php
			if(!empty($news['related'])){
				$this->insertBlock("interna", "relacionado", array("related" => $news['related']));
			}
		?>
	<?php } ?>

</div>
<!--FINAL DAS NOTICIAS RELACIONADAS-->
