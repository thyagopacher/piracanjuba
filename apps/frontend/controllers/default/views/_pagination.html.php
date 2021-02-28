<?php
if($this->totalPages > 1):
	?>
	<!-- Paginação -->
	<div class="pagination">

		<?php if(($this->currentPage-1) >= 0): ?><a href="<?php echo($this->paginationLink);?>=0" class="prev"></a><?php endif; ?>
		<?php for($i = $this->startPagination; $i < $this->endPagintation; $i++){

			echo '<a href="'.($this->paginationLink.($i)).'">'.($i + 1).'</a>';

		}?>
		<?php if($this->totalPages > ($this->currentPage+1)): ?><a href="<?php echo($this->paginationLink."".($this->totalPages-1)); ?>" class="next"></a><?php endif; ?>

	</div>
	<!-- /Paginação -->

<?php endif; ?>