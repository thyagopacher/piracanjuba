
<section id="insideContent">
    <div class="alignContent">
        <h3 class="txtCenter">{Perguntas Frequentes}</h3>
        <div class="releaseSearch">
            <form action="" method="post">
                <input name="releaseSearch" type="text" placeholder="{Encontre sua dúvida}">
                <button name="releaseSubmit" type="submit"></button>
            </form>
        </div>
        <ul class="questionsList accordion">
          <?php if(!empty($this->conteudo[0])) { ?>
            <?php foreach ($this->conteudo as $faq) {
                ?>
                <li class="close">
                    <a href="" class="questionsMore"><p><?=$faq->CNT_TIT?></p></a>
                    <div class="description">
                        <?=$faq->CNT_TXT?>
                    </div>
                </li>
            <?php } ?>
            <?php } else { ?>
              <li><p class="txtCenter">{Nothing Found}</p></li>
            <?php } ?>
        </ul>
    </div>
</section>
