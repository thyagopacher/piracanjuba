
<section id="insideContent">
	<div class="alignContent">
		<?php if(!empty($this->releases[0])){?>
		<ul class="releaseList">
			<?php
			foreach($this->releases as $release){
				?>
				<li>
					<div class="releaseDate">
						<h2><?php echo(date("d", strtotime($release->CNT_DTA))); ?></h2>
						<p>{Month: <?php echo(date("m", strtotime($release->CNT_DTA))); ?>}</p>
						<span><?php echo(date("Y", strtotime($release->CNT_DTA))); ?></span>
					</div>
					<div class="releaseDescription">
						<h3><?=$release->CNT_TIT?></h3>
						<p><?=$release->CNT_RES?></p>
						<div class="releaseMore">
							<div class="txtLeft">
								<?=$release->CNT_TXT?>
							</div>
							<p><span>{Fonte} <a href=""><?=$release->CNT_OLH?></a></span></p>
						</div>
					</div>
				</li>
			<?php } ?>
		</ul>

		<?php } ?>
	</div>
	<?php $this->insertBlock("home", "rodapeImprensa"); ?>
</section>
<style>
	 .home.red .insideWaves { height: 127px !important;  }
	.releaseList > li { border-bottom: 0; }
</style>
