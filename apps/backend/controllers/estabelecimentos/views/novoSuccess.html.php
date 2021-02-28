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
		<input type="hidden" name="news[CNT_ID]" value="<?php echo($this->content->getCNTID()); ?>" />
		<!-- Two Cols -->
		<div class="two-cols LeftExpanded">
			<!-- Col 1 -->
			<div class="col-1">
				<!-- Conteudo -->
				<div class="box">
					<h3><?php echo($this->pageTitle); ?></h3>
					<div>
						<label for="cnt_tit" class="hidden">Empresa</label>
						<input type="text" name="news[CNT_TIT]" id="cnt_tit" class="inputText" placeholder="Empresa" value="<?php echo($this->content->getCNTTIT()); ?>"/><br /><br />


						<label for="cnt_olh" class="hidden">Nome do estabelecimento</label>
						<input type="text" name="news[CNT_OLH]" id="cnt_olh" class="inputText" placeholder="Nome do estabelecimento" maxlength="180" value="<?php echo($this->content->getCNTOLH()); ?>"/><br />

						<input type="text" name="news[CNT_RES]" class="inputText" placeholder="Email" maxlength="180" value="<?php echo($this->content->getCNTRES()); ?>"/><br /><br />

						<label for="cnt_txt" class="">{Description}</label>
						<textarea name="news[CNT_TXT]" class="tinymce"><?php echo($this->content->getCNTTXT()); ?></textarea><br />

						<input type="text" name="news[CNT_RDT]" value="<?php echo($this->content->getCNTRDT()); ?>" class="inputText" placeholder="Cidade" /><br /><br />

						<input type="text" name="news[CNT_EMB]" class="inputText" placeholder="{Address}" maxlength="180" value="<?php echo($this->content->getCNTEMB()); ?>"/><br /><br />

					</div>
				</div>
				<!-- Submit Button -->
				<p class="centerTxt"><input type="submit" value="{Save}" /> <input type="reset" value="{Reset}" /></p>
				<!-- /Submit Button -->
			</div>
			<!-- /Col 1 -->
			<!-- Col 2 -->
			<div class="col-2">
				<?php $this->insertBlock("home", "publishBox", array("CONTAINER" => "news", "CONTENT" => $this->content, "STATUS_FIELD" => "CNT_STS")); ?>
				<?php $this->insertBlock("home", "editorialsBox", array("CONTAINER" => "news", "CONTENT" => $this->content, 'CATEGORY_TYPE' => 'PROD')); ?>
				<?php $this->insertBlock("estabelecimentos", "estadoBox", array("CONTAINER" => "news", "CONTENT" => $this->content, "STATUS_FIELD" => "CNT_STS")); ?>
				<?php $this->insertBlock("estabelecimentos", "produtoBox", array("CONTAINER" => "news", "CONTENT" => $this->content)); ?>

			</div>
			<!-- /Col 2 -->
		</div>
		<!-- /Two Cols -->
	</form>

</div>
<!-- /Content -->
