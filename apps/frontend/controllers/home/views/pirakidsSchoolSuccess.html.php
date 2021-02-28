<header id="insideHeader">
    <div class="insideWaves">
        <div class="insideTop">
            <h2>{Produtos}</h2>
            <p class="topSlogan">{WE_LOVE_DO_THE_BEST}</p>
            <p class="breadCrumb"><strong>{YOU_ARE_HERE}:</strong>  <a href="#">{Pagina_Principal}</a> / <a href="#">{Produtos}</a> / <a href="#">Pirakids</a></p>
        </div>
    </div>
    <div class="showImage" style="background-image: url(<?=$this->categoria->getCATFTO()->getFile()->getPath2();?>);" >
        <div class="productSlide">
            <?php
            if(!empty($this->prodMaior)){
                ?>
                <a href="<?=$this->prodMaior->getURL();?>" class="prev"></a>
                <?php
            }
            ?>
            <ul>
                <li>
                    <div class="description">
                        <h3>
                            <a href="">
                                <span class="name"><?=$this->produto->CNT_TIT?></span>
                                <?php if(!empty($this->produto->CNT_TXT)){
                                   ?>
                                    <span class="desc"><?=$this->produto->CNT_TXT?></span>
                                    <span class="weight"><?=$this->produto->CNT_OLH?></span>
                                <?php
                                }?>

                            </a>
                        </h3>
                        <a href="/faq" class="button faq">FAQ</a>
                        <a href="<?=$this->produto->getURL()?>/informacoes-nutricionais" class="button infoNutri">{Informacoes_Nutricionais}</a>
                    </div>
                    <a href=""><img src="<?=$this->produto->getCNTFTO()->getFile()->getFormat("250x380");?>" width="210" /></a>
                </li>
            </ul>
            <?php
            if(!empty($this->prodMenor)){
                ?>
                <a href="<?=$this->prodMenor->getURL();?>" class="next"></a>
                <?php
            }
            ?>
        </div>
    </div>
</header>
<!--  /Header -->

<!--  Content -->
<section id="insideContent">
    <div class="alignContent">
        <h1 class="txtCenter"><?=$this->categoria->CAT_NOM?></h1>
        <div class="txtCenter">
            <?=$this->categoria->CAT_TXT?></div>
    </div>

    <?php
    $fto = $this->produto->getDTQFTO("THB_EMB1");
    $bg = "";
    if(!empty($fto)){
        $bg = $fto->getPath2();
    }
    $fto2 = $this->produto->getDTQFTO("THB_EMB2");
    $bg2 = "";
    if(!empty($fto2)){
        $bg2 = $fto2->getPath2();
    }
    ?>
    <div class="custom-bg" style="background-image: url('<?php echo($bg); ?>'); ">
      <?php if(!empty($bg2)){ ?>
        <img src="<?php echo($bg2); ?>" />
        <?php } ?>
    </div>
    <?php

      if(!empty($this->seeMore)){
      $produtos = $this->seeMore->getConteudos("PROD", 2);

      $prods = array();

      foreach($produtos as $prod){
          $prods[] = $prod;
      }

      if(count($prods) > 0){
    ?>
    <div class="see-also" style="background-image: url(<?=APP_JS_PREFIX?>images/bg_veja_tambem.jpg); ">
        <div class="alignContent">
            <h1 class="txtCenter"><img src="<?=APP_JS_PREFIX?>images/veja-tambem.png" /></h1>
            <ul>
              <?php
                foreach($produtos as $prod){

                  $img = $prod->getCNTFTO();
                  if(!empty($img)){
                    $fto = $img->getFile();
                  }
                  if(!empty($fto)){ ?>
                <li><a href="<?php echo($prod->getUrl()); ?>"><img src="<?php echo($fto->getFormat("250x380")); ?>" width="210"></a></li>
              <?php } } ?>
            </ul>
        </div>
    </div>
    <?php } } ?>

    <?php
		$this->insertBlock("home", "outrosProdutos", array("produto" => $this->produto));
    ?>

</section>
