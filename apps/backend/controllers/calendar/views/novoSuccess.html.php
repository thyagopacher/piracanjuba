<!-- Content -->
<div id="internal-page">
	<!-- OpenHide -->
	<div class="openHideChecked">
		
		<input type="checkbox" name="showHidePanelSwitch" class="hidden-check" id="showHidePanelSwitch" value="show"/>
		<div>
			<h6>{Show on screen}</h6>
			<p>
				<input type="checkbox" name="show_comments" id="show_comments" value="show_comments" /><label class="no-points" for="show_comments">Comentários</label>
				<input type="checkbox" name="show_quiz" id="show_quiz" value="show_quiz" /><label class="no-points" for="show_quiz">Quiz</label>
				<input type="checkbox" name="show_pool" id="show_pool" value="show_pool" /><label class="no-points" for="show_pool">Enquete</label>
				<input type="checkbox" name="show_link" id="show_link" value="show_link" /><label class="no-points" for="show_link">Links relacionados</label>
			</p>
		</div>
		<label for="showHidePanelSwitch" class="showhideTit no-points">Opções de tela</label>
	</div>
	
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
		<input type="hidden" name="calendar[CNT_ID]" value="<?php echo($this->content->getCNTID()); ?>" />
		<!-- Two Cols -->
		<div class="two-cols LeftExpanded">
			<!-- Col 1 -->
			<div class="col-1">
				<!-- Conteudo -->
				<div class="box">
					<h3><?php echo($this->pageTitle); ?></h3>
					<div>
						<label for="cnt_tit" class="hidden">{Title}</label>
						<input type="text" name="calendar[CNT_TIT]" id="cnt_tit" class="inputText" placeholder="{Title}" value="<?php echo($this->content->getCNTTIT()); ?>"/><br />
						
						<?php $dta = $this->content->getCNTDTA(); $id = $this->content->getCNTTIT(); if(!empty($dta) && !empty($id)){ ?>
						<!-- LinkSite -->
						<?php
						$url = ($this->content->getCNTTIT() != false || $this->content->getCNTTIT() != "")?Slugfy($this->content->getCNTTIT()):"{untitled}";
						$url .= "-".($this->content->getCNTID());
						?>
						<p><a href="<?php printf("%s%s", $this->Site->getPDTURL(), $this->content->getURL()); ?>" class="linkSite" target="_blank">
						<?php printf("%s%s", $this->Site->getPDTURL(), $this->content->getURL()); ?>
						</a></p>
						<p><a href="<?php printf("%s%s", $this->Site->getPDTURL(), $this->content->getCNTID()); ?>" class="linkSite" target="_blank"><?php printf("%s%s", $this->Site->getPDTURL(), $this->content->getCNTID()); ?></a></p>
						<!-- /LinkSite -->
						<?php } ?>
						
						<label for="cnt_dtf" class="hidden">{Date}</label>
						<input type="text" name="calendar[CNT_DTF]" id="cnt_dtf" class="inputText" placeholder="{Date}" value="<?php if($this->content->getCNTDTF()){ echo(date("d/m/Y H:i:s", strtotime($this->content->getCNTDTF()))); } ?>"/><br />
						
						<label for="cnt_loc" class="hidden">{Place}</label>
						<input type="text" name="calendar[CNT_LOC]" id="cnt_loc" class="inputText" placeholder="{Place}" value="<?php echo($this->content->getCNTLOC()); ?>"/><br />
						<label for="cnt_chv" class="hidden">{Contact}</label>
						<input type="text" name="calendar[CNT_CHV]" id="cnt_chv" class="inputText" placeholder="{Contact}" value="<?php echo($this->content->getCNTCHV()); ?>"/><br />
						<label for="cnt_chv" class="hidden">{Period}</label>
						<input type="text" name="calendar[CNT_CAT]" id="cnt_cat" class="inputText" placeholder="{Period}" value="<?php echo($this->content->getCNTCAT()); ?>"/><br />
						
						<label for="cnt_olh" class="hidden">{Text}</label>
						<input type="text" name="calendar[CNT_OLH]" id="cnt_olh" class="inputText" placeholder="{Text}" value="<?php echo($this->content->getCNTOLH()); ?>"/><br />
						
						<label for="cnt_ema" class="hidden">{Text}</label>
						<input type="hidden" name="calendar[CNT_EMA]" id="cnt_ema" value="<?php echo($this->content->getCNTEMA()); ?>"/>
						
						<label for="cnt_txt" class="hidden">{Text Expanded}</label>
						<textarea name="calendar[CNT_TXT]" class="tinymce"><?php echo(($this->content->getCNTTXT())); ?></textarea>
						
					</div>
				</div>
				
				<!-- Submit Button -->
				<p class="centerTxt"><input type="submit" value="{Save}" /> <input type="reset" value="{Reset}" /></p>
				<!-- /Submit Button -->
			</div>
			<!-- /Col 1 -->
			<!-- Col 2 -->
			<div class="col-2">
				<?php $this->insertBlock("home", "publishBox", array("CONTAINER" => "calendar", "CONTENT" => $this->content, "STATUS_FIELD" => "CNT_STS")); ?>
				<?php $this->insertBlock("home", "imageBox", array("CONTAINER" => "calendar", "CONTENT" => $this->content, "THUMB_TYPE" => "THB_CNT")); ?>		
			</div>
			<!-- /Col 2 -->
		</div>
		<!-- /Two Cols -->
	</form>
	
</div>
<!-- /Content -->