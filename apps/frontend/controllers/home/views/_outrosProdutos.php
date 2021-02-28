
<!--  Products Carousel -->
<section id="productCarousel">
    <div class="alignContent slider">
        <a href="" class="prev"></a>
        <div class="mask">
            <ul class="item">

                <?php
                foreach($this->outrosProdutos as $prod){

                    $foto = $prod->getCNTFTO();
                    if(!empty($foto)){

                        if($prod->CNT_ID == $this->produto->CNT_ID){
                            $active = "active";
                        }else{
                            $active ="";
                        }

                        $img = $prod->getCNTFTO();
                        if($img){
                          $file = $img->getFile();
                        }
                        if(!empty($file)){?>
                          <li class="<?=$active?>">
                            <a href="<?php echo($prod->getUrl()); ?>">
                              <img src="<?=$file->getFormat("250x380");?>" alt="<?php echo($prod->getCNTTIT()); ?>" />
                            </a>
                          </li>
                        <?php
                      }
                    }
                }
                ?>

            </ul>
        </div>
        <a href="" class="next"></a>
    </div>
</section>
