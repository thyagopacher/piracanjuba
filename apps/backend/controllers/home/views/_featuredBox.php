<!-- Blocos -->
<div id="FeaturedBlock" class="box">
	<h3>{Blocks (Edit Home)}</h3>
	<div>
		<input type="hidden" name="featured[CONTENT_LINK]" value="<?php echo($this->content->getURL());?>" />
		
		<?php $select = new FuriousSelect("site", "{Site}", $this->itens, array("class" => "SiteAreas")); $select->setFormContainer("featured"); echo($select); ?>
		<!--<label for="site">Site</label>
		<select name="site" id="site">
			<option value="iurd.org">IURD</option>
		</select>-->
		<?php $select = new FuriousSelect("area", "{Area}", array("" => ""), array("class" => "SelectArea")); $select->setFormContainer("featured"); echo($select); ?>
		
		<p class="rightTxt"><a href="#" class="bot addButton">{Add}</a></p>
		
		<div class="hr"><hr /></div>
		<!--
		<input type="radio" name="hideShowBlock1" id="hideShowBlock1" value="on"  class="hidden-check" checked="checked"/>
		<fieldset class="blockForm">
			
			<legend><label for="hideShowBlock1" class="no-points">Sub Chamada Home 1</label></legend>
			
			<label for="order">Ordem</label>
			<input type="text" class="small-input" id="order" name="order" />
			<br />
			<label for="chapeu">Chapéu</label>
			<input type="text" id="chapeu" name="chapeu" />
			<br />
			<label for="titulo">Título</label>
			<input type="text" id="titulo" name="titulo" />
			<br />
			<label for="texto">Texto</label>
			<input type="text" id="texto" name="texto" />
			<br />
			<label for="image">Imagem</label>
			<input type="file" id="image" name="image" />
			<br />
			<div class="hr">
				<hr />
			</div>
		</fieldset>
		<input type="radio" name="hideShowBlock1" id="hideShowBlock2" value="on"  class="hidden-check"/>
		<fieldset class="blockForm">
			<legend><label for="hideShowBlock2" class="no-points">Sub Chamada Home 2</label></legend>
			
			<label for="order">Ordem</label>
			<input type="text" class="small-input" id="order" name="order" />
			<br />
			<label for="chapeu">Chapéu</label>
			<input type="text" id="chapeu" name="chapeu" />
			<br />
			<label for="titulo">Título</label>
			<input type="text" id="titulo" name="titulo" />
			<br />
			<label for="texto">Texto</label>
			<input type="text" id="texto" name="texto" />
			<br />
			<label for="image">Imagem</label>
			<input type="file" id="image" name="image" />
			<br />
			<div class="hr">
				<hr />
			</div>
		</fieldset>
		-->
		
		
	</div>
</div>
<!-- /Blocos -->