<!--  Content -->
<section id="insideContent">
    <div class="alignContent">
        <ul class="unitList">
            <?php
            foreach($this->conteudos as $conteudo){
                ?>
                <li>
                    <a><img src="<?=$conteudo->getCNTFTO()->getFile()->getPath2();?>"></a>
                    <h1><a href=""><?=$conteudo->CNT_TIT?></a></h1>
                    <div class="description">
                        <?=$conteudo->CNT_TXT?>
                    </div>
                    <div class="representative">
                        <p>{Representante}: <?=$conteudo->CNT_EMB?></p>
                    </div>
                </li>
            <?php
            }
            ?>
        </ul>
    </div>
</section>
