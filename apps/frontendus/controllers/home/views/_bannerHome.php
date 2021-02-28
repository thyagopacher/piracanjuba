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
				<?php
				$fto = $banner->getDTQFTO();
				if(!empty($fto)){
					$img1 = $fto->getFile()->getPath2();
				}
				if(!empty($img1)){
					$fto = $banner->getDTQFTO2();
					if(!empty($fto)){
						$img2 = $fto->getFile()->getPath2();
					} else {
						$img2 = $img1;
					}
				?>
                <div class="showImage imageChanger" data-mobile="<?php echo($img2); ?>" data-desktop="<?php echo($img1); ?>" style="background-image: url(<?= $img1; ?>);">f
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
        <?php } } ?>
    </div>
    <div class="txtCenter">
        <nav class="mediaRotate cyclePager" data-target=".sliderShow">

        </nav>
    </div>
</header>
