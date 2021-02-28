</header>
<style>
    #insideHeader .insideTop {
        position: static !important;

    }
</style>
<section id="insideContent">
    <h2 class="txtCenter"><?= $this->receita->CNT_TIT ?></h2>
    <div class="imgContent" >
        <img src="<?=$this->receita->getCNTFTO()->getFile()->getFormat("542x350")?>" />
    </div>
    <div class="description">
        <div class="alignContent">
          <?php if(!empty($this->receita->CNT_CKY)){ ?>
            <div class="">
                <img src="<?=APP_JS_PREFIX?>images/recipe-calories.png" />
                <p>{Calorias}</p>
                <p><?= $this->receita->CNT_CKY ?></p>
            </div>
            <?php } ?>
            <?php if(!empty($this->receita->CNT_RDT)){ ?>
            <div class="">
                <img src="<?=APP_JS_PREFIX?>images/recipe-yield.png" />
                <p>{Rendimento}</p>
                <p><?= $this->receita->CNT_RDT ?></p>
            </div>
            <?php } ?>
            <?php if(!empty($this->receita->CNT_OLH)){ ?>
            <div class="">
                <img src="<?=APP_JS_PREFIX?>images/recipe-time.png" />
                <p>{Tempo_de_preparo}</p>
                <p><?= $this->receita->CNT_OLH ?></p>
            </div>
            <?php } ?>
        </div>
    </div>
    <div class="alignContent">
        <div class="txtBox">
            <h2>Ingredientes</h2>
            <?= $this->receita->CNT_TXT ?>
        </div>
        <div class="txtBox">
            <h2>Modo de preparo</h2>
            <?= $this->receita->CNT_EMB ?>
        </div>

        <?php
        if (!empty($this->produtos)) {
            ?>

            <div class="tipsProducts">
                <h2 class="txtCenter">{Produtos_utilizados_nesta_dica}</h2>
                <ul>
                    <?php
                    foreach($this->produtos as $produto) {
                        $fto = $produto->getCNTFTO();
                        if($fto){
                            $file = $fto->getFile();
                            $img = $file->getFormat("165x165");
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
    <?php if(!empty($this->receita->CNT_RES)){?>
        <div class="chefTips txtCenter">
            <div class="alignChefTips">
                <img src="<?=APP_JS_PREFIX?>images/recipe-hat.png" />
                <h2>{Dicas_do_chef}</h2>
                <p><?=$this->receita->CNT_RES?></p>
            </div>
        </div>

    <?php } ?>

</section>
<!--  /Content -->


<!--  More Tips -->
<div class="moreTips">
    <h2 class="txtCenter">Mais Dicas de Nutrição</h2>
    <div class="alignContent">
        <div class="tipsSearch">
            <form action="" method="">
                <div>
                    <input name="tipsSearch" type="text" placeholder="Busca em Receitas"/>
                    <button name="tipsSubmit" type="submit"></button>
                </div>
                <label for="category" title="Selecione uma categoria">
                    <select id="category" class="selectchange" name="category">
                        <option value="">Selecione uma categoria</option>
                        <option value="cat1">Categoria 1</option>
                        <option value="cat2">Categoria 2</option>
                    </select>
                </label>
            </form>
        </div>
    </div>


    <div class="txtCenter"><a href="" class="button">Ver Todas</a></div>
</div>
<!--  /More Tips -->
