<div id="skrollr-body">
  <section id="insideContent">
    <?php
      $first = $this->conteudo[0];
      $bg = "";
      if($first->getCNTFTO()){
        $photo = $first->getCNTFTO()->getFile();
        $bg = $photo->getPath2();
      }

    if(empty($bg)){
        $bg = "images/_imgMedia.jpg";
    }

      $this->conteudo = array_slice($this->conteudo, 1);
    ?>

    <div class="intro" id="item-0">
        <div class="alignContent">
            <div class='txtCenter'>
                <h1><?php echo($first->getCNTTIT()); ?></h1>
                <div class="line"></div>
                <h3><?php echo($first->getCNTTXT()); ?></h3>
                <a href="#item-1" class="arrow-down skrollrCont"></a>
            </div>
        </div>
        <div class="showImage" style="background-image: url(<?php echo($bg); ?>);" ></div>
    </div>
    <div class="milkwayList">
        <ul>
            <?php
            $i = 1;
            $total = count($this->conteudo);
            foreach($this->conteudo as $content){
              $bg = "";
              if($content->getCNTFTO()){
                $photo = $content->getCNTFTO()->getFile();
                $bg = $photo->getPath2();

              }

              ?>

            <li id="item-<?php echo($i); ?>" data-500-top-top="backgroundColor: rgb(22, 89, 85)" data-300-top-top="backgroundColor: rgb(0, 170, 158)">
                <div class="photo" style="background-image: url('<?php echo($bg); ?>');" data-500-top-top="background-position: -100vw 0; opacity: 0" data-300-top-top="background-position: 0vw 0; opacity: 1">
                    <a href="" class="step txtCenter">
                        <h4>{PASSO}</h4>
                        <h1><?php echo(($i < 10)?"0".$i:$i); ?></h1>
                    </a>
                </div>
                <div class="description">
                    <div class="prev skrollrCont"  data-450-top-top="opacity: 0" data-250-top-top="opacity: 1">
                        <a href="#item-<?php echo($i-1); ?>" class="arrow-up"></a>
                    </div>
                    <div data-bottom-center="opacity: 0" data-400-top-top="opacity: 1" class="txtCenter">
                        <h3><?=$content->CNT_TIT?></h3>
                        <?=$content->CNT_TXT?>
                    </div>
                    <?php if($i+1 <= $total){ ?>
                    <div class="next skrollrCont" data-300-top-top="opacity: 0" data-550-top-top="opacity: 1">
                        <a href="#item-<?php echo($i+1); ?>" class="arrow-down"></a>
                    </div>
                    <?php } ?>
                </div>
            </li>
            <?php $i++; } ?>

        </ul>
    </div>
  </section>
</div>
