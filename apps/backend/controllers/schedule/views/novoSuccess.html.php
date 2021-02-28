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
		<input type="hidden" name="news[id]" value="<?php echo($this->content->getID()); ?>" />
		<!-- Two Cols -->
		<div class="two-cols LeftExpanded">
			<!-- Col 1 -->
			<div class="col-1">
				<!-- Conteudo -->
				<div class="box">
					<h3><?php echo($this->pageTitle); ?></h3>
					<div>
						<label for="cnt_tit">{Place}</label>
						<input type="text" name="news[place]" id="cnt_tit" class="inputText" placeholder="{Place}" value="<?php echo($this->content->getPlace()); ?>"/><br />
						
						
						<label for="cnt_olh">{Date}</label>
						<input type="text" name="news[date]" id="initial_pos" class="inputText" placeholder="{Date}" value="<?php echo(date("Y/m/d H:i:s", strtotime($this->content->getDate()))); ?>"/><br />
						
						<?php 
							$select = new FuriousSelect("team1", "{Selection}", $this->selections);
							$select->setFormContainer("news");
							$team = $this->content->getTeam1();
							if(!empty($team))
							{
								$select->setSelected($team->getID());
							}
							
							echo($select);
						?>
						<?php 
							$select = new FuriousSelect("team2", "{Selection}", $this->selections);
							$select->setFormContainer("news");
							$team = $this->content->getTeam2();
							if(!empty($team))
							{
								$select->setSelected($team->getID());
							}
							echo($select);
						?>
						
						<?php 
							$select = new FuriousSelect("winner", "{Winner}", array("" => "Selecione o vencedor", "1" => "{Team 1}", "2" => "{Team 2}"));
							$select->setFormContainer("news");
							$select->setSelected($this->content->getWinner());
							echo($select);
						?>
						
							<label for="cnt_olh">{Score Team 1}</label>
							<input type="text" name="news[score_team1]" id="initial_pos" class="inputText" placeholder="{Score Team 1}" value="<?php echo($this->content->getScoreTeam1()); ?>"/><br />
							
							<label for="cnt_olh">{Score Team 2}</label>
							<input type="text" name="news[score_team2]" id="initial_pos" class="inputText" placeholder="{Score Team 2}" value="<?php echo($this->content->getScoreTeam2()); ?>"/><br />
						
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
				<?php $this->insertBlock("home", "publishBox", array("CONTAINER" => "news", "CONTENT" => $this->content, "STATUS_FIELD" => "status", "HAS_DATE" => false)); ?>
				
				
			</div>
			<!-- /Col 2 -->
		</div>
		<!-- /Two Cols -->
	</form>
	
</div>
<!-- /Content -->