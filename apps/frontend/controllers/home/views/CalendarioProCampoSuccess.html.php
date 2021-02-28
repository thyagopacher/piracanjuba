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
			<?php $this->insertBlock("home", "breadcrumb", array("LINKS" => array('/proCampoParceiros' => "Pró-Campo / Calendário"))); ?>
		</div>
	</div>
	<div class="showImage" style="background-image: url(<?=$this->destaques[0]->getDTQFTO()->getFile()->getPath2();?>);" ></div>
	<div class="txtCenter">
		<h3 class="txtSlogan"><?=$this->destaques[0]->DTQ_TIT?></h3>
	</div>

	<div class="alignContent">
		<nav class="pro-menu txtCenter">
			<a href="OqueeoProCampo">{O_que_e_o}<br/> {PROCAMPO}</a>
			<a href="PerguntasFrequentesProCampo">{Pergunta}<br/> {Frequentes}</a>
			<a href="EquipeProCampo">{Equipe}</a>
			<a href="ContatoProCampo">{Contato}</a>
			<a href="QualidadeDoLeitoProCampo">{Qualidade}<br/> {do_Leite}</a>
			<a href="CalendarioProCampo" class="hover">{Calendario}</a>
			<a href="proCampoParceiros">{Parceiros}</a>
		</nav>
	</div>
</header>
<!--  /Header -->

<section id="insideContent">
	<div class="alignContent">
		<h3 class="txtCenter">Calendário</h3>
		<div class="manual-download calendar">
			<ul>
				<div class="alignContent">
					<li>
						<div class="txtRight">
							<h3><a href="<?=$this->destaques[1]->DTQ_LNK?>"><?=$this->destaques[1]->DTQ_TIT?></a></h3>
							<p><a href="<?=$this->destaques[1]->DTQ_LNK?>"><?=$this->destaques[1]->DTQ_LTX?></a></p>
						</div>
						<a href="<?=$this->destaques[1]->DTQ_LNK?>"><img src="<?=$this->destaques[1]->getDTQFTO()->getFile()->getFormat("225x225");?>" width="225" height="225" /></a>
					</li>
					<li>
						<div class="txtLeft">
							<h3><a href="<?=$this->destaques[2]->DTQ_LNK?>"><?=$this->destaques[2]->DTQ_TIT?></a></h3>
							<p><a href="<?=$this->destaques[2]->DTQ_LNK?>"><?=$this->destaques[2]->DTQ_LTX?></a></p>
						</div>
						<a href="<?=$this->destaques[2]->DTQ_LNK?>"><img src="<?=$this->destaques[2]->getDTQFTO()->getFile()->getFormat("225x225");?>" width="225" height="225" /></a>
					</li>
					<li>
						<div class="txtRight">
							<h3><a href="<?=$this->destaques[3]->DTQ_LNK?>"><?=$this->destaques[3]->DTQ_TIT?></a></h3>
							<p><a href="<?=$this->destaques[3]->DTQ_LNK?>"><?=$this->destaques[3]->DTQ_LTX?></a></p>
						</div>
						<a href="<?=$this->destaques[3]->DTQ_LNK?>"><img src="<?=$this->destaques[3]->getDTQFTO()->getFile()->getFormat("225x225");?>" width="225" height="225" /></a>
					</li>
					<li>
						<div class="txtLeft">
							<h3><a href="<?=$this->destaques[4]->DTQ_LNK?>"><?=$this->destaques[4]->DTQ_TIT?></a></h3>
							<p><a href="<?=$this->destaques[4]->DTQ_LNK?>"><?=$this->destaques[4]->DTQ_LTX?></a></p>
						</div>
						<a href="<?=$this->destaques[4]->DTQ_LNK?>"><img src="<?=$this->destaques[4]->getDTQFTO()->getFile()->getFormat("225x225");?>" width="225" height="225" /></a>
					</li>
					<li>
						<div class="txtRight">
							<h3><a href="<?=$this->destaques[5]->DTQ_LNK?>"><?=$this->destaques[5]->DTQ_TIT?></a></h3>
							<p><a href="<?=$this->destaques[5]->DTQ_LNK?>"><?=$this->destaques[5]->DTQ_LTX?></a></p>
						</div>
						<a href="<?=$this->destaques[5]->DTQ_LNK?>"><img src="<?=$this->destaques[5]->getDTQFTO()->getFile()->getFormat("225x225");?>" width="225" height="225" /></a>
					</li>
					<li>
						<div class="txtLeft">
							<h3><a href="<?=$this->destaques[6]->DTQ_LNK?>"><?=$this->destaques[6]->DTQ_TIT?></a></h3>
							<p><a href="<?=$this->destaques[6]->DTQ_LNK?>"><?=$this->destaques[6]->DTQ_LTX?></a></p>
						</div>
						<a href="<?=$this->destaques[6]->DTQ_LNK?>"><img src="<?=$this->destaques[6]->getDTQFTO()->getFile()->getFormat("225x225");?>" width="225" height="225" /></a>
					</li>
				</div>
			</ul>
		</div>

	</div>
	<div class="contentFull-bgcolor">
		<div class="manual-download">
			<div class="alignContent">
				<ul>
					<li>
						<div class="txtRight">
							<h3><a href="<?=$this->destaques[7]->DTQ_LNK?>"><?=$this->destaques[7]->DTQ_TIT?></a></h3>
							<p><a href="<?=$this->destaques[7]->DTQ_LNK?>"><?=$this->destaques[7]->DTQ_LTX?></a></p>
						</div>
						<a href="<?=$this->destaques[7]->DTQ_LNK?>"><img src="<?=$this->destaques[7]->getDTQFTO()->getFile()->getFormat("225x225");?>" width="225" height="225" /></a>
					</li>
					<li>
						<div class="txtLeft">
							<h3><a href="<?=$this->destaques[8]->DTQ_LNK?>"><?=$this->destaques[8]->DTQ_TIT?></a></h3>
							<p><a href="<?=$this->destaques[8]->DTQ_LNK?>"><?=$this->destaques[8]->DTQ_LTX?></a></p>
						</div>
						<a href="<?=$this->destaques[8]->DTQ_LNK?>"><img src="<?=$this->destaques[8]->getDTQFTO()->getFile()->getFormat("225x225");?>" width="225" height="225" /></a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</section>
