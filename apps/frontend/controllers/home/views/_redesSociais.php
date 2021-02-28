<section id="socialNetworks">
    <div class="alignContent">
        <h1 class="txtCenter">{Siga nossas redes sociais}</h1>
        <div class="blocksRedes">

            <?php
            foreach($this->redes as $rede){
                $foto = $rede->getDTQFTO()->getFile()->getPath();
                ?>
                <div id="<?=$rede->DTQ_CNL?>" class="block" style="background-image: url(<?=!empty($foto) ? $foto : ""  ;?>);">
                  <a href="<?=$rede->DTQ_LNK?>" class="linkImg"></a>
                    <p class="netLogo"><a href="<?=$rede->DTQ_LNK?>" class="social-network" target="_blank"><span class="<?=$rede->DTQ_LTX?>"></span></a></p>
                    <p class="countNumber"><a href="<?=$rede->DTQ_LNK?>"><?=$rede->DTQ_LN2?></a></p>
                    <p class="networkName"><a href="<?=$rede->DTQ_LNK?>"><?=$rede->DTQ_TIT?></a></p>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    </div>
</section>
