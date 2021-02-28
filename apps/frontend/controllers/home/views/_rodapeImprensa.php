  <?php if(!empty($this->imprensa[0])){
    $item = $this->imprensa[0];
  ?>
    <div class="assessoria">
      <p><strong><?php echo($item->DTQ_TIT); ?></strong></p>
      <?php echo($item->DTQ_TXT); ?>
    </div>
  <?php } ?>
