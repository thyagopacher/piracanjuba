
<!--  Receitas -->
<section id="recipes">
    <div class="alignContent">
        <h2 class="txtCenter">Receitas</h2>
        <ul class="blockRecipes">

            <?php foreach($this->receitasHome as $receita){
                $bg = "";

                $fto = $receita->getCNTFTO();
                if(!empty($fto)){
                  $file = $fto->getFile();

                  $bg = $file->getFormat("542x350");
                }

                ?>

                <li class="recipe">
                    <div class="imgRecipe"><a href="receitas/<?=Slugfy2($receita->CNT_TIT)."-".$receita->CNT_ID?>"><?php if(!empty($bg)){?><img src="<?=$bg;?>" width="542" height="350" /><?php }?></a></div>
                    <div class="recipeBlock">
                        <h3><a href="receitas/<?=Slugfy2($receita->CNT_TIT)."-".$receita->CNT_ID?>"><?=$receita->CNT_TIT?></a></h3>
                        <p><a href="receitas/<?=Slugfy2($receita->CNT_TIT)."-".$receita->CNT_ID?>"><?=$receita->CNT_RES?></a></p>
                        <ul class="recipeSpecs">
                            <li class="yield">
                                <h4>Rendimento</h4>
                                <p><?=$receita->CNT_RDT?></p>
                            </li>

                            <li class="prepTime">
                                <h4>Tempo de preparo</h4>
                                <p><?=$receita->CNT_OLH?></p>
                            </li>
                        </ul>
                    </div>
                </li>
            <?php } ?>
        </ul>
        <div class="txtCenter">
            <a href="/receitas" class="button">Veja Todas</a>
        </div>
    </div>
</section>
<!--  /Receitas -->
