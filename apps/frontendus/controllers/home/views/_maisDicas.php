<!--  More Tips -->
<div class="moreTips">
    <h2 class="txtCenter">{Mais_Dicas_de_Nutricao}</h2>
    <div class="alignContent">
        <div class="tipsSearch">
            <form action="<?php echo($this->site->PDT_URL); ?>/dicas-de-nutricao" method="post">
                <div>
                    <input name="titulo_dica" type="text" placeholder="{Busca em Dicas}"/>
                    <button name="tipsSubmit" type="submit"></button>
                </div>
                <label for="category" class="lblSel" title="Selecione uma categoria">
                    <select id="category" class="selectchange" name="category">
                        <option value="">{Selecione uma categoria}</option>
                        <?php if(!empty($this->categorias[0])){ ?>
                          <?php foreach($this->categorias as $cat) { ?>
                            <option value="<?php echo($cat->CAT_ID); ?>"><?php echo($cat->CAT_NOM); ?></option>
                          <?php } ?>
                        <?php } ?>
                    </select>
                </label>
            </form>
        </div>
    </div>

    <div class="tipsrecipesList">

        <div>
          <?php
          $i = 0;
          if(!empty($this->maisDicas[0])){
            foreach($this->maisDicas as $content){
              $fto = $content->getCNTFTO();

          ?>
            <div class="box" style="background-image: url('<?= $fto->getFile()->getPath2(); ?>');">
                <div class="bgHover"><a href=""></a></div>
                <div class="description">
                    <a href="<?php echo($content->getURL()); ?>" class="button">Ver Mais</a>
                    <p><a href="<?php echo($content->getURL()); ?>"><?php echo($content->getCNTTIT()); ?></a></p>
                    <p><span>
                      <a href="<?php echo($content->getURL()); ?>">
                      <?php echo(date("d", strtotime($content->CNT_DTA)));?> {Month: <?php echo(date("m", strtotime($content->CNT_DTA))); ?>}
                      </a>
                    </span></p>
                </div>
            </div>
            <?php if($i==0){ ?>
              </div>
              <div>
            <?php } ?>
        <?php
        $i++;
          }
        } ?>
        </div>
    </div>
    <div class="txtCenter"><a href="<?=$this->site->PDT_URL?>/dicas-de-nutricao" class="button">{Ver Todas}</a></div>
</div>
