<?php
@header("Content-type: text/html; charset=iso-8859-1");
/*echo "<pre>";
print_r($this->tabela);
echo "</pre>";*/
if(!empty($this->tabela[0])){
?>
<div class="nutritionTable">
	<a href="" class="produto"><img src="<?=$this->produto->getCNTFTO()->getFile()->getFormat("250x380");?>" width="180" /></a>
	<table border="0" cellpadding="0" cellspacing="0" >
		<thead>
		<tr>
			<th colspan="3"><?php echo($this->produto->CNT_CAT); ?></th>
		</tr>
		<tr>
			<th colspan="2">{QTD_PORCAO}</th>
			<th>{%VD(*)}</th>
		</tr>
		</thead>
		<tbody>


		<?php
		foreach($this->tabela as $linha){
			?>
			<tr>
				<td><?=htmlentities($linha->valor_energetico)?></td>
				<td><?=htmlentities($linha->quantidade_porcao)?></td>
				<td><?=htmlentities($linha->porcentagem_por_porcao)?></td>
			</tr>
		<?php
		}
		?>

		</tbody>
	</table>
	<div class="description">
		<?=htmlentities($this->produto->CNT_CHV)?>
		<?=($this->produto->CNT_EMB)?>
	</div>

</div>
<div class="alert">
	<?php echo($this->produto->CNT_RES); ?>
</div>
</div>
<?php } 	?>
