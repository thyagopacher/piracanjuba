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
		<input type="hidden" name="seven[CNT_ID]" value="<?php echo($this->content->getCNTID()); ?>" />
		<!-- Two Cols -->
		<div class="two-cols LeftExpanded">
			<!-- Col 1 -->
			<div class="col-1">
				<!-- Conteudo -->
				<div class="box">
					<h3><?php echo($this->pageTitle); ?></h3>
					<div>
						<label for="cnt_tit" class="hidden">{Title}</label>
						<input type="text" name="seven[CNT_TIT]" id="cnt_tit" class="inputText" placeholder="{Title}" value="<?php echo($this->content->getCNTTIT()); ?>"/><br />
						
						<?php $dta = $this->content->getCNTDTA(); if(!empty($dta)){ ?>
						<!-- LinkSite -->
						<?php
						$url = ($this->content->getCNTTIT() != false || $this->content->getCNTTIT() != "")?Slugfy($this->content->getCNTTIT()):"{untitled}";
						$url .= "-".($this->content->getCNTID());
						?>
						<p><a href="<?php printf($this->content->getURL()); ?>" class="linkSite" target="_blank">
						<?php printf($this->content->getURL()); ?>
						</a></p>
						<p><a href="<?php printf("%s%s", $this->Site->getPDTURL(), $this->content->getCNTID()); ?>" class="linkSite" target="_blank">
							<?php printf("%s%s", $this->Site->getPDTURL(), $this->content->getCNTID()); ?></a></p>
						<!-- /LinkSite -->
						<?php } ?>
						
						<label for="cnt_olh" class="hidden">{Intro}</label>
						<input type="text" name="seven[CNT_OLH]" id="cnt_olh" class="inputText" placeholder="Olho" value="<?php echo($this->content->getCNTOLH()); ?>"/><br />
						
						<label for="cnt_txt" class="hidden">{Text}</label>
						<textarea name="seven[CNT_TXT]" class="tinymce"><?php echo($this->content->getCNTTXT()); ?></textarea>
						
						<label for="cnt_res" class="no-points"><strong>{Summary}</strong></label><br />
						<textarea name="seven[CNT_RES]"><?php echo($this->content->getCNTRES()); ?></textarea>
						
						<label for="cnt_rdt" class="small-label rightTxt">{Editor}</label> <input type="text" name="seven[CNT_RDT]" id="cnt_rdt" value="<?php echo($this->content->getCNTRDT()); ?>" /> <input type="checkbox" name="seven[CNT_CMT]" id="cnt_com" <?php if($this->content->getCNTCMT()){?>checked="checked"<?php } ?> value="1"/><label for="cnt_com" class="no-points">{Comments}</label> <input type="text" name="seven[CNT_CKY]" id="cnt_toq" class="small-input" value="500"/> <label for="cnt_toq" class="no-points">{Touchs}</label><br />
						<label for="cnt_ema" class="small-label  rightTxt">{E-mail}</label> <input type="email" name="seven[CNT_EMA]" id="cnt_ema" value="<?php echo($this->content->getCNTEMA()); ?>"/>
						
						<?php 
							$img  = $this->content->getIMG1(); 
						?>
						
						<p><label>{Original Image}</label><input type="hidden" id="sevenImg" name="seven[IMG1]" class="previewImage2" <?php if(!empty($img)){ echo("value=\"".$img->getARQID()."\""); }?> />
						
						<a class="bot selectPrevImage">{Select Image}</a></p>
						<?php if(!empty($img)){?>
							<script>
								var obj = <?php echo(json_encode($img->toJSON())); ?>;
								$("#sevenImg").data("file", obj);
								$(document).ready(function (){
									$("#sevenImg").change();
								})
							</script>
						<?php } ?>
						
						
						<?php $img  = $this->content->getIMG2(); ?>
						
						<p><label>{Changed Image}</label><input type="hidden" id="sevenErr" name="seven[IMG2]" class="previewImageErrada" <?php if(!empty($img)){ echo("value=\"".$img->getARQID()."\""); }?> />
						
						<a class="bot selectPrevImage">{Select Image}</a></p>
						<?php if(!empty($img)){?>
							<script>
								var obj = <?php echo(json_encode($img->toJSON())); ?>;
								$("#sevenErr").data("file", obj);
								$(document).ready(function (){
									$("#sevenErr").change();
								})
								
							</script>
						<?php } ?>
						<?php $coords = $this->content->getGame(); 
							if(!empty($coords)):
						?>
						<ol id="Coords">
							<li rel="1"><label class="hidden" for="coord1">Erro 1</label><input type="text" name="seven[COORDS][]" id="coord1"  value="<?php echo($coords->getER7CO1()); ?>"/></li>
							<li rel="2"><label class="hidden" for="coord2">Erro 2</label><input type="text" name="seven[COORDS][]" id="coord2"  value="<?php echo($coords->getER7CO2()); ?>"/></li>
							<li rel="3"><label class="hidden" for="coord3">Erro 3</label><input type="text" name="seven[COORDS][]" id="coord3"  value="<?php echo($coords->getER7CO3()); ?>"/></li>
							<li rel="4"><label class="hidden" for="coord4">Erro 4</label><input type="text" name="seven[COORDS][]" id="coord4"  value="<?php echo($coords->getER7CO4()); ?>"/></li>
							<li rel="5"><label class="hidden" for="coord5">Erro 5</label><input type="text" name="seven[COORDS][]" id="coord5"  value="<?php echo($coords->getER7CO5()); ?>"/></li>
							<li rel="6"><label class="hidden" for="coord6">Erro 6</label><input type="text" name="seven[COORDS][]" id="coord6"  value="<?php echo($coords->getER7CO6()); ?>"/></li>
							<li rel="7"><label class="hidden" for="coord7">Erro 7</label><input type="text" name="seven[COORDS][]" id="coord7"  value="<?php echo($coords->getER7CO7()); ?>"/></li>
						</ol>
						<?php else: ?>
							<ol id="Coords">
								<li rel="1"><label class="hidden" for="coord1">Erro 1</label><input type="text" name="seven[COORDS][]" id="coord1" /></li>
								<li rel="2"><label class="hidden" for="coord2">Erro 2</label><input type="text" name="seven[COORDS][]" id="coord2"  /></li>
								<li rel="3"><label class="hidden" for="coord3">Erro 3</label><input type="text" name="seven[COORDS][]" id="coord3"  /></li>
								<li rel="4"><label class="hidden" for="coord4">Erro 4</label><input type="text" name="seven[COORDS][]" id="coord4"  /></li>
								<li rel="5"><label class="hidden" for="coord5">Erro 5</label><input type="text" name="seven[COORDS][]" id="coord5"  /></li>
								<li rel="6"><label class="hidden" for="coord6">Erro 6</label><input type="text" name="seven[COORDS][]" id="coord6"  /></li>
								<li rel="7"><label class="hidden" for="coord7">Erro 7</label><input type="text" name="seven[COORDS][]" id="coord7"  /></li>
							</ol>
							<?php endif; ?>
					</div>
				</div>
				<!-- /Conteudo -->
				<?php //$this->insertBlock("home", "linksBox", array("CONTAINER" => "seven", "CONTENT" => $this->content)); ?>
				
				<!-- Submit Button -->
				<p class="centerTxt"><input type="submit" value="{Save}" /> <input type="reset" value="{Reset}" /></p>
				<!-- /Submit Button -->
			</div>
			<!-- /Col 1 -->
			<!-- Col 2 -->
			<div class="col-2">
				<?php $this->insertBlock("home", "publishBox", array("CONTAINER" => "seven", "CONTENT" => $this->content, "STATUS_FIELD" => "CNT_STS")); ?>
				
				<?php //$this->insertBlock("home", "editorialsBox", array("CONTAINER" => "seven", "CONTENT" => $this->content)); ?>
				
				<?php $this->insertBlock("home", "imageBox", array("CONTAINER" => "seven", "CONTENT" => $this->content, "THUMB_TYPE" => "THB_CNT")); ?>
				
				<?php //$this->insertBlock("home", "tagsBox", array("CONTAINER" => "seven", "CONTENT" => $this->content)); ?>
				
				<?php $this->insertBlock("home", "featuredBox", array("CONTAINER" => "seven", "CONTENT" => $this->content)); ?>
				
			</div>
			<!-- /Col 2 -->
		</div>
		<!-- /Two Cols -->
	</form>
	
</div>
<!-- /Content -->