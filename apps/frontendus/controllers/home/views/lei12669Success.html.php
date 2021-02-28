<section id="insideContent">
	<div class="alignContent">
		<div class="txtContent txtCenter">
			<p><?=$this->conteudo[0]->CNT_TXT?></p>
		</div>
	</div>
	<div class="lawSearch">
		<div class="alignContent">
			<form name="lawsearch" action="" method="POST">
				<label for="year" class="lblSel" title="Ano">
					<select id="year" class="selectchange" name="year">
						<option value="">{Ano}</option>

						<?php if(!empty($this->years)){ ?>
							<?php foreach($this->years as $year){ ?>
								<option value="<?php echo($year->DTQ_LTX); ?>"><?php echo($year->DTQ_LTX); ?></option>
							<?php } ?>
						<?php } ?>
					</select>
				</label>
				<label for="month"  class="lblSel" title="{Mes}">
					<select id="month" class="selectchange txtCenter" name="month">

						<option value="">{Mes}</option>
						<?php if(!empty($this->months)){ ?>
							<?php foreach($this->months as $month){ ?>
								<option value="<?php echo($month->DTQ_LN2); ?>">{Mon: <?php echo($month->DTQ_LN2); ?>}</option>
							<?php } ?>
						<?php } ?>
					</select>
				</label>
				<input type="submit" value="{Pesquisar}">
			</form>


			<div class="lawTable">
				<p class="txtCenter"><?=$this->conteudo[1]->CNT_TXT?></p>
				<table border="0" cellpadding="0" cellspacing="0" >
					<thead>
					<tr>
						<th>{Itens}</th>
						<th>{Valores}</th>
						<th>{Unidade}</th>
					</tr>
					</thead>
					<tbody>

					<?php
					$i = 1;

					foreach($this->itens as $item){
						?>
						<tr>
							<td><?=$i." - ".$item->DTQ_TIT?></td>
							<td><?=$item->DTQ_CNL?></td>
							<td><?=$item->DTQ_LNK?></td>
						</tr>

					<?php
						$i++;
					}?>


					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="alignContent txtCenter obs">

		<?=$this->conteudo[2]->CNT_TXT?>
	</div>


	<div id="PagLeite" class="showImage tabs" style="background-image: url(<?=$this->conteudo[2]->getCNTFTO()->getFile()->getPath2();?>);" >
		<nav class="pro-menu txtCenter">
			<?php $i = 1;
			foreach($this->arrayTables as $outVar){ ?>
			<a href="#tab-<?php echo($i); ?>" class="hover">{<?php echo($outVar); ?>}</a>
			<?php $i++; } ?>
		</nav>

		<div class="lawTable">
			<?php
			$i = 1;
			foreach($this->arrayTables as $outVar){
				if(!empty($this->$outVar)){

					$out = $this->$outVar;
					$first = $out[0];
					//$this->$outVar = array_slice($this->$outVar, 1);

					?>
					<div id="tab-<?php echo($i); ?>" class="tab">
					<h2 class="txtCenter">{<?php echo($outVar); ?>}</h2>
					<?php 	if(!empty($first)){ ?>
					<table border="0" cellpadding="0" cellspacing="0" >
						<thead>
						<tr>
							<th><?=$first->DTQ_TIT?></th>
							<th><?=$first->DTQ_LNK?></th>
						</tr>
						</thead>
						<tbody>
						<?php foreach($this->$outVar as $key => $contagen_celula){

							if($key != 0){

								?>
								<tr>
									<td><?=$contagen_celula->DTQ_TIT?></td>
									<td><?=$contagen_celula->DTQ_LNK?></td>
								</tr>
						<?php
							}

						}?>
						</tbody>
					</table>
					<?php  } else { ?>
						<p>{Nothing Found}</p>
					<?php } ?>
				</div>
				<?php }
				$i++;
			} ?>

		</div>

	</div>



</section>
