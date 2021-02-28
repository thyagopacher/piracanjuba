<div class="box">
	<h3 class="titleBlock"><?php echo($this->itens->getMNUTIT()); ?></h3>
	<div>
		<div class="two-cols">
			<div class="col-1">
				<table class="contentCounter">
					<thead>
					</thead><caption>{Module}</caption>
					<tbody>
						<tr>
							<td><a href="<?php echo($this->generateEdtURL(array($this->module, "novo"))); ?>" title="adicionar" class="icnSpriteBefore">{Add}</a></td>
						</tr>
						<tr>
							<td><a href="<?php echo($this->generateEdtURL(array($this->itens->getMNUTIP()))); ?>" title="lista" class="icnSpriteBefore">{List Featured}</a></td>
						</tr>
						<?php if(!empty($this->contentItens)): ?>
						<tr>
							<td><a href="<?php echo($this->contentItens->getMenuURL()); ?>" title="adicionar noticia" class="icnSpriteBefore">{Add News}</a></td>							
						</tr>
						<?php endif; ?>
					</tbody>
				</table>
				<?php if(!empty($this->schedule)): ?>
				<table class="contentCounter">
					<thead>
						<caption>{Status}</caption>
					</thead>
					<tbody>
						<tr>
							<td><?php echo(count($this->schedule)); ?> <span class="pendant-color">{Pendant}</span></td>
						</tr>
					</tbody>
				</table>
				<?php endif; ?>
			</div>
			<div class="col-2">
				<?php if(!empty($this->schedule)): ?>
				<table class="contentCounter">
					<caption class="icnSpriteBefore clockIcn">{Next Scheduled}</caption>
					<tbody>
						<?php foreach($this->schedule as $dtq): ?>
						<tr>
							<td><a href="#"><?php echo($dtq->getDTQTIT()); ?></a></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>