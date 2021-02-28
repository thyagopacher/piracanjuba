<?php
//header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
//header ("Pragma: no-cache");
header ("Content-type: application/x-msexcel; charset=iso-8859-1");
header ("Content-Disposition: attachment; filename=\"livro.xls\"" );
header ("Content-Description: PHP Generated Data" );
?>

<table>
	<thead>
		<tr>
			<th class="leftTxt">{Date}</th>
			<th class="leftTxt">{Name}</th>
			<th class="leftTxt">{Email}</th>
			<th class="leftTxt">{Request}</th>
			<th class="leftTxt">{Newsletter}</th>
		</tr>
	</thead>
	<tbody>
		<?php if(!empty($this->items[0])){ ?>
			<?php foreach($this->items as $item) { ?>
		<tr>
			<td><?php echo(date("d/m/Y H:i:s", strtotime($item->getMSGDTA()))); ?></td>
			<td><?php echo($item->getMSGNOM()); ?></td>
			<td><?php echo($item->getMSGEMA()); ?></td>
			<td><?php echo($item->getMSGTXT()); ?></td>
			<td><?php echo(($item->getMSGNEW() == 1)?"{Yes}":"{No}"); ?></td>
		</td>
			<?php } ?>
		<?php } ?>
	</tbody>
</table>