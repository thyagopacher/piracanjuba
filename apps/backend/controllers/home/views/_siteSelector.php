<?php if(!empty($this->itens[0])): ?>
<!-- Menu Select -->
<label class="selectMenu selectSite alignRight" for="menuSelect2"> 
	<span>&nbsp;</span>
	<select name="menuSelect2" id="menuSelect2">
		<option value="">Selecione um site</option>
		<?php foreach($this->itens as $produto): ?>
		<option <?php if(!empty($this->siteSel) && $this->siteSel->getPDTID() == $produto->getPDTID()){echo(" selected=\"selected\" ");}?> value="<?php printf("%s%s-%s/", APP_WEB_PREFIX, $produto->getPDTID(), Slugfy($produto->getPDTNOM())); ?>"><?php echo($produto->getPDTNOM()); ?></option>
		<?php endforeach; ?>
	</select>
</label>
<!-- /Menu Select -->
<?php endif; ?>