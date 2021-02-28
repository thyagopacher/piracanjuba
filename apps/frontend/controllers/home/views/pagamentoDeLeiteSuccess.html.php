<header id="insideHeader">
	<div class="insideWaves">
		<div class="insideTop">
			<h2>{Qualidade do Leite}</h2>
			<p class="topSlogan">{WE_LOVE_DO_THE_BEST}</p>
			<p class="breadCrumb"><strong>{YOU_ARE_HERE}:</strong>  <a href="#">{Pagina_Principal}</a> / <a href="#">{Produtor de Leite}</a> / <a href="#">{Política Leiteira}</a> / <a href="#">{Qualidade do Leite}</a></p>
		</div>
	</div>
	<div class="showImage" style="background-image: url(<?=$this->conteudo->getCNTFTO()->getFile()->getPath();?>);" ></div>
	<div class="txtCenter">
		<h3 class="txtSlogan">Programa de Apoio Técnico ao Produtor de Leite Piracanjuba</h3>
	</div>
</header>
<!--  /Header -->
<?php
$links = $this->conteudo->getLinks();
?>
<!--  Content -->
<section id="insideContent">
	<div class="alignContent">
		<h3 class="txtCenter"><?=$this->conteudo->CNT_TIT?></h3>
		<div class="txtContent">
			<?=$this->conteudo->CNT_TXT?>

		</div>

		<nav class="greyBox">
			<a href="<?=$links[0]->getLNKLNK()?>" class="open"><h4><?=$links[0]->LNK_TIT?></h4></a>
			<a href="<?=$links[1]->getLNKLNK()?>"><h4><?=$links[1]->LNK_TIT?></h4></a>

		</nav>
	</div>
</section>
