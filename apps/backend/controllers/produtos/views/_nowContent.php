<!-- Now Content -->
<div id="nowContent" class="box">
	<h3>{Now}</h3>
	<div>
		<div class="two-cols">
			<div class="col-1">
				<table class="contentCounter">
					<thead>
						<caption>{Content}</caption>
					</thead>
					<tbody>
						<?php if($this->news > 0): ?>
						<tr>
							<td><?php echo($this->news); ?></td>
							<td>{News}</td>
						</tr>
						<?php endif; ?>
						<?php if($this->galeries > 0): ?>
						<tr>
							<td><?php echo($this->galeries); ?></td>
							<td>{Galleries}</td>
							
						</tr>
						<?php endif; ?>
						<?php if($this->polls > 0): ?>
						<tr>
							<td><?php echo($this->polls); ?></td>
							<td>{Polls}</td>
						</tr>
						<?php endif; ?>
					</tbody>
				</table>
				<?php if(!empty($this->contentItens["news/index"]) || !empty($this->contentItens["gallery/index"])): ?>
				<table class="contentCounter">
					<thead>
						<caption>{Actions}</caption>
					</thead>
					<tbody>
						<tr>
							<?php 
							if(!empty($this->contentItens["news/index"])): 
								$item = $this->contentItens["news/index"];
							?>
							<td><a href="<?php echo($item->getMenuURL()); ?>" title="adicionar noticia" class="icnSpriteBefore">{Add News}</a></td>
							<?php endif; ?>
						</tr>
						<tr>
							<?php 
							if(!empty($this->contentItens["gallery/index"])): 
								$item = $this->contentItens["gallery/index"];
							?>
							<td><a href="<?php echo($item->getMenuURL()); ?>" title="adicionar noticia" class="icnSpriteBefore">{Add Galerie}</a></td>
							<?php endif; ?>
						</tr>
					</tbody>
				</table>
				<?php endif; ?>
			</div>
			<div class="col-2">
				<table class="contentCounter">
					<caption>{Discussion}</caption>
					<tbody>
						<tr>
							<td><a href="<?php echo($this->siteSel->getURL()); ?>comments/index.php"><?php echo($this->allComments); ?></a></td>
							<td><a href="<?php echo($this->siteSel->getURL()); ?>comments/index.php">{Comments}</a></td>
						</tr>
						<tr>
							<td><a href="<?php echo($this->siteSel->getURL()); ?>comments/index.php?publishedSearch=1"><?php echo($this->approvedComments); ?></a></td>
							<td><a href="<?php echo($this->siteSel->getURL()); ?>comments/index.php?publishedSearch=1"><span class="approved-color">{Approved}</span></a></td>
						</tr>
						<tr>
							<td><a href="<?php echo($this->siteSel->getURL()); ?>comments/index.php?notpublishedSearch=0"><?php echo($this->penddantComments); ?></a></td>
							<td><a href="<?php echo($this->siteSel->getURL()); ?>comments/index.php?notpublishedSearch=0"><span class="pendant-color">{Pendant}</span></a></td>
						</tr>
						<tr>
							<td><a href="<?php echo($this->siteSel->getURL()); ?>comments/index.php?excluded=1"><?php echo($this->excludedComments); ?></a></td>
							<td><a href="<?php echo($this->siteSel->getURL()); ?>comments/index.php?excluded=1"><span class="excluded-color">{Excluded}</span></a></td>
						</tr>
					</tbody>
				</table>

			</div>
		</div>
	</div>
</div>
<!-- /Now Content -->