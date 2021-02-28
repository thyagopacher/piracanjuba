<?php if(!empty($this->dica)){
    ?>
    <div class="productNutrition">
        <div class="nutritionBg"  style="background-image: url(<?=$this->dica->getCNTFTO()->getFile()->getPath2();?>);"></div>
        <div class="nutritionBlock">
            <div class="alignContent">
                <div class="dBlock">
                    <h3 class="nutrition"><a href="<?=$this->conteudo->DTQ_LNK?>"><?=$this->conteudo->DTQ_TIT?></a></h3>
                    <p><a href="<?=$this->conteudo->DTQ_LNK?>"><?=$this->conteudo->DTQ_CNL?></a></p>
                    <a href="<?=$this->conteudo->DTQ_LNK?>" class="button">{Veja_Todas}</a>
                </div>
                <h3 class="hBlock"><a href=""><?=$this->dica->CNT_TIT?></a></h3>
            </div>
        </div>
    </div>

<?php
}
?>
