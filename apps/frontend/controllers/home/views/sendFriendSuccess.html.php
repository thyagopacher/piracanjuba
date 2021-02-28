<?php if(!empty($this->errors) && count($this->errors) >= 1){ ?>
  <ul class="error">
    <?php foreach($this->errors as $label){ ?>
      <li><?php echo($label); ?></li>
    <?php } ?>
  </ul>
<input type="text" name="name" value="<?php echo($_POST['name']); ?>" placeholder="{Seu_Nome}: ">
<input type="email" name="email" value="<?php echo($_POST['email']); ?>" placeholder="{Seu_Email}: ">
<input type="text" name="name_to" value="<?php echo($_POST['name_to']); ?>" placeholder="{Nome_do_seu_amigo}: ">
<input type="email" name="email_to" value="<?php echo($_POST['email_to']); ?>" placeholder="{Email_do_seu_amigo}: ">
<input type="hidden" name="url" value="<?php echo($_POST['url']); ?>">
<textarea name="message" placeholder="{Message}: "><?php echo($_POST['message']); ?></textarea>
<input type="submit" value="Enviar">
<?php } else { ?>
  <p>{MSG_SENDED}</p>
<?php }?>
