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
		<input type="hidden" name="news[CNT_ID]" value="<?php echo($this->content->getCNTID()); ?>" />
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
						
						<?php $dta = $this->content->getCNTDTA(); if(!empty($dta)){ ?>
						<!-- LinkSite -->
						<?php
						$url = ($this->content->getCNTTIT() != false || $this->content->getCNTTIT() != "")?Slugfy(html_entity_decode($this->content->getCNTTIT())):"{untitled}";
						$url .= "-".($this->content->getCNTID());
						?>
						<p><a href="<?php printf("%s{news_url}/%s/%s.html", $this->Site->getPDTURL(), date("Y/m/d", strtotime($dta)), $url); ?>" class="linkSite" target="_blank">
						<?php printf("%s{news_url}/%s/%s.html", $this->Site->getPDTURL(), date("Y/m/d", strtotime($dta)), $url); ?>
						</a></p>
						
						<p><a href="<?php printf("%s%s", $this->Site->getPDTURL(), $this->content->getCNTID()); ?>" class="linkSite" target="_blank">
						<?php printf("%s%s", $this->Site->getPDTURL(), $this->content->getCNTID()); ?>
						</a></p>
						
						<!-- /LinkSite -->
						<?php } ?>
						
						<label for="cnt_olh" class="hidden">{Intro}</label>
						<input type="text" name="news[CNT_OLH]" id="cnt_olh" class="inputText" placeholder="Olho" maxlength="180" value="<?php echo($this->content->getCNTOLH()); ?>"/><br />
						
						<label for="cnt_txt" class="hidden">{Text}</label>
						<textarea name="news[CNT_TXT]" class="tinymce"><?php echo($this->content->getCNTTXT()); ?></textarea>
						
						<label for="cnt_emb">Embed</label>
						<textarea name="news[CNT_EMB]"><?php echo($this->content->getCNTEMB()); ?></textarea>
						<?php /* ?>
						<label for="cnt_emb">Embed 2</label>
						<textarea name="news[CNT_EMB2]"><?php echo($this->content->getCNTEMB2()); ?></textarea>
						<?php */ ?>
						
						<label for="cnt_res" class="no-points"><strong>{Summary}</strong></label><br />
						<textarea name="news[CNT_RES]" maxlength="180"><?php echo($this->content->getCNTRES()); ?></textarea>
						
						<label for="cnt_rdt" class="small-label rightTxt">{Editor}</label> <input type="text" name="news[CNT_RDT]" id="cnt_rdt" value="<?php echo($this->content->getCNTRDT()); ?>" /> <input type="checkbox" name="news[CNT_CMT]" id="cnt_com" <?php if($this->content->getCNTCMT()){?>checked="checked"<?php } ?> value="1"/><label for="cnt_com" class="no-points">{Comments}</label> <input type="text" name="news[CNT_CKY]" id="cnt_toq" class="small-input" value="500"/> <label for="cnt_toq" class="no-points">{Touchs}</label><br />
						<?php /* ?><label for="cnt_ema" class="small-label  rightTxt">{E-mail}</label> <input type="email" name="news[CNT_EMA]" id="cnt_ema" value="<?php echo($this->content->getCNTEMA()); ?>"/><?php */ ?>
						
					</div>
				</div>
				<!-- /Conteudo -->
				<?php $this->insertBlock("home", "linksBox", array("CONTAINER" => "news", "CONTENT" => $this->content, "BOX_TITLE" => $this->linksTitle, "NOT_SHOWLINK" => $this->linksShow)); ?>
				
				<!-- Submit Button -->
				<p class="centerTxt"><input type="submit" value="{Save}" /> <input type="reset" value="{Reset}" /></p>
				<!-- /Submit Button -->
			</div>
			<!-- /Col 1 -->
			<!-- Col 2 -->
			<div class="col-2">
				<?php $this->insertBlock("home", "publishBox", array("CONTAINER" => "news", "CONTENT" => $this->content, "STATUS_FIELD" => "CNT_STS")); ?>
				
				<?php $this->insertBlock("home", "editorialsBox", array("CONTAINER" => "news", "CONTENT" => $this->content)); ?>
				
				<?php $this->insertBlock("home", "imageBox", array("CONTAINER" => "news", "CONTENT" => $this->content, "THUMB_TYPE" => "THB_CNT")); ?>

				
				<?php $this->insertBlock("home", "imageBox", array("CONTAINER" => "news", "CONTENT" => $this->content, "THUMB_TYPE" => "THB_EMB1", "TITLE"=> "Imagem Embed1", "FIELD_NAME" => "IMG_DTQ2")); ?>
				<?php /* ?>
				<?php $this->insertBlock("home", "imageBox", array("CONTAINER" => "news", "CONTENT" => $this->content, "THUMB_TYPE" => "THB_EMB2", "TITLE"=> "Imagem Embed2", "FIELD_NAME" => "IMG_DTQ3")); ?>
				<?php */ ?>
				<?php $this->insertBlock("home", "tagsBox", array("CONTAINER" => "news", "CONTENT" => $this->content)); ?>
				
				<?php $this->insertBlock("home", "relcontentBox", array("CONTAINER" => "news", "CONTENT" => $this->content)); ?>
				
				<?php $this->insertBlock("home", "featuredBox", array("CONTAINER" => "news", "CONTENT" => $this->content)); ?>
				
				
				
			</div>
			<!-- /Col 2 -->
		</div>
		<!-- /Two Cols -->
	</form>
	
</div>
<!-- /Content -->