<!-- Content -->
<div id="internal-page">
	<!-- OpenHide -->
	<!--div class="openHideChecked">
		
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
	</div-->
	
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
	
		<input type="hidden" name="menu[id]" value="<?php echo($this->content->getID()); ?>" />
		<?php //var_dump($this->content); ?>
		<!-- Two Cols -->
		<div class="two-cols LeftExpanded">
			<!-- Col 1 -->
			<div class="col-1">
				<!-- Conteudo -->
				<div class="box">
					<h3><?php echo($this->pageTitle); ?></h3>
					<div>
						<label for="name">Nome</label><br />
						<input type="text" name="menu[name]" id="name" class="inputText" value="<?php echo($this->content->getName()); ?>"/><br /><br />
						
						<label for="value1">Opção 1</label><br />
						<input type="text" name="menu[value1]" id="value1" class="inputText"  value="<?php echo($this->content->getValue1()); ?>"/><br /><?php echo(($this->content->getVoto1() != 0) ? "<b>".$this->content->getVoto1()."</b> voto(s)" : ""); ?><br /><br />
						
						<label for="value2">Opção 2</label><br />
						<input type="text" name="menu[value2]" id="value2" class="inputText"  value="<?php echo($this->content->getValue2()); ?>"/><br /><?php echo(($this->content->getVoto2() != 0) ? "<b>".$this->content->getVoto2()."</b> voto(s)" : ""); ?><br /><br />
						
						<label for="value3">Opção 3</label><br />
						<input type="text" name="menu[value3]" id="value3" class="inputText"  value="<?php echo($this->content->getValue3()); ?>"/><br /><?php echo(($this->content->getVoto3() != 0) ? "<b>".$this->content->getVoto3()."</b> voto(s)" : ""); ?><br /><br />
						
						<label for="value4">Opção 4</label><br />
						<input type="text" name="menu[value4]" id="value4" class="inputText"  value="<?php echo($this->content->getValue4()); ?>"/><br /><?php echo(($this->content->getVoto4() != 0) ? "<b>".$this->content->getVoto4()."</b> voto(s)" : ""); ?><br /><br />
						
						<label for="value5">Opção 5</label><br />
						<input type="text" name="menu[value5]" id="value5" class="inputText"  value="<?php echo($this->content->getValue5()); ?>"/><br /><?php echo(($this->content->getVoto5() != 0) ? "<b>".$this->content->getVoto5()."</b> voto(s)" : ""); ?><br /><br />
						
						<?php /*
							$target = new FuriousSelect("target", "{Target}", array("_self" => "Mesma Janela", "_blank" => "Nova Janela"));
							$target->setFormContainer("menu");
							$label = &$target->getLabel();
							$label->setAttribute("class", "inline");
							$target->setValue($this->content->getTGT());
							echo($target);*/
						?>
						<br />
						<?php 			/*				
							$pai = new FuriousSelect("pai", "Item Pai", $this->labels);
							$pai->setFormContainer("menu");
							$label = &$pai->getLabel();
							//$label->setAttribute("class", "inline");
							$pai->setValue($this->content->getPAI());
							echo($pai);*/
						?>
						<br />						
						<?php
								/*
								$ordem = new FuriousInput("ordem", "Ordem");
								$ordem->setFormContainer("menu");
								$ordem->setAttribute("type", "number");
								$label = &$ordem->getLabel();
								//$label->setAttribute("class", "inline");
								$ordem->setValue($this->content->getORD());
								echo($ordem);							
								*/
						?>
						
						<?php /*$dta = $this->content->getCNTDTA(); if(!empty($dta)){ ?>
						<!-- LinkSite -->
						<?php
							$url = ($this->content->getCNTTIT() != false || $this->content->getCNTTIT() != "")?Slugfy($this->content->getCNTTIT()):"{untitled}";
							$url .= "-".($this->content->getCNTID());
						?>
							<p>
								<a href="<?php printf("%s{news_url}/%s/%s.html", $this->Site->getPDTURL(), date("Y/m/d", strtotime($dta)), $url); ?>" class="linkSite" target="_blank">
									<?php printf("%s{news_url}/%s/%s.html", $this->Site->getPDTURL(), date("Y/m/d", strtotime($dta)), $url); ?>
								</a>
							</p>						
							<p>
								<a href="<?php printf("%s%s", $this->Site->getPDTURL(), $this->content->getCNTID()); ?>" class="linkSite" target="_blank">
									<?php printf("%s%s", $this->Site->getPDTURL(), $this->content->getCNTID()); ?>
								</a>
							</p>						
						<!-- /LinkSite -->
						
						<label for="cnt_olh" class="hidden">{Intro}</label>
						<input type="text" name="news[CNT_OLH]" id="cnt_olh" class="inputText" placeholder="Olho" maxlength="180" value="< ?php echo($this->content->getCNTOLH()); ?>"/><br />
						
						<label for="cnt_txt" class="hidden">{Text}</label>
						<textarea name="news[CNT_TXT]" class="tinymce"><?php echo($this->content->getCNTTXT()); ?></textarea>
						
						<?php */ ?>
						
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
				<?php $this->insertBlock("home", "publishBox", array("CONTAINER" => "menu", "CONTENT" => $this->content, "HAS_DATE" => false, "STATUS_FIELD" => "status")); ?>
				<?php /* ?>
				<?php $this->insertBlock("home", "editorialsBox", array("CONTAINER" => "news", "CONTENT" => $this->content)); */?>
				
				<?php //$this->insertBlock("home", "imageBox", array("CONTAINER" => "menu", "CONTENT" => $this->content, "THUMB_TYPE" => "file_id")); ?>

				
				<?php $this->insertBlock("home", "imageBox", array("CONTAINER" => "menu", "CONTENT" => $this->content, "THUMB_TYPE" => "THB_ENQ", "TITLE"=> "Imagem Embed1", "FIELD_NAME" => "file_id")); ?>
				
				<?php /*$this->insertBlock("home", "imageBox", array("CONTAINER" => "news", "CONTENT" => $this->content, "THUMB_TYPE" => "THB_EMB2", "TITLE"=> "Imagem Embed2", "FIELD_NAME" => "IMG_DTQ3")); ?>
				
				<?php $this->insertBlock("home", "tagsBox", array("CONTAINER" => "news", "CONTENT" => $this->content)); ?>
				
				<?php $this->insertBlock("home", "relcontentBox", array("CONTAINER" => "news", "CONTENT" => $this->content)); ?>
				<?php */ ?>
				<?php //$this->insertBlock("home", "featuredBox", array("CONTAINER" => "news", "CONTENT" => $this->content)); ?>
				
				
				
			</div>
			<!-- /Col 2 -->
		</div>
		<!-- /Two Cols -->
	</form>
	
</div>
<!-- /Content -->