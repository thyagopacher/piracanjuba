<!--  Content -->
<section id="insideContent">
    <div class="description">
        <div class="alignContent">
            <div class="calories">
                <p>Calorias</p>
                <p><?= $this->receita->CNT_CKY ?></p>
            </div>
            <div class="yield">
                <p>Rendimento</p>
                <p><?= $this->receita->CNT_RDT ?></p>
            </div>
            <div class="time">
                <p>Tempo de preparo</p>
                <p><?= $this->receita->CNT_OLH ?></p>
            </div>
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
                <h2 class="txtCenter">Produtos utilizados nesta dica</h2>
                <ul>
                    <?php
                    foreach($this->produtos as $produto) {
                        //$produto->getCNTFTO()->getFile()->getPath();
                        ?>
                    <li>
                        <p><a href=">"><?=$produto->CNT_OLH?></a></p>
                        <a href=""><img src="" width="120"
                                        height="130"></a>
                    </li>

                    <?php
                    }
                    ?>

                </ul>
            </div>
            <?php
        }
        ?>

    </div>
    <div class="chefTips txtCenter">
        <div class="alignChefTips">
            <h2>{Dicas_do_chef}</h2>
            <p>Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo
                utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os
                embaralhou para fazer um livro de modelos de tipos</p>
        </div>
    </div>

    <div class="alignContent">
        <div class="boxSettings">
            <nav>
                <a href="" class="star"></a>
                <a href="" class="down"></a>
                <a href="" class="emailto"></a>
                <a href="" class="print"></a>
            </nav>
            <div class="shareNote">
                <p>Compartilhe</p>
                <nav>
                    <a href="" class="fa fa-facebook"></a>
                    <a href="" class="fa fa-twitter"></a>
                    <a href="" class="fa fa-google-plus"></a>
                </nav>
            </div>
        </div>
    </div>
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