<!-- Tags -->
<div class="box">
	<h3>Produtos</h3>
	<div>
		<input type="text" id="prodsInsert" name="prodsInsert" rel="<?php echo($this->container); ?>" />
		<input type="button" class="addProd" value="{Add}" rel="<?php echo($this->container); ?>"/>
		<p></p>
		<ul class="prodlistAdd">
			<?php if(!empty($this->produtos[0])): ?>
				<?php foreach($this->produtos as $prod): ?>
			<li>
				<input type="hidden" name="<?php echo($this->container); ?>[cnt_prods][]" value="<?php echo($prod->getCNTID()); ?>" /><span class="tag"><a href="#"><?php echo($prod->getCNTTIT()); ?></a> <a href="#" class="removeProdBtn">X</a></span>
			</li>
				<?php endforeach; ?>
			<?php endif; ?>
		</ul>
	</div>
</div>
<!-- /Tags -->