<!-- Content -->
<div id="internal-page">
	<!-- OpenHide -->
	<div class="openHideChecked">
		
		<input type="checkbox" name="showHidePanelSwitch" class="hidden-check" id="showHidePanelSwitch" value="show"/>
		<div>
			<h6>{Show on screen}</h6>
			<p>
				<input type="checkbox" name="show_comments" id="show_comments" value="show_comments" /><label class="no-points" for="show_comments">Coment�rios</label>
				<input type="checkbox" name="show_quiz" id="show_quiz" value="show_quiz" /><label class="no-points" for="show_quiz">Quiz</label>
				<input type="checkbox" name="show_pool" id="show_pool" value="show_pool" /><label class="no-points" for="show_pool">Enquete</label>
				<input type="checkbox" name="show_link" id="show_link" value="show_link" /><label class="no-points" for="show_link">Links relacionados</label>
			</p>
		</div>
		<label for="showHidePanelSwitch" class="showhideTit no-points">Op��es de tela</label>
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
		<input type="hidden" name="faq[CNT_ID]" value="<?php echo($this->content->getCNTID()); ?>" />
		<!-- Two Cols -->
		<div class="two-cols LeftExpanded">
			<!-- Col 1 -->
			<div class="col-1">
				<!-- Conteudo -->
				<div class="box">
					<h3><?php echo($this->pageTitle); ?></h3>
					<div>
						<label for="cnt_tit" class="hidden">{Title}</label>
						<input type="text" name="faq[CNT_TIT]" id="cnt_tit" class="inputText" placeholder="{Question}" value="<?php echo($this->content->getCNTTIT()); ?>"/><br />
						
						<?php $dta = $this->content->getCNTDTA(); if(!empty($dta)){ ?>
						<!-- LinkSite -->
						<?php
						$url = ($this->content->getCNTTIT() != false || $this->content->getCNTTIT() != "")?Slugfy(html_entity_decode($this->content->getCNTTIT())):"{untitled}";
						$url .= "-".($this->content->getCNTID());
						?>
						<p><a href="<?php printf("%s{faq_url}/%s/%s.html", $this->Site->getPDTURL(), date("Y/m/d", strtotime($dta)), $url); ?>" class="linkSite" target="_blank">
						<?php printf("%s{faq_url}/%s/%s.html", $this->Site->getPDTURL(), date("Y/m/d", strtotime($dta)), $url); ?>
						</a></p>
						
						<p>
							<a href="<?php printf("%s%s", $this->Site->getPDTURL(), $this->content->getCNTID()); ?>" class="linkSite" target="_blank">
								<?php printf("%s%s", $this->Site->getPDTURL(), $this->content->getCNTID()); ?>
							</a>
						</p>
						
						<!-- /LinkSite -->
						<?php } ?>

						
						<label for="cnt_txt" class="hidden">{Repply}</label>
						<textarea name="faq[CNT_TXT]" class="tinymce2"><?php echo($this->content->getCNTTXT()); ?></textarea>
						
						<label for="cnt_rdt" class="small-label rightTxt">{Author}</label>
						<input type="text" name="faq[CNT_RDT]" id="cnt_rdt" value="<?php echo($this->content->getCNTRDT()); ?>" /> 
						
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
				<?php $this->insertBlock("home", "publishBox", array("CONTAINER" => "faq", "CONTENT" => $this->content, "STATUS_FIELD" => "CNT_STS")); ?>
				
				<?php $this->insertBlock("home", "editorialsBox", array("CATEGORY_TYPE"=> "CAT_FAQ", "CONTAINER" => "faq", "CONTENT" => $this->content)); ?>
				
				<?php $this->insertBlock("home", "tagsBox", array("CONTAINER" => "faq", "CONTENT" => $this->content)); ?>
												
				
			</div>
			<!-- /Col 2 -->
		</div>
		<!-- /Two Cols -->
	</form>
	
</div>
<!-- /Content -->