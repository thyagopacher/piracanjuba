<script>
	$(document).ready(function(){
		$(".buttonMore, .releaseMore").click(function(){
			var par = $(this).parent(".releaseMore");
			par.toggleClass("close");

			return false;
		});
	});
</script>

<!--  /Header -->

<!--  Content -->
<section id="insideContent">
	<div class="alignContent" id="introAPiracanjuba">
		<h1 class="txtCenter"><?=$this->conteudo[0]->DTQ_TIT;?></h1>
		<div class="txtContent">
			<?=$this->conteudo[0]->DTQ_TXT;?>
		</div>
		<div class="greyBox txtCenter" id="market">
			<h2><?=$this->conteudo[1]->DTQ_TIT;?></h2>
			<?=$this->conteudo[1]->DTQ_TXT;?>
		</div>
	</div>

	<div id="ContTabs" class="boxMvv valores">
		<div class="alignContent tabs">
			<nav>
				<?php
				$limit = (count($this->conteudo)<=4)?count($this->conteudo):4;
				for($i=2; $i<=$limit; $i++){ ?>
				<a href="#tab<?php echo($i-1); ?>"><?=$this->conteudo[$i]->DTQ_TIT;?></a>
				<?php } ?>
			</nav>
				<?php for($i=2; $i<=$limit; $i++){ ?>
					<span class="tab-<?php echo($i-1); ?>-"></span>
				<div id="tab<?php echo($i-1); ?>" class="tab">
					<h3 class="txtCenter"><?=$this->conteudo[$i]->DTQ_TXT;?></h3>
				</div>
			<?php } ?>

		</div>
	</div>
	</div>
	<h2 class="txtCenter" id="timeline">{Linha do tempo}</h2>
	<div class="timeline sliderPager">
		<nav class="pager">
			<?php
			$i = 0;
			foreach($this->timelineYears as $linha){

				//echo '<a href="" class="d'.$linha->CAT_NOM.' hover">'.$linha->CAT_NOM.'</a>';

				echo '<a href="" class="d'.Slugfy($linha->CAT_NOM).'">'.$linha->CAT_NOM.'</a>';

				$i++;

			}?>
			<!-- <a href="" class="d1955 hover">1955</a>
			<a href="" class="d1964">1964</a>
			<a href="" class="d1974">1974</a>
			<a href="" class="d1979">1979</a>
			<a href="" class="d1985">1985</a>
			<a href="" class="d1986">1986</a>
			<a href="" class="d1995">1995</a>
			<a href="" class="d1998">1998</a>
			<a href="" class="d2002">2002</a>
			<a href="" class="d2004">2004</a>
			<a href="" class="d2006">2006</a>
			<a href="" class="d2007">2007</a>
			<a href="" class="d2008">2008</a>-->
		</nav>
		<div class="greyBgcolor">
			<div class="alignContent">
				<a href="" class="prev"></a>
				<div class="mask">
				<ul class="item">

					<?php
					foreach($this->timelineYears as $linha){
						$contents = $linha->getConteudos("AN", 4);
						$i = 0;
						?>
						<li class="d<?=Slugfy(trim($linha->CAT_NOM))?>">
							<?php
							$sizes = array("258x245", "445x530", "258x245", "258x245");
						foreach($contents as $content){
							$fto = $content->getCNTFTO();
							if(!empty($fto)){
								$file = $fto->getFile();
							} else {
								$file = null;
							}
							$bg = "";
							if(!empty($file)){
								$bg = $file->getFormat($sizes[$i]);
							}

							if($i == 0){?>
								<div class="boxOne">
									<div class="colorOne"><h1><?php echo($linha->CAT_NOM); ?></h1></div>
									<div class="colorTwo  <?php echo((empty($bg)?"no-bg":"")); ?>" style="background-image: url('<?php echo($bg);?>')"><p><a class="ajaxedLightbox" href="<?php echo($content->getURL()); ?>"><?=$content->CNT_TIT?></a></p></div>
								</div>
							<?php } else if($i == 1){
								?>
									<div class="photo  <?php echo((empty($bg)?"no-bg":"")); ?>" style="background-image: url('<?=$bg;?>');"><p><a class="ajaxedLightbox" href="<?php echo($content->getURL()); ?>"><?php echo($content->CNT_TIT); ?></a></p></div>
							<?php } else if($i == 2){
								?>
									<div class="boxTwo">
										<div class="colorThree  <?php echo((empty($bg)?"no-bg":"")); ?>" style="background-image: url('<?php echo($bg);?>')"><p><a class="ajaxedLightbox" href="<?php echo($content->getURL()); ?>"><?=$content->CNT_TIT?></a></p></div>
							<?php } else if ($i == 3) { ?>
									<div class="colorFour <?php echo((empty($bg)?"no-bg":"")); ?>" style="background-image: url('<?php echo($bg);?>')"><p><a class="ajaxedLightbox" href="<?php echo($content->getURL()); ?>"><?=$content->CNT_TIT?></a></p></div>
							<?php }
								if(($i == 2 && count($contents) == 3) || $i == 3){ ?>
									</div>
								<?php }
								$i++;

						}?>
					</li>
						<?php
						/*
						?>
						<li class="d<?=$linha->DTQ_TIT?>">
							<div class="boxOne">
								<div class="colorOne"><h1><a href=""><?=$linha->DTQ_TIT?></a></h1></div>
								<div class="colorTwo"><p><a href=""><?=$linha->DTQ_CNL?></a></p></div>
							</div>
							<div class="photo" style="background-image: url(<?=$linha->getDTQFTO()->getFile()->getPath();?>);"><a href=""></a></div>
							<div class="boxTwo">
								<div class="colorThree"><a href=""><img src="<?=$linha->getDTQFTO2()->getFile()->getPath();?>" /></a></div>
								<div class="colorFour"><p><a href=""><?=$linha->DTQ_TXT?></a></p></div>
							</div>
						</li>
					<?php
					*/
					}?>
				</ul>
				</div>
				<a href="" class="next"></a>
			</div>
		</div>
	</div>
</section>
<!--  /Content -->
