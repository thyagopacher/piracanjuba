<script>
    $(document).ready(function(){
        $(".buttonMore, .releaseMore").click(function(){
            var par = $(this).parent(".releaseMore");
            par.toggleClass("close");

            return false;
        });
    });
</script>

<!--  Receitas -->
<section id="insideContent">
    <div class="alignContent">
        <div class="recipeBox">
            <nav>
                <a href="<?php echo($this->site->PDT_URL); ?>{receipts_url}/{todas_slug}" class="todas">{todas}</a>
                <a href="<?php echo($this->site->PDT_URL); ?>{receipts_url}/{bebidas_slug}" class="bebidas">{bebidas}</a>
                <a href="<?php echo($this->site->PDT_URL); ?>{receipts_url}/{entradas_slug}" class="entradas">{entradas}</a>
                <a href="<?php echo($this->site->PDT_URL); ?>{receipts_url}/{prato_principal_slug}" class="prato-principal">{prato_principal}</a>
                <a href="<?php echo($this->site->PDT_URL); ?>{receipts_url}/{sobremesa_slug}" class="sobremesa">{sobremesa}</a>
                <a href="<?php echo($this->site->PDT_URL); ?>{receipts_url}/{zero_lactose_slug}" class="zero-lactose">{zero_lactose}</a>
            </nav>
            <ul class="recipeList">


                <?php
                  foreach($this->receitas as $receita){
                    $cats = $receita->getCategorias();
                    if(!empty($cats[0])){
                        $cls = Slugfy($cats[0]->CAT_NOM);
                    }

                ?>
                <li class="todas <?php echo($cls); ?>">
                    <div class="recipePhoto">
                        <a href="receitas/<?=Slugfy2($receita->CNT_TIT)."-".$receita->CNT_ID?>"><img src="<?=$receita->getCNTFTO()->getFile()->getFormat("750x430");?>" width="750" height="430" /></a>
                    </div>
                    <div class="recipeDesc">
                        <h3><a href="receitas/<?=Slugfy2($receita->CNT_TIT)."-".$receita->CNT_ID?>"><?=$receita->CNT_TIT; ?></a></h3>
                        <!--<p><a href="receitas/<?=Slugfy2($receita->CNT_TIT)."-".$receita->CNT_ID?>"><? echo($receita->CNT_RES); ?></a></p>-->
                        <p class="txtCenter"><a href="receitas/<?=Slugfy2($receita->CNT_TIT)."-".$receita->CNT_ID?>" class="button">Ler mais</a></p>
                    </div>
                </li>
                <?php } ?>
            </ul>
        </div>
        <?php $this->includePartial("default", "pagination"); ?>
    </div>

</section>
<!--  /Receitas -->
