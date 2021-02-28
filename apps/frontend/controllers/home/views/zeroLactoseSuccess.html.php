<header id="insideHeader">
    <div class="insideWaves">
        <div class="insideTop">
            <div class="alignContent">
                <div style="background-image: url(images/carimbo-zero.png);"></div>
            </div>
            <h2>{Produtos}</h2>
            <p class="topSlogan">Gostamos de fazer bem o que te faz bem</p>
            <p class="breadCrumb"><strong>Voc� est� aqui:</strong>  <a href="#">P�gina Principal</a> / <a href="#">Produtos</a> / <a href="#">Zero Lactose</a></p>
        </div>
    </div>
    <div class="showImage" style="background-image: url(<?=$this->categoria->getCATFTO()->getFile()->getPath2();?>);" >
        <div class="productSlide">

            <?php
            if(!empty($this->prodMenor)){
                ?>
                <a href="<?=$this->prodMenor->getURL();?>" class="prev"></a>
                <?php
            }
            ?>
            <ul>
                <li>
                    <a href="<?=$this->produto->getURL(); ?>"><img src="<?=$this->produto->getCNTFTO()->getFile()->getFormat("250x380");?>" width="155"/></a>
                    <div class="description">
                        <h3><a href="<?=$this->produto->getURL(); ?>"><?=$this->produto->CNT_TIT?></a></h3>
                        <a href="/faq" class="button">FAQ</a>
                        <a href="<?=$this->produto->getURL()?>/informacoes-nutricionais" class="button infoNutri">{Informacoes_Nutricionais}</a>
                    </div>
                </li>
            </ul>

            <?php
            if(!empty($this->prodMaior)){
                ?>
                <a href="<?=$this->prodMaior->getURL();?>" class="next"></a>
                <?php
            }
            ?>

        </div>
    </div>
</header>


<section id="insideContent">
    <div class="alignContent">
        <h1 class="txtCenter"><?=$this->categoria->CAT_NOM?></h1>
        <div class="txtCenter">
          <?=$this->categoria->CAT_TXT?>
        </div>
    </div>
    <div class="rnnContent">
        <div class="alignContent">
            <h3 class="saibaMais">Saiba Mais</h3>
        </div>
        <?php $this->insertBlock("home", "receitas", array("produto" => $this->produto)); ?>

        <?php $this->insertBlock("home", "nutricao", array("produto" => $this->produto)); ?>

        <?php $this->insertBlock("home", "noticiasBlock", array("produto" => $this->produto)); ?>


        <?php if(!HomeController::$hasSaibaMais){ ?>
    			<script>$(".rnnContent .saibaMais").hide();</script>
    		<?php } ?>
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
    </div>
</section>



<?php
$args = array("produto" => $this->produto);
if(!empty($this->cat0)){
  $args["categoria"] = $this->cat0;
}
$this->insertBlock("home", "outrosProdutos", $args); ?>
<!--  /Products Carousel -->

<!--  Where to Find -->
<section id="mapFind">
    <div class="alignContent">
        <h1 class="txtCenter" id="whereFind">{Onde Encontrar}</h1>
        <h4 class="txtCenter">Piracanjuba Zero Lactose</h4>
        <form action="/onde-encontrar" method="post">
            <fieldset>
                <input type="text" name="produto" id="product" placeholder="Produto:" />
                <input type="text" name="cidade" id="city" placeholder="Cidade:" />
                <input type="text" name="estado" id="estado" placeholder="Estado:" />

                <button type="submit">{Search}</button>
            </fieldset>
        </form>
        <p class="txtCenter">Importante: Produto sujeito a disponibilidade nos pontos de venda</p>
    </div>
</section>
