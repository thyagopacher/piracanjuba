<div class="insideWaves">
    <div class="insideTop">
        <h2><?php echo($this->pageTitle); ?></h2>
        <p class="topSlogan"><?php if ($this->slogan) {
                echo($this->slogan);
            } else { ?>{WE_LOVE_DO_THE_BEST}<?php } ?></p>
        <?php $this->insertBlock("home", "breadcrumb", $this->breadcrumb); ?>
    </div>
</div>


<?php
if($this->heading['SHOW_IMAGE']){
if (!empty($this->heading['IMAGE'])) {
    ?>
    <div class="showImage" style="background-image: url('<?=$this->heading['IMAGE']?>');">
    <?php if (!empty($this->heading['TXT'])) { ?>
        <div class="txtCenter">
            <div class="alignContent">
                <h2><?=$this->heading['TXT']?></h2>
                <?php if(!empty($this->heading['DESC'])){ ?>
                  <p><?php echo($this->heading['DESC']); ?></p>
                <?php } ?>
                <?php if(!empty($this->heading['DESC2'])){ ?>
                  <p class="desc2"><?php echo($this->heading['DESC2']); ?></p>
                <?php } ?>
            </div>
        </div>
        <a href="" class="down-page"><i class="fa fa-angle-down" aria-hidden="true"></i></a>
    <?php } ?>
    </div>
<?php } else { ?>
    <div class="showImage" style="background-image: url('');"></div>

<?php } } ?>
