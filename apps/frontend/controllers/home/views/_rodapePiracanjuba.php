<?php
if(empty($this->layoutVars['semrodape'])){?>

<footer class="waves">
    <div class="alignContent">
        <ul id="footerMenu" class="columns">
            <li class="submenu">
                <a href="<?php echo($this->site->PDT_URL); ?>/a-piracanjuba/quem-somos"><span>{A_Piracanjuba}</span></a>
                <ul class="submenu">
                    <?php if(!empty($this->links_rodape1[0])){?>
                    <?php foreach($this->links_rodape1 as $link){
                        ?>
                        <li><a href="<?=$link->DTQ_LNK?>"><?=$link->DTQ_TIT?></a></li>
                    <?
                    }?>
                    <?php } ?>


                </ul>
            </li>
            <li class="submenu">
                <a href="<?php echo($this->site->PDT_URL); ?>produtos"><span>{Produtos}</span></a>
                <ul class="submenu">
                    <?php if(!empty($this->links_rodape2[0])){?>
                    <?php foreach($this->links_rodape2 as $link){
                        ?>
                        <li><a href="<?=$link->DTQ_LNK?>"><?=$link->DTQ_TIT?></a></li>
                        <?
                    }?>
                    <?php } ?>


                </ul>
            </li>
            <li class="submenu">
                <a href="<?php echo($this->site->PDT_URL); ?>receitas"><span>{RECEIPTS}</span></a>
                <ul class="submenu">
                    <?php if(!empty($this->links_rodape3[0])){?>
                    <?php foreach($this->links_rodape3 as $link){
                        ?>
                        <li><a href="<?=$link->DTQ_LNK?>"><?=$link->DTQ_TIT?></a></li>
                        <?
                    }?>
                    <?php } ?>


                </ul>
            </li>
            <li class="submenu">
                <a href="<?php echo($this->site->PDT_URL); ?>dicas-de-nutricao"><span>{Dicas_de_nutricao}</span></a>
                <ul class="submenu">
                    <ul class="submenu">
                        <?php if(!empty($this->links_rodape4[0])){?>
                        <?php foreach($this->links_rodape4 as $link){
                            ?>
                            <li><a href="<?=$link->DTQ_LNK?>"><?=$link->DTQ_TIT?></a></li>
                            <?
                        }?>
                        <?php } ?>


                    </ul>
                </ul>
            </li>
            <li class="submenu">
                <a href="<?php echo($this->site->PDT_URL); ?>produtor-de-leite/politica-leiteira"><span>{Produtor_de_leite}</span></a>
                <ul class="submenu">
                    <ul class="submenu">
                        <?php if(!empty($this->links_rodape5[0])){?>
                        <?php foreach($this->links_rodape5 as $link){
                            ?>
                            <li><a href="<?=$link->DTQ_LNK?>"><?=$link->DTQ_TIT?></a></li>
                            <?
                        }?>
                        <?php } ?>


                    </ul>
                </ul>
            </li>
            <li class="submenu">
                <a href="<?php echo($this->site->PDT_URL); ?>fale-conosco"><span>{Fale conosco}</span></a>
                <ul class="submenu">
                    <ul class="submenu">
                      <?php if(!empty($this->links_rodape6[0])){?>
                        <?php foreach($this->links_rodape6 as $link){
                            ?>
                            <li><a href="<?=$link->DTQ_LNK?>"><?=$link->DTQ_TIT?></a></li>
                            <?
                        }?>
                        <?php } ?>


                    </ul>
                </ul>
            </li>
        </ul>

    </div>
    </div>
</footer>
<?php } ?>
<footer id="copyright">
    <div class="alignContent">
        <p class="developed">Desenvolvido por <a target="_blank" href="http://www.containerdigital.com.br" id="developerLgo">Container Digital</a></p>
        <p>Copyright <?php echo(date("Y")); ?>&copy; - Todos os direitos reservados.</p>
    </div>
</footer>
