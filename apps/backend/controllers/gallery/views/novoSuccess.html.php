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
		<input type="hidden" name="gallery[CNT_ID]" id="gal_ID" value="<?php echo($this->content->getCNTID()); ?>" />
		<!-- Two Cols -->
		<div class="two-cols LeftExpanded">
			<!-- Col 1 -->
			<div class="col-1">
				<!-- Conteudo -->
				<div class="box">
					<h3><?php echo($this->pageTitle); ?></h3>
					<div>
						<label for="cnt_tit" class="hidden">{Title}</label>
						<input type="text" name="gallery[CNT_TIT]" id="cnt_tit" class="inputText" placeholder="{Title}" value="<?php echo($this->content->getCNTTIT()); ?>"/><br />

						<?php $dta = $this->content->getCNTDTA(); if(!empty($dta)){ ?>
						<!-- LinkSite -->
						<?php
						$url = ($this->content->getCNTTIT() != false || $this->content->getCNTTIT() != "")?Slugfy(html_entity_decode($this->content->getCNTTIT())):"{untitled}";
						$url .= "-".($this->content->getCNTID());
						?>
						<p><a href="<?php printf("%s{gallery_url}/%s/%s.html", $this->Site->getPDTURL(), date("Y/m/d", strtotime($dta)), $url); ?>" class="linkSite" target="_blank">
						<?php printf("%s{gallery_url}/%s/%s.html", $this->Site->getPDTURL(), date("Y/m/d", strtotime($dta)), $url); ?>
						</a></p>
						<p><a href="<?php printf("%s%s", $this->Site->getPDTURL(), $this->content->getCNTID()); ?>" class="linkSite" target="_blank"><?php printf("%s%s", $this->Site->getPDTURL(), $this->content->getCNTID()); ?></a></p>
						<!-- /LinkSite -->
						<p><a href="<?php printf("%spreview/{gallery_url}/%s/%s.html", $this->Site->getPDTURL(), date("Y/m/d", strtotime($dta)), $url); ?>" class="bot" id="previewBot" target="_blank">{preview}</a></p>
						<?php } ?>

						<label for="cnt_olh" class="hidden">{Intro}</label>
						<input type="text" name="gallery[CNT_OLH]" id="cnt_olh" class="inputText" placeholder="Linha Fina" value="<?php echo($this->content->getCNTOLH()); ?>"/><br />

						<label for="cnt_txt" class="hidden">{Text}</label>
						<textarea name="gallery[CNT_TXT]" class="tinymce"><?php echo(($this->content->getCNTTXT())); ?></textarea>

						<label for="cnt_res" class="no-points"><strong>Linha Fina</strong></label><br />
						<textarea name="gallery[CNT_RES]"><?php echo($this->content->getCNTRES()); ?></textarea>

						<label for="cnt_rdt" class="small-label rightTxt">{Editor}</label> <input type="text" name="gallery[CNT_RDT]" id="cnt_rdt" value="<?php echo($this->content->getCNTRDT()); ?>" /> <input type="checkbox" name="gallery[CNT_CMT]" id="cnt_com" <?php if($this->content->getCNTCMT()){?>checked="checked"<?php } ?> value="1"/><label for="cnt_com" class="no-points">{Comments}</label> <input type="text" name="gallery[CNT_CKY]" id="cnt_toq" class="small-input" value="500"/> <label for="cnt_toq" class="no-points">{Touchs}</label><br />
						
						<p>
							<?php 
								$select = new FuriousSelect("CNT_TAG", "Tamanho das imagens", $this->fileFormats);
								if($this->content->getCNTTAG()){
									$select->setValue($this->content->getCNTTAG());
								}
								$select->setFormContainer("gallery");
								echo($select);
							 ?>
						</p>
						<?php /* ?><label for="cnt_ema" class="small-label  rightTxt">{E-mail}</label> <input type="email" name="gallery[CNT_EMA]" id="cnt_ema" value="<?php echo($this->content->getCNTEMA()); ?>"/><?php */ ?>

					</div>
				</div>
				<!-- /Conteudo -->
				<?php $this->insertBlock("gallery", "images", array("CONTAINER" => "gallery", "CONTENT" => $this->content)); ?>

				<!-- Submit Button -->
				<p class="centerTxt"><input type="submit" value="{Save}" /> <input type="reset" value="{Reset}" /></p>
				<!-- /Submit Button -->
			</div>
			<!-- /Col 1 -->
			<!-- Col 2 -->
			<div class="col-2">
				<?php $this->insertBlock("home", "publishBox", array("CONTAINER" => "gallery", "CONTENT" => $this->content, "STATUS_FIELD" => "CNT_STS")); ?>

				<?php $this->insertBlock("home", "editorialsBox", array("CONTAINER" => "gallery", "CONTENT" => $this->content)); ?>

				<?php $this->insertBlock("home", "imageBox", array("CONTAINER" => "gallery", "CONTENT" => $this->content, "THUMB_TYPE" => "THB_CNT")); ?>

				<?php $this->insertBlock("home", "tagsBox", array("CONTAINER" => "gallery", "CONTENT" => $this->content)); ?>

				<?php $this->insertBlock("home", "relcontentBox", array("CONTAINER" => "gallery", "CONTENT" => $this->content)); ?>

				<?php $this->insertBlock("home", "featuredBox", array("CONTAINER" => "gallery", "CONTENT" => $this->content)); ?>

			</div>
			<!-- /Col 2 -->
		</div>
		<!-- /Two Cols -->
	</form>

</div>
<!-- /Content -->
