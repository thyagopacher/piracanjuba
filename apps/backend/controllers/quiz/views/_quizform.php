<input type="radio" name="inptType" id="Correct" class="noVisible" value="certo" checked="checked" />
<input type="radio" name="inptType" id="Profile" class="noVisible" value="perfil" />
<ul class="menuSeta">
	<li><label for="Correct">Certo e Errado</label></li>
	<li><label for="Profile">Traçar perfil</label></li>
</ul>
<div id="formQuiz">
	<?php $i = 1; if(!empty($this->questions[0])): ?>
		<?php foreach($this->questions as $question): ?>
		<fieldset class="question<?php echo($i); ?>">
			<input type="text" name="quiz[questions][questionName][]" placeholder="{Question} <?php echo($i); ?>" class="inputText" value="<?php echo($question->getTSPTIT()); ?>"/>
			<div>
				<?php $alphabet = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K"); ?>
				<?php for($z=0; $z<=9; $z++){ ?>
					<?php 
					$mName = "getTSPAL".$z;
					$alName = $question->$mName();
					if(!empty($alName)){
					?>
				<label rel="<?php echo($alphabet[$z]); ?>"><?php echo($alphabet[$z]); ?></label>
				<input type="text" name="quiz[questions][question<?php echo($i); ?>][]" value="<?php echo($alName); ?>"/><br />
				<?php } } ?>
				<p><a href="#" class="bot InsertOption">{Insert Alternative}</a></p>
			</div>
		</fieldset>	
		<?php $i++; endforeach; ?>
	<?php else: ?>
	<fieldset class="question<?php echo($i); ?>">
		<input type="text" name="quiz[questions][questionName][]" placeholder="{Question} <?php echo($i); ?>" class="inputText" />
		<div>
			<label rel="A">A</label><input type="text" name="quiz[questions][question<?php echo($i); ?>][]" /><br />
			<label rel="B">B</label><input type="text" name="quiz[questions][question<?php echo($i); ?>][]" /><br />
			<label rel="C">C</label><input type="text" name="quiz[questions][question<?php echo($i); ?>][]" /><br />
			<label rel="D">D</label><input type="text" name="quiz[questions][question<?php echo($i); ?>][]" /><br />
				
			<p><a href="#" class="bot InsertOption">{Insert Alternative}</a></p>
		</div>
	</fieldset>
	<?php endif; ?>
	<p class="centerTxt"><a href="#" class="bot insertQuestion">{Insert Question}</a></p>
	<div class="hr"><hr /></div>
	<h4>Resultado do Quiz <strong class="smallTxt">(Da maior incidência de acertos para o menor)</strong></h4>
	<?php if(!empty($this->answers[0])): ?>
		<?php foreach($this->answers as $answer): ?>
			<input type="text" name="quiz[answers][]" class="inputText" value="<?php echo($answer->getTSRTIT()); ?>" />	
		<?php endforeach; ?>
	<?php else:?>
	<input type="text" name="quiz[answers][]" class="inputText" />
	<input type="text" name="quiz[answers][]" class="inputText" />
	<input type="text" name="quiz[answers][]" class="inputText" />
	<?php endif; ?>
	<p><a href="#" class="bot  insertAnswer">{Insert Answer}</a></p>
</div>