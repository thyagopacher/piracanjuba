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
		<input type="hidden" name="quiz[CNT_ID]" value="<?php echo($this->content->getCNTID()); ?>" />
		<!-- Two Cols -->
		<div class="two-cols LeftExpanded">
			<!-- Col 1 -->
			<div class="col-1">
				<!-- Conteudo -->
				<div class="box">
					<h3><?php echo($this->pageTitle); ?></h3>
					<div>
						<label for="cnt_tit" class="hidden">{Title}</label>
						<input type="text" name="quiz[CNT_TIT]" id="cnt_tit" class="inputText" placeholder="{Title}" value="<?php echo($this->content->getCNTTIT()); ?>"/><br />
						
						<?php $dta = $this->content->getCNTDTA(); if(!empty($dta)){ ?>
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
						
						<label for="cnt_olh" class="hidden">{Intro}</label>
						<input type="text" name="quiz[CNT_OLH]" id="cnt_olh" class="inputText" placeholder="Olho" value="<?php echo($this->content->getCNTOLH()); ?>"/><br />
						
						<label for="cnt_txt" class="hidden">{Text}</label>
						<textarea name="quiz[CNT_TXT]" class="tinymce"><?php echo($this->content->getCNTTXT()); ?></textarea>
						
						<label for="cnt_res" class="no-points"><strong>{Summary}</strong></label><br />
						<textarea name="quiz[CNT_RES]"><?php echo($this->content->getCNTRES()); ?></textarea>
						
						<label for="cnt_rdt" class="small-label rightTxt">{Editor}</label> <input type="text" name="quiz[CNT_RDT]" id="cnt_rdt" value="<?php echo($this->content->getCNTRDT()); ?>" /> <input type="checkbox" name="quiz[CNT_CMT]" id="cnt_com" <?php if($this->content->getCNTCMT()){?>checked="checked"<?php } ?> value="1"/><label for="cnt_com" class="no-points">{Comments}</label> <input type="text" name="quiz[CNT_CKY]" id="cnt_toq" class="small-input" value="500"/> <label for="cnt_toq" class="no-points">{Touchs}</label><br />
						<label for="cnt_ema" class="small-label  rightTxt">{E-mail}</label> <input type="email" name="quiz[CNT_EMA]" id="cnt_ema" value="<?php echo($this->content->getCNTEMA()); ?>"/>
						
						<?php $this->insertBlock("quiz", "quizform", array("CONTAINER" => "quiz", "CONTENT" => $this->content)); ?>
					</div>
				</div>
				<!-- /Conteudo -->
				
				
				<!-- Submit Button -->
				<p class="centerTxt"><input type="submit" value="{Save}" /></p>
				<!-- /Submit Button -->
			</div>
			<!-- /Col 1 -->
			<!-- Col 2 -->
			<div class="col-2">
				<?php $this->insertBlock("home", "publishBox", array("CONTAINER" => "quiz", "CONTENT" => $this->content, "STATUS_FIELD" => "CNT_STS")); ?>
				
				<?php //$this->insertBlock("home", "editorialsBox", array("CONTAINER" => "quiz", "CONTENT" => $this->content)); ?>
				
				<?php $this->insertBlock("home", "imageBox", array("CONTAINER" => "quiz", "CONTENT" => $this->content, "THUMB_TYPE" => "THB_CNT")); ?>
				
				<?php //$this->insertBlock("home", "tagsBox", array("CONTAINER" => "quiz", "CONTENT" => $this->content)); ?>
				
				<?php //$this->insertBlock("home", "relcontentBox", array("CONTAINER" => "quiz", "CONTENT" => $this->content)); ?>
				
				<?php $this->insertBlock("home", "featuredBox", array("CONTAINER" => "quiz", "CONTENT" => $this->content)); ?>
				
				
				
			</div>
			<!-- /Col 2 -->
		</div>
		<!-- /Two Cols -->
	</form>
	
</div>
<!-- /Content -->