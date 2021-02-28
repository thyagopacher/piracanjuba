<ul class="bar">
    <li>
      <a href="" class="search"></a>
      <form action="/busca" method="GET" class="searchAll">
        <input type="text" name="q" placeholder="Buscar no site" />
        <button type="submit" ></button>
      </form>
    </li>
    <?php if(!empty($this->redes[0])){ ?>
    <li>
      <a href="" class="share"></a>
      <nav class="social">
        <?php foreach($this->redes as $rede){?>
        <a href="<?php echo($rede->DTQ_LNK); ?>" target="_blank" class="<?php echo(Slugfy($rede->DTQ_TIT));?>"><i class="fa fa-<?php echo(Slugfy($rede->DTQ_TIT));?>"></i></a>
        <?php } ?>
        <!--<a href="" class="facebook"><i class="fa fa-facebook"></i></a>
        <a href="" class="instagram"><i class="fa fa-instagram"></i></a>
        <a href="" class="youtube"><i class="fa fa-youtube"></i></a>-->
      </nav>
    </li>
    <?php } ?>
    <li>
      <a href="" class="pt"></a>
      <nav class="lang">
        <a href="" class="en"></a>
        <a href="" class="es"></a>
      </nav>
    </li>
</ul>
