<script>
    $(document).ready(function(){
        $(".buttonMore, .releaseMore").click(function(){
            var par = $(this).parent(".releaseMore");
            par.toggleClass("close");

            return false;
        });
    });
</script>

<section id="insideContent">

    <h3 class="txtCenter">{FIND_SUPERMARKET_IN_YOUR_REGION}</h3>
    <form action="" method="post">
        <fieldset>
            <input type="text" name="produto" id="product" placeholder="{Product}:" />
            <input type="text" name="cidade" id="city" placeholder="{City}:" />
            <input type="text" name="estado" id="estado" placeholder="{State}:" />
            <button type="submit">{Search}</button>
        </fieldset>
    </form>
    <p class="txtCenter">{Importante}: {Produto sujeito a disponibilidade nos pontos de venda}</p>

    <div class="line"></div>

    <div class="alignContent">
        <div class="ondeSearch txtCenter">
            <h4><?= $this->totalItens; ?></h4>
            <p>{Supermercados encontrados na busca}</p>
        </div>
        <ul class="ondeList">
            <?php


            if(!empty($this->representantes[0])) {
                foreach ($this->representantes as $representante) {
                  $estado = $representante->getEstado();
                  ?>

                    <li>
                        <h3><?= $representante->CNT_TIT ?></h3>
                        <p><?= $representante->CNT_EMB ?></p>
                        <p><?php echo($representante->CNT_RDT . "/" . $estado->sigla); ?></p>
                        <div>
                            <?= $representante->CNT_TXT; ?>
                        </div>
                    </li>
                    <?php
                }
            }?>
        </ul>

        <?php $this->includePartial("default", "pagination"); ?>
    </div>

</section>
<!--  /Receitas -->
