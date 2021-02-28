<nav id="primary-menu" class="main-menu">
    <ul>
        <li><a href="<?= $this->site->PDT_URL ?>" id="brandName">Piracanjuba</a></li>
        <li class="submenu">
            <a href="<?php echo($this->site->PDT_URL); ?>quem-somos" class="a-piracanjuba"><span>{A_Piracanjuba}</span></a>
            <?php if(!empty($this->aPiracanjuba[0])){ ?>
            <ul class="submenu">

                <?php
                $i = 0;
                $j = 0;
                $menuAntigo = "";
                foreach ($this->aPiracanjuba as $item) {
                    $active = (empty($item->DTQ_LNK) || $item->DTQ_LNK == "#")?"disabled":"";
                    $tgt = (empty($item->DTQ_TGT))?"_self":$item->DTQ_TGT;

                    if ($menuAntigo != $item->DTQ_CNL) {
                        $menuAntigo = $item->DTQ_CNL;
                        if ($i > 0) {
                            echo "</ul>";
                            echo "</li>";
                        }

                        echo "<li>";
                        echo '<a class="'.$active.'" target="'.$tgt.'" href="' . $item->DTQ_LNK . '">' . $item->DTQ_TIT . '</a>';
                        echo '<ul>';

                    } else {

                        echo '<li><a class="'.$active.'" target="'.$tgt.'" href="' . $item->DTQ_LNK . '">' . $item->DTQ_TIT . '</a></li>';
                    }

                    $i++;


                  }

                ?>

            </ul>
    </ul>
    <?php } ?>
    </li>
    <li class="submenu">
        <a href="<?= $this->site->PDT_URL ?>/produtos" class="produtos"><span>{Produtos}</span></a>
        <?php if(!empty($this->categorias[0])){ ?>
        <ul class="submenu">
            <li>
                <table>
                    <?php
                    $i = 0;
                    $j = 0;

                    foreach ($this->categorias as $categoria) {
                        if ($i == 0) {
                            echo "<tr>";
                        }
                        $bg = "";
                        if($this->produtos[$categoria->CAT_ID]){
                          $produto = $this->produtos[$categoria->CAT_ID];
                          $fto = $produto->getCNTFTO();
                          if(!empty($fto)){
                            $file = $fto->getFile();
                            if($file){
                              $bg = $file->getFormat("65x85");
                            }
                          }
                        } else {
                          continue;
                        }


                        ?>
                        <td><a href="<?= $this->produtos[$categoria->CAT_ID]->getURL(); ?>"><?php if(!empty($bg)){ ?><img
                                    src="<?php echo($bg); ?>"
                                    width="65" height="85"/><?php } ?>
                                <?= $categoria->CAT_NOM ?>
                            </a></td>

                        <?php

                        $i++;
                        if ($i == 4) {
                            if ($j == 0) {
                              $bg = "";
                              if(!empty($this->zeroLactose)){
                                //$produto = $this->produtos[$categoria->CAT_ID];
                                $fto = $this->zeroLactose->getCNTFTO();
                                if(!empty($fto)){
                                  $file = $fto->getFile();
                                  if($file){
                                    $bg = $file->getFormat("50x140");
                                  }
                                }
                              }

                                ?>
                                <td rowspan="2"><a href="<?= $this->zeroLactose->getURL(); ?>" class="zero-lactose">
                                        <?php if(!empty($bg)){ ?><img src="<?php echo($bg); ?>"
                                             width="50" height="140"/><?php } ?>
                                        <?= $this->categoriaZeroLactose->CAT_NOM ?>
                                    </a></td>
                                <?php
                                $j++;
                            }

                            if ($j == 2) {
                                ?>
                                <td><a href="<?php echo($this->site->PDT_URL); ?>onde-encontrar" class="onde-encontrar">{Onde Encontrar}</a></td>
                                <?php
                            }
                            echo "</tr>";
                            $i = 0;
                        }
                    }

                    ?>
                </table>
            </li>
        </ul>
        <?php } ?>
    </li>
    <?php if(APP_DEFAULT_EDITORIAL == 1){ ?>
    <li>
        <a href="<?= $this->site->PDT_URL ?>/receitas" class="receitas"><span>{RECEIPTS}</span></a>
    </li>
    <li>
        <a href="<?= $this->site->PDT_URL ?>/dicas-de-nutricao" class="dicas-de-nutricao"><span>{Dicas_de_nutricao}</span></a>
    </li>
    <?php } ?>

    <li class="submenu">
        <a href="<?php echo($this->site->PDT_URL); ?>" class="produtor-de-leite"><span>{Produtor_de_leite}</span></a>
        <?php if(!empty($this->produtorLeite[0])){ ?>
        <ul class="submenu">
            <?php
            $i = 0;
            $j = 0;
            $menuAntigo = "";

            foreach ($this->produtorLeite as $item) {
                $active = (empty($item->DTQ_LNK) || $item->DTQ_LNK == "#")?"disabled":"";
                $tgt = (empty($item->DTQ_TGT))?"_self":$item->DTQ_TGT;
                if ($menuAntigo != $item->DTQ_CNL) {
                    $menuAntigo = $item->DTQ_CNL;
                    if ($i > 0) {
                        echo "</ul>";
                        echo "</li>";
                    }


                    echo "<li>";
                    echo '<a class="'.$active.'" href="' . $item->DTQ_LNK . '" target="'.$tgt.'">' . $item->DTQ_TIT . '</a>';
                    echo '<ul>';

                } else {

                    echo '<li><a class="'.$active.'" href="' . $item->DTQ_LNK . '" target="'.$tgt.'">' . $item->DTQ_TIT . '</a></li>';
                }
                $i++;
            }

            ?>
        </ul>
        </ul>
        <?php } ?>
    </li>
    <li>
        <a href="<?= $this->site->PDT_URL ?>fale-conosco" class="fale-conosco"><span>{Fale conosco}</span></a>
    </li>


    </ul>
</nav>
<nav id="primary-menu-roll" class="main-menu-roll">
    <ul>
        <li><a href="<?= $this->site->PDT_URL ?>" id="brandName"></a></li>
        <li class="mobileMenu">
            <a href="#" class="responsiveToggle">
                <i class="fa fa-bars"></i>
                <i class="fa fa-times"></i>
            </a></li>
        <li class="submenu">
            <a href="<?php echo($this->site->PDT_URL); ?>quem-somos" class="quem-somos"><span>{A_Piracanjuba}</span></a>
            <?php if(!empty($this->aPiracanjuba[0])){ ?>
            <ul class="submenu">

                <?php
                $i = 0;
                $j = 0;
                $menuAntigo = "";

                foreach ($this->aPiracanjuba as $item) {
                  $active = (empty($item->DTQ_LNK) || $item->DTQ_LNK == "#")?"disabled":"";
                  $tgt = (empty($item->DTQ_TGT))?"_self":$item->DTQ_TGT;
                    if ($menuAntigo != $item->DTQ_CNL) {
                        $menuAntigo = $item->DTQ_CNL;
                        if ($i > 0) {
                            echo "</ul>";
                            echo "</li>";
                        }

                        echo "<li>";
                        echo '<a class="'.$active.'" target="'.$tgt.'" href="' . $item->DTQ_LNK . '">' . $item->DTQ_TIT . '</a>';
                        echo '<ul>';

                    } else {
                        echo '<li><a class="'.$active.'" target="'.$tgt.'" href="' . $item->DTQ_LNK . '">' . $item->DTQ_TIT . '</a></li>';
                    }
                    $i++;
                }

                ?>

            </ul>
    </ul>
    <?php } ?>
    </li>
    <li class="submenu">
        <a href="<?= $this->site->PDT_URL ?>/produtos" class="produtos"><span>{Produtos}</span></a>
        <?php if(!empty($this->categorias[0])){ ?>
        <ul class="submenu">
          <li>
              <table>
                  <?php
                  $i = 0;
                  $j = 0;

                  foreach ($this->categorias as $categoria) {
                      if ($i == 0) {
                          echo "<tr>";
                      }
                      $bg = "";
                      if($this->produtos[$categoria->CAT_ID]){
                        $produto = $this->produtos[$categoria->CAT_ID];
                        $fto = $produto->getCNTFTO();
                        if(!empty($fto)){
                          $file = $fto->getFile();
                          if($file){
                            $bg = $file->getFormat("65x85");
                          }
                        }
                      } else {
                        continue;
                      }



                      ?>
                      <td><a href="<?= $this->produtos[$categoria->CAT_ID]->getURL(); ?>"><?php if(!empty($bg)){ ?><img
                                  src="<?php echo($bg); ?>"
                                  width="65" height="85"/><?php } ?>
                              <?= $categoria->CAT_NOM ?>
                          </a></td>

                      <?php

                      $i++;
                      if ($i == 4) {
                          if ($j == 0) {
                            $bg = "";
                            if(!empty($this->zeroLactose)){
                              //$produto = $this->produtos[$categoria->CAT_ID];
                              $fto = $this->zeroLactose->getCNTFTO();
                              if(!empty($fto)){
                                $file = $fto->getFile();
                                if($file){
                                  $bg = $file->getFormat("50x140");
                                }
                              }
                            }
                              ?>
                              <td rowspan="2"><a href="<?= $this->zeroLactose->getURL(); ?>" class="zero-lactose">
                                      <?php if(!empty($bg)){ ?><img src="<?php echo($bg); ?>"
                                           width="50" height="140"/><?php } ?>
                                      <?= $this->categoriaZeroLactose->CAT_NOM ?>
                                  </a></td>
                              <?php
                              $j++;
                          }

                          if ($j == 2) {
                              ?>
                              <td><a href="<?= $this->site->PDT_URL ?>/onde-encontrar" class="onde-encontrar">{Onde Encontrar}</a></td>
                              <?php
                          }
                          echo "</tr>";
                          $i = 0;
                      }
                  }

                  ?>
              </table>
          </li>
        </ul>
        <?php  } ?>
    </li>
    <?php if(APP_DEFAULT_EDITORIAL == 1){ ?>
    <li>
        <a href="<?= $this->site->PDT_URL ?>/receitas" class="receitas"><span>{RECEIPTS}</span></a>
    </li>
    <li>
        <a href="<?= $this->site->PDT_URL ?>/dicas-de-nutricao" class="dicas-de-nutricao"><span>{Dicas_de_nutricao}</span></a>
    </li>
    <?php } ?>
    <li class="submenu">
        <a href="<?= $this->site->PDT_URL ?>" class="produtor-de-leite"><span>{Produtor_de_leite}</span></a>
        <?php if(!empty($this->produtorLeite[0])){ ?>
        <ul class="submenu">
            <?php
            $i = 0;
            $j = 0;
            $menuAntigo = "";
            foreach ($this->produtorLeite as $item) {
                if(!empty($this->produtorLeite[0])){
                if ($menuAntigo != $item->DTQ_CNL) {
                    $menuAntigo = $item->DTQ_CNL;
                    if ($i > 0) {
                        echo "</ul>";
                        echo "</li>";
                    }

                    echo "<li>";
                    echo '<a href="' . $item->DTQ_LNK . '">' . $item->DTQ_TIT . '</a>';
                    echo '<ul>';

                } else {
                    echo '<li><a href="' . $item->DTQ_LNK . '">' . $item->DTQ_TIT . '</a></li>';
                }
                $i++;
                }
            }
            ?>
        </ul>
        </ul>
        <?php } ?>
    </li>
    <li>
        <a href="<?= $this->site->PDT_URL ?>fale-conosco" class="fale-conosco"><span>{Fale conosco}</span></a>
    </li>
    </ul>
</nav>
<?php if(APP_DEFAULT_EDITORIAL != 1){ ?>
<style>
header #primary-menu>ul>li:nth-child(1) {
  order: 3;
}
</style>
<?php } ?>
