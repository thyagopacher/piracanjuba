<!-- Tags -->
<div class="box">
	<h3>Categorias de dicas</h3>
	<div>
		<input type="text" id="catDicasInsert" name="catDicasInsert" rel="<?php echo($this->container); ?>" />
		<input type="button" class="addCatDicas" value="{Add}" rel="<?php echo($this->container); ?>"/>
		<p></p>
		<ul class="catDicasListAdd">
			<?php
			if(!empty($this->produtos[0])): ?>
				<?php foreach($this->produtos as $cat): ?>
			<li>
				<input type="hidden" name="<?php echo($this->container); ?>[cnt_cats][]" value="<?php echo($cat->getCATID()); ?>" /><span class="tag"><a href="#"><?php echo($cat->getCATNOM()); ?></a> <a href="#" class="removeCatDicaBtn">X</a></span>
			</li>
				<?php endforeach; ?>
			<?php endif; ?>
		</ul>
	</div>
</div>
<!-- /Tags -->
