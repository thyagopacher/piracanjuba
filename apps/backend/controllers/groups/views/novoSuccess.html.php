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
	<form id="newsForm" action="<?php echo($this->action); ?>" method="post">
		<!-- Two Cols -->
		<div class="">
			<?php $this->insertBlock("home", "breadCrumb", array("CONTROLLER" => $this, "VARS" => $this->breadCrumb)); ?>
			
			<h1 class="pgTit">{Edit Profile}</h1>
			<!-- Col 1 -->
			<div class="col-1">
				
				<!-- Conteudo -->
				<div class="box">
					<h3>{Edit Profile} </h3>
					<div>
						<label for="grp_tit" class="hidden">{Profile Name}</label>
						<input type="text" name="groups[GRP_TIT]" id="grp_tit" class="inputText" placeholder="{Profile Name}" value="<?php echo($this->content->getGRPTIT()); ?>"/><br /><br />
						
						
						<?php if(!empty($this->sites[0])): ?>
						<div class="Sites">
							<?php foreach($this->sites as $site): ?>	
							<?php 
								$input = new FuriousCheckbox("sitePerm-".$site->getPDTID(), "<strong>".$site->getPDTNOM()."</strong>", $site->getPDTID(), array("name" => "groups[sites][".$site->getPDTID()."][siteID]"));
								
								if(!empty($this->profilePerms['PRODUTOS'][$site->getPDTID()]))
								{
									$input->setValue($this->profilePerms['PRODUTOS'][$site->getPDTID()]);
								}
								
								echo($input);
							?>
							
							<div class="hideShowPerms">
								<?php
								
								$edtItens = $site->getEditorialMenu();
								if(count($edtItens) > 0 && is_array($edtItens))
								{
									$edtItens = array_chunk($edtItens, (((count($edtItens)/3) > 1)?(count($edtItens)/3):1));
								
									echo("<div class=\"three-cols\">");
										$z=1;
										foreach($edtItens as $col)
										{
											echo("<ul class=\"col-{$z}\">");
											foreach($col as $item){
												echo("<li>");
												$input = new FuriousCheckbox("menuPerm-".$item->getMNUID(), "<strong>".$item->getMNUTIT()."</strong>", $item->getMNUID(), array("name" => "groups[menu][".$item->getMNUID()."]"));
											
												if(!empty($this->profilePerms['MENUS'][$item->getMNUID()]))
												{
													$input->setValue($this->profilePerms['MENUS'][$item->getMNUID()]);
												}
											
												echo($input);
												echo("</li>");
											}
											echo("</ul>");
										
											$z++;
										}
									echo("</div>");
								}
								
								
									$menuItens = $site->getAllEditorials();
									unset($menuItens[0]);
									
									$i=1;
									foreach($menuItens as $edt)
									{
										echo("<div class=\"edts\">");
										
											$input = new FuriousCheckbox("edtPerm-".$edt->getPDTID(), "<strong>".$edt->getPDTNOM()."</strong>", $edt->getPDTID(), array("name" => "groups[EDTS][".$edt->getPDTID()."]"));
											
											if(!empty($this->profilePerms['PRODUTOS'][$edt->getPDTID()]))
											{
												$input->setValue($this->profilePerms['PRODUTOS'][$edt->getPDTID()]);
											}
											echo($input);
											
											
											$edtItens = $edt->getEditorialMenu();
											if(count($edtItens) > 0 && is_array($edtItens))
											{
												$edtItens = array_chunk($edtItens, (((count($edtItens)/3) > 1)?(count($edtItens)/3):1));
											
												echo("<div class=\"hideShowPerms three-cols\">");
													$z=1;
													foreach($edtItens as $col)
													{
														echo("<ul class=\"col-{$z}\">");
														foreach($col as $item){
															echo("<li>");
															$input = new FuriousCheckbox("menuPerm-".$item->getMNUID(), "<strong>".$item->getMNUTIT()."</strong>", $item->getMNUID(), array("name" => "groups[menu][".$item->getMNUID()."]"));
														
															if(!empty($this->profilePerms['MENUS'][$item->getMNUID()]))
															{
																$input->setValue($this->profilePerms['MENUS'][$item->getMNUID()]);
															}
														
															echo($input);
															echo("</li>");
														}
														echo("</ul>");
													
														$z++;
													}
												echo("</div>");
											}
											
										//var_dump($col);
										echo("</div>");
										
										$i++;	
									}
								?>
							</div>
							<div class="hr"><hr /></div>
							<?php endforeach; ?>
						</div>
						<?php endif; ?>
						
					</div>
				</div>
				<!-- /Conteudo -->
				
				<!-- Submit Button -->
				<p class="centerTxt"><input type="submit" value="{Save}" /></p>
				<!-- /Submit Button -->
			</div>
			<!-- /Col 1 -->
		</div>
		<!-- /Two Cols -->
	</form>			
</div>
<!-- /Content -->