<!-- Content -->
<div id="internal-page">


	<?php $this->insertBlock("home", "breadCrumb", array("CONTROLLER" => $this, "VARS" => $this->breadCrumb)); ?>

	<!-- /OpenHide -->
	<form id="newsForm" method="post" action="<?php echo($this->action);?>">

		<?php if(!empty($this->Errors)): ?>
			<div class="error">
				<?php echo($this->Errors); ?>
			</div>
		<?php endif; ?>
		<?php if(!empty($this->Message)): ?>
			<div class="message">
				<?php echo($this->Message); ?>
			</div>
		<?php endif; ?>

		<input type="hidden" name="categoria[CAT_ID]" value="<?php echo($this->content->getCATID()); ?>" />
		<!-- Two Cols -->
		<div class="two-cols LeftExpanded">
			<!-- Col 1 -->
			<div class="col-1">
				<!-- Conteudo -->
				<div class="box">
					<h3><?php echo($this->pageTitle); ?></h3>
					<div>
						<label for="cat_nom" class="hidden">{Title}</label>
						<input type="text" name="categoria[CAT_NOM]" id="cat_nom" class="inputText" placeholder="{Title}" value="<?php echo($this->content->getCATNOM()); ?>"/><br /><br />

						<label for="cat_desc" class="hidden">{Description}</label>
						<input type="text" name="categoria[CAT_DESC]" id="cat_desc" class="inputText" placeholder="{Description}" maxlength="180" value="<?php echo($this->content->getCATDESC()); ?>"/><br /><br />

						<label for="cat_txt">{Text}</label>
						<textarea name="categoria[CAT_TXT]" class="tinymce"><?php echo($this->content->getCATTXT()); ?></textarea>

						<label for="cnt_emb">Titulo 2</label>
						<textarea name="categoria[CAT_TITULO]"><?php echo($this->content->getCATTITULO()); ?></textarea>

						<label for="cnt_res" class="no-points">Texto Livre</label><br />
						<textarea name="categoria[CAT_LIVRE]" maxlength="180"><?php echo($this->content->getCATLIVRE()); ?></textarea>

					</div>
				</div>
				<!-- /Conteudo -->


				<!-- Submit Button -->
				<p class="centerTxt"><input type="submit" value="{Save}" /> <input type="reset" value="{Reset}" /></p>
				<!-- /Submit Button -->
			</div>
			<!-- /Col 1 -->
			<!-- Col 2 -->
			<div class="col-2">

				<?php $this->insertBlock("categorias", "imageBox", array("CONTAINER" => "news", "CONTENT" => $this->content, "THUMB_TYPE" => "CAT")); ?>




			</div>
			<!-- /Col 2 -->
		</div>
		<!-- /Two Cols -->
	</form>

</div>
<!-- /Content -->
