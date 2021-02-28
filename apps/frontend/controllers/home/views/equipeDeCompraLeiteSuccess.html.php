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
