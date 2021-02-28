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
		<input type="hidden" name="news[id]" value="<?php echo($this->content->getID()); ?>" />
		<!-- Two Cols -->
		<div class="two-cols LeftExpanded">
			<!-- Col 1 -->
			<div class="col-1">
				<!-- Conteudo -->
				<div class="box">
					<h3><?php echo($this->pageTitle); ?></h3>
					<div>
						<label for="cnt_tit">Valor Energético</label>
						<input type="text" name="news[valor_energetico]" id="cnt_tit" class="inputText" placeholder="Valor Energético" value="<?php echo($this->content->getTABELAVALORENERGICO()); ?>"/><br />



						<label for="cnt_olh">Quantidade Porção</label>
						<input type="text" name="news[quantidade_porcao]" id="cnt_olh" class="inputText" placeholder="Quantidade Porção" maxlength="180" value="<?php echo($this->content->getTABELAQUANTIDADE()); ?>"/><br />

						<label for="cnt_olh2">Porcentagem Porção</label>
						<input type="text" name="news[porcentagem_por_porcao]" id="cnt_olh2" class="inputText" placeholder="Porcentagem Porção" maxlength="180" value="<?php echo($this->content->getTABELAPORCENTAGEM()); ?>"/><br />




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
				<?php $this->insertBlock("home", "publishBox", array("CONTAINER" => "news", "HAS_DATE" => false, "CONTENT" => $this->content, "STATUS_FIELD" => "status")); ?>





			</div>
			<!-- /Col 2 -->
		</div>
		<!-- /Two Cols -->
	</form>

</div>
<!-- /Content -->
