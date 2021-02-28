
<?php
if(!empty($this->maisDicas[0])){
foreach($this->maisDicas as $dica){?>
    <li>
        <div class="photo" style="background-image: url(<?=$dica->getCNTFTO()->getFile()->getPath2();?>);"><span><?=date("d", strtotime($dica->CNT_DTA))?><br /> {<?= "Month: ".date("m", strtotime($dica->CNT_DTA))?>}</span></div>
        <div class="description">
            <div class="alignDescription">
                <h3><?=$dica->CNT_TIT?></h3>
                <?=$dica->CNT_TXT?>
                <a href="<?=$dica->getURL();?>" class="button">{Ler mais}</a>
            </div>
        </div>
    </li>
<?php } } else {?>
<script>
  $("a[data-target='.tipsList ul']").hide();
</script>

<?php }?>
