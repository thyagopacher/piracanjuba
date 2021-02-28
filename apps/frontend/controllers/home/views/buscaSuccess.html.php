<section id="insideContent">
    <div class="alignContent">
        <div class="releaseSearch">
            <form action="" method="GET">
                <input name="q" type="text" placeholder="{FACA_SUA_BUSCA_DIGITANDO_AQUI}"/>
                <button type="submit"></button>
            </form>
        </div>


        <?php
        if (!empty($this->content[0])) {
            ?>
            <ul class="releaseList">
                <?php
                foreach ($this->content as $result) {


                    $foto = $result->getCNTFTO();
                    if (!empty($foto)) {
                        $foto = $foto->getFile()->getPath2();

                        ?>
                        <li class="yesphoto">
                            <div class="releasePhoto"
                                 style="background: url('<?= $foto; ?>') center center no-repeat; background-size: cover;"></div>
                            <div class="releaseDescription">
                                <a href="<?= $result->getURL(); ?>"><h3><?= $result->CNT_TIT ?></h3></a>
                                <p><?= $result->CNT_TIP == "NT" ? substr($result->CNT_TXT, 0, 140) : ""; ?></p>
                            </div>
                        </li>
                    <?php } else {
                        ?>
                        <li class="yesdate">
                            <div class="releaseDate">
                                <h2><?php echo(date("d", strtotime($result->CNT_DTA))); ?></h2>
                                <p>{Month: <?php echo(date("m", strtotime($result->CNT_DTA))); ?>}</p>
                                <span><?php echo(date("Y", strtotime($result->CNT_DTA))); ?></span>
                            </div>
                            <div class="releaseDescription">
                                <a href="<?= $result->getURL(); ?>"><h3><?= $result->CNT_TIT ?></h3></a>

                            </div>
                        </li>
                        <?php
                    }

                } ?>
            </ul>
        <?php } ?>




        <?php $this->includePartial("default", "pagination"); ?>

        <!--  /Header -->

        <!--  Receitas -->


</section>

<!--
        <li class="nophoto">
            <div class="releaseDate"><h2>13</h2>
                <p>JAN</p><span>2015</span></div>
            <div class="releasePhoto"
                 style="background: url(images/_imgcomida2.jpg) center center no-repeat; background-size: cover;"></div>
            <div class="releaseDescription">
                <h3>Sem Foto - Produtos Piracanjuba chegam aos Estados Unidos</h3>
                <p>Por meio de parceria com um distribuidor norte-americano, marca será comercializada, inicialmente,
                    para o público brasileiro que vive nos EUA</p>
            </div>
        </li>
       -->
