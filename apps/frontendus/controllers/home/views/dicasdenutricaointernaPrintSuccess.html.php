<!--  Content -->
<section id="insideContent">
    <div class="alignContent">
        <div class="imgContent"><img src="<?=$this->dica->getCNTFTO()->getFile()->getFormat("542x350")?>" /></div>
        <div class="txtContent">
            <?=$this->dica->CNT_TXT?>
            <div class="bibliography">
                <p><b>{REFERENCIAS_BIBLIOGRAFICAS}</b></p>
                <?=$this->dica->CNT_EMB?>
            </div>
        </div>

        <div class="tipsProducts">
            <h2 class="txtCenter"><?=$this->dica->CNT_EMB?></h2>
            <ul>
                <li>
                    <p><a href="">Creme de Leite Zero Lactose 200g</a></p>
                    <a href=""><img src="<?=APP_JS_PREFIX?>images/creme-de-leite.png" width="120" height="130"></a>
                </li>
                <li>
                    <p><a href="">Creme de Leite Zero Lactose 200g</a></p>
                    <a href=""><img src="<?=APP_JS_PREFIX?>images/creme-de-leite.png" width="120" height="130"></a>
                </li>
                <li>
                    <p><a href="">Creme de Leite Zero Lactose 200g</a></p>
                    <a href=""><img src="<?=APP_JS_PREFIX?>images/creme-de-leite.png" width="120" height="130"></a>
                </li>
            </ul>
        </div>
    </div>
</section>
<!--  /Content -->

<style>
    #insideHeader .insideTop {
        position: static !important;

    }
</style>