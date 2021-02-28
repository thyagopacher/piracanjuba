<!--  Content -->
<section id="insideContent">
    <div class="description">
        <div class="alignContent">
          <?php if(!empty($this->receita->CNT_CKY)){ ?>
            <div class="calories">
                <p>{Calorias}</p>
                <p><?= $this->receita->CNT_CKY ?></p>
            </div>
            <?php } ?>
            <?php if(!empty($this->receita->CNT_RDT)){ ?>
            <div class="yield">
                <p>{Rendimento}</p>
                <p><?= $this->receita->CNT_RDT ?></p>
            </div>
            <?php } ?>
            <?php if(!empty($this->receita->CNT_OLH)){ ?>
            <div class="time">
                <p>{Tempo_de_preparo}</p>
                <p><?= $this->receita->CNT_OLH ?></p>
            </div>
            <?php } ?>
        </div>
    </div>
    <div class="alignContent">
        <?php if(!empty($this->receita->CNT_TXT)){ ?>
        <div class="txtBox">
            <h2>{Ingredientes}</h2>
            <?= $this->receita->CNT_TXT ?>
        </div>
        <?php } ?>
        <?php if(!empty($this->receita->CNT_EMB)){ ?>
        <div class="txtBox">
            <h2>{Modo de preparo}</h2>
            <?= $this->receita->CNT_EMB ?>
        </div>
        <?php } ?>

        <?php
        if (!empty($this->produtos[0])) {
            ?>

            <div class="tipsProducts">
                <h2 class="txtCenter">{Produtos utilizados nesta receita}</h2>
                <ul>
                    <?php
                    foreach($this->produtos as $produto) {
                        //$produto->getCNTFTO()->getFile()->getPath();
                        $fto = $produto->getCNTFTO();
                        if($fto){
                          $file = $fto->getFile();
                          $img = $file->getFormat("250x380");
                        }
                        if(!empty($img)){ ?>
                          <li>
                              <p><a href="<?php echo($produto->getUrl()); ?>"><?=$produto->CNT_TIT?></a></p>
                              <a href="<?php echo($produto->getUrl()); ?>"><img src="<?=$img;?>" width="120" /></a>
                          </li>
                        <?php
                          }

                    }
                    ?>

                </ul>
            </div>
            <?php
        }
        ?>

    </div>
    <?php if(!empty($this->receita->CNT_RES)){
        ?>
        <div class="chefTips txtCenter">
            <div class="alignChefTips">
                <h2>{Dicas_do_chef}</h2>
                <?=$this->receita->CNT_RES?>
            </div>
        </div>

    <?php

    }?>


    <div class="alignContent">
        <div class="boxSettings">
            <nav>
                <a href="" class="star"></a>
                <a href="" class="emailto"></a>
                <a href="/receita-impressao/<?=Slugfy2($this->receita->CNT_TIT)."-".$this->receita->CNT_ID?>" class="print" target="_blank"></a>
            </nav>
            <div class="shareNote">
                <p>{Compartilhe}</p>
                <nav>
                    <a href="http://www.facebook.com/sharer.php?u=<?=$this->receita->getUrl();?>" target="_blank" class="fa fa-facebook"></a>
                    <a href="https://twitter.com/intent/tweet?via=Piracanjuba&url=<?=$this->receita->getUrl();?>" target="_blank" class="fa fa-twitter"></a>
                    <a href="https://plus.google.com/share?url=<?=$this->receita->getUrl();?>" target="_blank" class="fa fa-google-plus"></a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!--  /Content -->


<?php $this->insertBlock("home", "maisReceitas"); ?>

</div>
<!--  /More Tips -->
