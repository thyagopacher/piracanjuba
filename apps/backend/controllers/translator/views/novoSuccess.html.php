<div>
  <?php if(!empty($this->success)){ ?>
    <div class="message">Salvo com sucesso</div>
  <?php } ?>
  <?php if(!empty($this->error)){ ?>
    <div class="error">Erro ao salvar</div>
  <?php } ?>
  <div class="box">
    <h3 class="titleBlock">Editing: <?php echo($this->language); ?></h3>
    <div>
      <form method="post">
        <a href="#" class="addTransBtn">Add</a>
        <?php foreach($this->lines as $line){
          if(!empty($line[0])){
        ?>
        <fieldset>
          <input type="text" name="key[]" value="<?php echo($line[0]);?>" /><input type="text" name="value[]" value="<?php echo($line[1]);?>"/> <a href="#" class="removeTransBtn">x</a>
        </fieldset>
        <?php } } ?>
        <fieldset>
          <input type="text" name="key[]" /><input type="text" name="value[]" /> <a href="#" class="removeTransBtn">x</a>
        </fieldset>
        <button type="submit" name="button">Salvar</button>
      </form>
    </div>
  </div>
</div>
