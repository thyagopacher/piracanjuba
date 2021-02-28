<?php if(!empty($this->current)){ ?><a href="<?php echo($this->current['PATH']); ?>" class="<?php echo($this->current['NAME']); ?>"></a><?php } ?>
<nav class="lang">
  <?php foreach($this->langs as $lang){ ?>
  <a href="<?php echo($lang['PATH']); ?>" class="<?php echo($lang['NAME']); ?>"></a>
  <?php } ?>
</nav>
