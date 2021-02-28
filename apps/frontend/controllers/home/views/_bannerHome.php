<header id="introBG">

    <div class="sliderShow">
        <?php

        $i = 1;
        foreach ($this->banners as $banner) {
            if ($i == 1) {
                $active = "active";
                $i++;
            } else {
                $active = "";
            }


            ?>
            <!--  Media -->

                <div class="showImage"
                     style="background-image: url(<?= $banner->getDTQFTO()->getFile()->getPath2(); ?>);">
                    <a href="<?= $banner->DTQ_LNK ?>"></a>
                    <?php if (!empty($banner->DTQ_TIT)) { ?>

                        <div class="alignImage">
                            <div class="txtBG txtCenter">
                                <?php if (!empty($banner->DTQ_TIT)) { ?>
                                    <h3><?php echo($banner->DTQ_TIT); ?></h3>
                                <?php } ?>
                                <?php if (!empty($banner->DTQ_TXT)) { ?>
                                    <p><?php echo(nl2br($banner->DTQ_TXT)); ?></p>
                                <?php } ?>
                            </div>
                        </div>

                    <?php } ?>
                </div>

            <!-- /Media -->
        <?php } ?>
    </div>
    <div class="txtCenter">
        <nav class="mediaRotate cyclePager" data-target=".sliderShow">

        </nav>
    </div>
</header>
