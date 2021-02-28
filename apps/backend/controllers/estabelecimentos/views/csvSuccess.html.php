<!-- Content -->
<div id="internal-page">
	<?php if(!empty($this->importacao)){

		echo $this->importacao;
	}?>
	<?php $this->insertBlock("home", "breadCrumb", array("CONTROLLER" => $this, "VARS" => $this->breadCrumb)); ?>
	<!-- /OpenHide -->
	<form id="newsForm" method="post" action="<?php echo($this->action);?>" enctype="multipart/form-data">
		<!-- Two Cols -->
		<div class="two-cols LeftExpanded">
			<!-- Col 1 -->
			<div class="col-1">
				<!-- Conteudo -->
				<div class="box">
					<h3><?php echo($this->pageTitle); ?></h3>
					<div>
						<input type="file" name="filename" id="cnt_tit" class="" /><br />

					</div>
				</div>
				<!-- Submit Button -->
				<p class="centerTxt"><input type="submit" value="{Save}" /> <input type="reset" value="{Reset}" /></p>
				<!-- /Submit Button -->
			</div>

		</div>
		<!-- /Two Cols -->
	</form>

</div>
<!-- /Content -->
