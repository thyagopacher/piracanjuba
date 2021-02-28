
<!--  /Header -->
<?php
$links = $this->conteudo->getLinks();
?>
<!--  Content -->
<section id="insideContent">
	<div class="alignContent">
		<!--<h3 class="txtCenter"><?=$this->conteudo->CNT_TIT?></h3>-->
		<div class="txtContent">
			<?=$this->conteudo->CNT_TXT?>

		</div>
		<?php
		$links = $this->conteudo->getLinks();
		if(!empty($links[0])){
		?>
		<nav class="greyBox">
				<?php foreach($links as $link){ ?>
					<a href="<?=$link->getLNKLNK()?>" target="_blank"><h4><?=$link->LNK_TIT?></h4></a>
				<?php } ?>
		</nav>
		<?php } ?>
	</div>
</section>
