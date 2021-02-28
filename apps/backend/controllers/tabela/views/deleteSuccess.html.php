<!-- Content -->
<div id="internal-page">
	<?php $this->insertBlock("home", "breadCrumb", array("CONTROLLER" => $this, "VARS" => $this->breadCrumb)); ?>
	<p><?php
		if(!empty($this->DeleteOk)): ?>
		{Successfully deleted record}
	<?php else: ?>
		{An error occurred try again latter}
	<?php endif; ?></p>
	<p><a href="<?php echo($this->linkLista); ?>" class="bot">{Back to list}</a></p>
</div>
