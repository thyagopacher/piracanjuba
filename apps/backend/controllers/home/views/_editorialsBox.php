<!-- EditorialForm -->
<div id="EditorialForm" class="box">
	<h3>Editorias</h3>
	<div>
		<div class="masker">
			<ul class="editorialList">
				<?php
					if(empty($this->option)):
					if(!empty($this->itens[0])):
						foreach($this->itens as $item):
							$checkbox = new FuriousCheckbox("EDT_CATS", $item->getCATNOM(), $item->getCATID());
							$checkbox->setMultiple();
							$checkbox->setFormContainer($this->container);
							if(in_array($item->getCATID(), $this->selecteds))
							{
								// Make Checkbox Selected
								$checkbox->setValue( $item->getCATID() );
							}
				?>
				<li><?php echo($checkbox); ?></li>
				<?php endforeach; else: ?>
					<li>Nenhuma categoria para este site.</li>
				<?php endif; ?>
				<?php else: 
						$select = new FuriousSelect("EDT_CATS", "Editorias", $this->option);
						$select->setFormContainer($this->container);
						foreach($this->selecteds as $selected)
						{
							$select->setValue( $selected);
						}
						
						echo($select);
					endif; ?>

			</ul>
		</div>
	</div>
</div>
<!-- /EditorialForm -->