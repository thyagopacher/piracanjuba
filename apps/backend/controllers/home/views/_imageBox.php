<!-- Imagem Thumb -->
<div id="featuredImage" class="box">
	<h3><?php echo($this->title); ?></h3>
	<div>
		<?php
		$id = "";

		if(!empty($this->imgCnt[0])):
			$this->imgCnt = $this->imgCnt[0];
			$img = $this->imgCnt->getFormat("100x100");
			$id = $this->imgCnt->getId();
		?>

		<a href="#" class="OpenMediaUploader" rel="useAsThumbPage">
			<img src="<?php echo($img); ?>" class="ftdImage"/>
		</a>
		<p><a href="#" class="OpenMediaUploader removeImg" rel="useAsThumbPage"><?php echo($this->removeText); ?></a></p>
		<?php else: ?>
			<p><a href="#" class="OpenMediaUploader bot" rel="useAsThumbPage"><?php echo($this->addText); ?></a></p>
		<?php endif; ?>
		<input type="hidden" name="<?php echo($this->container); ?>[<?php echo($this->fName); ?>]" class="IDThumbNailImage" value="<?php echo($id); ?>" />
	</div>
</div>
<!-- /Imagem Thumb -->
