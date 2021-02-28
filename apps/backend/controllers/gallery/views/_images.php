<div>
	<a href="/" class="OpenMediaUploader bot" rel="createGaleryPage">Adicionar Imagens</a>
	<div id="ImagesRelations">
		<?php if(!empty($this->itens[0])){ ?>
		<?php foreach($this->itens as $item): ?>
		<fieldset class="imageRem">
			<a href="#" class="ImageRemoveIcn" title="{Remove}">{Remove}</a>
			<?php
				$file = $item->getFile();
			?>
			<img src="<?php echo($file->getFormat("100x100")); ?>" />
			<input type="hidden" name="<?php echo($this->container);?>[IMG_REL][IMG_ID][]" value="<?php echo($item->getARCAID());?>" />
			<input type="text" name="<?php echo($this->container);?>[IMG_REL][IMG_TIT][]" class="imgRelTit" value="<?php echo($item->getARCTIT());?>" placeholder="Título"/>
			<textarea name="<?php echo($this->container);?>[IMG_REL][IMG_TXT][]" class="imgRelTxt" placeholder="Texto"><?php echo($item->getARCTXT());?></textarea>
			<!-- <input type="text" name="<?php echo($this->container);?>[IMG_REL][IMG_TAGS][]" class="imgRelTag" value=""  placeholder="Tags" /> -->
		</fieldset>
		<?php endforeach; ?>
		<?php } ?>
		<!-- <fieldset class="imageRem">
					<a href="#" class="ImageRemoveIcn" title="{Remove}">{Remove}</a>
					<img src="/images/teste.jpg" />
					<input type="hidden" name="<?php echo($this->container);?>[IMG_REL][IMG_ID][]" value="1" />
					<input type="text" name="<?php echo($this->container);?>[IMG_REL][IMG_TIT][]" class="imgRelTit" value="" placeholder="Título"/>
					<textarea name="<?php echo($this->container);?>[IMG_REL][IMG_TXT][]" class="imgRelTxt" placeholder="Texto"></textarea>
					<input type="text" name="<?php echo($this->container);?>[IMG_REL][IMG_TAGS][]" class="imgRelTag" value=""  placeholder="Tags" />
				</fieldset>
				<fieldset class="imageRem">
					<a href="#" class="ImageRemoveIcn" title="{Remove}">{Remove}</a>
					<img src="/images/teste.jpg" />
					<input type="hidden" name="<?php echo($this->container);?>[IMG_REL][IMG_ID][]" value="1" />
					<input type="text" name="<?php echo($this->container);?>[IMG_REL][IMG_TIT][]" class="imgRelTit" value="" placeholder="Título"/>
					<textarea name="<?php echo($this->container);?>[IMG_REL][IMG_TXT][]" class="imgRelTxt" placeholder="Texto"></textarea>
					<input type="text" name="<?php echo($this->container);?>[IMG_REL][IMG_TAGS][]" class="imgRelTag" value=""  placeholder="Tags" />
				</fieldset>
				<fieldset class="imageRem">
					<a href="#" class="ImageRemoveIcn" title="{Remove}">{Remove}</a>
					<img src="/images/teste.jpg" />
					<input type="hidden" name="<?php echo($this->container);?>[IMG_REL][IMG_ID][]" value="1" />
					<input type="text" name="<?php echo($this->container);?>[IMG_REL][IMG_TIT][]" class="imgRelTit" value="" placeholder="Título"/>
					<textarea name="<?php echo($this->container);?>[IMG_REL][IMG_TXT][]" class="imgRelTxt" placeholder="Texto"></textarea>
					<input type="text" name="<?php echo($this->container);?>[IMG_REL][IMG_TAGS][]" class="imgRelTag" value=""  placeholder="Tags" />
				</fieldset>
				<fieldset class="imageRem">
					<a href="#" class="ImageRemoveIcn" title="{Remove}">{Remove}</a>
					<img src="/images/teste.jpg" />
					<input type="hidden" name="<?php echo($this->container);?>[IMG_REL][IMG_ID][]" value="1" />
					<input type="text" name="<?php echo($this->container);?>[IMG_REL][IMG_TIT][]" class="imgRelTit" value="" placeholder="Título"/>
					<textarea name="<?php echo($this->container);?>[IMG_REL][IMG_TXT][]" class="imgRelTxt" placeholder="Texto"></textarea>
					<input type="text" name="<?php echo($this->container);?>[IMG_REL][IMG_TAGS][]" class="imgRelTag" value=""  placeholder="Tags" />
				</fieldset>
				<fieldset class="imageRem">
					<a href="#" class="ImageRemoveIcn" title="{Remove}">{Remove}</a>
					<img src="/images/teste.jpg" />
					<input type="hidden" name="<?php echo($this->container);?>[IMG_REL][IMG_ID][]" value="1" />
					<input type="text" name="<?php echo($this->container);?>[IMG_REL][IMG_TIT][]" class="imgRelTit" value="" placeholder="Título"/>
					<textarea name="<?php echo($this->container);?>[IMG_REL][IMG_TXT][]" class="imgRelTxt" placeholder="Texto"></textarea>
					<input type="text" name="<?php echo($this->container);?>[IMG_REL][IMG_TAGS][]" class="imgRelTag" value=""  placeholder="Tags" />
				</fieldset> -->
	</div>
</div>