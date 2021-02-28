
<section id="ProductHolderHome" class="waves">
    <div class="alignContent">
        <!--  Block -->
        <div id="lineExplain" class="block">
            <h3 class="titleBlock"><?=$this->produtoPrincipal[0]->DTQ_CNL?></h3>
            <div class="bodyBlock">
                <h4><?=$this->produtoPrincipal[0]->DTQ_TIT?></h4>
                <p><a href="#"><?=$this->produtoPrincipal[0]->DTQ_TXT?></a></p>
            </div>

        </div>
        <!--  /Block -->
        <!--  Block -->
        <div id="productHolder" class="block">
            <div class="bodyBlock">
                <a href="#" class="disabled"><img src="<?=$this->produtoPrincipal[0]->getDTQFTO()->getFile()->getPath2();?>" /></a>
                <a href="<?=$this->produtoPrincipal[0]->DTQ_LNK?>" class="button"><?=$this->produtoPrincipal[0]->DTQ_LTX?></a>
            </div>
        </div>
        <!--  /Block -->
        <!--  Block -->
        <!-- <div id="testimonial" class="block">
            <h3 class="titleBlock"><?=$this->depoimentoPrincipal[0]->DTQ_CNL?></h3>
            <div class="bodyBlock">
                <h4><?=$this->depoimentoPrincipal[0]->DTQ_TIT?></h4>
                <blockquote>
                    <?=$this->depoimentoPrincipal[0]->DTQ_TXT?>
                    <footer class="author"><?=$this->depoimentoPrincipal[0]->DTQ_LN2?></footer>
                </blockquote>
            </div>
        </div>-->

        <div id="testimonial" class="block">
            <div class="bodyBlock">
                <a href="#"><img src="<?=$this->depoimentoPrincipal[0]->getDTQFTO()->getFile()->getPath2();?>" /></a>
            </div>
        </div>
        <!--  /Block -->
    </div>
</section>
