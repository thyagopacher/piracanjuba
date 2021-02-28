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
		<input type="hidden" name="news[MSG_ID]" value="<?php echo($this->content->getMSGID()); ?>" />
		<!-- Two Cols -->
		<div class="two-cols LeftExpanded">
			<!-- Col 1 -->
			<div class="col-1">
				<!-- Conteudo -->
				<div class="box">
					<h3><?php echo($this->pageTitle);
					//var_dump($this);?></h3>
					<div>
						<!--label for="cnt_tit" class="hidden">{Title}</label>
						<input type="text" name="news[MSG_CTI]" id="cnt_tit" class="inputText" placeholder="{Title}" value="< ?php echo($this->content->getMSGCTI()); ?>"/><br /-->


						<label for="msg_nom" class="hidden">Nome</label>
						<input type="text" name="news[MSG_NOM]" id="msg_nom" class="inputText" placeholder="Nome" value="<?php echo($this->content->getMSGNOM()); ?>"/><br />

						<label for="msg_ema" class="hidden">E-mail</label>
						<input type="text" name="news[MSG_EMA]" id="msg_ema" class="inputText" placeholder="E-mail" value="<?php echo($this->content->getMSGEMA()); ?>"/><br />

						<label for="msg_tel" class="hidden">Estado</label>
						<input type="text" name="news[MSG_TIT]" id="msg_tel" class="inputText" placeholder="Estado" value="<?php echo($this->content->getMSGTIT()); ?>"/><br />


						<?php if($this->arqConfig == 67){ ?>
							<label for="msg_arq">Arquivo</label>
							<input type="hidden" name="news[MSG_TXT]" id="msg_arq" class="inputText" value="<?php echo($this->content->getMSGTXT()); ?>"/><br />
							<?php
								$arq = $this->content->getArquivo();

								//if(!empty($arq) && $arq->isExtension('mp3')){

								//}
								echo($arq);
							 	//echo("Embed: ".$arq);
							} else{ echo("<b>Embed:</b>&nbsp; ".$this->content->getMSGTXT()); } ?>





					</div>
				</div>
				<!-- /Conteudo -->
				<?php //$this->insertBlock("home", "linksBox", array("CONTAINER" => "news", "CONTENT" => $this->content, "BOX_TITLE" => $this->linksTitle, "NOT_SHOWLINK" => $this->linksShow)); ?>

				<!-- Submit Button -->
				<p class="centerTxt"><input type="submit" value="{Save}" /> <input type="reset" value="{Reset}" /></p>
				<!-- /Submit Button -->
			</div>
			<!-- /Col 1 -->
			<!-- Col 2 -->
			<div class="col-2">
				<?php $this->insertBlock("home", "publishBox", array("CONTAINER" => "news", "CONTENT" => $this->content, "STATUS_FIELD" => "MSG_STS")); ?>

				<?php $this->insertBlock("home", "imageBox", array("CONTAINER" => "news", "FILE_ID" => $this->content->getMSGRSP(), "TITLE"=> "Arquivo Rezende", "FIELD_NAME" => "MSG_RSP", "ADD_TEXT" => "Adicionar Arquivo", "REMOVE_TEXT" => "Remover Arquivo")); ?>



				<!-- ?php $this->insertBlock("home", "editorialsBox", array("CONTAINER" => "news", "CONTENT" => $this->content)); ?>

				< ?php $this->insertBlock("home", "imageBox", array("CONTAINER" => "news", "CONTENT" => $this->content, "THUMB_TYPE" => "THB_CNT")); ?>




				< ?php $this->insertBlock("home", "imageBox", array("CONTAINER" => "news", "CONTENT" => $this->content, "THUMB_TYPE" => "THB_EMB2", "TITLE"=> "Imagem Embed2", "FIELD_NAME" => "IMG_DTQ3")); ?>

				< ?php $this->insertBlock("home", "tagsBox", array("CONTAINER" => "news", "CONTENT" => $this->content)); ?>

				< ?php $this->insertBlock("home", "relcontentBox", array("CONTAINER" => "news", "CONTENT" => $this->content)); ?>

				< ?php $this->insertBlock("home", "featuredBox", array("CONTAINER" => "news", "CONTENT" => $this->content)); ?-->



			</div>
			<!-- /Col 2 -->
		</div>
		<!-- /Two Cols -->
	</form>

</div>
<!-- /Content -->
