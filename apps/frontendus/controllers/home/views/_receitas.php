<?php
if(!empty($this->receita)){
    ?>
    <div class="productRecipe">
        <div class="recipeSlider">
            <ul>
                <li style="background-image: url('<?=$this->receita->getCNTFTO()->getFile()->getPath2();?>');">
                    <div class="alignContent">
                        <h3 class="hBlock"><a href=""><?=$this->receita->CNT_TIT?></a></h3>
                    </div>
                </li>
            </ul>
        </div>
        <div class="recipeBlock">
            <div class="alignContent">
                <div class="dBlock">
                    <h3 class="recipe"><a href="<?=$this->conteudo->DTQ_LNK?>"><?=$this->conteudo->DTQ_TIT?></a></h3>
                    <p><a href="<?=$this->conteudo->DTQ_LNK?>"><?=$this->conteudo->DTQ_CNL?></a></p>
                    <a href="<?=$this->conteudo->DTQ_LNK?>" class="button">{Veja_Todas}</a>
                </div>
            </div>
        </div>
    </div>

<?php
}
?>
