<!-- PublishForm -->
<div id="boxPublish" class="box">
	<h3>Estado</h3>
	<div>
	<select name="news[CNT_CKY]">
        <?php foreach($this->estados as $estado){

            if($this->estadoEscolhido == $estado->id){

                $selected = "selected";
            }else{
                $selected = "";
            }
            ?>
        <option value="<?=$estado->id;?>" <?=$selected?>><?=$estado->nome;?></option>
        <?php } ?>
    </select>
        <br /><br />
        </div>
</div>
<!-- /PublishForm -->
