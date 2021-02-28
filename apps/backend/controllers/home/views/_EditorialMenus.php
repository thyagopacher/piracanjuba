<!-- Menu Select -->
<label class="selectMenu" id="menuSel" for="menuSelect"> 
	<span>&nbsp;</span>
	<select name="menuSelect" id="menuSelect">
		<option value="<?php printf("%s%s-%s/", APP_WEB_PREFIX, $this->siteSel->getPDTID(), Slugfy($this->siteSel->getPDTNOM())); ?>"><?=$this->siteSel->getPDTNOM()?></option>
		<?php foreach($this->itens as $key => $item): ?>
		<option <?php if(!empty($this->EditorialID) && $this->EditorialID == $key){echo(" selected=\"selected\" "); }?>value="<?php printf("%s%s-%s/", APP_WEB_PREFIX, $key, str_replace("&nbsp;", "", Slugfy($item))); ?>"><?php echo($item); ?></option>
		<?php endforeach; ?>
	</select>
</label>
<!-- /Menu Select -->