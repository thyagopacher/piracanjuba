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
			<h2>{Releases}</h2>
			<p class="topSlogan">{WE_LOVE_DO_THE_BEST}</p>
			<p class="breadCrumb"><strong>{YOU_ARE_HERE}:</strong>  <a href="#">{Pagina_Principal}</a> / <a href="#">{A_Piracanjuba}</a> / <a href="#">{Releases}</a> / <a href="#">{Piracanjuba na Mídia}</a></p>
		</div>
	</div>
	<div class="showImage" style="background-image: url(<?=APP_JS_PREFIX?>images/_imgMedia.jpg);" ></div>
	<div class="txtCenter">
		<h3 class="txtSlogan">{Confira aqui todos os releases e novidades da empresa e seus produtos}..</h3>
	</div>
</header>
<section id="insideContent">
	<div class="alignContent">
		<div class="releaseSearch">
			<form action="" method="POST">
				<input name="releaseSearch" type="text" placeholder="{FAÇA SUA BUSCA DIGITANDO AQUI}" />
				<button name="releaseSubmit" type="submit"></button>
			</form>
		</div>

		<ul class="releaseList">


			<?php
			if(!empty($this->noticias[0])) {
				foreach ($this->noticias as $noticia) {

					?>
					<li>
						<div class="releaseDate">
							<h2>13</h2>
							<p>JAN</p>
							<span>2015</span>
						</div>
						<div class="releaseDescription">
							<h3><?= $noticia->CNT_TIT ?></h3>
							<p><?= $noticia->CNT_RES ?></p>
							<div class="releaseMore">
								<div class="txtLeft">
									<?= $noticia->CNT_TXT ?>
								</div>
								<p><span>{Fonte}: <a href=""><?= $noticia->CNT_OLH ?></a></span></p>
								<div class="txtLeft">
									<div class="boxSettings">
										<nav>
											<a href="" class="star"></a>
											<a href="" class="save"></a>
											<a href="" class="emailto"></a>
											<a href="" class="print"></a>
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
								<a href="" class="buttonMore"></a>
							</div>
						</div>
					</li>
				<?php }
			}?>
		</ul>



		<?php $this->includePartial("default", "pagination"); ?>


	</div>

	<div class="assessoria">
		<p><strong>Assessoria de Imprensa Link Comunicação</strong></p>
		<p>Contato: Juliana Morato</p>
		<p>Email: juliana.morato@linkcomunicacao.com.br</p>
		<p>Telefones: (31) 2126-8072 / (31) 9809 3471 / (31) 9815-5467</p>
	</div>
</section>
  