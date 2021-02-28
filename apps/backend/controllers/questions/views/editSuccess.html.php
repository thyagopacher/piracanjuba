<div class="formEdit">
	<form action="<?php echo($_SERVER['REDIRECT_URL']); ?>?ID=<?php echo($this->ID); ?>" method="post">
		<input type="hidden" name="message[MSG_ID]" value="<?php echo($this->msg->getMSGID()); ?>" />
		<input type="hidden" name="message[MSG_IPR]" value="<?php echo($this->msg->getMSGIPR()); ?>" />
		<input type="hidden" name="message[MSG_CNT]" value="<?php echo($this->msg->getMSGCNT()); ?>" />
		<label for="msg_nom">{Name}</label><input type="text" name="message[MSG_NOM]" id="msg_nom" value="<?php echo($this->msg->getMSGNOM()); ?>"/>
		<label for="msg_ema">{Email}</label><input type="text" name="message[MSG_EMA]" id="msg_ema" value="<?php echo($this->msg->getMSGEMA()); ?>"/>
		<label for="msg_tit">{Title}</label><input type="text" name="message[MSG_TIT]" id="msg_tit" value="<?php echo($this->msg->getMSGTIT()); ?>"/><br />
		<label for="msg_txt">{Text}</label><br />
		<textarea name="message[MSG_TXT]"><?php echo($this->msg->getMSGTXT()); ?></textarea>
		<input type="hidden" name="message[MSG_STS]" value="<?php echo($this->msg->getMSGSTS()); ?>" />
		<input type="hidden" name="message[MSG_DTA]" value="<?php echo($this->msg->getMSGDTA()); ?>" />
		<input type="reset" value="{Clean}" class="alignLeft"><input type="submit" value="{Submit}" class="alignRight" />
	</form>
</div>