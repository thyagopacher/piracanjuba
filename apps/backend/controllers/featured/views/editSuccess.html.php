<!-- Content -->
<div id="internal-page">
	<!-- OpenHide -->
	<div class="openHideChecked">

		<input type="checkbox" name="showHidePanelSwitch" class="hidden-check" id="showHidePanelSwitch" value="show"/>
		<div>
			<h6>{Show on screen}</h6>
			<p>
				<input type="checkbox" name="show_comments" id="show_comments" value="show_comments" /><label class="no-points" for="show_comments">Comentários</label>
				<input type="checkbox" name="show_pool" id="show_pool" value="show_pool" /><label class="no-points" for="show_pool">Enquete</label>
				<input type="checkbox" name="show_link" id="show_link" value="show_link" /><label class="no-points" for="show_link">Links relacionados</label>
			</p>
		</div>
		<label for="showHidePanelSwitch" class="showhideTit no-points">Opções de tela</label>
	</div>
	<form id="dtqForm" method="post">
		<input type="hidden" name="featured[DTQ_ID]" id="dtq_id" value="<?php echo($this->content->getDTQID()); ?>"  />
		<input type="hidden" name="featured[DTQ_EDT]" id="dtq_edt" value="<?php echo($this->content->getDTQEDT()); ?>"  />
		<input type="hidden" name="featured[DTQ_TIP]" id="dtq_tip" value="<?php echo($this->content->getDTQTIP()); ?>"  />
		<?php /*$title = $this->content->getDTQTIT(); if(empty($title)){ ?>
		<input type="hidden" name="featured[isNew]" id="dtq_isNew" value="true"  />
		<?php } */ ?>
		<!-- Two Cols -->
		<div class="two-cols LeftExpanded">
		<?php $this->insertBlock("home", "breadCrumb", array("CONTROLLER" => $this, "VARS" => $this->breadCrumb)); ?>

		<h2 class="icnPage newPage"><a href="<?php echo($this->Editorial->getURL()); ?><?php echo($this->type);?>/new.php">{Add Featured}</a></h2>

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

			<!-- Col 1 -->
			<div class="col-1">

				<!-- Conteudo -->
				<div class="box">
					<h3>{Edit Content:} {Featured} <?php echo($this->content->getDTQCID()); ?> </h3>
					<div>

						<?php $title = $this->content->getDTQTIT(); if(!empty($title)){ ?>
						<div><a href="<?php printf("%s", str_replace("http://r7.com/marcelo-rezende/", "http://r7.com/marcelo-rezende/preview/", $this->Site->getPDTURL())); ?>" class="bot" id="previewBot" target="_blank">{preview}</a></div><br />
						<?php } ?>


						<!--<label for="news_id" class="inline">{Order}</label>
						<input type="text" name="featured[DTQ_CID]" id="news_id" value="<?php echo($this->content->getDTQCID()); ?>" />
						<br />-->
						<?php if($this->configs->getMNUCHP() == 1): ?>
						<label for="dtq_ch" class="inline">{Intro}</label>
						<input type="text" name="featured[DTQ_CNL]" id="dtq_ch" class="inptAll" maxlength="180" value="<?php echo($this->content->getDTQCNL()); ?>" />
						<br />
						<?php endif; ?>

						<label for="dtq_tit" class="inline">{Title}</label>
						<input type="text" name="featured[DTQ_TIT]" id="dtq_tit" class="inptAll" value="<?php echo($this->content->getDTQTIT()); ?>"/>
						<br />

						<?php if($this->configs->getMNUDTA() == 1): ?>
						<label for="dtq_ch" class="inline">{Date}</label>
						<input type="text" name="featured[DTQ_DTA]" id="dtq_ch" class="inptAll" value="<?php echo($this->content->getDTQDTA()); ?>" placeholder="dd/mm/YYYY hh:mm:ss" />
						<br />
						<?php endif; ?>


						<?php if($this->configs->getMNUTXT() == 1 && $this->configs->getMNUWRD() != 1): ?>
						<label for="dtq_txt" class="inline">{Text}</label>
						<textarea name="featured[DTQ_TXT]" id="dtq_txt" class="inptAll vTop"><?php echo(htmlentities($this->content->getDTQTXT())); ?></textarea>
						<br />
						<?php endif; ?>

						<?php if($this->configs->getMNUWRD() == 1): ?>
						<label for="cnt_txt" class="hidden">{Text}</label>
						<textarea name="featured[DTQ_TXT]" class="tinymce"><?php echo(htmlentities($this->content->getDTQTXT())); ?></textarea>
						<?php endif; ?>

						<?php if($this->configs->getMNULIN() == 1): ?>
						<label for="dtq_lnk" class="inline">{Link}</label>
						<input type="text" name="featured[DTQ_LNK]" id="dtq_lnk" class="inptAll" value="<?php echo($this->content->getDTQLNK()); ?>"  />
						<br />
						<?php endif; ?>
						<?php if($this->configs->getMNULTX() == 1): ?>
							<label for="dtq_ltx" class="inline">{Link Text}</label>
							<input type="text" name="featured[DTQ_LTX]" id="dtq_ltx" class="inptAll" maxlength="180" value="<?php echo($this->content->getDTQLTX()); ?>"/><br />
						<?php endif; ?>
						<?php if($this->configs->getMNULN2() == 1): ?>
							<label for="dtq_ln2" class="inline">{Link} 2</label>
							<input type="text" name="featured[DTQ_LN2]" id="dtq_ln2" class="inptAll" value="<?php echo($this->content->getDTQLN2()); ?>"  /><br />
						<?php endif; ?>
						<?php if($this->configs->getMNUTGT() == 1): ?>
						<?php
							$target = new FuriousSelect("DTQ_TGT", "{Target}", array("_self" => "Mesma Janela", "_blank" => "Nova Janela"));
							$target->setFormContainer("featured");
							$label = &$target->getLabel();
							$label->setAttribute("class", "inline");
							$target->setValue($this->content->getDTQTGT());
							echo($target);
						?>
						<br />
						<?php endif; ?>

						<?php if($this->configs->getMNUIRE() == 1): ?>
							<label for="dtq_ire" class="inline">{Related Content}</label>
							<input type="text" name="featured[DTQ_IRE]" id="dtq_ire" class="inptAll relID" rel="dtq_ire2" value="<?php echo($this->content->getDTQIRE()); ?>"/><br />
							<br />
						<?php endif; ?>
						<?php if($this->configs->getMNUCAT() == 1 ): ?>
							<?php
								$array = array("" => "Selecione uma Editoria");
								$array = $array + $this->cats[0];


								$select = new FuriousSelect("DTQ_CAT", "{Editorial}", $array);
								$label = &$select->getLabel();

								$label->setAttribute("class", "inline");

								$select->setFormContainer("featured");
								$select->setValue($this->content->getDTQCAT());

								echo($select);
							?>
						<?php endif; ?>

						<?php if($this->configs->getMNUDTP() == 1 ): ?>
							<?php
								$array = array("" => "Selecione o Tipo de Conte?do", "NT" => "Nota", "GA" => "Galeria", "CA" => "Agenda", "VD" => "V?deo");

								$select = new FuriousSelect("DTQ_DTP", "{Content Type}", $array);
								$label = &$select->getLabel();

								$label->setAttribute("class", "inline");

								$select->setFormContainer("featured");
								$select->setValue($this->content->getDTQDTP());

								echo($select);
							?>
						<?php endif; ?>
						<?php if($this->configs->getMNUPRG() == 1): ?>
						<?php
						$array = array("" => "Selecione o Programa", "1" => "Palavra Amiga", "2" => "Santo Culto", "3" => "The Love School", "4" => "Duelo dos Deuses");

						$select = new FuriousSelect("DTQ_CAT", "{Program}", $array);
						$label = &$select->getLabel();

						$label->setAttribute("class", "inline");

						$select->setFormContainer("featured");
						$select->setValue($this->content->getDTQCAT());

						echo($select);

						?>
						<br />
						<?php endif; ?>

						<?php if($this->configs->getMNUEMB1() == 1): ?>
						<br />
						<label for="dtq_emb" class="inline">Embed1</label>
						<textarea name="featured[DTQ_EMB]" id="dtq_emb" class="inptAll vTop"><?php echo(htmlentities($this->content->getDTQEMB())); ?></textarea>
						<br />
						<?php endif; ?>
						<?php if($this->configs->getMNUEMB2() == 1): ?>
						<label for="dtq_emb2" class="inline">Embed2</label>
						<textarea name="featured[DTQ_EMB2]" id="dtq_emb2" class="inptAll vTop"><?php echo(htmlentities($this->content->getDTQEMB2())); ?></textarea>
						<br />
						<?php endif; ?>



					</div>
				</div>
				<!-- /Conteudo -->


				<!-- Submit Button -->
				<p class="centerTxt"><input type="submit" value="{Save}" />  <input type="reset" value="{Reset}" /></p>
				<!-- /Submit Button -->
			</div>
			<!-- /Col 1 -->
			<!-- Col 2 -->
			<div class="col-2">
				<?php $this->insertBlock("home", "publishBox", array("CONTAINER" => "featured", "CONTENT" => $this->content, "STATUS_FIELD" => "DTQ_STS")); ?>

				<?php if($this->configs->getMNUIMG() == 1): ?>
				<?php $this->insertBlock("home", "imageBox", array("CONTAINER" => "featured", "CONTENT" => $this->content, "THUMB_TYPE" => "THB_DTQ", "FIELD_NAME" => "IMG_DTQ")); ?>
				<?php endif; ?>

				<?php if($this->configs->getMNUIMG2() == 1): ?>
				<?php $this->insertBlock("home", "imageBox", array("CONTAINER" => "featured", "CONTENT" => $this->content, "THUMB_TYPE" => "THB_DTQ2", "FIELD_NAME" => "IMG_DTQ2")); ?>
				<?php endif; ?>

				<?php if($this->configs->getMNUIMG3() == 1): ?>
				<?php $this->insertBlock("home", "imageBox", array("CONTAINER" => "featured", "CONTENT" => $this->content, "THUMB_TYPE" => "THB_DTQ3", "FIELD_NAME" => "IMG_DTQ3")); ?>
				<?php endif; ?>



			</div>
			<!-- /Col 2 -->
		</div>
		<!-- /Two Cols -->
	</form>
<!-- /Content -->
</div>
