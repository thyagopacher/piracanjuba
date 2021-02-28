<div id="internal-page">
	<!-- OpenHide -->
	<div class="openHideChecked">
		
		<input type="checkbox" name="showHidePanelSwitch" class="hidden-check" id="showHidePanelSwitch" value="show"/>
		<div>
			<h6>Mostrar na tela</h6>
			<p>
				<input type="checkbox" name="show_comments" id="show_comments" value="show_comments" /><label class="no-points" for="show_comments">Comentários</label>
				<input type="checkbox" name="show_quiz" id="show_quiz" value="show_quiz" /><label class="no-points" for="show_quiz">Quiz</label>
				<input type="checkbox" name="show_pool" id="show_pool" value="show_pool" /><label class="no-points" for="show_pool">Enquete</label>
				<input type="checkbox" name="show_link" id="show_link" value="show_link" /><label class="no-points" for="show_link">Links relacionados</label>
			</p>
		</div>
		<label for="showHidePanelSwitch" class="showhideTit no-points">Opções de tela</label>
	</div>
	<!-- /OpenHide -->
	<form id="userForm" action="<?php echo($this->action); ?>" method="post">
		<!-- Two Cols -->
		<div class="">
			<?php $this->insertBlock("home", "breadCrumb", array("CONTROLLER" => $this, "VARS" => $this->breadCrumb)); ?>
			
				
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
		
			<h1 class="pgTit">{Edit User}</h1>
			<!-- Col 1 -->
			<div class="col-1">
				
				<!-- Conteudo -->
				<div class="box">
					<h3>{Edit User} </h3>
					<div>
						<input type="hidden" name="user[USU_ID]" id="usu_id" value="<?php echo($this->content->getUSUID()); ?>"/><br />
						
						<label for="usu_nom">{User Name}</label>
						<input type="text" name="user[USU_NOM]" id="usu_nom" placeholder="{User Name}" value="<?php echo($this->content->getUSUNOM()); ?>"/><br />
						<label for="usu_ema">{Email}</label>
						<input type="text" name="user[USU_EMA]" id="usu_ema" placeholder="{Email}" value="<?php echo($this->content->getUSUEMA()); ?>"/><br />
						<label for="usu_dpt">{Department}</label>
						<input type="text" name="user[USU_DPT]" id="usu_dpt" placeholder="{Department}" value="<?php echo($this->content->getUSUDPT()); ?>"/><br />
						<label for="usu_log">{Login}</label>
						<input type="text" name="user[USU_LOG]" id="usu_dpt"  placeholder="{Login}" value="<?php echo($this->content->getUSULOG()); ?>"/><br />
						<label for="usu_sen">{Password}</label>
						<input type="password" name="user[USU_SEN]" id="usu_sen"  placeholder="{Login}" value="<?php echo($this->content->getUSUSEN()); ?>"/><br />
						
						<?php
						/*$select = new FuriousSelect("USU_LAN", "{Language}", array("pt" => "{Portuguese}", "en" => "{English}", "es" => "{Espanol}"));
						$select->setFormContainer("user");
						if($this->content->getUSULAN())
						{
							$select->setSelected($this->content->getUSULAN());
						}
						echo($select);*/
						?>
						
						<?php
						$select = new FuriousSelect("USU_GRP", "{Group}", $this->groups);
						$select->setFormContainer("user");
						if($this->content->getUSUGRP())
						{
							$select->setSelected($this->content->getUSUGRP());
						}
						echo($select);
						?>
						
						<?php
						$select = new FuriousSelect("USU_STS", "{Status}", array(0 => "Desativado", 1 => "Ativo", 9 => "Deletado"));
						$select->setFormContainer("user");
						if($this->content->getUSUSTS())
						{
							$select->setSelected($this->content->getUSUSTS());
						}
						echo($select);
						?>
						
						
						
					</div>
				</div>
				<!-- /Conteudo -->
				
				<!-- Submit Button -->
				<p class="centerTxt"><input type="submit" value="cadastrar" /> <input type="reset" value="limpar" /></p>
				<!-- /Submit Button -->
			</div>
			<!-- /Col 1 -->
			
		</div>
		<!-- /Two Cols -->
	</form>			
</div>
<!-- /Content -->