<div class="showImage">
	<div class="productSlide">
		<ul>
			<li>
				<a href=""><img src="<?=$this->produto->getCNTFTO()->getFile()->getFormat("155x385")?>" width="155" /></a>
				<div class="description">
					<h3><a href=""><?=$this->produto->CNT_TIT?></a></h3>
				</div>
			</li>
		</ul>
	</div>
</div>
</header>
<!--  /Header -->

<!--  Content -->
<section id="insideContent">
	<div class="alignContent">
		<h1 class="txtCenter"><?=$this->categoria->CAT_NOM?></h1>
		<h3 class="txtCenter"><?=$this->categoria->CAT_DESC?></h3>
		<p class="txtCenter"><?=$this->categoria->CAT_TXT?></p>
	</div>
	<div class="rnnContent">
		<div class="alignContent">
			<h3 class="saibaMais">{Saiba_Mais}</h3>
		</div>
		<?php $this->insertBlock("home", "receitas", array("produto" => $this->produto)); ?>

		<?php $this->insertBlock("home", "nutricao", array("produto" => $this->produto)); ?>

		<?php $this->insertBlock("home", "noticiasBlock", array( "produto" => $this->produto)); ?>
		<?php if(!HomeController::$hasSaibaMais){ ?>
			<script>$(".rnnContent .saibaMais").hide();</script>
		<?php } ?>
	</div>
	</div>
</section>
