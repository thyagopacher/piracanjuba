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
		<input type="hidden" name="news[CNT_ID]" id="CNT_ID" value="<?php echo($this->content->getCNTID()); ?>" />
		<!-- Two Cols -->
		<div class="two-cols LeftExpanded">
			<!-- Col 1 -->
			<div class="col-1">
				<!-- Conteudo -->
				<div class="box">
					<h3><?php echo($this->pageTitle); ?></h3>
					<div>
						<input type="text" name="news[CNT_TIT]" id="cnt_tit" class="inputText" placeholder="{Title}" value="<?php echo($this->content->getCNTTIT()); ?>"/>
                        <br />
						<br />
                        <input type="text" name="news[CNT_RDT]" id="cnt_rdt" class="inputText" placeholder="Rendimento" value="<?php echo($this->content->getCNTRDT()); ?>"/>
                        <br />
                        <br />
                        <input type="text" name="news[CNT_CKY]" id="cnt_toq" class="inputText" placeholder="Calorias" value="<?php echo($this->content->getCNTCKY()); ?>"/>
                        <br />
                        <br />
						<input type="text" name="news[CNT_OLH]" id="cnt_olh" class="inputText" placeholder="Tempo de preparo" maxlength="" value="<?php echo($this->content->getCNTOLH()); ?>"/><br />

						<label for="cnt_txt">Ingredientes</label>
						<textarea name="news[CNT_TXT]" class="tinymce"><?php echo($this->content->getCNTTXT()); ?></textarea>

						<label for="cnt_emb">Modo de preparo</label>
						<textarea name="news[CNT_EMB]" class="tinymce"><?php echo($this->content->getCNTEMB()); ?></textarea>
						<?php /* ?>
						<label for="cnt_emb">Embed 2</label>
						<textarea name="news[CNT_EMB2]"><?php echo($this->content->getCNTEMB2()); ?></textarea>
						<?php */ ?>

						<label for="cnt_res" class="no-points">Dicas do Chef</label><br />
						<textarea name="news[CNT_RES]" class="tinymce"><?php echo($this->content->getCNTRES()); ?></textarea>

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
				<?php $this->insertBlock("home", "imageBox", array("CONTAINER" => "news", "CONTENT" => $this->content, "THUMB_TYPE" => "THB_CNT")); ?>

				<?php $this->insertBlock("receitas", "categoriaBox", array("CONTAINER" => "news", "CONTENT" => $this->content)); ?>

                <?php $this->insertBlock("receitas", "produtoBox", array("CONTAINER" => "news", "CONTENT" => $this->content)); ?>





			</div>
			<!-- /Col 2 -->
		</div>
		<!-- /Two Cols -->
	</form>

</div>
<!-- /Content -->
