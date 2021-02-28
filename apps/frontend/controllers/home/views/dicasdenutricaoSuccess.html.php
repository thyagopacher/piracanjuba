<header id="insideHeader">
    <div class="insideWaves">
        <div class="insideTop">
            <h2>{Dicas_de_nutricao}</h2>
            <p class="topSlogan">{WE_LOVE_DO_THE_BEST}</p>
            <p class="breadCrumb"><strong>{YOU_ARE_HERE}:</strong>  <a href="#">{Pagina_Principal}</a> / <a href="#">{Dicas_de_nutricao}</a></p>
        </div>

        <?php if(!empty($this->dicas)){ ?>
          <div class="tipsSlider alignContent slider">
              <a href="" class="prev"></a>
              <div class="mask">
              <ul class="item">
                  <li>
                  <?php
                  $i= 0;
                  foreach($this->dicas as $dica){


                    $fto = $dica->getDTQFTO();
                    if(!empty($fto)){
                      $file = $fto->getFile();
                      if($file){
                        $bg = $file->getPath2();
                      }
                    }

                      ?>
                      <div class="box txtCenter" style="background-image: url('<?=$bg?>');">
                          <a href="<?=$dica->getDTQLNK();?>" class="button ">{Ver Mais}</a>
                          <div class="description">
                              <h4><a href="<?=$dica->getDTQLNK();?>"><?=$dica->DTQ_TIT?></a></h4>
                              <p><a href="<?=$dica->getDTQLNK();?>"><?php echo($dica->DTQ_CNL); ?></a></p>
                          </div>
                      </div>
                  <?php
                      $i++;
                      if($i == 5){
                          break;
                      }

                  }?>

                  </li>
              </ul>
              </div>
              <a href="" class="next"></a>
          </div>
        <?php } ?>

    </div>
</header>
<!--  /Header -->

<!--  Content -->
<section id="insideContent">
    <div class="alignContent">

        <div class="tipsSearch">
            <form action="" method="post">
                <div>
                    <input name="titulo_dica" type="text" placeholder="Busca em Dicas de Nutrição" />
                    <button name="tipsSubmit" type="submit"></button>
                </div>
                <label for="category" class="lblSel" title="Selecione uma categoria">
                    <select id="category" class="selectchange" name="category">
                        <option value="">Selecione uma categoria </option>
                        <?php if(!empty($this->categorias[0])){ ?>
                          <?php foreach($this->categorias as $cat) { ?>
                            <option value="<?php echo($cat->CAT_ID); ?>"><?php echo($cat->CAT_NOM); ?></option>
                          <?php } ?>
                        <?php } ?>
                    </select>
                </label>
            </form>
        </div>
    </div>
    <div class="tipsList">


            <?php if(!empty($this->maisDicas[0])){ ?>
              <ul>
            <?php   foreach($this->maisDicas as $dica){?>
                <li>
                    <div class="photo" style="background-image: url(<?=$dica->getCNTFTO()->getFile()->getPath2();?>);"><span><?=date("d", strtotime($dica->CNT_DTA))?><br /> {<?= "Month: ".date("m", strtotime($dica->CNT_DTA))?>}</span><a href="<?=$dica->getURL();?>" class="linkImg"></a></div>
                    <div class="description">
                        <div class="alignDescription">
                            <h3><?=$dica->CNT_TIT?></h3>
                            <?=$dica->CNT_TXT?>
                            <a href="<?=$dica->getURL();?>" class="button">{Ler mais}</a>
                        </div>
                    </div>
                </li>
            <?php } ?>
          </ul>
          <?php if(!empty($this->titulo)){
  ?>
              <div class="txtCenter"><a href="/maisDicasnutricao?titulo=<?=$this->titulo?>" class="button ajaxed" data-target=".tipsList ul" data-posFunc="pagerDoido">{Carregar mais}</a></div>
          <?php
          }else{
              ?>
              <div class="txtCenter"><a href="/maisDicasnutricao?page=1" class="button ajaxed" data-target=".tipsList ul" data-posFunc="pagerDoido">{Carregar mais}</a></div>
          <?php
          }
          ?>
            <?php } else { ?>
              <p class="txtCenter">{Nothing Found}</p>
            <?php } ?>





    </div>
</section>
