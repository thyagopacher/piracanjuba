<?php 
if(!empty($this->item)): 
	$item = $this->item;
?>
<div class="formEdit">
	<form action="<?php echo($_SERVER['REDIRECT_URL']); ?>?ID=<?php echo($item->getlivroid()); ?>" method="post">
		<input type="hidden" name="book[livroid]" value="<?php echo($item->getlivroid()); ?>" />
		<label for="msg_nom">{Name}</label><input type="text" name="book[nome]" id="msg_nom" value="<?php echo($item->getnome()); ?>"/>
		<label for="msg_ema">{acronym}</label><input type="text" name="book[sigla]" id="msg_ema" value="<?php echo($item->getsigla()); ?>"/>
		<?php 
		$opts = array("" => "Selecione um testamento");
		if(!empty($this->tests[0])){
			foreach($this->tests as $test)
			{
				$opts[$test->gettestamentoid()] = $test->getnome();
			}
		}
		$select = new FuriousSelect("testamentoid", "{Testament}", $opts);
		$select->setFormContainer("book");
		if($item->gettestamentoid())
		{
			$select->setValue($item->gettestamentoid());
		}
		echo($select);
		?>
		<input type="reset" value="{Clean}" class="alignLeft"><input type="submit" value="{Submit}" class="alignRight" />
	</form>
	</form>
</div>
<?php endif; ?>