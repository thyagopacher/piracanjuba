<?php 
if(!empty($this->item)): 
	$item = $this->item;
?>
<div class="formEdit">
	<form action="<?php echo($_SERVER['REDIRECT_URL']); ?>?ID=<?php echo($item->gettextoid()); ?>" method="post" id="formVersicle">
		<input type="hidden" name="text[textoid]" value="<?php echo($item->gettextoid()); ?>" />
		<table>
			<tr>
				<td style="width: 130px; ">
					<?php $opts = array("" => "Selecione um livro"); if(!empty($this->books[0])){ foreach($this->books as $book){$opts[$book->getlivroid()] = $book->getnome(); }} $select = new FuriousSelect("livroid", "{Book}", $opts); $select->setFormContainer("text"); $select->setFormatRender("%INPUT%"); if($item->getlivroid()){$select->setValue($item->getlivroid());} echo($select); ?><br />
					<label>Cap:Ver</label> <input type="text" name="text[capitulo]" id="chapter" value="<?php if($item->getcapitulo()){echo($item->getcapitulo());} ?>"/> : <input type="text" name="text[versiculo]" id="versicle" value="<?php if($item->getversiculo()){echo($item->getversiculo());} ?>"/>
				</td>
				<td style="width: 500px; ">
					<textarea name="text[texto]"><?php if($item->gettexto()){echo($item->gettexto()); }?></textarea>
					<input type="reset" value="{Cancel}" class="alignLeft"><input type="submit" value="{Submit}" class="alignRight" />
				</td>
				<td>&nbsp;</td>
			</tr>
		</table>
		
	</form>
	</form>
</div>
<?php endif; ?>