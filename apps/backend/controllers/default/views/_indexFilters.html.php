<form action="<?php echo($_SERVER['REQUEST_URI']); ?>" method="get">
	<fieldset>
		<legend class="hidden">{Search}</legend>
		<label for="q">{Search}</label>
		<input type="text" id="q" name="q" <?php if(!empty($this->filters['q'])){ echo(" value=\"{$this->filters['q']}\"");}?> />
		<input type="checkbox" id="publishedSearch" name="publishedSearch" value="1" <?php if(!empty($this->filters['publishedSearch'])){ echo(" checked=\"checked\"");}?>/><label for="publishedSearch" class="no-points">{Published}</label>
		<input type="checkbox" id="notpublishedSearch" name="notpublishedSearch" value="0" <?php if(isset($this->filters['notpublishedSearch'])){ echo(" checked=\"checked\"");}?>/><label for="notpublishedSearch" class="no-points">{Not Published}</label>
		<!-- <input type="checkbox" id="pendantSearch" name="filters[pendantSearch]" /><label for="pendantSearch" class="no-points">Pendente</label>-->
		<input type="submit" value="{Ok}" />
	</fieldset>
</form>