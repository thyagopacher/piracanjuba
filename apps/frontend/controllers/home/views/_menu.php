<nav id="primary-menu" class="main-menu">
    <ul>
        <li><a href="<?= $this->site->PDT_URL ?>" id="brandName">Piracanjuba</a></li>
        <li class="submenu">
            <a href="/quem-somos" class="a-piracanjuba"><span>{A_Piracanjuba}</span></a>
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
    </li>
    <li class="submenu">
        <a href="/produtos" class="produtos"><span>{Produtos}</span></a>
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
                                <td><a href="/onde-encontrar" class="onde-encontrar">{Onde Encontrar}</a></td>
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
    </li>
    <li>
        <a href="/receitas" class="receitas"><span>{RECEIPTS}</span></a>
    </li>
    <li>
        <a href="/dicas-de-nutricao" class="dicas-de-nutricao"><span>{Dicas_de_nutricao}</span></a>
    </li>
    <li class="submenu">
        <a href="/qualidade-do-leite" class="produtor-de-leite"><span>{Produtor_de_leite}</span></a>
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
    </li>
    <li>
        <a href="/fale-conosco" class="fale-conosco"><span>{Fale conosco}</span></a>
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
            <a href="/quem-somos" class="quem-somos"><span>{A_Piracanjuba}</span></a>
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
    </li>
    <li class="submenu">
        <a href="/produtos" class="produtos"><span>{Produtos}</span></a>
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
                              <td><a href="/onde-encontrar" class="onde-encontrar">{Onde Encontrar}</a></td>
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
    </li>
    <li>
        <a href="/receitas" class="receitas"><span>{RECEIPTS}</span></a>
    </li>
    <li>
        <a href="/dicas-de-nutricao" class="dicas-de-nutricao"><span>{Dicas_de_nutricao}</span></a>
    </li>
    <li class="submenu">
        <a href="/qualidade-do-leite" class="produtor-de-leite"><span>{Produtor_de_leite}</span></a>
        <ul class="submenu">
            <?php
            $i = 0;
            $j = 0;
            $menuAntigo = "";
            foreach ($this->produtorLeite as $item) {

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
            ?>
        </ul>
        </ul>
    </li>
    <li>
        <a href="/fale-conosco" class="fale-conosco"><span>{Fale conosco}</span></a>
    </li>
    </ul>
</nav>
