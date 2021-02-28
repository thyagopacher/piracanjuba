<?php $this->insertBlock("home", "bannerHome", array("CONTENT" => $this->content)); ?>

<?php $this->insertBlock("home", "produtoDestaque", array("CONTENT" => $this->content)); ?>

<?php if(APP_DEFAULT_EDITORIAL == 1){
  $this->insertBlock("home", "receitasHome", array("CONTENT" => $this->content));
  $this->insertBlock("home", "ondeEncontrar", array("CONTENT" => $this->content));
} ?>

<?php $this->insertBlock("home", "redesSociais", array("CONTENT" => $this->content)); ?>
