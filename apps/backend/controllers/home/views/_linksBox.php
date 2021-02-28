<!-- Links Relacionados -->
<div class="box" id="relatedLinks">
	<h3><?php echo($this->title); ?></h3>
	<div>
		<p class="rightTxt"><a href="#" class="addLinkBtn"><?php echo($this->labels['ADD_BUTTON']); ?></a></p>
		<?php
			$i=0;
			if(!empty($this->links[0])):
			foreach($this->links as $link):?>
			<fieldset class="linksAddFieldset">
				<a href="#" class="removeLinkBtn"><?php echo($this->labels['REMOVE_BUTTON']); ?></a>
				<label for="cnt_lnk1txt"><?php echo($this->labels['TITLE']); ?></label>
				<input type="text" name="<?php echo($this->container); ?>[CNT_LINK][<?php echo($i); ?>][TXT]" id="cnt_lnk<?php echo($i); ?>txt" value="<?php echo($link->getLNKTIT()); ?>" />
				<br />
				<?php if(!empty($this->labels['LINK'])): ?>
				<label for="cnt_lnk1lnk"><?php echo($this->labels['LINK']); ?></label>
				<?php if($this->title != 'Perguntas e Respostas'): ?>
				<input type="text" id="cnt_lnk<?php echo($i); ?>lnk" name="<?php echo($this->container); ?>[CNT_LINK][<?php echo($i); ?>][LNK]" value="<?php echo($link->getLNKLNK()); ?>"/>
				<button class="add_file_url" type="button" rel="cnt_lnk<?php echo($i); ?>lnk">{ADD_FILE_URL}</button>
				<?php else: ?>
					<textarea id="cnt_lnk<?php echo($i); ?>lnk" name="<?php echo($this->container); ?>[CNT_LINK][<?php echo($i); ?>][LNK]"><?php echo($link->getLNKLNK()); ?></textarea>
				<?php endif; ?>
				<?php endif; ?>
				<br />
			</fieldset>
			<?php
			$i++;
			endforeach;
		endif; ?>
		<fieldset class="linksAddFieldset">
			<a href="#" class="removeLinkBtn"><?php echo($this->labels['REMOVE_BUTTON']); ?></a>
			<label for="cnt_lnk<?php echo($i); ?>txt"><?php echo($this->labels['TITLE']); ?></label>
			<input type="text" name="<?php echo($this->container); ?>[CNT_LINK][<?php echo($i); ?>][TXT]" id="cnt_lnk<?php echo($i); ?>txt" name="cnt_lnk<?php echo($i); ?>txt" value="" />
			<br />
			<?php if(!empty($this->labels['LINK'])): ?>
				<label for="cnt_lnk<?php echo($i); ?>lnk"><?php echo($this->labels['LINK']); ?></label>
			<?php if($this->title != 'Perguntas e Respostas'): ?>
			<input type="text" name="<?php echo($this->container); ?>[CNT_LINK][<?php echo($i); ?>][LNK]" id="cnt_lnk<?php echo($i); ?>lnk" name="cnt_lnk<?php echo($i); ?>lnk" value=""/>
			<button class="add_file_url" type="button" rel="cnt_lnk<?php echo($i); ?>lnk">{ADD_FILE_URL}</button>
			<?php else: ?>
				<textarea name="<?php echo($this->container); ?>[CNT_LINK][<?php echo($i); ?>][LNK]" id="cnt_lnk<?php echo($i); ?>lnk" name="cnt_lnk<?php echo($i); ?>lnk"></textarea>
			<?php endif; ?>
			<?php endif; ?>
			<br />
		</fieldset>

	</div>
</div>
<!-- /Links Relacionados -->
