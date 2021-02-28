<?php if(!empty($this->itens[0])): ?>
<!-- News not Published -->
<div id="notPublishedNews" class="box">
	<h3>{Not Published News}</h3>
	<div>
		<table>
			<tbody>
				<?php foreach($this->itens as $item): ?>
				<tr>
					<td><a href="#"><?php echo($item->getCNTTIT()); ?></a></td>
					<td class="rightTxt"><a href="#"><?php echo(date("d/m/Y H:i", strtotime($item->getCNTDTA()))); ?></a></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
<!-- /News not Published -->
<?php endif; ?>