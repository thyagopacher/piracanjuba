<section id="insideContent">
    <div class="alignContent">
        <div class="releaseSearch">
            <form action="" method="POST">
                <input name="releaseSearch" type="text" placeholder="{FACA_SUA_BUSCA_DIGITANDO_AQUI}"/>
                <button name="releaseSubmit" type="submit"></button>
            </form>
        </div>

        <ul class="releaseList">


            <?php

            if (!empty($this->releases[0])) {
                foreach ($this->releases as $release) {
                    ?>
                    <li>
                        <div class="releaseDate">
                          <h2><?php echo(date("d", strtotime($release->CNT_DTA))); ?></h2>
                          <p>{Month: <?php echo(date("m", strtotime($release->CNT_DTA))); ?>}</p>
                          <span><?php echo(date("Y", strtotime($release->CNT_DTA))); ?></span>
                        </div>
                        <div class="releaseDescription">
                            <h3><?= $release->CNT_TIT ?></h3>
                            <p><?= $release->CNT_RES ?></p>
                            <div class="releaseMore close">
                                <div class="txtLeft">
                                    <?= $release->CNT_TXT ?>
                                    <p><span>Fonte: <a href=""><?= $release->CNT_OLH ?></a></span></p>
                                </div>

                                <div class="txtLeft">
                                    <div class="boxSettings">
                                        <nav>
                                            <a href="" class="star"></a>
                                            <?php
                        										$links = $release->getLinks();
                        										if(!empty($links[0])){
                        											$lnk = $links[0];
                        										?>
                        										<a href="<?php echo($lnk->getLNKLNK()); ?>" target="_blank" class="save"></a>
                        										<?php } ?>
                                            <a href="" class="emailto"></a>
                                            <a href="<?php echo($this->site->PDT_URL); ?>a-piracanjuba/releases/<?php echo(Slugfy2($release->CNT_TIT)); ?>-<?php echo(Slugfy2($release->CNT_ID)); ?>" target="_blank" class="print"></a>
                                        </nav>
                                        <?php $this->insertBlock("home", "share"); ?>
                                    </div>
                                </div>
                                <a href="" class="buttonMore"></a>
                            </div>
                        </div>
                    </li>
                <?php }
            } ?>
        </ul>


        <?php $this->includePartial("default", "pagination"); ?>


    </div>

    <?php $this->insertBlock("home", "rodapeImprensa"); ?>
</section>
