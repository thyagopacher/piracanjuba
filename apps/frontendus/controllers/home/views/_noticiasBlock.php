<?php

if(!empty($this->noticias)){
?>
<div class="productNews">
    <div class="recipeSlider">
        <ul>
            <li style="background-image: url(<?=$this->noticias->getCNTFTO()->getFile()->getPath2();?>);">
                <div class="alignContent">
                    <h3 class="hBlock"><a href=""><?=$this->noticias->CNT_TIT?></a></h3>
                </div>
            </li>
        </ul>
    </div>
    <div class="recipeBlock">
        <div class="alignContent">
            <div class="dBlock">
                <h3 class="news"><a href="<?=$this->conteudo->DTQ_LNK?>"><?=$this->conteudo->DTQ_TIT?></a></h3>
                <p><a href="<?=$this->conteudo->DTQ_LNK?>"><?=$this->conteudo->DTQ_CNL?></a></p>
                <a href="<?=$this->conteudo->DTQ_LNK?>" class="button">{Veja_Todas}</a>
            </div>
        </div>
    </div>
</div>
    <?php }
        ?>