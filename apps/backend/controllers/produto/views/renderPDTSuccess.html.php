<?php if(!empty($this->ID)): ?>
	<a href="/json/<?php echo(substr("00".$this->ID, 0, 2));?>/<?php echo(substr("00".$this->ID, -2));?>/PDT_1_<?php echo($this->ID); ?>.json">/json/<?php echo(substr("00".$this->ID, 0, 2));?>/<?php echo(substr("00".$this->ID, -2));?>/PDT_1_<?php echo($this->ID); ?>.json</a>
<?php endif; ?>