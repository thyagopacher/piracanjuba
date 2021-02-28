<!-- PublishForm -->
<div id="boxPublish" class="box">
	<h3>{Publish}</h3>
	<div>
		<?php 
			$select = new FuriousSelect($this->statusFieldName, "{Status}", $this->statuses); 
			$select->setFormContainer($this->container);
			$sts = ($this->content->getStatus() == "8")?0:$this->content->getStatus();
			$select->setValue($sts);
			echo($select);
		?>
		<div class="hr">
			<hr />
		</div>
	
		<?php  if($this->hasDate == true){ ?>
		<!-- PubDate -->
		<span class="PubDate"><?php echo($this->statuses[$sts]); ?> em: <?php echo(date("d/m/Y H:i", strtotime($this->content->getDTA()))); ?> 
			<?php if(method_exists($this->content, "getDTQFIM")){ ?> <br /> Válido até: <?php echo(date("d/m/Y H:i", strtotime($this->content->getDTQFIM()))); ?><?php } ?>
			<a href="#" class="changePubDate">Editar</a></span>
		<?php $fieldName = (method_exists($this->content, "getDTQINI"))?"DTQ_INI":"CNT_DTA"; ?>
		<div class="date showHide hidden">
			<p><input type="text" name="<?php echo($this->container);?>[<?php echo($fieldName); ?>]" id="CNT_DTA" placeholder="mm/dd/YYYY HH:MM:SS" value="<?php echo(date("d/m/Y H:i:s",strtotime(($this->content->getDTA())))); ?>"/></p>
			<?php if(method_exists($this->content, "getDTQFIM")){ ?>
			<!-- End Date -->
				<label for="DTQ_FIM">até</label>
				<input type="text" name="<?php echo($this->container);?>[DTQ_FIM]" id="DTQ_FIM" placeholder="mm/dd/YYYY HH:MM:SS" value="<?php echo(date("d/m/Y H:i:s",strtotime(($this->content->getDTQFIM())))); ?>"/>
			<!-- /End Date -->
			<?php } ?>
		</div>
		<!-- /PubDate -->
		<?php } ?>
		
		<p class="rightTxt"><input type="submit" value="<?php if($this->content->getStatus() == '8'){?>{Save}<?php } else { ?>{Update}<?php } ?>" /></p>
	</div>
</div>
<!-- /PublishForm -->