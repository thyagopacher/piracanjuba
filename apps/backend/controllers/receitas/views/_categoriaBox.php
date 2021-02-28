<!-- Tags -->
<div class="box">
	<h3>Categorias de receitas</h3>
	<div>
		<input type="text" id="catInsert" name="catInsert" rel="<?php echo($this->container); ?>" /><!-- <input type="button" class="addCat" value="{Add}" rel="<?php echo($this->container); ?>"/>-->
		<p></p>
		<ul class="catListAdd">
			<?php


			if(!empty($this->categorias[0])): ?>
				<?php foreach($this->categorias as $cat): ?>
			<li>
				<input type="hidden" name="<?php echo($this->container); ?>[cnt_cats][]" value="<?php echo($cat->getCATID()); ?>" /><span class="tag"><a href="#"><?php echo($cat->getCATNOM()); ?></a> <a href="#" class="removeTagBtn">X</a></span>
			</li>
				<?php endforeach; ?>
			<?php endif; ?>
		</ul>
	</div>
</div>
<!-- /Tags -->