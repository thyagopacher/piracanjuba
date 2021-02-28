<div class="hr">
	<hr />
</div>
<input type="radio" name="hideShowBlock1" id="hideShowBlock1" value="on"  class="hidden-check" checked="checked"/>
<fieldset class="blockForm">
	<legend><label for="hideShowBlock1" class="no-points"><?php echo($this->itens->getMNUTIT()); ?></label></legend>
	
	<label>{Order}</label>
	<input type="text" class="small-input" name="featured[<?php echo($this->EditorialID); ?>][<?php echo($this->type); ?>][DTQ_ORD]" />
	<br />
	
	<label>{Title}</label>
	<input type="text" name="featured[<?php echo($this->EditorialID); ?>][<?php echo($this->type); ?>][DTQ_TIT]" />
	<br />
	
	
	<?php if($this->itens->getMNUCHP() == 1): ?>
	<label>{Intro}</label>
	<input type="text" name="featured[<?php echo($this->EditorialID); ?>][<?php echo($this->type); ?>][DTQ_CNL]" />
	<br />
	<?php endif; ?>
	
	
	<?php if($this->itens->getMNUTXT() == 1 || $this->itens->getMNUWRD() == 1): ?>
	<label>{Text}</label>
	<textarea name="featured[<?php echo($this->EditorialID); ?>][<?php echo($this->type); ?>][DTQ_TXT]"></textarea>
	<br />
	<?php endif; ?>
	
	<?php if($this->itens->getMNULIN() == 1): ?>
	<label>{Link}</label>
	<input type="text" name="featured[<?php echo($this->EditorialID); ?>][<?php echo($this->type); ?>][DTQ_LNK]" />
	<br />
	<?php endif; ?>
	
	<?php if($this->itens->getMNUTGT() == 1): ?>
	<label>{Target}</label>
	<select name="featured[<?php echo($this->EditorialID); ?>][<?php echo($this->type); ?>][DTQ_TGT]">
		<option value="_self">_self</option>
		<option value="_blank">_blank</option>
	</select>
	<br />
	<?php endif; ?>
	
	<?php if($this->itens->getMNUIMG() == 1): ?>
	<label>{Thumbnail}</label>
	<input type="hidden" name="featured[<?php echo($this->EditorialID); ?>][<?php echo($this->type); ?>][DTQ_IMG]" class="previewImage" />
	<a href="#" class="bot selectPrevImage">Selecionar Imagem</a>
	<br />
	<?php endif; ?>
	
	<?php if($this->itens->getMNULN2() == 1): ?>
	<label>{Link2}</label>
	<input type="text" name="featured[<?php echo($this->EditorialID); ?>][<?php echo($this->type); ?>][DTQ_LN2]" />
	<br />
	<?php endif; ?>
	
	<?php if($this->itens->getMNULTX() == 1): ?>
	<label>{Link2 Text}</label>
	<input type="text" name="featured[<?php echo($this->EditorialID); ?>][<?php echo($this->type); ?>][DTQ_LTX]" />
	<br />
	<?php endif; ?>
	
	<?php if($this->itens->getMNUIRE() == 1): ?>
	<label>{Content Related}</label>
	<input type="text" name="featured[<?php echo($this->EditorialID); ?>][<?php echo($this->type); ?>][DTQ_IRE]" />
	<br />
	<?php endif; ?>
	
	<?php if($this->itens->getMNUCAT() == 1): ?>
	<label>{Category Related}</label>
	<input type="text" name="featured[<?php echo($this->EditorialID); ?>][<?php echo($this->type); ?>][DTQ_CAT]" />
	<br />
	<?php endif; ?>
	
	<?php if($this->itens->getMNUDTA() == 1): ?>
	<label>{Date}</label>
	<input type="text" name="featured[<?php echo($this->EditorialID); ?>][<?php echo($this->type); ?>][DTQ_DTA]" placeholder="dd/mm/YYYY hh:mm:ss"/>
	<br />
	<?php endif; ?>
	
	
	<label>{Date}</label>
	<input type="text" name="featured[<?php echo($this->EditorialID); ?>][<?php echo($this->type); ?>][DTQ_INI]" value="<?php echo(date("d/m/Y H:i:s")); ?>" />
	<br />
	
	<label>{Final Date}</label>
	<input type="text" name="featured[<?php echo($this->EditorialID); ?>][<?php echo($this->type); ?>][DTQ_FIM]" value="<?php echo(date("d/m/Y H:i:s")); ?>" />
	<br />
	
	<!-- <label></label> -->
	<input type="hidden" name="featured[<?php echo($this->EditorialID); ?>][<?php echo($this->type); ?>][DTQ_STS]" value="1" />
	<br />
	
	<input type="hidden" name="featured[<?php echo($this->EditorialID); ?>][<?php echo($this->type); ?>][DTQ_EDT]" value="<?php echo($this->EditorialID); ?>" />
	
	<input type="hidden" name="featured[<?php echo($this->EditorialID); ?>][<?php echo($this->type); ?>][DTQ_TIP]" value="<?php echo($this->type); ?>" />
	
	<br />
	<p><a href="#" class="bot previewFeatured">{Preview}</a>  <a href="#" class="bot removeFeatured">{Delete}</a></p>
	<div class="hr">
		<hr />
	</div>
</fieldset>