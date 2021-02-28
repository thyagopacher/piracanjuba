<?php if(!empty($this->itens)): ?>
<!-- News not Published -->
<div id="notPublishedNews" class="box">
	<h3>{Not Published} Enquete</h3>
	<div>
		<table>
			<tbody>
				<?php foreach($this->itens as $item): ?>
				<tr>
					<td><a href="#"><?php echo($item->getName()); ?></a></td>
					<!--td class="rightTxt"><a href="#">< ?php echo(date("d/m/Y H:i", strtotime($item->getCNTDTA()))); ?></a></td-->
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
<!-- /News not Published -->
<?php endif; ?>