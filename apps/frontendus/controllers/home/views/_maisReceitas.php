<!--  More Tips -->
<div class="moreTips">
    <h2 class="txtCenter">{Mais_Receitas}</h2>
    <div class="alignContent">
        <div class="tipsSearch">
            <form action="<?php echo($this->site->PDT_URL); ?>receitas" method="post">
                <div>
                    <input name="titulo_dica" type="text" placeholder="{Busca em Receitas}"/>
                    <button name="tipsSubmit" type="submit"></button>
                </div>
                <label for="category" class="lblSel" title="Selecione uma categoria">
                    <select id="category" class="selectchange subSelect" name="category">
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
              $fto = $content->getCNTFTO()->getFile();
              $cats = $content->getCategorias();
              $cat = null;
              if(!empty($cats[0])){
                  $cat = $cats[0];
              }

          ?>
            <div class="box" style="background-image: url('<?php echo($fto->getPath2()); ?>');">
                <div class="bgHover"><a href=""></a></div>
                <div class="description">
                    <a href="<?php echo($content->getURL()); ?>" class="button">Ver Mais</a>
                    <p><a href="<?php echo($content->getURL()); ?>"><?php echo($content->getCNTTIT()); ?></a></p>
                    <?php if(!empty($cat)){ ?>
                      <p><span>
                      <a href="<?php echo($content->getURL()); ?>">
                      <?php echo($cat->getCATNOM()); ?>
                      </a>
                    </span></p>
                    <?php } ?>
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
    <div class="txtCenter"><a href="<?=$this->site->PDT_URL?>receitas" class="button">{Ver Todas}</a></div>
</div>
