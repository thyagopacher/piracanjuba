<script>
	$(document).ready(function(){
		$(".buttonMore, .releaseMore").click(function(){
			var par = $(this).parent(".releaseMore");
			par.toggleClass("close");

			return false;
		});
	});
</script>


<header id="insideHeader">
	<div class="insideWaves">
		<div class="insideTop">
			<h2>{PROCAMPO}</h2>
			<p class="topSlogan">{WE_LOVE_DO_THE_BEST}</p>
			<?php $this->insertBlock("home", "breadcrumb", array("LINKS" => array('/proCampoParceiros' => "Pró-Campo / O que é o Pró-Campo	"))); ?>
		</div>
	</div>
	<div class="showImage" style="background-image: url(<?=$this->destaques[0]->getDTQFTO()->getFile()->getPath2();?>);" ></div>
	<div class="txtCenter">
		<h3 class="txtSlogan"><?=$this->destaques[0]->DTQ_TIT?></h3>
	</div>

	<div class="alignContent">
		<nav class="pro-menu txtCenter">
			<a href="OqueeoProCampo" class="hover">{O_que_e_o}<br/> {PROCAMPO}</a>
			<a href="PerguntasFrequentesProCampo">{Pergunta}<br/> {Frequentes}</a>
			<a href="EquipeProCampo">{Equipe}</a>
			<a href="ContatoProCampo">{Contato}</a>
			<a href="QualidadeDoLeitoProCampo">{Qualidade}<br/> {do_Leite}</a>
			<a href="CalendarioProCampo">{Calendario}</a>
			<a href="proCampoParceiros">{Parceiros}</a>
		</nav>
	</div>
</header>
<!--  /Header -->

<section id="insideContent">
	<div class="alignContent">
		<h3 class="txtCenter"><?=$this->destaques[1]->DTQ_TIT?></h3>
		<div class="txtContent">
			<?=$this->destaques[1]->DTQ_TXT?>
		</div>
	</div>
	<div class="processContent">
		<div class="alignContent">
			<p class="txtCenter"><img src="<?=$this->destaques[1]->getDTQFTO()->getFile()->getFormat("225x225");?>" width="225" height="225" /></p>
			<div class="process">
				<nav>
					<a href="<?=$this->destaques[2]->DTQ_LNK?>"><h3><?=$this->destaques[2]->DTQ_TIT?></h3></a>
					<a href="#" class="hover"><h3><?=$this->destaques[2]->DTQ_CNL?></h3></a>
				</nav>
			</div>
		</div>
		<div class="processContent">
			<div class="alignContent">
				<h3 class="txtCenter"><?=$this->destaques[2]->DTQ_CNL?></h3>
				<div class="txtContent">
					<?=$this->destaques[2]->DTQ_TXT?>
				</div>
			</div>
			<div class="diagramContent">
				<div class="alignContent txtCenter">
					<h3><?=$this->destaques[3]->DTQ_TIT?></h3>
					<?=$this->destaques[3]->DTQ_TXT?>
					<img src="<?=$this->destaques[3]->getDTQFTO()->getFile()->getPath2();?>" />
				</div>
			</div>

			<div class="alignContent">
				<h3 class="txtCenter"><?=$this->destaques[6]->DTQ_TIT?></h3>
				<div class="txtContent txtCenter">
					<?=$this->destaques[6]->DTQ_TXT?>
				</div>
			</div>
			<ul class="processList">
				<li>
					<div class="photo" style="background-image: url(<?=$this->destaques[7]->getDTQFTO()->getFile()->getPath2();?>);"></div>
					<div class="description">
						<div>
							<?=$this->destaques[7]->DTQ_TXT?>
						</div>
					</div>
				</li>
				<li>
					<div class="photo" style="background-image: url(<?=$this->destaques[8]->getDTQFTO()->getFile()->getPath2();?>);"></div>
					<div class="description">
						<div>
							<h3><?=$this->destaques[8]->DTQ_TIT?></h3>
							<?=$this->destaques[8]->DTQ_TXT?>
						</div>
					</div>
				</li>
				<li>
					<div class="photo" style="background-image: url(<?=$this->destaques[9]->getDTQFTO()->getFile()->getPath2();?>);"></div>
					<div class="description">
						<div>
							<h3><?=$this->destaques[9]->DTQ_TIT?></h3>
							<?=$this->destaques[9]->DTQ_TXT?>
						</div>
					</div>
				</li>
				<li>
					<div class="photo" style="background-image: url(<?=$this->destaques[10]->getDTQFTO()->getFile()->getPath2();?>);"></div>
					<div class="description">
						<div>
							<h3><?=$this->destaques[10]->DTQ_TIT?></h3>
							<?=$this->destaques[10]->DTQ_TXT?>
						</div>
					</div>
				</li>
			</ul>

			<div class="alignContent">
				<h3 class="txtCenter"><?=$this->destaques[11]->DTQ_TIT?></h3>
				<div class="txtContent txtCenter">
					<?=$this->destaques[11]->DTQ_TXT?>
				</div>
			</div>

		</div>
	</div>

	<div class="manual-download">
		<div class="alignContent">
			<ul>
				<li>
					<div class="txtRight">
						<h3><a href=""><?=$this->destaques[5]->DTQ_TIT?></a></h3>
						<p><a href=""><?=$this->destaques[5]->DTQ_LTX?></a></p>
					</div>
					<a href="<?=$this->destaques[5]->DTQ_LNK?>"><img src="<?=$this->destaques[5]->getDTQFTO()->getFile()->getFormat("225x225");?>" width="225" height="225" /></a>
				</li>
				<li>
					<div class="txtLeft">
						<h3><a href=""><?=$this->destaques[6]->DTQ_TIT?></a></h3>
						<p><a href=""><?=$this->destaques[6]->DTQ_LTX?></a></p>
					</div>
					<a href="<?=$this->destaques[6]->DTQ_LNK?>"><img src="<?=$this->destaques[6]->getDTQFTO()->getFile()->getFormat("225x225");?>" width="225" height="225" /></a>
				</li>
			</ul>
		</div>
	</div>

</section>
