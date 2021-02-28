<header id="insideHeader">
    <div class="insideWaves">
        <div class="insideTop">
            <h2>{Nutricao}</h2>
            <p class="topSlogan">{WE_LOVE_DO_THE_BEST}</p>
            <p class="breadCrumb"><strong>{YOU_ARE_HERE}:</strong>  <a href="#">{Pagina_Principal}</a> / <a href="#">{Nutricao}</a></p>
        </div>
    </div>
    <div class="showImage" style="background-image: url(<?=$this->dica->getCNTFTO()->getFile()->getPath2();?>);" >
        <div class="txtCenter">
            <div class="alignContent">
                <h2><?=$this->dica->CNT_TIT?></h2>
                <p class="topSlogan">
                  <?=date("d", strtotime($this->dica->CNT_DTA))?> {<?= "Month: ".date("m", strtotime($this->dica->CNT_DTA))?>} <?php echo(date("Y", strtotime($this->dica->CNT_DTA))); ?>
                </p>
            </div>
        </div>
        <span class="miniImage" style="background-image: url(<?=$this->dica->getCNTFTO()->getFile()->getPath2();?>);" ></span>
    </div>
</header>
<!--  /Header -->
<style>
    #insideHeader .insideTop {
        position: static !important;

    }
</style>
<!--  Content -->
<section id="insideContent">
    <div class="alignContent">
        <div class="txtContent">
            <?=$this->dica->CNT_TXT?>
            <div class="bibliography">
                <p><b>{REFERENCIAS_BIBLIOGRAFICAS}</b></p>
                <?=$this->dica->CNT_EMB?>
            </div>
        </div>

        <?php
        $prods = $this->dica->getProdsDicas();
        if($prods[0]){?>
          <div class="tipsProducts">
              <h2 class="txtCenter">Produtos utilizados nesta dica</h2>
              <ul>
                  <?php foreach($prods as $prod){ ?>
                    <?php
                      $foto = $prod->getCNTFTO();
                      if(!empty($foto)){
                        $file = $foto->getFile();
                      }
                    ?>
                  <li>
                      <p><a href="<?php echo($prod->getURL()); ?>"><?php echo($prod->getCNTTIT()); ?></a></p>
                      <?php if(!empty($file)){ ?> <a href="<?php echo($prod->getURL()); ?>"><img src="<?= $file->getFormat("165x165"); ?>" width="120" /></a><?php } ?>
                  </li>
                  <?php } ?>
              </ul>
          </div>
        <?php } ?>

        <div class="boxSettings">
            <nav>
                <a href="" class="star"></a>
                <a href="" class="emailto"></a>
                <a href="<?php echo($this->site->PDT_URL); ?>dicas-de-nutricao-impressao/<?=Slugfy2($this->dica->CNT_TIT)?>-<?=$this->dica->CNT_ID?>"  target="_blank" class="print"></a>
            </nav>

            <?php $this->insertBlock("home", "share"); ?>

        </div>
    </div>
</section>
<!--  /Content -->


<?php $this->insertBlock("home", "maisDicas"); ?>
