
<section id="ProductHolderHome" class="waves">
    <div class="alignContent">
        <!--  Block -->
        <div id="lineExplain" class="block">
          <?php if(!empty($this->produtoPrincipal[0])){?>
            <h3 class="titleBlock"><?=$this->produtoPrincipal[0]->DTQ_CNL?></h3>
            <div class="bodyBlock">
                <h4><?=$this->produtoPrincipal[0]->DTQ_TIT?></h4>
                <p><a href="#"><?=$this->produtoPrincipal[0]->DTQ_TXT?></a></p>
            </div>

            <?php } ?>
        </div>
        <!--  /Block -->
        <!--  Block -->
        <div id="productHolder" class="block">
          <?php 
		  if(!empty($this->produtoPrincipal[0])){ 
			  $fto = $this->produtoPrincipal[0]->getDTQFTO();
			  if(!empty($fto)){
			  
		  ?>
            <div class="bodyBlock">
                <a href="#" class="disabled"><img src="<?= $fto->getFile()->getPath2(); ?>" /></a>
                <a href="<?=$this->produtoPrincipal[0]->DTQ_LNK?>" class="button"><?=$this->produtoPrincipal[0]->DTQ_LTX?></a>
            </div>
            <?php } } ?>
        </div>
        <!--  /Block -->
        <!--  Block -->

        <div id="testimonial" class="block">
          <?php if(!empty($this->depoimentoPrincipal[0])){ ?>
            <div class="bodyBlock">
                <a href="#"><img src="<?=$this->depoimentoPrincipal[0]->getDTQFTO()->getFile()->getPath2();?>" /></a>
            </div>
          <?php } ?>
        </div>
        <!--  /Block -->
    </div>
</section>
