<div id="forumNew" class="align <?php if(empty($this->user)){echo("noBar");}?>">
	
	<div class="div-laranja">
		<div class="align-laranja">
			<?php $this->insertBlock("login", "userBar"); ?>
		</div>
	</div>
	
	<div class="div-cinza">
		<div class="align-cinza">
			<span class="titulo forum">Forum</span>
		</div>
		<div class="bg-post-principal">
			<div class="align-cinza">
				<form action="/<?php echo(APP_LANGUAGE);?>/forum/new" method="POST" id="formQuestion">
					<fieldset>
						<legend class="hidden">{New Topic}</legend>
						<label for="title">{Title}:</label><br />
						<input type="text" name="topic[title]" id="title" /><br />
						<label for="text">{Question}:</label><br />
						<textarea name="topic[text]" id="text" class="tinymce"></textarea>
						<input type="submit" value="{Publish your question}" />
						<div class="tags">
							<input type="button" name="sendTag" id="tagBut" value="{Add Tag}"/>
							<input type="text" name="tag" id="tagBar" class="autocompleteTag" />
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
	
</div>