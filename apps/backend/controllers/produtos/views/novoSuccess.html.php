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
		<input type="hidden" id="news_cnt_id" name="news[CNT_ID]" value="<?php echo($this->content->getCNTID()); ?>" />
		<!-- Two Cols -->
		<div class="two-cols LeftExpanded">
			<!-- Col 1 -->
			<div class="col-1">
				<!-- Conteudo -->
				<div class="box">
					<h3><?php echo($this->pageTitle); ?></h3>
					<div>
						<label for="cnt_tit" class="hidden">{Title}</label>
						<input type="text" name="news[CNT_TIT]" id="cnt_tit" class="inputText" placeholder="{Title}" value="<?php echo($this->content->getCNTTIT()); ?>"/><br />
						<br />

						<label for="cnt_olh" class="hidden">{Title} 2</label>
						<input type="text" name="news[CNT_OLH]" id="cnt_olh" class="inputText" placeholder="{Title} 2" maxlength="180" value="<?php echo($this->content->getCNTOLH()); ?>"/><br />

						<label for="cnt_txt">{Description}</label>
						<textarea name="news[CNT_TXT]"><?php echo($this->content->getCNTTXT()); ?></textarea>

						<br />

						<label for="cnt_cat" class="hidden">{Title} 2</label>
						<input type="text" name="news[CNT_CAT]" id="cnt_cat" class="inputText" placeholder="Tabela" maxlength="180" value="<?php echo($this->content->getCNTCAT()); ?>"/><br />

						<br />
						<label for="cnt_txt">{Description}</label>
						<textarea name="news[CNT_CHV]"><?php echo($this->content->getCNTTXT()); ?></textarea>

						<br />


						<label for="cnt_emb">VD e Ingredientes</label>
						<textarea name="news[CNT_EMB]" class="tinymce"><?php echo($this->content->getCNTEMB()); ?></textarea>



						<label for="cnt_res" class="no-points">Alergenicos</label><br />

						<textarea name="news[CNT_RES]" maxlength="180" class="tinymce"><?php echo($this->content->getCNTRES()); ?></textarea>


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
				<?php $this->insertBlock("home", "publishBox", array("CONTAINER" => "news", "CONTENT" => $this->content, "STATUS_FIELD" => "CNT_STS")); ?>

				<?php $this->insertBlock("home", "editorialsBox", array("CONTAINER" => "news", "CONTENT" => $this->content, 'CATEGORY_TYPE' => 'PROD')); ?>

				<?php
				$this->insertBlock("home", "imageBox", array("CONTAINER" => "news", "CONTENT" => $this->content, "THUMB_TYPE" => "THB_CNT"));
				$this->insertBlock("home", "imageBox", array("CONTAINER" => "news", "CONTENT" => $this->content, "THUMB_TYPE" => "THB_EMB1", "FIELD_NAME" => "IMG_DTQ2", "TITLE" => "Imagem Central BG"));
				$this->insertBlock("home", "imageBox", array("CONTAINER" => "news", "CONTENT" => $this->content, "THUMB_TYPE" => "THB_EMB2", "FIELD_NAME" => "IMG_DTQ3", "TITLE" => "Imagem Central"));
				?>

				<?php $this->insertBlock("produtos", "tabelaNutricionalBox", array("CONTAINER" => "news", "CONTENT" => $this->content)); ?>



			</div>
			<!-- /Col 2 -->
		</div>
		<!-- /Two Cols -->
	</form>

</div>
<!-- /Content -->
