<!-- Tags -->
<div class="box">
	<h3>{Tags}</h3>
	<div>
		<input type="text" id="tagsInsert" name="tagsInsert" rel="<?php echo($this->container); ?>" /><input type="button" class="addTag" value="{Add}" rel="<?php echo($this->container); ?>"/>
		<p><em>{it separates tags with comma}</em></p>
		<ul class="taglistAdd">
			<?php if(!empty($this->tags[0])): ?>
				<?php foreach($this->tags as $tag): ?>
			<li>
				<input type="hidden" name="<?php echo($this->container); ?>[cnt_tags][]" value="<?php echo($tag->getTAGID()); ?>" /><span class="tag"><a href="#"><?php echo($tag->getTAGNOM()); ?></a> <a href="#" class="removeTagBtn">X</a></span>
			</li>
				<?php endforeach; ?>
			<?php endif; ?>
		</ul>
	</div>
</div>
<!-- /Tags -->