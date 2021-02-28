<?php
$fto = $this->produto->getCNTFTO();

 ?>
<header id="insideHeader">
    <div class="insideWaves">
        <div class="insideTop">
            <div class="alignContent">
                <div></div>
            </div>
            <h2>{Produtos}</h2>
            <p class="topSlogan">{WE_LOVE_DO_THE_BEST}</p>
            <p class="breadCrumb"><strong>{YOU_ARE_HERE}:</strong>  <a href="#">{Pagina_Principal}</a> / <a href="/produtos">{Produtos}</a> / <a href="#">Pirakids</a></p>
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
                        <div class="faq">
                            <h3><a href="<?=$this->produto->getUrl(); ?>">Pirakids</a></h3>
                            <p><a href="<?=$this->produto->getUrl(); ?>"><b><?=$this->produto->CNT_TXT?></b><br/>  </a></p>
                            <a href="/faq" class="button faq">FAQ</a>
                        </div>
                        <div class="product">
                            <a href="<?=$this->produto->getUrl(); ?>"><img src="<?= $fto->getFile()->getFormat("250x380"); ?>" width="155" /></a>
                        </div>
                        <div class="info">
                            <h3>
                                <a href="<?=$this->produto->getUrl(); ?>">
                                    <span class="name"><?=$this->produto->CNT_TIT?></span><br/>
                                    <span class="desc"><?=$this->produto->CNT_OLH?></span><br/>
                                    <!--<span class="weight"><?=$this->produto->CNT_RES?></span>-->
                                </a>
                                <a href="<?=$this->produto->getURL()?>/informacoes-nutricionais" class="button infoNutri">{Informacoes_Nutricionais}</a>
                            </h3>
                        </div>
                    </div>

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
    <div class="custom-bg">
        <div class="alignContent who">
            <!-- QUANDO FOR EM PORTUGUÃŠS SERÃ A IMAGEM PORQUE ESSA LETRA NÃƒO POSSUI ACENTO E QUANDO FOR INGLÃŠS/ESPANHOL SERÃ O H1 E O H2-->
            <!--h1>QUEM E O </h1>
            <h2>PIRADINHO<span>?</span></h2-->
            <img src="<?=APP_JS_PREFIX?>images/quem-e-o-piradinho.png" />
        </div>
        <div class="see-also">
            <div class="alignContent">
                <div class="text">
                    <div>
                        <p>{Piradinho nasceu numa famí­lia comum e desde cedo se mostrava muito curioso e disposto a aprender coisas novas, a entender como as coisas funcionam.}</p>
                        <p>{Seus pais sempre lhe incentivam a brincar, inventar, experimentar.}</p>
                    </div>

                    <div>
                        <p>{Ás vezes, ele é meio atrapalhado, nem sempre suas ideias dão certo, mas o importante é que ele continua tentando, ele nunca desiste.}</p>
                        <p>{Com seu uniforme espacial, ele está pronto para qualquer aventura e/ou experimento.}</p>
                    </div>
                </div>

                <?php
                if(!empty($this->seeMore)){
                  $produtos = $this->seeMore->getConteudos("PROD", 4);
                  $prods = array();
                  foreach($produtos as $prod){
                    if($prod->CNT_ID != $this->produto->CNT_ID && count($prods) <= 2){
                      $prods[] = $prod;
                    }
                  }
                  if(count($prods) > 0){
                ?>
                <h1 class="txtCenter"><img src="<?=APP_JS_PREFIX?>images/veja-tambem.png" /></h1>
                <ul>
                  <?php
                  $i = 0;
                    foreach($produtos as $prod){
                      if($i >= 2){
                        break;
                      }
                      if($prod->CNT_ID != $this->produto->CNT_ID){

                      $img = $prod->getCNTFTO();
                      if(!empty($img)){
                        $fto = $img->getFile();
                      }
                      if(!empty($fto)){ ?>
                    <li><a href="<?php echo($prod->getUrl()); ?>"><img src="<?php echo($fto->getFormat("250x380")); ?>" width="200"></a></li>
                  <?php $i++; } } } ?>
                </ul>
                <?php } ?>
                <?php } ?>
            </div>
        </div>

        <div class="alignContent">
            <div class="boxSettings">
                <nav>
                    <a href="" class="star"></a>
                    <a href="" class="emailto"></a>
                    <a href="" class="print"></a>
                </nav>
                <?php $this->insertBlock("home", "share"); ?>
            </div>
        </div>

    </div>

    <?php
		$this->insertBlock("home", "outrosProdutos", array("produto" => $this->produto));
    ?>

</section>
<!--  /Content -->
