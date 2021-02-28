<header id="insideHeader">
	<div class="insideWaves">
		<div class="insideTop">
			<h2>{Produtos}</h2>
			<p class="topSlogan">{WE_LOVE_DO_THE_BEST}</p>
			<p class="breadCrumb"><strong>{YOU_ARE_HERE}:</strong>  <a href="#">{Pagina_Principal}</a> / <a href="/produtos">{Produtos}</a> / <a href="#"><?=$this->categoria->CAT_NOM?></a></p>
		</div>
	</div>
	<?php
	$bg = "";
	$catFto = $this->categoria->getCATFTO();
	if($catFto){
		$file = $catFto->getFile();
		$bg = $file->getPath2();
	}


	?>
	<div class="showImage" style="background-image: url(<?= $bg;?>); " >
		<div class="productSlide">
			<?php
			if(!empty($this->prodMaior)) {
				?>
				<a href="<?= $this->prodMaior->getURL(); ?>" class="prev"></a>
				<?php
			}
			$fto = $this->produto->getCNTFTO();
			?>
			<ul>
				<li>
					<a href=""><img src="<?=(!empty($fto))?$fto->getFile()->getFormat("250x380"):""?>" width="155" /></a>
					<div class="description">
						<h3><a href=""><?=$this->produto->CNT_TIT?></h3>
						<a href="/faq" class="button">FAQ</a>
						<a href="<?=$this->produto->getURL()?>/informacoes-nutricionais" class="button infoNutri">{Informacoes_Nutricionais}</a>
					</div>
				</li>
			</ul>
			<?php
			if(!empty($this->prodMenor)){
				?>
				<a href="<?=$this->prodMenor->getURL();?>" class="next"></a>
				<?php
			}
			?>

		</div>
	</div>
</header>
<!--  /Header -->

<!--  Content -->
<section id="insideContent">
	<div class="alignContent">
		<h1 class="txtCenter"><?=$this->categoria->CAT_NOM?></h1>
		<h3 class="txtCenter"><?=$this->categoria->CAT_DESC?></h3>
		<div class="txtCenter"><?=$this->categoria->CAT_TXT?></div>
	</div>
	<div class="rnnContent">
		<div class="alignContent">
			<h3 class="saibaMais">Saiba Mais</h3>
		</div>
		<?php $this->insertBlock("home", "receitas", array("produto" => $this->produto)); ?>

		<?php $this->insertBlock("home", "nutricao", array("produto" => $this->produto)); ?>

		<?php $this->insertBlock("home", "noticiasBlock", array( "produto" => $this->produto)); ?>
		<?php if(!HomeController::$hasSaibaMais){ ?>
			<script>$(".rnnContent .saibaMais").hide();</script>
		<?php } ?>

		<div class="alignContent">
			<div class="boxSettings">
				<nav>
					<a href="" class="star"></a>
					<a href="" class="down"></a>
					<a href="#" class="emailto"></a>
					<a href="/produtos-impressao/<?=Slugfy2($this->produto->CNT_TIT)."-".$this->produto->CNT_ID?>" class="print" target="_blank"></a>
				</nav>
				<div class="shareNote">
					<p>{Compartilhe}</p>
					<nav>
						<a href="" class="fa fa-facebook"></a>
						<a href="" class="fa fa-twitter"></a>
						<a href="" class="fa fa-google-plus"></a>
					</nav>
				</div>
			</div>
		</div>

		<?php
		$args = array("produto" => $this->produto);

		$this->insertBlock("home", "outrosProdutos", $args); ?>

	</div>
	</div>
</section>
