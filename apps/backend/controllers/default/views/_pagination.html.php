<?php 
if($this->totalPages > 1): 
	?>
<!-- Paginação -->
<div class="rightTxt pagination clearR mBottom alignRight"> <?php echo($this->totalItens); ?> itens 
	<?php if(($this->currentPage-1) >= 0): ?><a href="<?php echo($this->paginationLink);?>=0" class="bot">&laquo;</a><?php endif; ?>
	<?php if($this->prevPage != NULL && is_int($this->prevPage)): ?><a href="<?php echo($this->paginationLink.($this->prevPage-1)); ?>" class="bot">&lt;</a><?php endif; ?>
	<form class="inline" class="paginationForm" method="get">
		<input type="text" id="pg" name="pg" value="<?php echo(($this->currentPage+1)); ?>" /> de <?php echo($this->totalPages); ?></form>
<?php if($this->nextPage != NULL): ?><a href="<?php echo($this->paginationLink.($this->nextPage-1)); ?>" class="bot">&gt;</a><?php endif; ?>
<?php if($this->totalPages > ($this->currentPage+1)): ?><a href="<?php echo($this->paginationLink."".($this->totalPages-1)); ?>" class="bot">&raquo;</a><?php endif; ?>
	</div>
<!-- /Paginação -->

<?php endif; ?>